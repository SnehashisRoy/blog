@extends('layouts.admin')

@section('content')
       @foreach($blogs as $blog)

             <a href="{{route('admin.blogs.edit', $blog->id)}}"><p>{{$blog->title}}</p></a>

       @endforeach

@endsection