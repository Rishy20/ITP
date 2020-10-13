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
<body class="login poslogin">

    <div class="login-div">
        <div class="logo-container mt-3">
            <img src="{{ asset('images/logo.png')}}" class="logo" />
        </div>
        <div class="login-container poslogin">

            <form method="POST" action="{{ route('pos.login') }}" class="needs-validation" novalidate>
                @csrf
                <div class="form-group mt-4">
                    <input type="password" id="pin" name="pin" class="form-control  pin" placeholder="Enter Pin"  required />
                    <label for="name" class="float-label"></label>
                    <div class="invalid-feedback">
                        Please enter a Pin
                    </div>
                </div>
                <div class="login-num">
                    <div class="row">
                        <div class="col cursor" id="one">
                            <div class="num">1</div>
                        </div>
                        <div class="col cursor" id="two">
                            <div class="num">2</div>
                        </div>
                        <div class="col cursor" id="three">
                            <div class="num">3</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col cursor" id="four">
                            <div class="num">4</div>
                        </div>
                        <div class="col cursor" id="five">
                            <div class="num">5</div>
                        </div>
                        <div class="col cursor" id="six">
                            <div class="num">6</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col cursor" id="seven">
                            <div class="num">7</div>
                        </div>
                        <div class="col cursor" id="eight">
                            <div class="num">8</div>
                        </div>
                        <div class="col cursor" id="nine">
                            <div class="num">9</div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col"></div>
                        <div class="col cursor" id="zero">
                            <div class="num">0</div>
                        </div>
                        <div class="col"></div>

                    </div>
                </div>
                @if(session('fail'))
                <div class="invalid-credentials">
                    Invalid Pin, Please Try again!
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

        $('#one').click(function(){
            $('#pin').val(function(){
                return this.value + "1";
            });
        })
        $('#two').click(function(){
            $('#pin').val(function(){
                return this.value + "2";
            });
        })
        $('#three').click(function(){
            $('#pin').val(function(){
                return this.value + "3";
            });
        })
        $('#four').click(function(){
            $('#pin').val(function(){
                return this.value + "4";
            });
        })
        $('#five').click(function(){
            $('#pin').val(function(){
                return this.value + "5";
            });
        })
        $('#six').click(function(){
            $('#pin').val(function(){
                return this.value + "6";
            });
        })
        $('#seven').click(function(){
            $('#pin').val(function(){
                return this.value + "7";
            });
        })
        $('#eight').click(function(){
            $('#pin').val(function(){
                return this.value + "8";
            });
        })
        $('#nine').click(function(){
            $('#pin').val(function(){
                return this.value + "9";
            });
        })
        $('#zero').click(function(){
            $('#pin').val(function(){
                return this.value + "0";
            });
        })

    </script>
</body>
</html>
