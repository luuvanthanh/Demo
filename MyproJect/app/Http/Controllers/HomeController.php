<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //Method GET
        $data = [];
        $post = Post::get();
        $data['posts'] = $post;
        return view('welcome',$data);
    }
}
