<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){

        
        return '<h1>это главная страница, короче</h1> <p>все посты <a href="'.route('getPosts').'">тут</a></p>';
//        $title = TestModel::all();
//        $data = ['test' => 'text'];
//        foreach ($title as $item) {
//            echo $item['title'];
//        }
    }
}
