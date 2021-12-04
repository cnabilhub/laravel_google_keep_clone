<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title> @yield('title') </title>

 {{-- preloader --}}

 <link rel="stylesheet" href="{{asset('css/preloader.css')}}">
 <link rel="icon" type="image/png" href="{{asset('images/logo.png')}}">
 




  {{-- bootstrap4 --}}
 <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
 <link href="{{asset('/css/jquery.dataTables.min.css')}}" rel="stylesheet">

   {{-- bootstrap5 --}}
 {{-- <link href="{{asset('/css/bootstrap5.min.css')}}" rel="stylesheet"> --}}
 
 {{-- spectrum --}}
 <link href="{{asset('/css/spectrum.min.css')}}" rel="stylesheet">


  {{-- sweetalert2 --}}
 <link href="{{asset('/css/dark.css')}}" rel="stylesheet">

 {{-- select2 --}}
 <link href="{{asset('/css/select2.min.css')}}" rel="stylesheet">

 <link rel="stylesheet" href="{{asset('/css/index.css')}}">
 <link rel="stylesheet" href="{{asset('/css/all.css')}}">

</head>