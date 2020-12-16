@extends('layouts.public')

@section('pagejs-head')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5fd94a153a7243001157e100&product=inline-share-buttons" async="async"></script>
@endsection


@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-9 " style="text-align: justify;">


        <h2 style="color: white;"> <span class="title-bg">{{$blog->title}}</span></h2>

        

        <h5 style="margin-top: 25px;"> {{$blog->excerpt}}</h5>

        <div class="sharethis-inline-share-buttons"></div>

        <p style="font-size: 1.5rem;">{!! $blog->content !!}</p>


    </div>

</div>


@endsection