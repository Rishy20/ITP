<!DOCTYPE html>
<html>
<head>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/OverlayScrollbars/css/OverlayScrollbars.css') }}" rel="stylesheet" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{ asset('icons/css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sample.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('vendor/OverlayScrollbars/js/OverlayScrollbars.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/DataTables/datatables.min.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</head>
<body>
    @include('assets.header')


    @include('assets.navbar')
    <div class="main">
        @yield('content')

    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
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

         table = $('#myTable').DataTable({
                "order": []
                , "dom": '<"top"f><t><"bottom"lip>'
                , language: {
                    search: "_INPUT_"
                    , searchPlaceholder: "🔎 Search"
                }
            });


            $(document).ready(function() {


                $('document').ready(function() {
                    setTimeout(function() {
                        $('.message').addClass("none");

                    }, 3000);
                });
                $('.dlt-btn').click(function() {
                    var btnid = this.id;
                    var formid = btnid.replace(/[^0-9]/g, '');
                    var formClass = '#dlt-form' + formid;

                    if (confirm('Are you sure you want to delete?')) {
                        $(formClass).submit();
                    }
                });
            });

            // $(".inv-select").focus(function() {
            //         $(".inv-label").css("display", "block");
            // });
        });

    </script>

    <script>
        $(document).on('click', '.number-spinner button', function() {
            var btn = $(this)
                , oldValue = btn.closest('.number-spinner').find('input').val().trim()
                , newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                newVal = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            btn.closest('.number-spinner').find('input').val(newVal);
        });

    </script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                locale: {
                    format: 'DD/MM/YYYY'
                }
            },

            function(start, end, label) {
                $("#start").val(start.format('YYYY-MM-DD'));
                $("#end").val(end.format('YYYY-MM-DD'));
                setDate();
            });
        });

        var FilterStart ;
        var FilterEnd;

    $("#pSelect").click(function(){

        if($("#today").is(':selected')){
            FilterStart = moment().format("YYYY-MM-DD");
            FilterEnd = moment().format("YYYY-MM-DD");
            table.draw();
            document.cookie = "timeperiod = 1";

        }else if($("#day2").is(':selected')){
            FilterStart = moment().subtract(1, 'days').format("YYYY-MM-DD");
            FilterEnd =  moment().subtract(1, 'days').format("YYYY-MM-DD");
            table.draw();
            document.cookie = "timeperiod = 2";

        }else if($("#day7").is(':selected')){
            FilterStart = moment().subtract(6, 'days').format("YYYY-MM-DD");
            FilterEnd = moment().format("YYYY-MM-DD");
            table.draw();
            document.cookie = "timeperiod = 7";

        }else if($("#day14").is(':selected')){
            FilterStart = moment().subtract(13, 'days').format("YYYY-MM-DD");
            FilterEnd = moment().format("YYYY-MM-DD");
            table.draw();
            document.cookie = "timeperiod = 14";
        }else if($("#day30").is(':selected')){
            FilterStart = moment().startOf('month').format("YYYY-MM-DD");
            FilterEnd = moment().endOf('month').format("YYYY-MM-DD");
            table.draw();
            document.cookie = "timeperiod = 30";
        }else if($("#day60").is(':selected')){
            FilterStart = moment().subtract(1, 'month').startOf('month').format("YYYY-MM-DD");
            FilterEnd = moment().subtract(1, 'month').endOf('month').format("YYYY-MM-DD");
            table.draw();
            document.cookie = "timeperiod = 60";
        }

        if($("#date").is(':selected')){
            $("#daterange").show();
        }else{
            $("#daterange").hide();
        }
    });
    function setDate(){
        FilterStart = $('#start').val();
        FilterEnd = $('#end').val();
        table.draw();
        document.cookie = "timeperiod = 100";
        document.cookie = "start = " + FilterStart;
        document.cookie = "end = " + FilterEnd;
    }
    </script>


</body>
</html>
