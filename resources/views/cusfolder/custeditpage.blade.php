@extends('layouts.main')
@section('content')

            
    <div class="container">
        <div class="jumbotron">

                 <form method="POST" action="{{action('CustomerController@update' ,$id)}}">

                    {{ csrf_field() }}

                    <form>
                       

                         <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="{{$cust->firstname }}" placeholder="Enter your first name">
                        </div>

                        <div class="form-group">
                        
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $cust->lastname }}" placeholder="Enter your last name">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" class="form-control" name="gender" id="gender" value="{{ $cust->gender }}" placeholder="Enter your gender">
                        </div>

                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="text" class="form-control" name="dob" id="dob" value="{{ $cust->dob }}" placeholder="Enter your dob">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ $cust->email }}" placeholder="name@gmail.com">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $cust->phone }}" placeholder="Enter your phone number">
                        </div>

                        <div class="form-group">
                            <label>Street Address</label>
                            <input type="text" class="form-control" name="streetaddress" id="streetaddress" value="{{ $cust->streetaddress }}" placeholder="Enter your street address">
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ $cust->city }}" placeholder="Enter your city">
                        </div>

                        {{ method_field('PUT') }}
                      
                        <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width :50%;">Update Data</button>
                   
                   
                </form>   
        </div>      
    </div>   


@endsection