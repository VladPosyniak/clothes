<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostsModel;
use App\Http\Requests;
use App\Tags;
use Hash;
use Config;
use Validator;
use Firebase\JWT\JWT;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class PostsController extends Controller
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



    public function index(){
        return '<h1>не, сюда пока рано ходить</h1>';
    }

    public function getPostsSub(Request $request){
        $limit=4;
        $user=$this->user($request);

        $subs=explode(',',$user->sub);
        $pack=$request['pack'];

        $offset=$limit*$pack;

        $query = PostsModel::select('posts.*','users.name','users.avatar')->whereIn('author',$subs)->join('users', 'posts.author', '=', 'users.id')->orderBy('posts.updated_at','DESC')->limit($limit)->offset($offset)->get();

        return json_encode($query);

    }




    public function getPostsBest(Request $request){
            $limit=4;
            $pack=$request['pack'];
            $offset=$limit*$pack;
            $interval=intval($request['interval']);
            if($interval==0){
                $query = PostsModel::select('posts.*','users.name','users.avatar')->whereRaw('posts.created_at >= CURDATE()')->join('users', 'posts.author', '=', 'users.id')->orderBy('rating','DESC')->limit($limit)->offset($offset)->get();
            }
            else if($interval==1){
                $query = PostsModel::select('posts.*','users.name','users.avatar')->whereRaw('posts.created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)')->join('users', 'posts.author', '=', 'users.id')->orderBy('rating','DESC')->limit($limit)->offset($offset)->get();
            }
            else if($interval==2){
                $query = PostsModel::select('posts.*','users.name','users.avatar')->whereRaw('posts.created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)')->join('users', 'posts.author', '=', 'users.id')->orderBy('rating','DESC')->limit($limit)->offset($offset)->get();
            }
            else{
                return response()->json(array('interval' => "Invalid interval"));
            }
            return json_encode($query);
        }

    public function getPost(Request $request){
        $id = $request->input('PostId');
        $query = PostsModel::select('posts.*','users.name','users.avatar')->join('users', 'posts.author', '=', 'users.id')->find($id);
        $data = json_encode($query);
        return $data;
    }


    public function getWinner(){
        $query = PostsModel::select('posts.*','users.name','users.avatar')->whereRaw('posts.created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)')->join('users', 'posts.author', '=', 'users.id')->orderBy('rating','DESC')->limit(1)->get();
        $data = json_encode($query);
        return $data;
    }



    public function search(Request $request){
        $limit=4;    
        $pack=$request['pack'];
        $offset=$limit*$pack;
        $search=$request['search'];
        if(!preg_match("/^([А-Яа-яA-Za-zыЫъЪёЁіІїЇ ]+)$/u",$search)){
            return response()->json(array('search' => "Invalid search"));
        }

        $query = PostsModel::select('posts.*','users.name','users.avatar')->where('title', 'LIKE', '%'.$search.'%')->orWhere('tag', 'LIKE', '%'.$search.'%')->join('users', 'posts.author', '=', 'users.id')->orderBy('updated_at','DESC')->limit($limit)->offset($offset)->get();

        return json_encode($query);

    }


    public function check(Request $request)
    {
    
    $credentials = $request->only('email', 'password');

    if ($this->auth->attempt($credentials))
    {
        /*return (['msg' => 'Login Successfull'], 200) // 200 Status Code: Standard response for successful HTTP request
          ->header('Content-Type', 'application/json');
          */
          return "true";
    }

    /*return response(['msg' => $this->getFailedLoginMessage()], 401) // 401 Status Code: Forbidden, needs authentication
          ->header('Content-Type', 'application/json');
*/
          return "false";

    }

    public function getTags(){
        $tags=Tags::select('name')->orderBy('rating','DESC')->limit(14)->get();
        return json_encode($tags);
    }
}
