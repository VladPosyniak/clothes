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

use App\Models\PostsModel;


class likeController extends Controller
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


     protected function user($request)
    {   

        $ip=$request->ip();

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        $user = User::find($token['sub']);

        return $user;

    }

    public function like(Request $request){

    	$user=$this->user($request);

    	$post = PostsModel::find($request['idpost']);
    	$likes=$user->plus_ids;
    	$dislikes= explode(',',$user->minus_ids);


    	if(!$post){
    			return response()->json(array('idpost' => "Invalid id of post"));
    	}

	    if(array_search($request['idpost'], explode(',',$likes))!== False){
	    	return response()->json(array('like' => "cant be repeated"));
	    }

	    if(array_search($request['idpost'],$dislikes)!== False){
	    	unset($dislikes[array_search($request['idpost'],$dislikes)]);
	    	$user->minus_ids=implode(",", $dislikes);
	    	$rating=intval($post->rating)+1;
	    	$post->rating=$rating;

	    	$post->save();
	    	$user->save();

	    	return response()->json(array('like' => "done"));
	    }

    	$user->plus_ids=$likes.$request['idpost'].',';

    	$rating=intval ($post->rating)+1;
    	$post->rating=$rating;

    	$post->save();
    	$user->save();

    	return response()->json(array('dislike' => "done"));
    }

    public function dislike(Request $request){

    	$user=$this->user($request);

    	$post = PostsModel::find($request['idpost']);
    	$dislikes=$user->minus_ids;
    	$likes= explode(',',$user->plus_ids);


    	if(!$post){
    			return response()->json(array('idpost' => "Invalid id of post"));
    	}

	    if(array_search($request['idpost'], explode(',',$dislikes))!== False){
	    	return response()->json(array('dislike' => "cant be repeated"));
	    }

	    if(array_search($request['idpost'],$likes)!== False){
	    	unset($likes[array_search($request['idpost'],$likes)]);
	    	$user->plus_ids=implode(",", $likes);
	    	
	    	$rating=intval ($post->rating)-1;
	    	$post->rating=$rating;

	    	$post->save();
	    	$user->save();

	    	return response()->json(array('dislike' => "done"));
	    }

    	$user->minus_ids=$dislikes.$request['idpost'].',';

    	$rating=intval ($post->rating)-1;
    	$post->rating=$rating;

    	$post->save();
    	$user->save();

    	return response()->json(array('dislike' => "done"));
    }






}
