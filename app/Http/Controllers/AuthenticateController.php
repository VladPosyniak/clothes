<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Socialite;


class AuthenticateController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    protected function createToken($user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }

        protected function provider(Request $request, $name)
    {
        if ($request->has('redirectUri')) {
            config()->set("services.{$name}.redirect", $request->get('redirectUri'));
        }        

        $provider = \Socialite::driver($name);
        $provider->stateless();

        try {
            /** @var AbstractUser $profile */
            $profile = $provider->user();
        } catch (ClientException $e) {
            return response()->json(['message' => (string) $e->getResponse()->getBody()], 500);
        }

        $user->$name = $profile->getId();
        $user->name = $profile->getName();
        $user->avatar = $profile->getAvatar();
        $user->email = $profile->getEmail();
        $user->save();

        return response()->json(['token' => $this->createToken($user)]);
    }

     public function unlink(Request $request, $provider)
    {
        $user = User::find($request['user']['sub']);
        if (!$user)
        {
            return response()->json(['message' => 'User not found']);
        }
        $user->$provider = '';
        $user->save();
        
        return response()->json(array('token' => $this->createToken($user)));
    }




    public function authenticate(Request $request)
    {
        
    }


    public function google(Request $request)

        {

            return provider($request, "google");

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