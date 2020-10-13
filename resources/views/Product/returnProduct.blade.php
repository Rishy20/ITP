@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('inventories.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Return products</div>
</div>

<div class="section">
    <div class="section-title">
        Vendor Information

        <hr>
    </div>
    <div class="section-content">
        <form method="POST" class="needs-validation" action="{{ route('return.store') }}" novalidate>
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Vendor</label>
                        <input type="text" id="vendor" name="vendor" class="form-control" data-toggle="dropdown" placeholder="Select Vendor" required/>
                        <ul class="dropdown-menu service-cus-dropdown">
                            <input class="form-control" id="vendorSearch" type="text" placeholder="Search..">
                            @foreach($vendor as $v)
                                <li onclick="addVendor({{$v->id}})" >{{$v->first_name . " " .$v->last_name }}</li>
                            @endforeach
                        </ul>
                        <input type="text" name="vendorId" id="vendorId" hidden/>
                    </div>
                </div>
                <div class="col">
                    <label>Return Date</label>

                        <input type="date" name="date" class="form-control "value="<?php echo date('Y-m-d'); ?>"required/>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Remarks</label>
                    <textarea name="remarks" class="pos-sub-txtArea" rows=5></textarea>
                </div>
            </div>


    </div>
</div>

<div class="section mb-4"> {{-- Start of Section--}}
    <div class="section-title">
        Select Products
        <hr>
    </div>

    <div class="section-content"> {{-- Start of sectionContent--}}

        <div id="allProducts">
            <div class="row pb-2">
                <div class="col">
                    Search Products
                </div>

            </div>
            <div class="section-content selectProductsContent"> {{-- Start of sectionContent--}}
                <div class="col">
                    <div class="product-search">
                        <form method="post" action="">
                            @csrf
                            <input type="text" id="prdSearch" class="search-textbox form-control p" data-toggle="dropdown" placeholder="Find Products By Name Or Code">
                            <div class="load-spinner load-spinner-return">
                                <div class="spinner-border text-secondary" role="status">
                                    <span class="sr-only">Loading...</span>
                                  </div>
                            </div>
                            <div class="dropdown-menu product-overlay" aria-labelledby="dropdownMenuButton" >
                                <table class="table table-borderless" id="productSearchTable">

                                </table>


                            </div>

                            <div class="row ">
                                <div class="item-display backend">
                                    <table class="table table-striped " id="selectedProducts">

                                        <tr class="item-table-head">

                                            <th scope="col">#</th>
                                            <th scope="col">Item Code</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Colour</th>
                                            <th scope="col" style="width: 100px">Qty</th>
                                            <th></th>

                                        </tr>


                                    </table>
                                </div>
                            </div>

                    </div>
                </div> {{-- End  of sectionContent--}}
            </div>
        </div>
        <div class="return-total">
            <h3 class="return-total-txt">Total</h3>
            <div class="return-total-box"> Rs. <span id="return-tot-amount">0</span></div>
        </div>
    <div class="row submit-row mt-3">
        <div class="col">
            <input class="btn-submit" type="submit" value="Save">
        </div>
    </div>
</form>
    </div> {{-- End  of sectionContent--}}
    </div> {{-- End  of section--}}
<script>
      var num = 0;
    var del = 0;
    var arr = [];
      //Search Vendors
      $("#vendorSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
    });

    function addVendor(id){

        $('#vendorId').val(id);

        var vendor = <?php echo json_encode($vendor); ?>;
        vendor.forEach(function(index, value, array) {

            if (array[value]['id'] == id) {
                $('#vendor').val(array[value]['first_name']+" "+array[value]['last_name']);
            }
        });
        $('.load-spinner').show();
        $url = "/vendorproduct/"+id;

        $.get($url, function(data, status){
            $("tr").remove(".item-table-row");
            productDropdown(data);
            $('.load-spinner').hide();
        }).fail(function(err,status){
            $('.load-spinner').hide();
        });

    };




    function addProduct(id,vid){

var complex = <?php echo json_encode($prd); ?>;
complex.forEach(myFunction);
function myFunction(index,value,array){


    var selectedProducts = document.getElementById("selectedProducts");
    if(array[value]['id'] == id && array[value]['vid'] == vid){
        var row = selectedProducts.insertRow();
        row.className = 'item-table-row';
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var cell11 = row.insertCell(10);
        var index = num;
        cell1.innerHTML = ++num;
        cell2.innerHTML = array[value]['pcode'];
        cell3.innerHTML = array[value]['name'];

            cell4.innerHTML = array[value]['costPrice'];

        cell5.innerHTML = array[value]['size'];
        cell6.innerHTML = array[value]['color'];



        if(array[value]['quantity'] == null){
            cell7.innerHTML = '<input type="text" value="'+array[value]['Qty']+'" class="table-qty"/>';
        }else{
            cell7.innerHTML = '<input type="text" value="'+array[value]['quantity']+'" class="table-qty"/>';
        }

        cell8.innerHTML = '<i class="fas fa-times cancel" id="remove"></i>';
        cell9.innerHTML = index;
        cell9.className = 'none';
        cell10.innerHTML = array[value]['id'];
        cell10.className = 'none';
        cell11.innerHTML = array[value]['vid'];
        cell11.className = 'none';

        if(array[value]['quantity'] == null){
            arr.push([array[value]['id'],array[value]['vid'],array[value]['Qty']]);
        }else{
            arr.push([array[value]['id'],array[value]['vid'],array[value]['quantity']]);
        }
    }else if(vid.length == 0){
        if(array[value]['id'] == id){
            var row = selectedProducts.insertRow();
        row.className = 'item-table-row';
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
        var cell9 = row.insertCell(8);
        var cell10 = row.insertCell(9);
        var cell11 = row.insertCell(10);
        var index = num;
        cell1.innerHTML = ++num;
        cell2.innerHTML = array[value]['pcode'];
        cell3.innerHTML = array[value]['name'];
        cell4.innerHTML = array[value]['costPrice'];
        cell5.innerHTML = array[value]['size'];
        cell6.innerHTML = array[value]['color'];



        if(array[value]['quantity'] == null){
            cell7.innerHTML = '<input type="text" value="'+array[value]['Qty']+'" class="table-qty"/>';
        }else{
            cell7.innerHTML = '<input type="text" value="'+array[value]['quantity']+'" class="table-qty"/>';
        }

        cell8.innerHTML = '<i class="fas fa-times cancel" id="remove"></i>';
        cell9.innerHTML = index;
        cell9.className = 'none';
        cell10.innerHTML = array[value]['id'];
        cell10.className = 'none';
        cell11.innerHTML = array[value]['vid'];
        cell11.className = 'none';

        if(array[value]['quantity'] == null){
            arr.push([array[value]['id'],array[value]['vid'],array[value]['Qty']]);
        }else{
            arr.push([array[value]['id'],array[value]['vid'],array[value]['quantity']]);
        }

    }

    }

}
updateTotal();
var s = JSON.stringify(arr);
document.cookie = "returnproducts = "+s;
}

function updateTotal(){
    var table = document.getElementById("selectedProducts");

            var x = table.rows.length;
            var qty = 0;
            var total = 0;
            var price = 0;

            for(i=1;i<x;i++){
                qty = parseInt($(table.rows[i].cells[6]).find('.table-qty').val());
                price = parseInt(table.rows[i].cells[3].innerHTML);
                total = total + (price * qty);
            }
            total = format_number(total);
            $('#return-tot-amount').html(total);

}
function format_number(n) {
  return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

$('#selectedProducts').on('click', '#remove', function(e){

    var index = $(this).closest('tr').index();
    var table = document.getElementById("selectedProducts");
    var delrow = table.rows[index].cells[7].innerHTML;
    arr.splice(delrow,1);
    var n = JSON.stringify(arr);
    document.cookie = "returnproducts = "+n;
    $(this).closest('tr').remove();
    updateTotal();
    var x = table.rows.length;
    num = 0;
    for(i=1; i<=x;i++){
        table.rows[i].cells[0].innerHTML = ++num;
        table.rows[i].cells[8].innerHTML = num-1;
    }

});
$("#selectedProducts").on('change','.table-qty',function() {
                var table = document.getElementById("selectedProducts");
                var qty = $(this).val();
                var i = $(this).parent().parent().index();
                var product = <?php echo json_encode($prd); ?>;
                product.forEach(function(index,value,array){
                        if (array[value]['pcode'] == table.rows[i].cells[1].innerHTML){

                                var pid = table.rows[i].cells[9].innerHTML;
                                var vid = table.rows[i].cells[10].innerHTML;

                                for(j = 0; j < arr.length ; j++){
                                    if(pid.length > 0 && vid.length > 0){
                                        if(arr[j][0] == pid && arr[j][1] == vid){
                                            arr[j][2] = qty;
                                        }
                                    }else if(vid.length == 0){
                                        if(arr[j][0] == pid){
                                            arr[j][2] = qty;
                                        }
                                    }
                                }
                        }
                });
                var s = JSON.stringify(arr);
                updateTotal();
                document.cookie = "returnproducts = "+s;
});


$(document).ready(function(){
    var p = <?php echo json_encode($prd); ?>;
    productDropdown(p);
});
      function productDropdown(product){
                var table = document.getElementById("productSearchTable");
                product.forEach(function(index, value, array){
                        var row = table.insertRow();
                        row.className = 'item-table-row';
                        var cell1 = row.insertCell(0);
                        cell1.className = "pr-code";
                        var cell2 = row.insertCell(1);
                        cell2.className = "pr-name";
                        var cell3 = row.insertCell(2);
                        cell3.className = "pr-name";
                        var cell4 = row.insertCell(3);
                        cell4.className = "pr-name";
                        var cell5 = row.insertCell(4);
                        cell5.className = "none";
                        var cell6 = row.insertCell(5);
                        cell6.className = "none";

                        cell1.innerHTML = array[value]['pcode'];
                        cell2.innerHTML = array[value]['name'];
                        cell3.innerHTML = array[value]['size'];
                        cell4.innerHTML = array[value]['color'];
                        cell5.innerHTML = array[value]['id'];
                        cell6.innerHTML = array[value]['vid'];
                });
        }
 $('#productSearchTable').on('click','tr',function(){
    var index = $(this).index();
    var table = document.getElementById("productSearchTable");
    var pid= table.rows[index].cells[4].innerHTML;
    var vid= table.rows[index].cells[5].innerHTML;
    addProduct(pid,vid);
 })

</script>
@endsection
