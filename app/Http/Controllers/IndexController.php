<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){


        return view('index');
//        $title = TestModel::all();
//        $data = ['test' => 'text'];
//        foreach ($title as $item) {
//            echo $item['title'];
//        }
    }
}
