<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostsModel;
use App\Http\Requests;

class PostsController extends Controller
{
    public function index(){
        return '<h1>не, сюда пока рано ходить</h1>';
    }

    public function getPosts(){
        $query = PostsModel::all();
        $data = json_encode($query);
        echo $data;
    }
    public function getPost(Request $request){
        $id = $request->input('PostId');
        $query = PostsModel::find($id);
        $data = json_encode($query);
        echo $data;
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
}
