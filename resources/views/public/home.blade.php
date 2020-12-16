@extends('layouts.public')


@section('content')

         <div class="row justify-content-md-center">
              <div class="col-md-9 " style="text-align: justify;">

                    @foreach($blogs as $blog)

                        <h2 style="color: white;"> <span class="title-bg"><a href="/blogs/{{$blog->slug}}">{{$blog->title}}</a></span></h2>

                        <h5 style="margin-top: 25px;"> {{$blog->excerpt}}</h5>

                        <p style="font-size: 1.5rem;">{!! $blog->content !!}</p>

                    @endforeach

              </div>
              
         </div>

@endsection