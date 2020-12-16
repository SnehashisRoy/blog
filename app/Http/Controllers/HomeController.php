<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        $blogs = Blog::all();
        return view('public.home', ['blogs' => $blogs]);
    }

    public function show($slug){

        $blog = Blog::where('slug', $slug)->first();

        return view('public.blogs.show', ['blog' => $blog]);
    }
}
