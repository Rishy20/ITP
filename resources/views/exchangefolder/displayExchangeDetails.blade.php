@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">All Exchanges</div>
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
                <a href="{{ route('exchanges.report') }}" target="_blank">Export Exchanges</a>
            </div>
            {{-- <div class="add-btn">
                <a href="{{ route('exchange.create') }}">Add Return</a>
            </div> --}}
    <thead class="table-head">
       <tr>
        <th>ID</th>
        <th>Product Code</th>
        <th>Customer ID</th>
        <th>Salesman ID</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Actions</th>


        </tr>
    </thead>
       <tbody>
            @foreach($exchanges as $row)
           <tr>
             <td>{{ $row->id }}</td>
             <td>{{ $row->pcode }}</td>
             <td>{{ $row->firstname." ".$row->lastname }}</td>
             <td>{{ $row->fname." ".$row->lname }}</td>
             <td>{{ $row->amount }}</td>
             <td>{{ $row->created_at }}</td>



                    <td class="action-icon">
                        {{-- <a href="{{ route('exchange.edit',$row->id) }}"><i class="fas fa-pen"></i></a> Edit icon --}}
                        {{-- Delete Icon --}}
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $row->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $row->id }}" action="{{ route('exchange.destroy',$row->id) }}">
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
<script>

    $(document).ready(function() {

FilterStart = moment().format("YYYY-MM-DD");
FilterEnd = moment().format("YYYY-MM-DD");
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {

        var DataTableStart = data[5].trim();
        var DataTableEnd = data[5].trim();
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
