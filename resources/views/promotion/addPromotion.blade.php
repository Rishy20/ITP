@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Create Promotion</div>
</div>

<div class="row">
    <div class="col-md-9">

        <div class="section"> {{-- Start of Section--}}
            <div class="section-title">
                Promotion Details
                <hr>
            </div>

            <div class="section-content"> {{-- Start of sectionContent--}}
                {{-- Start of Form --}}

                <form method="post" class="needs-validation" action="{{route('promotion.store')}}" novalidate>

                    @csrf

                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="promotionname" id="promotionname" placeholder="Promotion Name" required>
                            <label for="promotionname" class="float-label">Promotion Name</label>
                            <div class="invalid-feedback">
                                Please fill out this field
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea name="description" id="descriptionEdit" class="pos-sub-txtArea" rows=5></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="date" class="form-control" name="startdate" id="startdate" placeholder="Start Date" required>
                            <label class="float-label">Start Date</label>
                            <div class="invalid-feedback">
                                Please fill out this field
                            </div>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="enddate" id="enddate" placeholder="End Date" required>
                            <label for="enddate" class="float-label">End Date</label>
                            <div class="invalid-feedback">
                                Please fill out this field
                            </div>
                        </div>

                    </div>




            </div> {{-- End  of sectionContent--}}
        </div> {{-- End  of section--}}
    </div>
    <div class="col-md-3">


        <div class="section sec-promotion"> {{-- Start of Section--}}
            <div class="section-title">
                Discount
                <hr>
            </div>

            <div class="section-content"> {{-- Start of sectionContent--}}
                {{-- Start of Form --}}

                <form method="post" class="needs-validation" action="{{route('promotion.store')}}" novalidate>

                    @csrf
                    <div class="row">
                        <label class="form-check-label font-weight-bold">
                            Type
                        </label>
                    </div>
                    <div class="row">

                        <select class="custom-select" name="discounttype" id="discountSel">
                            <option value="cash" id="cash" >Cash</option>
                            <option value="percentage" id="percentage">Percentage</option>
                        </select>

                        {{-- <div class="col-sm-5">
                            <input type="radio" name="promotionname" id="cash" placeholder="Promotion Name" required checked>
                            <label class="form-check-label" for="cash">
                                Cash
                            </label>
                        </div>
                        <div class="col-sm-7">
                            <input type="radio" name="promotionname" id="percentage" placeholder="Promotion Name" required>
                            <label class="form-check-label" for="percentage">
                                Percentage
                            </label>
                        </div> --}}

                    </div>
                    <div id="amount">
                        <div class="row">
                            <label class="form-check-label font-weight-bold pt-2">
                                Amount
                            </label>
                        </div>
                        <div class="row " id="amount">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rs</span>
                                </div>

                                <input type="text" name="amount" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                        </div>
                    </div>
                    <div id="percents">
                        <div class="row">
                            <label class="form-check-label font-weight-bold pt-2">
                                Percentage
                            </label>
                        </div>
                        <div class="row ">
                            <div class="input-group mb-3">
                                <input type="text" name="percentage" class="form-control" placeholder="0" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div> {{-- End  of sectionContent--}}
    </div> {{-- End  of section--}}
</div>
<div class="row mt-4 mb-4">
    <div class="col-md-9">

        <div class="section"> {{-- Start of Section--}}
            <div class="section-title">
                Promotion Type
                <hr>
            </div>

            <div class="section-content promotion"> {{-- Start of sectionContent--}}
                {{-- Start of Form --}}

                <form method="post" class="needs-validation" action="{{route('promotion.store')}}" novalidate>

                    @csrf

                    <div class="row pb-2">
                        <div class="col">
                            Select Promotion type
                        </div>

                    </div>
                    <div class="row pb-0 pt-2">
                        <div class="col">
                        <select class="custom-select" name="promotiontype" id="typeSel">
                            <option value="all" id="allPrd">All Products</option>
                            <option value="specific">Specific Products</option>
                        </select>
                    </div>
                    </div>
        <livewire:select-products :product="$prd" />
        <div class="row submit-row mt-3">
            <div class="col">
                <input class="btn-submit" type="submit" value="Save">
            </div>
        </div>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}


</div>


</div>

</div>
</form>
{{-- End of Form --}}
<script>
    var num = 0;
    var del = 0;
    var arr = [];
    $("document").ready(function() {
        $("#percents").hide();
    });

    $("#discountSel").click(function() {
        if($("#cash").is(':selected')){
            $("#amount").show();
             $("#percents").hide();


        }else{
            $("#percents").show();
        $("#amount").hide();

        }

    });
    $("#typeSel").click(function() {
        if($("#allPrd").is(':selected')){
            $("#allProducts").hide();


        }else{
            $("#allProducts").show();

        }
    });
    document.addEventListener("DOMContentLoaded", function() {

        OverlayScrollbars(document.querySelectorAll(".product-overlay"), {});

    });
    $(document).ready(function() {
        // Search Products
        $("#prdSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".dropdown-menu tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        if($("#allPrd").is(':selected')){
            $("#allProducts").hide();
        }

    });

    $(document).ready(function() {
        $('.mdb-select').materialSelect();

    });
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
            var index = num;
            cell1.innerHTML = ++num;
            cell2.innerHTML = array[value]['pcode'];
            cell3.innerHTML = array[value]['name'];
            cell4.innerHTML = array[value]['size'];
            cell5.innerHTML = array[value]['color'];
            cell6.innerHTML = '<i class="fas fa-times cancel" id="remove"></i>';
            cell7.innerHTML = index;
            cell7.className = 'none';
            arr.push([array[value]['id'],array[value]['vid']]);

            }
        }
        var s = JSON.stringify(arr);
        document.cookie = "promotions = "+s;
    }


    $('#selectedProducts').on('click', '#remove', function(e){

        var index = $(this).closest('tr').index();
        var table = document.getElementById("selectedProducts");
        var delrow = table.rows[index].cells[6].innerHTML;
        arr.splice(delrow,1);
        var n = JSON.stringify(arr);
        document.cookie = "promotions = "+n;
        $(this).closest('tr').remove();
        var x = table.rows.length;
        num = 0;
        for(i=1; i<=x;i++){
            table.rows[i].cells[0].innerHTML = ++num;
            table.rows[i].cells[6].innerHTML = num-1;
        }

    });





</script>
@endsection

