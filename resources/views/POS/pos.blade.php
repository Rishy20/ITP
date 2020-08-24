<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/OverlayScrollbars/css/OverlayScrollbars.css') }}" rel="stylesheet" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link href="{{ asset('icons/css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sample.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
    <script type="text/javascript" src="{{ asset('vendor/OverlayScrollbars/js/OverlayScrollbars.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @livewireStyles
</head>
<body class="pos-terminal">

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            {{-- <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
            </div> --}}

            <ul class="list-unstyled components">
                {{-- <p>Dummy Heading</p> --}}
                {{-- <li class="active pos-nav-li">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li> --}}
                <li class="pos-nav-li">
                    <a href="#" id="addexpense">Add Expense</a>
                </li>
                <li class="pos-nav-li">
                    <a href="#">Mark Attendance</a>
                </li>
                <li class="pos-nav-li">
                    <a href="#">About</a>
                </li>
                <li class="pos-nav-li">
                    <a href="#">About</a>
                </li>

                {{-- <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> --}}
            </ul>

        </nav>
        <!-- Page Content -->
        <div id="content">

            <header>
                <div class="header pos-header">
                    <div class="header-content">


                                <button type="button" id="sidebarCollapse" class="btn-nav">
                                    <i class="fas fa-align-left"></i>
                                </button>


                        <div class="header-store">Leatherline</div>
                        <div class="header-time">
                            <livewire:time />
                        </div>
                        <div class="header-user pos-header-user">
                            <i class="fas fa-user-circle header-icon"></i> Rishard Akram
                        </div>
                    </div>
                </div>
            </header>


            <div class="pos">

                <livewire:product-dropdown />
                <div class="full-pg" id="fadeBg"></div>
                <div class="pos-sub-display" id="posSubDisplay" >

                    <div class="pos-sub-display-title">
                        <span class="title">Expense</span>
                        <button class="close-btn" id="closeBtn"><i class="fas fa-window-close"></i></button>
                    </div>

                    <div class="pos-sub-display-content">

                        <form>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Type</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                        </select>
                                      </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label >Amount</label>
                                        <input type="text" class="form-control" />
                                      </div>
                                </div>
                            </div>


                            <div class="form-group pl-2 pr-2">
                                <div class="row">
                                    <label >Description</label>
                                </div>
                                <div class="row">
                                    <textarea class="pos-sub-txtArea" rows=5></textarea>
                                </div>
                            </div>
                            <div class="action-btn-row">

                                <button class="add-sub-btn">Add</button>

                            </div>
                          </form>
                    </div>
                </div>
            </div>



        </div>
    </div>


    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            OverlayScrollbars(document.querySelectorAll(".product-dropdown"), {});
        });






        $(document).ready(function() {
            // $(".search-textbox").focus(function() {
            //     $(".product-dropdown").css("display", "block");
            // });
            // $(".search-textbox").focusout(function() {
            //     setTimeout(function(){
            //         $(".product-dropdown").css("display", "none");
            //     },200);
            // });
            // $(".search-textbox").focusout(function() {
            //     setTimeout(function(){
            //         $(".product-dropdown-1").css("display", "none");
            //     },200);
            // });
        });

    </script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>

$(document).ready(function() {

$('#sidebarCollapse').on('click', function() {
    $('#sidebar').toggleClass('active');
});
$('#addexpense').on('click', function() {
    $('#posSubDisplay').toggleClass('block');
    $('#fadeBg').toggleClass('block');
    $('#sidebar').removeClass('active');
});
$('#closeBtn').on('click', function() {
    $('#posSubDisplay').removeClass('block');
    $('#fadeBg').removeClass('block');

});

});
    </script>
</body>
</html>
