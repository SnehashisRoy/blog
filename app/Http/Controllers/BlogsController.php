<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function show($id){
        $blog = Blog::findOrFail($id);
        return view('public.blogs.show', ['blog' => $blog]);
    }
}
