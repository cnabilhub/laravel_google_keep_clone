@extends('layout.master')

@section('section')
<div class="container">
    <div class=" p-5">

        <form class="form-signin" method="POST" action="{{route('auth.create')}}" enctype="multipart/form-data">
            @csrf


            <div class="row">
                <div class="col-md-6">

                    <input name="name" type="text" id="inputEmail" class="form-control" placeholder="Name" required
                        autofocus>
                    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address"
                        required>
                    <input name="password" type="password" id="inputPassword" class="form-control"
                        placeholder="Password" required>
                    <input name="password" type="password" id="inputPassword" class="form-control"
                        placeholder="Password" required>
                    <input name="password" type="password" id="inputPassword" class="form-control"
                        placeholder="Password" required>

                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"><i
                            class="fas fa-user-edit"></i> Update</button>
                </div>
                <div class="col-md-6">

                    <img src="{{asset('images/profiles/default.png')}}" alt="" class="mb-3 img-thumbnail" id="image">
                    <input id="files" type="file" class="form-control mt-3 mb-3 img" alt="avatar" name="img">
                </div>
            </div>



        </form>

    </div>
</div>

<style>
    .form-signin #inputEmail,
    .form-signin #inputPassword {
        direction: ltr;
        height: 44px;
        font-size: 16px;
    }

    .form-signin input[type=email],
    .form-signin input[type=password],
    .form-signin input[type=text],
    .form-signin button {
        width: 100%;
        display: block;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        border-color: rgb(104, 145, 162);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(104, 145, 162);
    }

    .btn.btn-signin {
        background-color: rgb(0, 0, 0);
        padding: 0px;
        font-weight: 700;
        font-size: 14px;
        height: 36px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        -o-transition: all 0.218s;
        -moz-transition: all 0.218s;
        -webkit-transition: all 0.218s;
        transition: all 0.218s;
    }

    .btn.btn-signin:hover,
    .btn.btn-signin:active,
    .btn.btn-signin:focus {
        background-color: #f6c711;
    }

    .img-thumbnail {
        max-width: 300px;
    }
</style>




@endsection

@section('js')
<script>
    $( document ).ready(function() {
            document.getElementById('files').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
            }
     });
</script>
@endsection