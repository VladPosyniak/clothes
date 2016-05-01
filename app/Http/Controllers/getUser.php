<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Hash;
use Config;
use Validator;
use Firebase\JWT\JWT;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class getUser extends Controller
{
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


     public function getself(Request $request)
    {   

        $ip=$request->ip();

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        $user = User::find($token['sub']);

        return response()->json(array('name'=>$user->name,
        							  'email'=> $user->email,
        							  'rating'=> $user->rating,
        							  'new_messages'=> $user->new_messages,
        							  'new_comments'=> $user->new_comments,
        							  'avatar'=> $user->avatar,
                                      'friends'=> $user->friends
        							  ));
    }


     public function getId(Request $request)
    {   

     $user = User::find($request['id']);
     if($user){

     	return response()->json(array('name'=>$user->name,
        							  'avatar'=> $user->avatar
        							  ));

     }else{
     	return response()->json(array('id' => "Invalid"));
     }

    }

}
