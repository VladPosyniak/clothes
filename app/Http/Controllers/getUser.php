<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\PostsModel;

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
        							  'new_comments'=> $user->new_comments,
        							  'avatar'=> $user->avatar
        							  ));
    }


    public function getPhotos(Request $request)

    {  

        $ip=$request->ip();
        
        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));

        $limit=7;
        $pack=$request['pack'];

        $offset=$limit*$pack;


      $query = PostsModel::where('author',$token['sub'])->orderBy('updated_at','DESC')->limit($limit)->offset($offset)->select('images')->get();

      return json_encode($query);
    }



    public function profile(Request $request)
    {   

        $ip=$request->ip();

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        $user = User::find($token['sub']);

        $id=$request['id'];


        if ( !is_numeric($id)) {
                return response()->json(['message' =>'error of type id']);
            }
        return response()->json(array('name'=>$user->name,
                                      'rating'=> $user->rating,
                                      'avatar'=> $user->avatar,
                                      'posts'=> $user->posts,
                                      'subs'=> $user->subs,
                                      'subs_self'=> $user->subs_self,
                                      'photos'=> $user->photos,
                                      'details'=> $user->details
                                      ));
                                      
    }

}
