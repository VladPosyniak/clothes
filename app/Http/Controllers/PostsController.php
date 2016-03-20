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
}
