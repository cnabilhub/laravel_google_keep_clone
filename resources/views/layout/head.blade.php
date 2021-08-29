<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title> @yield('title') </title>

 {{-- preloader --}}

 <link rel="stylesheet" href="{{asset('css/preloader.css')}}">


 {{-- bootstrap --}}
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

 {{-- sweetalert2 --}}
 <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
 <link rel="icon" type="image/png" href="{{asset('images/logo.png')}}">

 {{-- select2 --}}
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 {{-- dataTables --}}
 <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">

 {{-- spectrum --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

 <link rel="stylesheet" href="{{asset('/css/index.css')}}">
 <link rel="stylesheet" href="{{asset('/css/all.css')}}">

</head>