@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Services</div>
</div>
@if(session('message'))
<div class="message">
    <div class="message-success">
        <i class="far fa-check-circle message-icon"></i>
        <span class="message-text">Success!</span>
        <span class="message-text-sub">You're awesome!!!</span>
    </div>
</div>
{{ Session::forget('message') }}
@endif
<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('service.report') }}" target="_blank">Export Service</a>
            </div>
            <div class="add-btn">
                <a id="addService">Add Service</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Service ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Return Date</th>
                    <th>Service Description</th>
                    <th>Cost</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($service as $s)
                <tr>
                   <td>{{ $s->id  }}</td>
                    <td>{{ $s->firstname .' '. $s->lastname}}</td>
                     <td>{{ $s->created_at}}</td>
                   <td>{{ $s->return_date }}</td>
                    <td>{{ $s->service_description }}</td>
                   <td>{{ $s->cost }}</td>
                    <td>{{ $s->username }}</td>
                      <td class="action-icon">
                        <a onclick="editService({{$s->id}})" href="{{ route('service.edit',$s->id) }}" ><i class="fas fa-pen"  ></i></a>
                        <button class="dlt-btn" id="dlt-btn{{ $s->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $s->id }}"  action="{{ route('service.destroy',$s->id) }}">
                            @method('DELETE')
                            @csrf

                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

{{-- /****** Add Service Model ******/ --}}
<div class="full-pg" id="fadeBgService"></div>
<div class="pos-sub-display" id="posSubService">

    <div class="pos-sub-display-title">
        <span class="title">Service</span>
        <button class="close-btn" id="closeBtnService"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">
    <form method="POST" action="{{route('service.store')}}">
        @csrf

            <div class="row">

                 <div class="col">
                     <div class="form-group">
                         <label>Service ID</label>
                         <input type="text" name="id" id="serviceId" class="form-control" />
                     </div>
                 </div>

                <div class="col">
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" id="serviceCustomer"  class="form-control" data-toggle="dropdown" required/>
                        <ul class="dropdown-menu service-cus-dropdown">
                            <input class="form-control" id="cusSearch" type="text" placeholder="Search..">
                            @foreach($customer as $cus)
                                <li onclick="addServiceCustomer({{$cus->id}})" ><span class="sid">{{ $cus->phone }}</span><span class="sname">{{ $cus->firstname}} </span></li>
                            @endforeach
                        </ul>
                        <input type="text" id="cusId" name="customer_id" hidden/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                 <div class="form-group">
                     <label>Return Date</label>
                     <input type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days')); ?>" id="serviceReturn" name="return_date" class="form-control" />
                 </div>
                </div>
                <div class="col">
                 <div class="form-group">
                     <label>Cost</label>
                     <input type="text" id="serviceCost" name="cost" class="form-control" />
                 </div>
                </div>
            </div>


            <div class="form-group pl-2 pr-2">
                <div class="row">
                    <label>Description</label>
                </div>
                <div class="row">
                    <textarea name="service_description" id="serviceDescription" class="pos-sub-txtArea" rows=5></textarea>
                </div>
            </div>
            <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
            <div class="action-btn-row">


                <input type="submit"  class="add-sub-btn" value="Add" />

            </div>

    </div>
</form>
</div>

{{-- /****** Edit Service Model ******/ --}}
<div class="full-pg" id="fadeBgEditService"></div>
<div class="pos-sub-display" id="posSubEditService">

    <div class="pos-sub-display-title">
        <span class="title">Edit Service</span>
        <button class="close-btn" id="closeBtnEditService"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">
    <form method="POST" action="{{route('service.updateService')}}">
        @csrf
        @method('patch')
            <div class="row">
                 <div class="col">
                     <div class="form-group">
                         <label>Service ID</label>
                         <input type="text" name="id" id="editserviceId" class="form-control" />
                     </div>
                 </div>

                <div class="col">
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" id="editserviceCustomer" name="customer_id" class="form-control" data-toggle="dropdown" required/>
                        <ul class="dropdown-menu service-cus-dropdown">
                            <input class="form-control" id="cusSearch" type="text" placeholder="Search..">
                            @foreach($customer as $cus)
                                <li onclick="addServiceCustomer({{$cus->id}})" ><span class="sid">{{ $cus->phone }}</span><span class="sname">{{ $cus->firstname}} </span></li>
                            @endforeach
                        </ul>
                        <input type="text" id="editcusId" name="customer_id" hidden/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                 <div class="form-group">
                     <label>Return Date</label>
                     <input type="date" name="return_date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days')); ?>" id="editserviceReturn" class="form-control" />
                 </div>
                </div>
                <div class="col">
                 <div class="form-group">
                     <label>Cost</label>
                     <input type="text" id="editserviceCost" name="cost" class="form-control" />
                 </div>
                </div>
            </div>


            <div class="form-group pl-2 pr-2">
                <div class="row">
                    <label>Description</label>
                </div>
                <div class="row">
                    <textarea name="service_description" id="editserviceDescription" class="pos-sub-txtArea" rows=5></textarea>
                </div>
            </div>
            <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
            <div class="action-btn-row">

                <input type="submit"  class="add-sub-btn" value="Update" />

            </div>
        </form>
    </div>
</div>
<script>
    //Service model

    var serviceId = {{$serviceId}}

       //Search Customers
       $("#cusSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

    $('#addService').on('click', function() {
                $('#posSubService').toggleClass('block');
                $('#fadeBgService').toggleClass('block');

                $('#serviceId').val(serviceId);
            });
            $('#closeBtnService').on('click', function() {
                $('#posSubService').removeClass('block');
                $('#fadeBgService').removeClass('block');

            });
            $('#closeBtnEditService').on('click', function() {
                $('#posSubEditService').removeClass('block');
                $('#fadeBgEditService').removeClass('block');

            });


function addServiceCustomer(id){

serviceCus = id;
$('#cusId').val(id);
var customer = <?php echo json_encode($customer); ?>;
customer.forEach(function(index, value, array){

    if (array[value]['id'] == id) {
        $('#serviceCustomer').val(array[value]['firstname']+' '+array[value]['lastname']);
    }
});

}
function editService(id){
    event.preventDefault();
    $('#posSubEditService').toggleClass('block');
    $('#fadeBgEditService').toggleClass('block');

        var complex = <?php echo json_encode($service); ?>;

        complex.forEach(myFunction);

        function myFunction(index,value,array){

            if(array[value]['id'] == id){
                $('#editcusId').val(array[value]['customer_id']);
                serviceCus = id;
                $('#editserviceId').val(array[value]['id']);
                $('#editserviceCustomer').val(array[value]['firstname']+' '+array[value]['lastname']);
                $('#editserviceReturn').val(moment(array[value]['return_date']).format("YYYY-MM-DD"));
                $('#editserviceCost').val(array[value]['cost']);
                $('textArea#editserviceDescription').val(array[value]['service_description']);
            }
        }
    }


//     function updateService(){

// if($('#editserviceCustomer').val().length == 0){
//     alert("Please select a Customer");
// }else if($('#editserviceCost').val().length == 0){
//     alert("Please enter a Cost");
// }else  if($('#editserviceDescription').val().length == 0){
//     alert("Please enter a Description");
// }else{



// $('#posSubEditService').removeClass('block');
// $('#fadeBgEditService').removeClass('block');


// let id = $('#editserviceId').val();
// let customer_id = serviceCus;
// let return_date = $('#editserviceReturn').val();
// let description = $('#editserviceDescription').val();
// let cost = $('#editserviceCost').val();
// let user = {{Auth::user()->id}};
// let _token   = $('meta[name="csrf-token"]').attr('content');

// $.ajax({
//     url:"/service/"+id,
//     type:"POST",
//     data:{
//         id : id,
//         customer_id:customer_id,
//         return_date:return_date,
//         service_description:description,
//         cost:cost,
//         user_id:user,
//         _token:_token
//     },
//     success:function(response){

//     },
// });
// }
//     }

//     function addService(){

// if($('#serviceCustomer').val().length == 0){
//     alert("Please select a Customer");
// }else if($('#serviceCost').val().length == 0){
//     alert("Please enter a Cost");
// }else  if($('#serviceDescription').val().length == 0){
//     alert("Please enter a Description");
// }else{



// $('#posSubService').removeClass('block');
// $('#fadeBgService').removeClass('block');


// let id = $('#serviceId').val();
// let customer_id = serviceCus;
// let return_date = $('#serviceReturn').val();
// let description = $('#serviceDescription').val();
// let cost = $('#serviceCost').val();
// let user = {{Auth::user()->id}};
// let _token   = $('meta[name="csrf-token"]').attr('content');

// $.ajax({
//     url:"/service",
//     type:"POST",
//     data:{
//         id : id,
//         customer_id:customer_id,
//         return_date:return_date,
//         service_description:description,
//         cost:cost,
//         user_id:user,
//         _token:_token
//     },
//     success:function(response){

//     },
// });

// $('#serviceId').val('');
// $('#serviceDescription').val('');
// $('#serviceCustomer').val('');
// $('#serviceCost').val('');
// serviceId++;
// serviceCus = '';
// }
// }
</script>
@endsection
