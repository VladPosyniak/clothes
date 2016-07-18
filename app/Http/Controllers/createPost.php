<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use File;
use Hash;
use Config;
use Validator;
use App\Tags;
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
        $user = User::find($token['sub']);


	 	$image =  array('image' =>$request->file('file'));

		$validator = Validator::make([$image], ['image' => 'required|mimes:jpeg,jpg,bmp,png']);

        if ($validator->fails()) {
	            return response()->json(['message' =>'error of type image']);
	        }

	    

	    $nameoffile=str_random(7).'.'.$image['image']->getClientOriginalExtension();
	    while(true){
			if (File::exists( '/uploads'.'/'.$nameoffile))
			{
			    $nameoffile=str_random(7).$image['image']->getClientOriginalExtension();
			}
			else{
				break;
			}
	       
		}

	    if(!$image['image']->move($destinationPath, $nameoffile)) {
	            return response()->json(['message' => 'Error saving the file.', 'code' => 400]);
	        }    


        if(!$post){

            $tags=json_decode($request['tags'],true);
            $tags_string='';

        	foreach($tags as $tag){
                if(!preg_match("/^([А-Яа-яA-Za-zыЫъЪёЁіІїЇ ]+)([,][А-Яа-яA-Za-zыЫъЪёЁіІїЇ ]+)*$/u",$tag)){
                    return response()->json(['message' =>'invalid tags']);
                }

        		$tag_db=Tags::where('name',$tag)->first();
        		if(!$tag_db){
        			$tag_new=new Tags;
        			$tag_new->name=$tag;
        			$tag_new->save();
        		}else{
        			$old_rating=$tag_db->rating;
        			$tag_db->rating=intval($old_rating)+1;
        			$tag_db->save();
        		}
                $tags_string.=','.$tag;
        	}

        	$post=new PostsModel;
	        $post->author=$token['sub'];
	        $post->title=$request['title'];
	        $post->content=$request['content'];
	        $post->tag=substr($tags_string,1);
	        $post->random_id=$request['random_id'];
	        $post->images='/uploads'.'/'.$nameoffile;

	        $posts=$user->posts;
	        $user->posts=intval($posts)+1;
        }
       	else{
	      
	        $links=$post->images;
	        $post->images=$links.",".'/uploads'.'/'.$nameoffile;

       	}
	        $photos=$user->photos;
	        $user->photos=intval($photos)+1;
	        $post->save();
	        $user->save();

	        	return response()->json(['result'=>true]);
	    }




}
