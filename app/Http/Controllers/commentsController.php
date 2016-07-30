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

use App\CommentsModel;


class commentsController extends Controller
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

    public function createComment(Request $request){

        $ip=$request->ip();

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }

        

        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        $destinationPath = public_path() . '/uploads';

        $comment=new CommentsModel;
        $comment->author=$token['sub'];
        $comment->id=$request['id'];
        $comment->content=$request['content'];
        $comment->save();

        return '{"status":"done"}';
    }


     public function deleteComment(Request $request){

        $ip=$request->ip();
        $id=$request['id'];

        if(!$this->checkToken($request['token'],$ip)){
            return response()->json(array('token' => "Invalid Token"));
        }
        $token=(array) JWT::decode($request['token'], Config::get('app.token_secret'), array('HS256'));
        
        $comment= CommentsModel::where('author',$token['sub'])->where('id_of_comment',$id)->delete();
        

        return '{"status":'.$comment.'}';
    }




    public function getComments(Request $request){

    	$id=$request['id'];
    	$limit=10;
        $pack=$request['pack'];

        $offset=$limit*$pack;

        $query = CommentsModel::select('comments.*','users.name','users.avatar')->where('comments.id',$id)->join('users', 'comments.author', '=', 'users.id')->orderBy('date','DESC')->limit($limit)->offset($offset)->get();
        return json_encode($query);
    }
}
