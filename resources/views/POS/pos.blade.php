<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">

    <link href="{{ asset('icons/css/all.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sample.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/DataTables/datatables.min.css" />
</head>
<body class="pos-terminal">
    @include('POS.pos-header')

    <div class="pos">
        <div class="row">
            <div class="col-md-8">
                <div class="product-search">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <form class="search-bar">
                        <input type="text" class="search-textbox form-control" placeholder="Find Products By Name, Number or Barcode">
                    </form>
                </div>
                <div class="item-display">
                    <table class="table">
                        <thead class="item-table-head">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="item-table-row">
                                <th scope="row">1</th>
                                <td>IGN0362</td>
                                <td>Oberri Designer Shoes</td>
                                <td>2</td>
                                <td>Rs.3000.00</td>
                                <td>0</td>
                                <td>Rs.6000.00</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="price-display">

                    <div class="mini-display">
                        <button class="mini-display-btn btn">
                            <i class="fas fa-user-circle s-icon"></i><span class="s-text"> Add a Salesman </span>
                        </button>
                    </div>

                    <div class="mini-display">
                        <button class="mini-display-btn btn">
                            <i class="fas fa-users s-icon"></i><span class="s-text"> Add a Customer </span>
                        </button>
                    </div>

                    <hr class="price-display-rule">
                    <div class="display-info">
                        <span class="display-text">No of Items</span>
                        <span class="display-values">05</span>
                    </div>
                    <hr class="price-display-rule">
                    <div class="display-info">
                        <span class="display-text">Discount</span>
                        <span class="display-values">Rs.500</span>
                    </div>
                    <hr class="price-display-rule">
                    <div class="display-info">
                        <span class="display-text">Subtotal</span>
                        <span class="display-values">Rs.3350.00</span>
                    </div>
                    <hr class="price-display-rule">
                    <div class="display-info">
                        <span class="display-text">Taxes</span>
                        <span class="display-values">Rs. 0.00</span>
                    </div>
                    <hr class="price-display-rule">
                    <div class="display-info">
                        <span class="display-text">Total</span>
                        <span class="display-values">Rs.5000.00</span>
                    </div>

                    <div class="pay-btn-div">
                        <button class="pay-btn btn">
                            <span class="pay">PAY</span>
                            <span class="pay-value">Rs.5000.00</span>
                        </button>
                    </div>

                    <div class="sub-btn-div">

                             <button class="sub-btn btn mr-2">
                                <i class="fas fa-undo sub-icon"></i><span class="sub-btn-txt"> Retrieve Sale</span>
                            </button>

                            <button class="sub-btn btn mr-2">
                                <i class="fas fa-parking sub-icon"></i><span class="sub-btn-txt"> Park Sale</span>
                            </button>
                            <button class="sub-btn btn">
                                <i class="fas fa-trash-alt sub-icon"></i><span class="sub-btn-txt"> Discard Sale</span>
                            </button>


                    </div>
                </div>
            </div>
        </div>

    </div>


</body>
</html>
