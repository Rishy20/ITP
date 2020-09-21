<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet"> --}}
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

            <ul class="list-unstyled components">

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

            </div>



        </div>
    </div>


    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            OverlayScrollbars(document.querySelectorAll(".product-overlay"), {});
        });

        $(document).ready(function() {
            // Search Salesman
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            // Search Products
            $("#prdSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            //Search Customers
            $("#cusSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });



        });
    </script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            //Expense Model
            $('#addexpense').on('click', function() {
                $('#posSubExpense').toggleClass('block');
                $('#fadeBg').toggleClass('block');
                $('#sidebar').removeClass('active');
            });
            $('#closeBtn').on('click', function() {
                $('#posSubExpense').removeClass('block');
                $('#fadeBg').removeClass('block');

            });
            //Pay Model
            $('#payBtn').on('click', function() {
                $('#posSubPay').toggleClass('block');
                $('#fadeBgPay').toggleClass('block');

            });
            $('#closeBtnSize').on('click', function() {
                $('#selectSize').hide();
            });
            $('#closeBtnColor').on('click', function() {
                $('#selectColour').hide();
            });
            $('#closeBtnPay').on('click', function() {
                $('#posSubPay').removeClass('block');
                $('#fadeBgPay').removeClass('block');

            });
            $(document).ready(function() {
                $('.mdb-select').materialSelect();
            });

        });

        var num = 0;
        var del = 0;
        var arr = [];
        var size = [];
        var color = [];
        var distColors;
        var distSize;
        var seledSize;

        function showSize() {
            $("#selectSize").show();
            $("button").remove(".varSize");
            for (i = 0; i < distSize.length; i++) {
                var btn = document.createElement("BUTTON");
                btn.innerHTML = distSize[i];
                btn.className = "var-btn varSize";
                document.getElementById("sizeContent").appendChild(btn);
            }
        }

        function showColor() {
            $("#selectColour").show();
            $("button").remove(".varColor");
            for (i = 0; i < distColors.length; i++) {

                var btn = document.createElement("BUTTON");
                btn.innerHTML = distColors[i];
                btn.className = "var-btn varColor";
                document.getElementById("colorContent").appendChild(btn);
            }
        }

        function addProducts(id) {

            size.splice(0, size.length);
            color.splice(0, color.length);
        
            var variant = <?php echo json_encode($var); ?>;
            variant.forEach(variantFunction);


            function variantFunction(index, value, array) {

                if (array[value]['product_id'] == id) {
                    size.push(array[value]['size']);
                    color.push(array[value]['color']);
                }
            }
            distSize = [...new Set(size)];
            distColors = [...new Set(color)];

            if (distSize.length > 0 && distSize != "") {
                showSize();
            } else if (distColors.length > 0 && distColors != "") {
                showColor();
            }else{
                addProductsRow(id);
            }
            $(".varColor").click(function() {
                    var selectedColor = $(this).html();
                    $("#selectColour").hide();
                    addProductsRow(id, null, selectedColor);
            });
          
            $(".varSize").click(function() {
                selectedSize = $(this).html();
                var availableColors = [];
                $("#selectSize").hide();
                variant.forEach(function(index, value, array) {
                    if (array[value]['product_id'] == id && array[value]['size'] == selectedSize) {
                        availableColors.push(array[value]['color']);
                    }
                });

                if (availableColors.length > 0 && availableColors != "") {
                    distColors = [...new Set(availableColors)];
                    showColor();
                } else {
                    addProductsRow(id, selectedSize);
                }

                $(".varColor").click(function() {
                    var selectedColor = $(this).html();
                    $("#selectColour").hide();
                    addProductsRow(id, selectedSize, selectedColor);

                });
               
            });
           


            // var s = JSON.stringify(arr);
            // document.cookie = "promotions = "+s;

        }

        function addProductsRow(id, size, color) {

            var product = <?php echo json_encode($prd); ?>;
            product.forEach(myFunction);
            console.log(size);
            console.log(color);
            function myFunction(index, value, array) {

                var selectedProducts = document.getElementById("selectedProducts");
                var x = selectedProducts.rows.length;
                var check = false;

                if (array[value]['id'] == id) {


                    for (i = 1; i < x; i++) {
                        if (array[value]['pcode'] == selectedProducts.rows[i].cells[1].innerHTML) {
                            var qty = selectedProducts.rows[i].cells[3].innerHTML;
                            qty = parseInt(qty) + 1;
                            selectedProducts.rows[i].cells[3].innerHTML = qty;
                            var price = array[value]['sellingPrice'];
                            price = parseInt(price) * qty;
                            selectedProducts.rows[i].cells[4].innerHTML = price;
                            var discount = array[value]['discount'];
                            discount = parseInt(discount) * qty;
                            selectedProducts.rows[i].cells[5].innerHTML = discount;  
                            selectedProducts.rows[i].cells[6].innerHTML = price - discount;  
                            check = true;
                        }

                    }

                    if (check == false) {

                        var row = selectedProducts.insertRow();
                        row.className = 'item-table-row';
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                        var cell7 = row.insertCell(6);
                        var index = num;
                        var price = array[value]['sellingPrice'];
                        var discount = array[value]['discount'];
                        cell1.innerHTML = ++num;
                        cell2.innerHTML = array[value]['pcode'];
                        cell3.innerHTML = array[value]['name'];
                        cell4.innerHTML = 1;
                        cell5.innerHTML = array[value]['sellingPrice'];
                        cell6.innerHTML = array[value]['discount'];
                        cell7.innerHTML = price - discount;
                        // cell6.innerHTML = '<i class="fas fa-times cancel" id="remove"></i>';
                        // cell7.innerHTML = index;
                        // cell7.className = 'none';
                        // arr.push([array[value]['id'],array[value]['vid']]);
                    }
                }
            }
        }
    </script>
</body>

</html>