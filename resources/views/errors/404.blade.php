@extends('layout.master')
@section('title')
404
@endsection

@section('section')

<div class="row">
   <div class="col-md-12">
      <div class="error-template">
         <img class="img-fluid" src="{{asset('/images/404.png')}}" alt="error 404" srcset="">
         <h1>
            Oops!</h1>
         <h2>
            404 Not Found</h2>
         <div class="error-details">
            Sorry, an error has occured, Requested page not found!
         </div>
      </div>
   </div>
</div>

<style>
   .error-template {
      padding: 40px 15px;
      text-align: center;
   }

   .error-actions {
      margin-top: 15px;
      margin-bottom: 15px;
   }

   .error-actions .btn {
      margin-right: 10px;
   }
</style>
@endsection