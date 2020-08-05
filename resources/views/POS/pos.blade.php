<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/OverlayScrollbars/css/OverlayScrollbars.css') }}" rel="stylesheet" />

    <link href="{{ asset('icons/css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sample.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
    <script type="text/javascript" src="{{ asset('vendor/OverlayScrollbars/js/OverlayScrollbars.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="pos-terminal">
    @include('POS.pos-header')

    <div class="pos">

                <livewire:product-dropdown />



    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            OverlayScrollbars(document.querySelectorAll(".product-dropdown"), {});
        });
        $(document).ready(function() {
            $(".search-textbox").focus(function() {
                $(".product-dropdown").css("display", "block");
            });
            $(".search-textbox").focusout(function() {
                setTimeout(function(){
                    $(".product-dropdown").css("display", "none");
                },200);

            });






        });

    </script>
</body>
</html>
