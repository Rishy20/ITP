<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="icons/css/all.css" rel="stylesheet">
    <link href="css/sample.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    @include('header')
    @include('navbar')
    <div class="main">
        @yield('content')
    </div>
</body>
</html>
