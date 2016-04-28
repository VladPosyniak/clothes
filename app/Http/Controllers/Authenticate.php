<?php

namespace App\Http\Controllers;

use Hash;
use Config;
use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class Authenticate extends Controller
{

    protected function createToken($user,$ip)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60),
            'ip' =>$ip
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }

     protected function checkToken($token,$ip)
    {
        if(!preg_match("/^[a-zA-Z0-9\-_]+?\.[a-zA-Z0-9\-_]+?\.([a-zA-Z0-9\-_]+)?$/",$token)){
            return false;
        }

        try{
            $token=(array) JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

        }catch(JWTException $e){
            return false;
        }

        $user = User::find($token['sub']);
        if (!$user | $ip!=$token['ip'])
        {
            return false;
        }
        return true;

    }



     public function unlink(Request $request)
    {   
        
        $provider=$request['name'];
        $ip=$request->ip();

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        $user = User::find($token['sub']);
        $user->$provider = null;
        $user->save();
        
        return response()->json(array('status'=>'done'));
    }




    public function authenticate(Request $request)
     {

        $ip=$request->ip();
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        $user = User::where('email', '=', $request['email']);
        $user = $user->first();
        return response()->json(array('token' => $this->createToken($user,$ip)));
    }


     public function google(Request $request)
    {
        $ip=$request->ip();
        $client = new GuzzleHttp\Client();
        $params = [
            'code' => $request->input('code'),
            'client_id' => $request->input('clientId'),
            'client_secret' => Config::get('app.google_secret'),
            'redirect_uri' => $request->input('redirectUri'),
            'grant_type' => 'authorization_code',
        ];
        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
            'form_params' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);
        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://www.googleapis.com/plus/v1/people/me/openIdConnect', [
            'headers' => array('Authorization' => 'Bearer ' . $accessToken['access_token'])
        ]);
        $profile = json_decode($profileResponse->getBody(), true);
        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization'))
        {
            $user = User::where('google', '=', $profile['sub']);
            if ($user->first())
            {
                return response()->json(['message' => 'There is already a Google account that belongs to you'], 409);
            }
            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array) JWT::decode($token, Config::get('app.token_secret'), array('HS256'));
            $user = User::find($payload['sub']);

            $user->google = $profile['sub'];
            $user->displayName = $user->displayName ?: $profile['name'];
            $user->email=$user->email?:$profile['email'];
            $user->save();


            return response()->json(['token' => $this->createToken($user,$ip)]);
        }
        // Step 3b. Create a new user account or return an existing one.
        else
        {
            $user = User::where('google', '=', $profile['sub']);
            if ($user->first())
            {
                return response()->json(['token' => $this->createToken($user->first(),$ip)]);
            }

            $user = User::where('email', '=', $profile['email']);

            if(!$user->first()){
                $user = new User;
                $user->displayName = $profile['name'];
                $user->email= $profile['email'];
            }else{
                $user =$user->first();
            }

            $user->google = $profile['sub'];
            $user->save();
            return response()->json(['token' => $this->createToken($user,$ip)]);
        }
    }

}

/*

 public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    */