@extends('layouts.main')
@section('content')
<div class="allexpense">
<div class="pg-heading">

    <div class="pg-title">All Expenses</div>
    <input type="text" class="daterange" id="daterange" name="daterange" />
    {{-- <span  id="daterange"> --}}
    <input type="text" id="end" name="end" hidden>
    {{-- <span class="dash">-</span> --}}
    <input type="text" id="start" name="start" hidden>
    {{-- </span> --}}

    <div class="period-selector">
        <select class="custom-select p-select" id="pSelect" id="typeSel">
            <option value="1" id="today">Today</option>
            <option value="2" id="day2">Yesterday</option>
            <option value="7" id="day7">Last 7 Days</option>
            <option value="14" id="day14">Last 14 Days</option>
            <option value="30" id="day30">This Month</option>
            <option value="60" id="day60">Last Month</option>
            <option value="range" id="date">Date Range</option>
        </select>

    </div>
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
                <a href="{{ route('expense.report') }}" target="_blank">Export Expense</a>
            </div>
            <div class="add-btn"> {{-- Add button --}}
                <a href="#" id="addexpense1">Add Expense</a> {{-- Enter the name of the add btn --}}
            </div>
            <thead class="table-head">

                <tr>
                    <th>Expense Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expense as $e)
                <tr>

                    <td>{{$e->type}}</td>
                    <td>{{$e->description}}</td>
                    <td>{{$e->amount}}</td>
                    <td>{{$e->username}}</td>
                    <td>{{$e->created_at}}</td>
                    <td class="action-icon">
                        <a onclick="editExpense({{ $e->id }})"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $e->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $e->id }}" action="{{ route('expense.destroy',$e->id)}}">
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

{{-- /****** Add Expense Model ******/ --}}

<div class="full-pg" id="fadeBg1"></div>
<div class="pos-sub-display" id="posSubExpense1">

    <div class="pos-sub-display-title">
        <span class="title">Add Expense</span>
        <button class="close-btn" id="closeBtn1"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{route('expense.store')}}" novalidate>
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type</label>
                        <select name="type" class="form-control" id="exampleFormControlSelect1">
                            <option value="Stationary">Stationary</option>
                            <option value="Food">Food</option>
                            <option value="Electricity">Electricity</option>
                            <option value="Telephone">Telephone</option>
                            <option value="Petty Cash">Petty Cash</option>
                            <option value="Water">Water</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" required />
                        <div class="invalid-feedback">
                            Please enter an amount
                          </div>
                    </div>
                </div>
            </div>


            <div class="form-group pl-2 pr-2">
                <div class="row">
                    <label>Description</label>
                </div>
                <div class="row">
                    <textarea name="description" class="pos-sub-txtArea" rows=5></textarea>
                </div>
            </div>
            <input type="text" value="22" name="userId" hidden>
            <div class="action-btn-row">

                <input type="submit" class="add-sub-btn" value="Add" />

            </div>
        </form>
    </div>
</div>

{{-- End of Add Expense Model --}}

{{-- /****** Edit Expense Model ******/ --}}

<div class="full-pg" id="fadeBg2"></div>
<div class="pos-sub-display" id="posSubExpense2">

    <div class="pos-sub-display-title">
        <span class="title">Edit Expense</span>
        <button class="close-btn" id="closeBtn2"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{route('updateExpense')}}" novalidate>
            @csrf
            @method('patch')
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="editExpenseSelect">Type</label>
                        <select name="type" class="form-control" id="editExpenseSelect">
                            <option value="Stationary">Stationary</option>
                            <option value="Food">Food</option>
                            <option value="Electricity">Electricity</option>
                            <option value="Telephone">Telephone</option>
                            <option value="Petty Cash">Petty Cash</option>
                            <option value="Water">Water</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" id="amntEdit" name="amount" class="form-control" required/>
                        <div class="invalid-feedback">
                            Please enter an amount
                          </div>
                    </div>
                </div>
            </div>


            <div class="form-group pl-2 pr-2">
                <div class="row">
                    <label>Description</label>
                </div>
                <div class="row">
                    <textarea name="description" id="descriptionEdit" class="pos-sub-txtArea" rows=5></textarea>
                </div>
            </div>
            <input type="text" value="22" name="userId" hidden>
            <input type="text" name="id" id="editExpenseId" hidden>
            <div class="action-btn-row">

                <input type="submit" class="add-sub-btn" value="Add" />

            </div>

        </form>
    </div>
</div>
</div>
</div>

{{-- End of Add Expense Model --}}
<script>
    //Expense Model
    $(document).ready(function() {
        $('#addexpense1').on('click', function() {
            $('#posSubExpense1').toggleClass('block');
            $('#fadeBg1').toggleClass('block');
        });
        $('#closeBtn1').on('click', function() {
            $('#posSubExpense1').removeClass('block');
            $('#fadeBg1').removeClass('block');
        });
        $('#closeBtn2').on('click', function() {
            $('#posSubExpense2').removeClass('block');
            $('#fadeBg2').removeClass('block');
        });
    });
    function editExpense(id){
        $('#posSubExpense2').toggleClass('block');
        $('#fadeBg2').toggleClass('block');

        var complex = <?php echo json_encode($expense); ?>;

        complex.forEach(myFunction);

        function myFunction(index,value,array){

            if(array[value]['id'] == id){
                $('#amntEdit').val(array[value]['amount']);
                $('#descriptionEdit').text(array[value]['description']);
                $('#editExpenseSelect').val(array[value]['type']);
                $('#editExpenseId').val(array[value]['id']);

            }
        }
    }


$(document).ready(function() {

    FilterStart = moment().format("YYYY-MM-DD");
    FilterEnd = moment().format("YYYY-MM-DD");
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {

            var DataTableStart = data[4].trim();
            var DataTableEnd = data[4].trim();
            if (FilterStart == '' || FilterEnd == '') {
                return true;
            }
            if (DataTableStart >= FilterStart && DataTableEnd <= FilterEnd + 1) {
                return true;
            } else {
                return false;
            }
        });
});


</script>
@endsection
