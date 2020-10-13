<div>
    <nav id="navbar">
        <ul class="list-unstyled components">
            <li class="pos-nav-li">
                <a href="#" id="addexpense">Add Expense</a>
            </li>
            <li class="pos-nav-li">
                <a href="#">Mark Attendance</a>
            </li>
            <li class="pos-nav-li">
                <a href="#">About</a>
            </li>
            <li class="pos-nav-li">
                <a href="#">About</a>
            </li>
        </ul>
    </nav>
<div class="navigation">
    <a class="nav-btn" href="{{ route('dashboard') }}"  id="sidebarCollapseHome">
        <i class="fas fa-home nav-icon"></i>
        <div class="nav-text">Home</div>
    </a>
    <button class="nav-btn" id="sidebarCollapseProducts">
        <i class="fas fa-tags nav-icon"></i>
        <div class="nav-text">Products</div>
    </button>
    <button class="nav-btn" id="sidebarCollapseSales">
        <i class="fas fa-layer-group nav-icon"></i>
        <div class="nav-text">Sales</div>
    </button>
    <button class="nav-btn" id="sidebarCollapseReports">
        <i class="fas fa-file-contract nav-icon"></i>
        <div class="nav-text">Reports</div>
    </button>
    <button class="nav-btn" id="sidebarCollapseCustomers">
        <i class="fas fa-users nav-icon"></i>
        <div class="nav-text">Customers</div>
    </button>
    <button class="nav-btn" id="sidebarCollapseStaffs">
        <i class="fas fa-user-tag nav-icon"></i>
        <div class="nav-text">Staff</div>
    </button>
    <button class="nav-btn" id="sidebarCollapseSetup">
        <i class="fas fa-cog nav-icon"></i>
        <div class="nav-text">Setup</div>
    </button>
</div>
</div>

{{-- Products Collapse --}}

<nav id="navbar" class="navbar-products">
    <ul class="list-unstyled components">
        <li class="pos-nav-li">
            <a href="{{ route('product.index') }}" >All Products</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('product.create') }}">Add Products</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('category.index') }}">Manage Categories</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('brand.index') }}">Manage Brands</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('return.index') }}">Return Products</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('inventories.index') }}">Manage Inventories</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('stock-transfers.index') }}">Stock Transfer</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('inventory-counts.index') }}">Inventory Counts</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('promotion.index') }}">Manage Promotions</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('purchase.index') }}">Manage Purchases</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('barcode') }}">Print Labels</a>
        </li>

    </ul>
</nav>

{{-- Sales Collapse --}}

<nav id="navbar" class="navbar-sales">
    <ul class="list-unstyled components">
        <li class="pos-nav-li">
            <a href="{{ route('sale.index') }}" >All Sales</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('expense.index') }}">Expenses</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('exchange.index') }}">Manage Exchanges</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('voucher.index') }}">Manage Vouchers</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('service.index') }}">Manage Services</a>
        </li>

    </ul>
</nav>

{{-- Reports Collapse --}}
<nav id="navbar" class="navbar-reports">
    <ul class="list-unstyled components">
        <li class="pos-nav-li">
            <a href="{{ route('reports.index') }}" >All Reports</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('reports.index') }}">Sales Report</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('reports.index') }}">Inventory Report</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('reports.index') }}">Product Report</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('reports.index') }}">Customer Report</a>
        </li>
    </ul>
</nav>

{{-- Customers Collapse --}}
<nav id="navbar" class="navbar-customers">
    <ul class="list-unstyled components">
        <li class="pos-nav-li">
            <a href="{{ route('customer.index') }}" >All Customers</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('customer.create') }}">Add Customers</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('loyalty.index') }}">Manage Loyalty</a>
        </li>

    </ul>
</nav>

{{-- Staffs Collapse --}}

<nav id="navbar" class="navbar-staffs">
    <ul class="list-unstyled components">
        <li class="pos-nav-li">
            <a href="{{ route('employee.index') }}" >All Staff</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('employee.create') }}">Add Staff</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('attendance.index') }}">Staff Attendance</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('salaryPayment.index') }}">Salary Payment</a>
        </li>

    </ul>
</nav>
{{-- Setup Collapse  --}}
<nav id="navbar" class="navbar-setup">
    <ul class="list-unstyled components">
        <li class="pos-nav-li">
            <a href="{{ route('user.index') }}" >All Users</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('user.create') }}">Add User</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('role.index') }}">Manage Roles</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('bank.index') }}">Manage Bank Accounts</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('vendors.index') }}">Manage Vendors</a>
        </li>
        <li class="pos-nav-li">
            <a href="{{ route('vendorPayment.index') }}">Vendor Payment</a>
        </li>
    </ul>
</nav>

<script>
    $('document').ready(function(){

        $('#sidebarCollapseProducts').on('click', function() {
                    $('.navbar-products').toggleClass('active');
                    var classFound = false;
                    $('.navbar-setup,.navbar-sales,.navbar-reports,.navbar-customers,.navbar-staffs').each(function() {
                            if ($(this).hasClass('active')){
                                classFound = true;
                            }
                    });
                    if(classFound == false){
                        $('.main').toggleClass('margin');
                    }
                    $('.navbar-setup,.navbar-sales,.navbar-reports,.navbar-customers,.navbar-staffs').each(function() {
                        $(this).removeClass('active')
                    });
        });

        $('#sidebarCollapseSales').on('click', function() {
                    $('.navbar-sales').toggleClass('active');
                    var classFound = false;
                    $('.navbar-products,.navbar-setup,.navbar-reports,.navbar-customers,.navbar-staffs').each(function() {
                            if ($(this).hasClass('active')){
                                classFound = true;
                            }
                    });
                    if(classFound == false){
                        $('.main').toggleClass('margin');
                    }
                    $('.navbar-products,.navbar-setup,.navbar-reports,.navbar-customers,.navbar-staffs').each(function() {
                        $(this).removeClass('active')
                    });
        });

        $('#sidebarCollapseReports').on('click', function() {
                    $('.navbar-reports').toggleClass('active');
                    var classFound = false;
                    $('.navbar-products,.navbar-sales,.navbar-setup,.navbar-customers,.navbar-staffs').each(function() {
                            if ($(this).hasClass('active')){
                                classFound = true;
                            }
                    });
                    if(classFound == false){
                        $('.main').toggleClass('margin');
                    }
                    $('.navbar-products,.navbar-sales,.navbar-setup,.navbar-customers,.navbar-staffs').each(function() {
                        $(this).removeClass('active')
                    });
        });

        $('#sidebarCollapseCustomers').on('click', function() {
                    $('.navbar-customers').toggleClass('active');
                    var classFound = false;
                    $('.navbar-products,.navbar-sales,.navbar-reports,.navbar-setup,.navbar-staffs').each(function() {
                            if ($(this).hasClass('active')){
                                classFound = true;
                            }
                    });
                    if(classFound == false){
                        $('.main').toggleClass('margin');
                    }
                    $('.navbar-products,.navbar-sales,.navbar-reports,.navbar-setup,.navbar-staffs').each(function() {
                        $(this).removeClass('active')
                    });
        });

        $('#sidebarCollapseStaffs').on('click', function() {
                    $('.navbar-staffs').toggleClass('active');
                    var classFound = false;
                    $('.navbar-products,.navbar-sales,.navbar-reports,.navbar-customers,.navbar-setup').each(function() {
                            if ($(this).hasClass('active')){
                                classFound = true;
                            }
                    });
                    if(classFound == false){
                        $('.main').toggleClass('margin');
                    }
                    $('.navbar-products,.navbar-sales,.navbar-reports,.navbar-customers,.navbar-setup').each(function() {
                        $(this).removeClass('active')
                    });
        });

        $('#sidebarCollapseSetup').on('click', function() {
                    $('.navbar-setup').toggleClass('active');
                    var classFound = false;
                    $('.navbar-products,.navbar-sales,.navbar-reports,.navbar-customers,.navbar-staffs').each(function() {
                            if ($(this).hasClass('active')){
                                classFound = true;
                            }
                    });
                    if(classFound == false){
                        $('.main').toggleClass('margin');
                    }
                    $('.navbar-products,.navbar-sales,.navbar-reports,.navbar-customers,.navbar-staffs').each(function() {
                        $(this).removeClass('active')
                    });
        });

    })
</script>
