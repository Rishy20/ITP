@extends('layouts.main')
@section('content')

<div class="addUser"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route ( 'loyalty.index' )}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Loyalty</div>

    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <form method="post" action="{{route('loyalty.update',$loyalty->id)}}">
                    @method('patch')
                <div class="section-title">
                    Loyalty Information
                    <input class="btn-submit" type="submit" value="Submit">
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}

                        @csrf

                        <div class="row">
                            <div class="col">
                            <input type="text" id="loyaltyName" name="loyaltyName" class="form-control" value="{{$loyalty->loyaltyName}}" placeholder="Loyalty Name" required/>
                                <label for="loyaltyName" class="float-label">Loyalty Name</label>
                            </div>
                        </div>

                        <br>
                         <div class="section-title">
                            Add Customers
                            <hr>
                        </div>

{{--
                        <div class="form-group">
                            <input type="search" name="add_customer" id="add_customer" class="form-control input-lg" placeholder="Enter Customer Name" style="width: 50%" />

                        </div>
                        {{ csrf_field() }}

                        <br>

                        <table class="table hover table-striped table-borderless table-hover all-table">
                            <thead class="table-head">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last name</th>
                                    <th>gender</th>
                                    <th>DOB</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 2</td>
                                </tr> --}}
                       {{--    </tbody>
                        </table> --}}


                        {{-- <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Submit">
                            </div>
                        </div> --}}
                        <livewire:select-customers/>
                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}


        </div>
        <div class="col-md-3">
            <div class="section"> {{-- Start of Section 2--}}
                <div class="section-title section-title-sub">
                    Tier Points
                    <hr>
                </div>

            <div class="section-content"> {{-- Start of sectionContent--}}


                <div class="section"> {{-- Start of Section 2--}}
                    <p style="text-align: center">Minimum Points Required</p>



                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                <input type="number" id="minimumPointRequired" name="minimumPointRequired" value="{{$loyalty->minimumPointRequired}}" style="width: 25%"/>
                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>

                </div>

                    <hr>

                <div class="section"> {{-- Start of Section 2--}}
                    <p style="text-align: center">Earning Loyalty</p>


                        Rs. <input type="number" id="number" name="tierPoints" value="{{$loyalty->tierPoints}}"  style="width: 32%"/> = 1 Loyalty Point


                </div>
                    <hr>

                <div class="section"> {{-- Start of Section 2--}}
                    <p style="text-align: center">Points On Sign Up</p>


                        <div class="value-button" id="decrease" onclick="decreaseValue1()" value="Decrease Value">-</div>
                        <input type="number" id="points" name="points"value="{{$loyalty->points}}"  style="width: 25%"/>
                        <div class="value-button" id="increase" onclick="increaseValue1()" value="Increase Value">+</div>


                </div>
            </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
</form>
</div>{{-- End of addUser --}}

<script>
    function increaseValue() {
        var value = parseInt(document.getElementById('minPoint').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('minPoint').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('minPoint').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('minPoint').value = value;
    }
    function increaseValue1() {
        var value = parseInt(document.getElementById('points').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('points').value = value;
    }

    function decreaseValue1() {
        var value = parseInt(document.getElementById('points').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('points').value = value;
    }


    var num = 0;
    var del = 0;
    var arr = [];
    $(document).ready(function() {
        // Search Products
        $("#cusSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".dropdown-menu tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        var loyal_cus = <?php echo json_encode($loyal_cus); ?>;

        loyal_cus.forEach(function(index,value,array){
            addCustomer(array[value]['customerId']);
        })

    });

    function addCustomer(id){

        var complex = <?php echo json_encode($customer); ?>;
        complex.forEach(myFunction);
        function myFunction(index,value,array){


            var selectedCustomers = document.getElementById("selectedCustomers");
            if(array[value]['id'] == id){
            var row = selectedCustomers.insertRow();
            row.className = 'item-table-row';
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var index = num;
            cell1.innerHTML = ++num;
            cell2.innerHTML = array[value]['id'];
            cell3.innerHTML = array[value]['firstname'] + ' ' + array[value]['lastname'];
            cell4.innerHTML = array[value]['gender'];
            cell5.innerHTML = array[value]['city'];
            cell6.innerHTML = array[value]['phone'];
            cell7.innerHTML = '<i class="fas fa-times cancel" id="remove"></i>';
            cell8.innerHTML = index;
            cell8.className = 'none';
            arr.push([array[value]['id']]);

            }
        }
        var s = JSON.stringify(arr);
        document.cookie = "customers = "+s;
    }


$('#selectedCustomers').on('click', '#remove', function(e){

var index = $(this).closest('tr').index();
var table = document.getElementById("selectedCustomers");
var delrow = table.rows[index].cells[7].innerHTML;
arr.splice(delrow,1);
var n = JSON.stringify(arr);
document.cookie = "customers = "+n;
$(this).closest('tr').remove();
var x = table.rows.length;
num = 0;
for(i=1; i<=x;i++){
    table.rows[i].cells[0].innerHTML = ++num;
    table.rows[i].cells[7].innerHTML = num-1;
}

});


</script>

@endsection
