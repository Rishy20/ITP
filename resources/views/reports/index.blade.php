@extends('layouts.main')
@section('content')
<div class="user">
    <div class="pg-title">
        <h2>Reports</h2>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="section">
            <div class="section-content">
                <div class="section-title">
                    Report Categories
                    <hr>
                </div>

                <div class="list-group" role="tablist">
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#sales" role="tab" onclick="categorySection('Sales')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-shopping-cart"></i></div>
                        Sales
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#inventory" role="tab" onclick="categorySection('Inventory')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-book"></i></div>
                        Inventory
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#product" role="tab" onclick="categorySection('Product')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-tshirt"></i></div>
                        Product
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#customer" role="tab" onclick="categorySection('Customer')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-people-arrows"></i></div>
                        Customer
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#payment" role="tab" onclick="categorySection('Payment')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-dollar-sign"></i></div>
                        Payment
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#other" role="tab" onclick="categorySection('Other')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-file"></i></div>
                        Other
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="section" id="by-category-section" hidden>
            <div class="section-content">
                <div class="section-title">
                    <span id="category-header"></span>
                    <hr>
                </div>

                {{-- Sales Category --}}
                <div class="list-group category" id="sales" hidden>
                    <a class="list-group-item list-group-item-action" id="product-wise-sales" role="tabpanel"
                       href="#">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-tshirt"></i></div>
                        Product-wise Sales Report
                    </a>
                    <a class="list-group-item list-group-item-action" id="category-wise-sales" role="tabpanel" href="#">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-list"></i></div>
                        Category-wise Sales Report
                    </a>
                    <a class="list-group-item list-group-item-action" id="supplier-wise-sales" role="tabpanel" href="#">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-building"></i></div>
                        Supplier-wise Sales Report
                    </a>
                    <a class="list-group-item list-group-item-action" id="customer-wise-sales" role="tabpanel" href="#">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-user"></i></div>
                        Customer-wise Sales Report
                    </a>
                    <a class="list-group-item list-group-item-action" id="salesman-wise-sales" role="tabpanel" href="#">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-hospital-user"></i></div>
                        Salesman-wise Sales Report
                    </a>
                    {{-- Total Expense Report --}}
                    <a class="list-group-item list-group-item-action" id="total-expense" role="tabpanel"
                       href="{{ route('reports.total-expense') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-money-check"></i></div>
                        Total Expense Report
                    </a>
                    {{-- Product Return Report --}}
                    <a class="list-group-item list-group-item-action" id="product-return" role="tabpanel"
                       href="{{ route('reports.product-return') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-backward"></i></div>
                        Product Return Report
                    </a>
                    {{-- Daily Profit Report --}}
                    <a class="list-group-item list-group-item-action" id="daily-profit" role="tabpanel"
                       href="{{ route('reports.daily-profit') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-coins"></i></div>
                        Daily Profit Report
                    </a>
                    {{-- Monthly Profit Report --}}
                    <a class="list-group-item list-group-item-action" id="monthly-profit" role="tabpanel"
                       href="{{ route('reports.monthly-profit') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-coins"></i></div>
                        Monthly Profit Report
                    </a>
                </div>

                {{-- Inventory Category --}}
                <div class="list-group category" id="inventory" hidden>
                    {{-- Stock Transfer Summary Report --}}
                    <a class="list-group-item list-group-item-action" id="stock-transfer" role="tabpanel"
                       href="{{ route('reports.stock-transfer-summary') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-shuttle-van"></i></div>
                        Stock Transfer Summary Report
                    </a>
                    {{-- Stock Valuation Report --}}
                    <a class="list-group-item list-group-item-action" id="stock-valuation" role="tabpanel"
                       href="{{ route('reports.stock-valuation') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-book-open"></i></div>
                        Stock Valuation Report
                    </a>
                    {{-- Product-wise Stock Report --}}
                    <a class="list-group-item list-group-item-action" id="product-wise-stock" role="tabpanel"
                       href="{{ route('reports.product-wise-stock') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-tshirt"></i></div>
                        Product-wise Stock Report
                    </a>
                    {{-- Category-wise Stock Report --}}
                    <a class="list-group-item list-group-item-action" id="category-wise-stock" role="tabpanel"
                       href="{{ route('reports.category-wise-stock') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-tags"></i></div>
                        Category-wise Stock Report
                    </a>
                    {{-- Supplier-wise Stock Report --}}
                    <a class="list-group-item list-group-item-action" id="supplier-wise-stock" role="tabpanel"
                       href="{{ route('reports.supplier-wise-stock') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-store-alt"></i></div>
                        Supplier-wise Stock Report
                    </a>
                </div>

                {{-- Product Category --}}
                <div class="list-group category" id="product" hidden>
                    {{-- Zero Stock Product Report --}}
                    <a class="list-group-item list-group-item-action" id="zero-stock" role="tabpanel"
                       href="{{ route('reports.zero-stock-product') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-book"></i></div>
                        Zero Stock Product Report
                    </a>
                    {{-- Minus Stock Product Report --}}
                    <a class="list-group-item list-group-item-action" id="minus-stock" role="tabpanel"
                       href="{{ route('reports.minus-stock-product') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-book"></i></div>
                        Minus Stock Product Report
                    </a>
                    {{-- Supplier Purchase Report --}}
                    <a class="list-group-item list-group-item-action" id="supplier-purchase" role="tabpanel"
                       href="{{ route('reports.supplier-purchase') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-building"></i></div>
                        Supplier Purchase Report
                    </a>
                    {{-- Product-wise Profit Report --}}
                    <a class="list-group-item list-group-item-action" id="supplier-purchase" role="tabpanel"
                       href="#" data-toggle="modal" data-target="#date_range_select">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-coins"></i></div>
                        Product-wise Profit Report
                    </a>
                </div>

                {{-- Payment Category --}}
                <div class="list-group category" id="payment" hidden>
{{--                    --}}{{-- Total Payment Report --}}
{{--                    <a class="list-group-item list-group-item-action" id="total-payment" role="tabpanel"--}}
{{--                       href="{{ route('reports.total-payment') }}">--}}
{{--                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-money-check"></i></div>--}}
{{--                        Total Payment Report--}}
{{--                    </a>--}}
                    {{-- Supplier Payment Report --}}
                    <a class="list-group-item list-group-item-action" id="supplier-payment" role="tabpanel"
                       href="{{ route('reports.supplier-payment') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-building"></i></div>
                        Supplier Payment Report
                    </a>
                </div>

                {{-- Other Category --}}
                <div class="list-group category" id="other" hidden>
                    {{-- Day-End Report --}}
                    <a class="list-group-item list-group-item-action" id="day-end" role="tabpanel"
                       href="{{ route('reports.day-end') }}">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-calendar"></i></div>
                        Day-End Report
                    </a>
                </div>

                {{-- Date range selection modal --}}
                <div class="modal fade" id="date_range_select" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('reports.product-wise-profit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="start_date" id="start_date">
                                <input type="hidden" name="end_date" id="end_date">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="date-range-title">Select Date Range for the Report</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="text-center">
                                            <div id="date_range" style="background: #fff; cursor: pointer; padding: 9px 18px; border: 1px solid #ccc; width: 100%">
                                                <i class="fa fa-calendar"></i>&nbsp;
                                                <span></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Proceed</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function categorySection($category) {
        $('#category-header').text($category);
        $('#by-category-section').removeAttr('hidden');
        let categories = document.getElementsByClassName('category');

        for (let i = 0; i < categories.length; i++) {
            if (categories[i].id === $category.toLowerCase()) {
                categories[i].removeAttribute('hidden');
            } else {
                categories[i].setAttribute('hidden', '');
            }
        }

    }

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

            if (start === today && end === today)
                date_range_text.html("Today");
            else if (start === yesterday && end === yesterday)
                date_range_text.html("Yesterday");
            else if (start === seven_days_back && end === today)
                date_range_text.html("Last 7 Days");
            else if (start === thirty_days_back && end === today)
                date_range_text.html("Last 30 Days");
            else if (start === month_start && end === month_end)
                date_range_text.html("This Month");
            else if (start === last_month_start && end === last_month_end)
                date_range_text.html("Last Month");
            else
                date_range_text.html(moment(start).format('MMMM D, YYYY') + ' - ' + moment(end).format('MMMM D, YYYY'));

            $('#start_date').val(start);
            $('#end_date').val(end);
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
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
@endsection
