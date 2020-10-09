@extends('layouts.main')
@section('content')

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
<div class="pg-heading">

    <div class="pg-title">All Sales</div>
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

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('sales.report') }}" target="_blank">Export Sales</a>
            </div>
            {{-- <div class="add-btn">
                <a href="{{ route('user.create') }}">Add User</a>
    </div> --}}
    <thead class="table-head">
        <tr>
            <th>Sale Id</th>
            <th>Staff Name</th>
            <th>Customer Name</th>
            <th>Amount</th>
            <th>Discount</th>
            <th>Date</th>


        </tr>
    </thead>
    <tbody>
        @foreach($sale as $s)


        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->fname.' '.$s->lname }}</td>
            <td>{{ $s->firstname.' '.$s->lastname }}</td>
            <td>{{ $s->amount }}</td>
            <td>{{ $s->discount }}</td>
            <td>{{ $s->updated_at }}</td>

            <td class="action-icon">
                <a href="{{ route('sale.edit',$s->id) }}"><i class="fas fa-pen"></i></a>
                <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                <form method="POST" class="dlt-form" action="{{ route('sale.destroy',$s->id) }}">
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
{{-- <livewire:all-sales :sales="$sale"/> --}}

<script type="text/javascript">
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
