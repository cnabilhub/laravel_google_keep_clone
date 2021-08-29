<!DOCTYPE html>
<html>

@include('layout.head')

<body>
    <div class="container">
        <div class="card card-container">

            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @endif

            <form class="form-signin form-group" method="POST" action="{{route('auth.authenticate')}}">
                @csrf
                <span id="reauth-email" class="reauth-email"></span>
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address"
                    required autofocus value="email@email.com">
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password"
                    required value="email@email.com">

                <button class="btn btn-warning btn-block form-control mt-3" type="submit"><i class="fas fa-user"></i>
                    Sign
                    in</button>
            </form>
            <span class="mt-3">Dont have account ?
                <a href="{{route('auth.register')}}" class="forgot-password">
                    Register
                </a>
            </span>
        </div>
    </div>

    <style>
        body {
            width: 100%;
            height: 100vh;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgb(255, 207, 21), rgb(200, 159, 0));
        }

        .card-container.card {
            max-width: 350px;
            padding: 40px 40px;
            margin-top: 10%;
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


        .profile-name-card {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 0;
            min-height: 1em;
        }
    </style>


    @include('layout.script')

    @include('layout.notifications')


</body>

</html>