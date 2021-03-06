<!DOCTYPE html>
<html lang="en">

@include('layout.head')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Register </title>

</head>

<body>

    <div class="container">
        <div class="card card-container rounded">

            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST" action="{{route('auth.create')}}" enctype="multipart/form-data">
                @csrf
                <span id="reauth-email" class="reauth-email"></span>
                <input name="name" type="text" id="inputEmail" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required
                    autofocus>

                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    
                    
                    <input name="email" type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email address"
                    required>
                    @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror

                <input id="files" type="file" class="form-control mt-3 mb-3 img" alt="avatar" name="img">

                <img src="{{asset('images/profiles/default.png')}}" alt="" class="mb-3 img-thumbnail" id="image">

                <input name="password" type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                    required>

                                        @error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror


                <button class="btn  btn-warning btn-block form-control mt-4 mb-2" type="submit">Register</button>
            </form>
            <span>Alredy have account ? <a class="d-inline" href="{{route('auth.authenticate')}}"
                    class="forgot-password">
                    login
                </a>
            </span>
        </div>
    </div>

    <style>
        #image {
    width: 80px;
    border-radius: 50%;
}

        body,
        html {
            height: 100%;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgb(255, 207, 21), rgb(200, 159, 0));
        }

        .card-container.card {
            max-width: 350px;
            padding: 40px 40px;
        }


        .card {
            background-color: #F7F7F7;
            /* just in case there no content*/
            padding: 20px 25px 30px;
            margin: 0 auto 25px;
            margin-top: 50px;
            /* shadows and rounded borders */
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .profile-img-card {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }
    </style>


    <script src="{{asset('script/jquery-3.2.1.slim.min.js')}}"></script>
    
    <script src="{{asset('script/popper.min.js')}}"></script>

    {{-- bootstrap 4.6 --}}
    <script src="{{asset('/script/bootstrap5.bundle.min.js')}}"></script> 

    <script>
        $( document ).ready(function() {
        document.getElementById('files').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
        }
 });
 

    </script>

    @include('layout.notifications')
</body>

</html>