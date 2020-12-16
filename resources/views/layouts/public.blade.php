<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('pagejs-head')

    
  </head>

  <body>

      

        <div class="jumbotron text-center header">

            <h1  style="font-size: 3em;"> আতাফুল </h1>
            <h5  style="letter-spacing: 0.5em;">আনমন ভাবনার হাওয়া</h5>

        </div>
      <div class="container">
          @yield('content')
      </div>
     


    
  </body>
</html>

