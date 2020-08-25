<!DOCTYPE html>
<html>
<head>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">

    <link href="{{ asset('icons/css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sample.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}"/>

</head>
<body class="login">

    <div class="login-div">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png')}}" class="logo"/>
    </div>
    <div class="login-container">
        <h4 class="login-title">BACK OFFICE</h4>
        <form>
            <div class="form-group">
                <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter Username" />
                <label for="fname" class="float-label">Username</label>
            </div>
            <div class="form-group">
                <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter Password" />
                <label for="fname" class="float-label">Password</label>
            </div>
            <button type="submit" class="login-btn">SIGN IN</button>
        </form>
    </div>
    </div>
</body>
</html>
