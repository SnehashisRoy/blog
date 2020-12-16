<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function indexPublished(){

        $blogs = Blog::where('status', 1)->get();

        return view('admin.blogs.index', ['blogs' => $blogs]);

    }
    
    public function create(){

        $categories = Category::all();
        return view('admin.blogs.create',['categories' => $categories]);
    }

    public function store(Request $r){

        $blog = $this->validate($r, [
            'title' => 'required',
            'content' => 'required',
            'excerpt' => 'required'
        ]);

		// meta stuff
		$blog['slug'] =  implode('-', explode('-', $r->title));
        $blog['meta_title'] = $r->title;
        $blog['meta_descrption'] = $r->excerpt;
		// image upload
		if ($file = $r->file('featured_image')) {
			$name = uniqid() . $file->getClientOriginalName();
			$name = strtolower(str_replace(' ', '-', $name));
			$file->move('images/featured_image/', $name);
			$blog['featured_image'] = $name;
        }
        
		// $blog = Blog::create($blog);
		$blogByUser = $r->user()->blogs()->create($blog);
		// sync with categories
		if ($r->category_id) {
			$blogByUser->category()->sync($r->category_id);
		}

		// mail
		// $users = User::all();
		// foreach ($users as $user) {
		// 	Mail::to($user->email)->queue(new BlogPublished($blogByUser, $user));
		// }

		//Session::flash('blog_created_message', 'Congratulations on createing a great blog!');

		return redirect('/admin/blogs');

    }

    public function edit($id){

        $blog = Blog::with('category')->find($id);

        $array = [];
        foreach($blog->category as $c){
            $array[]= $c->id;
        }

        

        $categories = Category::all();

        return view('admin.blogs.edit', [
            'blog' => $blog,
             'categories' => $categories,
             'presentCategories' => $array
        ]);


    }

    public function update($id, Request $r){

        $this->validate($r, [
            'title' => 'required',
            'content' => 'required',
            'excerpt' => 'required'
        ]);

        $blog = Blog::findOrFail($id);

        $blog->title = $r->title;
        $blog->meta_description = $r->excerpt;
        $blog->excerpt= $r->excerpt;
        $blog->content= $r->content;

        $blog->save();

		
		// image upload
		if ($file = $r->file('featured_image')) {
			$name = uniqid() . $file->getClientOriginalName();
			$name = strtolower(str_replace(' ', '-', $name));
			$file->move('images/featured_image/', $name);
			$blog->featured_image = $name;
        }
        
	
		// sync with categories
		if ($r->category_id) {
			$blog->category()->sync($r->category_id);
		}


		return redirect('/admin/blogs');

    }

}
