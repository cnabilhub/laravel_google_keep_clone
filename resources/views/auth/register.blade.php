<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Register </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>



    <!------ Include the above in your HEAD tag ---------->

    <!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
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

                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Register</button>
            </form><!-- /form -->
            <span>Alredy have account ? <a class="d-inline" href="{{route('auth.authenticate')}}"
                    class="forgot-password">
                    login
                </a>
            </span>
        </div><!-- /card-container -->
    </div><!-- /container -->

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

        .btn {
            font-weight: 700;
            height: 36px;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
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

        /*
 * Form styles
 */
        .profile-name-card {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 0;
            min-height: 1em;
        }

        .reauth-email {
            display: block;
            color: #404040;
            line-height: 2;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

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
            /*background-color: #4d90fe; */
            background-color: rgb(0, 0, 0);
            /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
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

        .forgot-password {
            color: rgb(104, 145, 162);
        }

        .forgot-password:hover,
        .forgot-password:active,
        .forgot-password:focus {
            color: rgb(12, 97, 33);
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
 loadProfile();
 });
 
 /**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
 function getLocalProfile(callback){
 var profileImgSrc = localStorage.getItem("PROFILE_IMG_SRC");
 var profileName = localStorage.getItem("PROFILE_NAME");
 var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");
 
 if(profileName !== null
 && profileReAuthEmail !== null
 && profileImgSrc !== null) {
 callback(profileImgSrc, profileName, profileReAuthEmail);
 }
 }
 
 /**
 * Main function that load the profile if exists
 * in localstorage
 */
 function loadProfile() {
 if(!supportsHTML5Storage()) { return false; }
 // we have to provide to the callback the basic
 // information to set the profile
 getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
 //changes in the UI
 $("#profile-img").attr("src",profileImgSrc);
 $("#profile-name").html(profileName);
 $("#reauth-email").html(profileReAuthEmail);
 $("#inputEmail").hide();
 $("#remember").hide();
 });
 }
 
 /**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
 function supportsHTML5Storage() {
 try {
 return 'localStorage' in window && window['localStorage'] !== null;
 } catch (e) {
 return false;
 }
 }
 
 /**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
 function testLocalStorageData() {
 if(!supportsHTML5Storage()) { return false; }
 localStorage.setItem("PROFILE_IMG_SRC",
 "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" );
 localStorage.setItem("PROFILE_NAME", "César Izquierdo Tello");
 localStorage.setItem("PROFILE_REAUTH_EMAIL", "oneaccount@gmail.com");
 }
    </script>
</body>

</html>