@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <a href="{{ route('reports.index') }}">
        <i class="fa fa-arrow-left pg-back"></i>
    </a>
    <div class="pg-title">Product Return Report</div>
</div>

<div class="section">

    <div class="section-content">
        <form action="{{ route('reports.export-product-return') }}" target="_blank" method="POST">
            @csrf
            <input type="hidden" name="start_date" id="start_date">
            <input type="hidden" name="end_date" id="end_date">

            <table id="data_table" class="table table-striped table-borderless table-hover all-table">
                <button type="submit" class="add-btn">Export Report</button>
                <div class="float-right pr-3">
                    <div id="date_range" style="background: #fff; cursor: pointer; padding: 9px 18px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>

                <thead class="table-head">
                    <tr>
                        <th>Product Code</th>
                        <th>Customer</th>
                        <th>Salesman</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returns as $return)
                        <tr>
                            <td>{{ $return->pcode }}</td>
                            <td>{{ $return->firstname." ".$return->lastname }}</td>
                            <td>{{ $return->fname." ".$return->lname }}</td>
                            <td class="text-right">{{ $return->amount }}</td>
                            <td>{{ $return->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    let dataTable, startDate, endDate;

    $(function() {
        const date_range_text = $('#date_range span');

        const today = moment().format("YYYY-MM-DD");
        const yesterday = moment().subtract(1, 'days').format("YYYY-MM-DD");
        const seven_days_back = moment().subtract(6, 'days').format("YYYY-MM-DD");
        const thirty_days_back = moment().subtract(29, 'days').format("YYYY-MM-DD");
        const month_start = moment().startOf('month').format("YYYY-MM-DD");
        const month_end = moment().endOf('month').format("YYYY-MM-DD");
        const last_month_start = moment().subtract(1, 'month').startOf('month').format("YYYY-MM-DD");
        const last_month_end = moment().subtract(1, 'month').endOf('month').format("YYYY-MM-DD");

        const start = moment();
        const end = moment();

        function render(start, end) {
            start = start.format('YYYY-MM-DD');
            end = end.format('YYYY-MM-DD');

            if (start === today && end === today) {
                date_range_text.html("Today");
                startDate = today;
                endDate = today;
            }
            else if (start === yesterday && end === yesterday) {
                date_range_text.html("Yesterday");
                startDate = yesterday;
                endDate = yesterday;
            }
            else if (start === seven_days_back && end === today) {
                date_range_text.html("Last 7 Days");
                startDate = seven_days_back;
                endDate = today;
            }
            else if (start === thirty_days_back && end === today) {
                date_range_text.html("Last 30 Days");
                startDate = thirty_days_back;
                endDate = today;
            }
            else if (start === month_start && end === month_end) {
                date_range_text.html("This Month");
                startDate = month_start;
                endDate = month_end;
            }
            else if (start === last_month_start && end === last_month_end) {
                date_range_text.html("Last Month");
                startDate = last_month_start;
                endDate = last_month_end;
            }
            else {
                date_range_text.html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));
                startDate = start;
                endDate = end;
            }

            if ($.fn.dataTable.isDataTable(dataTable)) {
                dataTable.draw();
            }

            $('#start_date').val(startDate);
            $('#end_date').val(endDate);
        }

        $('#date_range').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, render);

        render(start, end);
    });

    $(document).ready(function() {
        $.fn.dataTable.ext.search.push(
            function(settings, data) {
                let rangeStart = data[4];
                let rangeEnd = data[4];

                if (startDate === '' || endDate === '') {
                    return true;
                }

                return rangeStart >= startDate && (rangeEnd <= endDate + 1);
            });

        dataTable = $('#data_table').DataTable({
            "order": []
            , "dom": '<"top"f><t><"bottom"lip>'
            , language: {
                search: "_INPUT_"
                , searchPlaceholder: "🔎 Search"
            }
        });

        $('#start_date').val(startDate);
        $('#end_date').val(endDate);
    });
</script>

@endsection
