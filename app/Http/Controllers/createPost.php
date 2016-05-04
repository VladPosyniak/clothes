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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\Models\PostsModel;

class createPost extends Controller
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

	public function create(Request $request)
	    {   

        $ip=$request->ip();

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        $destinationPath = public_path() . '/uploads';

        $post=PostsModel::where('random_id',$request['random_id'])->first();



        if(!$post){

        	$post=new PostsModel;
	        $post->author=$token['sub'];
	        $post->title=$request['title'];
	        $post->content=$request['content'];

	 		$image =  $request->file('file');

	        $validator = Validator::make([$image], ['image' => 'required|mimes:jpeg,jpg,bmp,png']);
/*
	        if ($validator->fails()) {
	            return response()->json(['message' => var_dump($image), 'code' => 400]);
	        }
	        */

	        if(!$image->move($destinationPath, $image->getClientOriginalName())) {
	            return response()->json(['message' => 'Error saving the file.', 'code' => 400]);
	        }

	        $post->random_id=$request['random_id'];
	        $post->images='/uploads'.'/'.$image->getClientOriginalName();
        }
       	else{
       		

			$image =  $request->file('file');
	        $validator = Validator::make([$image], ['image' => 'required|mimes:jpeg,jpg,bmp,png']);


/*
	        if ($validator->fails()) {
	            return response()->json(['message' => var_dump($image), 'code' => 400]);
	        }
	        */
	        
	        if(!$image->move($destinationPath, $image->getClientOriginalName())) {
	            return response()->json(['message' => 'Error saving the file.', 'code' => 400]);
	        }
	        $links=$post->images;
	        $post->images=$links.",".'/uploads'.'/'.$image->getClientOriginalName();

       	}
	        $post->save();

	        	return response()->json(['result'=>true]);
	    }




}
