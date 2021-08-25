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
                <input name="name" type="text" id="inputEmail" class="form-control" placeholder="Name" required
                    autofocus>
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address"
                    required>

                <input id="files" type="file" class="form-control mt-3 mb-3 img" alt="avatar" name="img">

                <img src="{{asset('images/profiles/default.png')}}" alt="" class="mb-3 img-thumbnail" id="image">

                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password"
                    required>

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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $( document ).ready(function() {
        document.getElementById('files').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
        }
 });
 

    </script>
</body>

</html>