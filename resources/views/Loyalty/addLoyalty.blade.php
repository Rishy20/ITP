@extends('layouts.main')
@section('content')

<div class="addUser"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route ( 'loyalty.index' )}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Add Loyalty</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <form method="post" class="needs-validation" action="{{route('loyalty.store')}}" novalidate>
                <div class="section-title">
                    Loyalty Information
                    <input class="btn-submit" type="submit" value="Submit">
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}

                        @csrf

                        <div class="row">
                            <div class="col">
                                <input type="text" id="loyaltyName" name="loyaltyName" class="form-control" placeholder="Loyalty Name" required/>
                                <label for="loyaltyName" class="float-label">Loyalty Name</label>
                                <div class="invalid-feedback">
                                    Please fill out this field
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="section-title">
                            Add Customers
                            <hr>
                        </div>
                        <br>

                        <div class="form-group">
                            <input type="search" name="add_customer" id="add_customer" class="form-control input-lg" placeholder="Enter Customer Name" style="width: 50%" required/>
                            <div class="invalid-feedback">
                                Please fill out this field
                            </div>
                        </div>
                        {{ csrf_field() }}

                        <br>

                        <table class="table hover table-striped table-borderless table-hover all-table">
                            <thead class="table-head">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last name</th>
                                    <th>gender</th>
                                    <th>DOB</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 2</td>
                                </tr> --}}
                            </tbody>
                        </table>


                        {{-- <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Submit">
                            </div>
                        </div> --}}

                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}


        </div>
        <div class="col-md-3">
            <div class="section"> {{-- Start of Section 2--}}
                <div class="section-title section-title-sub">
                    Tier Points
                    <hr>
                </div>

            <div class="section-content"> {{-- Start of sectionContent--}}


                <div class="section"> {{-- Start of Section 2--}}
                    <p style="text-align: center">Minimum Points Required</p>



                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                        <input type="number" id="minimumPointRequired" name="minimumPointRequired" value="100" style="width: 25%"/>
                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>

                </div>

                    <hr>

                <div class="section"> {{-- Start of Section 2--}}
                    <p style="text-align: center">Earning Loyalty</p>


                        Rs. <input type="number" id="number" name="tierPoints" value="100.00" style="width: 32%"/> = 1 Loyalty Point


                </div>
                    <hr>

                <div class="section"> {{-- Start of Section 2--}}
                    <p style="text-align: center">Points On Sign Up</p>


                        <div class="value-button" id="decrease" onclick="decreaseValue1()" value="Decrease Value">-</div>
                        <input type="number" id="points" name="points" value="100" style="width: 25%"/>
                        <div class="value-button" id="increase" onclick="increaseValue1()" value="Increase Value">+</div>


                </div>
            </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
</form>
</div>{{-- End of addUser --}}

<script>
    function increaseValue() {
        var value = parseInt(document.getElementById('minPoint').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('minPoint').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('minPoint').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('minPoint').value = value;
    }
    function increaseValue1() {
        var value = parseInt(document.getElementById('points').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('points').value = value;
    }

    function decreaseValue1() {
        var value = parseInt(document.getElementById('points').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('points').value = value;
    }
</script>

@endsection
