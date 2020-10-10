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
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#customer" role="tab" onclick="categorySection('Customers')">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-people-arrows"></i></div>
                        Customer
                    </a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#payment" role="tab" onclick="categorySection('Payments')">
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
                </div>

                <div class="list-group category" id="payment" hidden>
                    <a class="list-group-item list-group-item-action" id="total-expense" role="tabpanel" href="#">
                        <div class="d-inline-block" style="width: 32px"><i class="fa fa-money-bill"></i></div>
                        Total Expense Report
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
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
@endsection
