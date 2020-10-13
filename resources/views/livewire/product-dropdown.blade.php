<div>
    <div class="row">
        <div class="col-md-8">
            <div class="product-search">
                <div class="search-box">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>

                    <form class="search-bar" id="posSearch">
                        <input type="text"  id="prdSearch" class="search-textbox form-control" data-toggle="dropdown" placeholder="Find Products By Name, Number or Barcode">
                        <div class="dropdown-menu product-overlay" aria-labelledby="dropdownMenuButton">


                            <table class="table table-borderless" id="productSearchTable">



                            @foreach($products as $pr)
                            <tr >

                            <td class="pr-code">
                                {{ $pr->pcode }}
                            </td>
                            <td class="pr-name">
                                {{ $pr->name }}
                            </td>
                            <td class="pr-qty">
                                {{ $pr->Qty }}
                            </td>
                            <td class="pr-price">
                                Rs. {{ $pr->sellingPrice }}
                            </td>
                            <td class="none">
                                {{$pr->id}}
                            </td>
                        </tr>
                            @endforeach
                            </table>

                        </div>

                    </form>





                    <button class="v-btn btn" id="voucher">
                        <i class="fas fa-gift sub-icon"></i><span class="sub-btn-txt">Voucher</span>
                    </button>
                    <button class="v-btn btn " id="exchange">
                        <i class="fas fa-exchange-alt sub-icon"></i><span class="sub-btn-txt">Exchange</span>
                    </button>


                </div>

            </div>

            <div class="var-display" id="selectSize">
                <div class="var-display-title">
                    Select a Size
                    <button class="close-btn" id="closeBtnSize"><i class="fas fa-times"></i></button>
                </div>
                <hr>
                <div class="var-display-content" id="sizeContent">

<!--
                    <button class="var-btn"">36</button> -->



                </div>
            </div>


            <div class="var-display" id="selectColour">
                <div class="var-display-title">
                    Select a Color
                    <button class="close-btn" id="closeBtnColor"><i class="fas fa-times"></i></button>
                </div>
                <hr>
                <div class="var-display-content" id="colorContent">



                </div>
            </div>

            <div class="item-display">
                <table class="table" id="selectedProducts">

                        <tr class="item-table-head">

                            <th scope="col">#</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Item Name</th>
                            <th scope="col" style="width: 60px">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col" style="width: 60px">Discount</th>
                            <th scope="col">Total</th>
                            <th></th>

                        </tr>

                    <tbody>
                        <!-- @if($items)

                        @foreach($items as $item)

                        <tr class="item-table-row">
                            <th scope="row">{{ $item['num']}}</th>
                            <td>{{ $item['code']}}</td>
                            <td>{{ $item['name'] }}
                                @if($item['size'] && $item['color'] )
                                <div class="size">
                                    {{ $item['size'] }}/{{ $item['color'] }}
                                </div>
                                @elseif($item['size'])
                                <div class="size">
                                    {{ $item['size'] }}
                                </div>
                                @elseif( $item['color'] )
                                <div class="size">
                                    {{ $item['color'] }}
                                </div>
                                @endif

                            </td>
                            <td>{{ $item['qty']}}</td>
                            <td>Rs.{{ $item['price'] }}</td>
                            <td>Rs.{{ $item['discount']}}</td>
                            <td>Rs.{{ $item['total']}}</td>
                        </tr>
                        @endforeach

                        @endif
 -->

                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-4">
            <div class="price-display">

                <div class="mini-display">
                    <button class="mini-display-btn btn" data-toggle="dropdown">
                        <i class="fas fa-user-circle s-icon"></i>

                        <span class="s-text" id="adds">Add a Salesman</span>

                        <span class="s-text" id="emp"><span class="sid" id="sid"></span><span class="sname" id="sname"></span></span>


                    </button>
                    <ul class="dropdown-menu">
                        <input class="form-control" id="myInput" type="text" placeholder="Search..">
                        @foreach($employee as $emp)
                        <li onclick="addEmployee({{$emp->id}})" ><span class="sid">{{ $emp->id }}</span><span class="sname">{{ $emp->fname . ' '. $emp->lname }} </span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="mini-display">
                    <button class="mini-display-btn btn" data-toggle="dropdown">
                        <i class="fas fa-users s-icon"></i>
                        <span class="s-text" id="addc">Add a Customer</span>
                        <span class="s-text" id="cus"><span class="sid" id="cid"></span><span class="sname" id="cname"> </span></span>
                    </button>
                    <ul class="dropdown-menu">
                        <input class="form-control" id="cusSearch" type="text" placeholder="Search..">
                        @foreach($customer as $cus)
                        <li onclick="addCustomers({{$cus->id}})" ><span class="sid">{{ $cus->phone }}</span><span class="sname">{{ $cus->firstname . ' '. $cus->lastname }} </span></li>
                        @endforeach
                    </ul>
                </div>

                <hr class="price-display-rule">
                <div class="display-info">
                    <span class="display-text">No of Items</span>
                    <span class="display-values" id="nitems">0</span>
                </div>
                <hr class="price-display-rule">
                <div class="display-info">
                    <span class="display-text">Discount &nbsp;  <button class="discount-plus" ><i class="fas fa-plus-circle"></i></button> </span>
                    <span class="display-values" id="discount">Rs.0</span>
                    <div class="promotion-pos" id="promotion-pos">
                        Promotion Applied
                    </div>
                    <div class="pos-discount" >
                        <div class="full-pg" id="discountBg"></div>
                        <div class="row">
                            <div class="col-sm-5">
                            <input type="radio" name="discount-type"  id="cash"  required checked>
                            <label class="form-check-label" for="cash">
                                Cash
                            </label>
                        </div>
                        <div class="col-sm-7">
                            <input type="radio" name="discount-type" id="percentage" required>
                            <label class="form-check-label" for="percentage">
                                Percentage
                            </label>
                        </div>
                    </div>


                    <div id="amount" class="mt-4">
                        <div class="row " >
                            <div class="col-sm-3 form-check-label font-weight-bold pt-2 ">
                                Discount
                            </div>
                            <div class="col-sm-8 input-group mb-3 ml-2 pl-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rs</span>
                                </div>

                                <input type="text" id="discamnt" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                        </div>
                    </div>
                    <div id="percents" class="mt-4">

                        <div class="row ">
                            <div class="col-sm-3 form-check-label font-weight-bold pt-2 ">
                                Discount
                            </div>

                            <div class="col-sm-8 input-group mb-3">
                                <input type="text" id="percentageDisc" class="form-control" placeholder="0" >
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <hr class="price-display-rule">
                <div class="display-info">
                    <span class="display-text">Subtotal</span>
                    <span class="display-values" id="subtotal">Rs.0</span>
                </div>
                <hr class="price-display-rule">
                <div class="display-info">
                    <span class="display-text">Taxes</span>
                    <span class="display-values">Rs.0</span>
                </div>
                <hr class="price-display-rule">
                <div class="display-info">
                    <span class="display-text">Total</span>
                    <span class="display-values" id="total">Rs.0</span>
                </div>

                <div class="pay-btn-div">

                    <button class="pay-btn btn" id="payBtn">
                        <span class="pay">PAY</span>
                        <span class="pay-value" id="paytotal">Rs.0</span>
                    </button>

                </div>

                <div class="sub-btn-div">
{{--
                    <button class="sub-btn btn mr-2">
                        <i class="fas fa-undo sub-icon"></i><span class="sub-btn-txt"> Retrieve Sale</span>
                    </button>

                    <button class="sub-btn btn mr-2">
                        <i class="fas fa-parking sub-icon"></i><span class="sub-btn-txt"> Park Sale</span>
                    </button> --}}
                    <button class="sub-btn btn" id="discardSale">
                        <i class="fas fa-trash-alt sub-icon" ></i><span class="sub-btn-txt"> Discard Sale</span>
                    </button>


                </div>
            </div>
        </div>
    </div>

    {{-- /****** Add Expense Model ******/ --}}
    <div class="full-pg" id="fadeBg"></div>
    <div class="pos-sub-display" id="posSubExpense">

        <div class="pos-sub-display-title">
            <span class="title">Expense</span>
            <button class="close-btn" id="closeBtn"><i class="fas fa-window-close"></i></button>
        </div>

        <div class="pos-sub-display-content">


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="FormControlSelect1">Type</label>
                            <select name="type" class="form-control" id="expenseSelect">
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
                            <input type="text" id="expenseAmount" name="amount" class="form-control" />
                        </div>
                    </div>
                </div>


                <div class="form-group pl-2 pr-2">
                    <div class="row">
                        <label>Description</label>
                    </div>
                    <div class="row">
                        <textarea name="description" id="expenseDescription" class="pos-sub-txtArea" rows=5></textarea>
                    </div>
                </div>
                <input type="text" value="{{Auth::user()->id}}" name="userId" id="expenseUserId" hidden>
                <div class="action-btn-row">

                    <input type="submit" onclick="addExpense()" class="add-sub-btn" value="Add" />

                </div>

        </div>
    </div>
    {{-- End of Add Expense Model --}}
    <div class="full-pg" id="fadeBgVoucher"></div>
    <div class="pos-sub-display pos-pay product-overlay" id="posSubPay">

        <div class="pos-sub-display-title">
            <span class="title">Pay</span>
            <button class="close-btn" id="closeBtnPay"><i class="fas fa-window-close"></i></button>
        </div>

        <div class="pos-sub-display-content">

            <div class="row">
                <div class="col" id="pay-col">


                <div class="row mt-2">
                    <div class="col-md-5">
                        <h4 class="pos-pay-total pt-3">Amount To Pay</h4>
                    </div>
                    <div class="col-md-7">
                        <div class="total-rect">
                            <span class="rs-pay">Rs.</span><span class="total-rect-value" id="amnt-total">{{ $total }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <h4 class="pos-pay-total pt-3">Amount Tendered</h4>
                    </div>
                    <div class="col-md-7">
                        <div class="total-rect">
                            <span class="rs-pay">Rs.</span><input type="text" id="amnt-tend" class="amnt-tend" placeholder="0" />
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-5">
                        <h4 class="pos-pay-total pt-3">Balance</h4>
                    </div>
                    <div class="col-md-7">
                        <div class="total-rect">
                            <span class="rs-pay">Rs.</span><span class="total-rect-value" id="balance">0</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <button class="payment-btn" id="cashbtn">Cash</button>
                    </div>
                    <div class="col">
                        <button class="payment-btn" id="cardbtn">Card</button>
                    </div>
                    <div class="col">
                        <button class="payment-btn" id="loyaltybtn">Loyalty</button>
                    </div>
                    <div class="col">
                        <button class="payment-btn" id="voucherbtn">Voucher</button>
                    </div>
                    <div class="col">
                        <button class="payment-btn" id="splitbtn">Split</button>
                    </div>
                </div>

                <div class="row pay-options" id="cardOptions">
                    <div class="col">
                        <div class="form-group">
                            <label>Card Type</label>
                            <select class="form-control" id="cardSelect">
                                <option value="Visa">VISA</option>
                                <option value="Master">Master Card</option>
                                <option value="Amex">American Express</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Last 4 digits</label>
                            <input type="text" id="cardDigits" class="form-control" />
                        </div>
                    </div>
                    <button class="btn pay-model-btn">PAY</button>
                </div>
                <div class="row pay-options" id="voucherOptions">
                  {{-- <livewire:voucher-payment /> --}}
                  <div class="col">
                    <div class="form-group">
                        <label>Voucher Code</label>
                        <input type="text" id="voucherCode"  name="amount" class="form-control" />
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="voucherAmount" class="form-control" disabled />
                        <div class="load-spinner">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                        </div>
                    </div>
                </div>
                <button class="btn pay-model-btn">PAY</button>
                </div>
                <div class="pay-options" id="splitOptions">
                    <div class="row" id="method1">
                    <div class="col">
                        <div class="form-group">
                            <label>Method 1</label>
                            <select class="form-control" id="pay-method1">
                                <option value="Cash" id="cash">Cash</option>
                                <option value="Card" id="card">Card</option>
                                <option value="Voucher" id="voucherSelect">Voucher</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount"  id="method1Amount" class="form-control" />
                        </div>
                    </div>
                </div>


                <div class="row pay-options" id="cardOptions1">
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Card Type</label>
                            <select class="form-control" id="split1card">
                                <option value="Visa">VISA</option>
                                <option value="Master">Master Card</option>
                                <option value="Amex">American Express</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Last 4 digits</label>
                            <input type="text" name="amount" class="form-control" id="split1digits"/>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row pay-options" id="voucherOptions1">
                  {{-- <livewire:voucher-payment /> --}}
                  <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label>Voucher Code</label>
                        <input type="text" id="split1VoucherCode"  name="amount" class="form-control" />
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="split1VoucherAmount" class="form-control" disabled />
                        <div class="load-spinner spinner1">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
                <div class="row" id="method2">
                    <div class="col">
                        <div class="form-group">
                            <label>Method 2</label>
                            <select class="form-control" id="pay-method2">
                                <option value="Cash" id="cash">Cash</option>
                                <option value="Card" id="card">Card</option>
                                <option value="Voucher" id="voucherSelect">Voucher</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="method2Amount" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row pay-options" id="cardOptions2">
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Card Type</label>
                            <select class="form-control"  id="split2card">
                                <option value="Visa">VISA</option>
                                <option value="Master">Master Card</option>
                                <option value="Amex">American Express</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Last 4 digits</label>
                            <input type="text" name="amount"  id="split2digits" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
                <div class="row pay-options" id="voucherOptions2">
                    <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label>Voucher Code</label>
                        <input type="text" id="split2VoucherCode"  name="amount" class="form-control" />
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" id="split2VoucherAmount" class="form-control" disabled />
                        <div class="load-spinner spinner2">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                              </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <button class="btn pay-model-btn">PAY</button>

                </div>

                <div class="row " id="loyaltyOptions">
                    <div class="pay-options">
                    <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer Mobile</label>
                        <input type="text" id="cusMobile"  name="amount" class="form-control" />
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Redeem Points</label>
                        <input type="text" name="amount" id="redeemAmount" class="form-control" />

                    </div>
                </div>
                </div>
            </div>
                <button class="btn pay-model-btn mt-2" id="redeembtn">Redeem Points</button>
            </div>


                <button class="btn pay-model-btn">PAY</button>

            </div>
            <div class="col-md-4 pay-customer">
                <div class="row cus-heading">
                    <h5 >CUSTOMER DETAILS</h5>
                </div>
               <div class="row">
                   <div class="col">
                       First Name :
                   </div>
                   <div class="col" id="fname">

                    </div>
               </div>
               <div class="row">
                <div class="col" >
                    Last Name :
                </div>
                <div class="col" id="lname">

                 </div>
            </div>
            <div class="row">
                <div class="col">
                    Membership :
                </div>
                <div class="col" id="membership">

                 </div>
            </div>
            <div class="row">
                <div class="col">
                    Points :
                </div>
                <div class="col" id="points">

                 </div>
            </div>
            <div class="row">
                <div class="col">
                    Mobile :
                </div>
                <div class="col" id="mobile">

                 </div>
            </div>
            <div class="row">
                <div class="col">
                   City :
                </div>
                <div class="col" id="city">

                 </div>
            </div>
            <div class="load-spinner-cus">
                <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
            </div>

            </div>
        </div>


        </div>
    </div>

 {{-- /****** Add Voucher Model ******/ --}}
 <div class="full-pg" id="fadeBgVoucher"></div>
 <div class="pos-sub-display" id="posSubVoucher">

     <div class="pos-sub-display-title">
         <span class="title">Voucher</span>
         <button class="close-btn" id="closeBtnVoucher"><i class="fas fa-window-close"></i></button>
     </div>

     <div class="pos-sub-display-content">


             <div class="row">

                 <div class="col">
                    <div class="form-group">
                        <label>Voucher Id</label>
                        <input type="text" id="vou_id" name="vou_id" class="form-control" />
                    </div>
                </div>
                <div class="col">
                     <div class="form-group">
                         <label>Amount</label>
                         <input type="text" id="vou_amount" name="amount" class="form-control" />
                     </div>
                    </div>
             </div>
             <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>ExpiryDate</label>
                        <input type="date" id="vou_exp" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 year')); ?>" name="exp-date" class="form-control" />
                    </div>
                </div>
            </div>
             <div class="action-btn-row">
                 <input type="button" class="add-sub-btn" id="addVoucherBtn" value="Add" />
             </div>

     </div>
 </div>
 {{-- End of Add Voucher Model --}}

   {{-- /****** Add Service Model ******/ --}}
   <div class="full-pg" id="fadeBgService"></div>
   <div class="pos-sub-display" id="posSubService">

       <div class="pos-sub-display-title">
           <span class="title">Service</span>
           <button class="close-btn" id="closeBtnService"><i class="fas fa-window-close"></i></button>
       </div>

       <div class="pos-sub-display-content">


               <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Service ID</label>
                            <input type="text" name="sid" id="serviceId" class="form-control" />
                        </div>
                    </div>

                   <div class="col">
                       <div class="form-group">
                           <label>Customer</label>
                           <input type="text" id="serviceCustomer" name="customer_id" class="form-control" data-toggle="dropdown" required/>
                           <ul class="dropdown-menu service-cus-dropdown">
                               <input class="form-control" id="cusSearch" type="text" placeholder="Search..">
                               @foreach($customer as $cus)
                               <li onclick="addServiceCustomer({{$cus->id}})" ><span class="sid">{{ $cus->phone }}</span><span class="sname">{{ $cus->firstname}} </span></li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col">
                    <div class="form-group">
                        <label>Return Date</label>
                        <input type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days')); ?>" id="serviceReturn" class="form-control" />
                    </div>
                   </div>
                   <div class="col">
                    <div class="form-group">
                        <label>Cost</label>
                        <input type="text" id="serviceCost" name="sid" class="form-control" />
                    </div>
                   </div>
               </div>


               <div class="form-group pl-2 pr-2">
                   <div class="row">
                       <label>Description</label>
                   </div>
                   <div class="row">
                       <textarea name="description" id="serviceDescription" class="pos-sub-txtArea" rows=5></textarea>
                   </div>
               </div>
               <input type="text" value="{{Auth::user()->id}}" name="userId" hidden>
               <div class="action-btn-row">

                   <input type="submit" onclick="addService()" class="add-sub-btn" value="Add" />

               </div>

       </div>
   </div>
   {{-- End of Add Service Model --}}

   {{-- Staff In Attendance --}}
<div class="full-pg" id="fadeBg1"></div>
<div class="pos-sub-display emp-attendance" id="staffInModel">

    <div class="pos-sub-display-title">
        <span class="title">Staff In</span>
        <button class="close-btn" id="closeBtn1"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" id="staffInForm" class="needs-validation" action="{{route('attendance.store')}}" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Arrival Time
                    </h6>
                </div>
                <div class="col-md-8">
                    @php
                        date_default_timezone_set('Asia/Colombo');
                    @endphp
                    <input type="time" name="arrival" class="form-control " value="{{ date('H:i') }}" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-3">
                        Select Employees
                    </h6>
                </div>
                <div class="col-md-8">
                    @foreach($employee as $e)
                    <div class="form-check permission-check emp-check">
                        <input name="emp[{{ $e->id }}]" class="form-check-input" type="checkbox" value="1" id="emp_name_{{ $e->id }}">
                        <label class="form-check-label" for="emp_name_{{ $e->id }}">
                            {{ $e->fname." ".$e->lname }}
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="action-btn-row mt-4">

                <input type="submit" class="add-sub-btn" value="Mark" />

            </div>
        </form>
    </div>
</div>

{{-- End of Staff In Attendance --}}

{{-- Staff Out Attendance --}}
<div class="full-pg" id="fadeBg2"></div>
<div class="pos-sub-display emp-attendance" id="staffOutModel">

    <div class="pos-sub-display-title">
        <span class="title">Staff Out</span>
        <button class="close-btn" id="closeBtn2"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" class="needs-validation" action="{{route('attendance.markout')}}" novalidate>
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-2">
                        Time
                    </h6>
                </div>
                <div class="col-md-8">
                    @php
                        date_default_timezone_set('Asia/Colombo');
                    @endphp
                    <input type="time" name="time" class="form-control " value="{{ date('H:i') }}" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h6 class="pt-3">
                        Select Employees
                    </h6>
                </div>
                <div class="col-md-8">
                    @foreach($employee as $e)
                    <div class="form-check permission-check emp-check">
                        <input name="emp[{{ $e->id }}]" class="form-check-input" type="checkbox" value="1" id="emp_name_{{ $e->id }}">
                        <label class="form-check-label" for="emp_name_{{ $e->id }}">
                            {{ $e->fname." ".$e->lname }}
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="action-btn-row mt-4">

                <input type="submit" class="add-sub-btn" value="Mark" />

            </div>
        </form>
    </div>
</div>

{{-- End of Staff Out Attendance --}}

</div>
