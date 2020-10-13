<!DOCTYPE html>
<html>
<head>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">

    <link href="{{ asset('icons/css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sample.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="login">

    <div class="login-div">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png')}}" class="logo" />
        </div>
        <div class="login-container">
            <h4 class="login-title">BACK OFFICE</h4>
            <form method="POST" action="{{ route('login.admin') }}" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="username" class="form-control " placeholder="Enter Username"   v required />
                    <label for="name" class="float-label">Username</label>
                    <div class="invalid-feedback user-invalid">
                        Please enter a username
                    </div>

                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control " placeholder="Enter Password"  required />
                    <label for="password" class="float-label">Password</label>
                    <div class="invalid-feedback password-invalid">
                        Please enter a Password
                    </div>
                </div>
                @if(session('fail'))
                <div class="invalid-credentials">
                    Invalid Credentials, Please Try again!
                </div>
                {{ Session::forget('fail') }}
                @endif
                <input type="submit" class="login-btn" value="SIGN IN"></input>
            </form>
        </div>
    </div>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $(document).ready(function() {


            $('document').ready(function() {
                setTimeout(function() {
                    $('.invalid-credentials').addClass("none");

                }, 3000);
            });
        });

    </script>
</body>
</html>
