@extends('layouts.main')
@section('content')

    <div class="container">
        <div class="jumbotron">

             @if(\Session::has('success'))
                <div class="alret alert-danger">
                    <p> {{\Session::get('success')}}</p>
            
                 </div>

             @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Details</h5>

                    <form method="POST" action="{{action('CustomerController@store')}}">

                    {{ csrf_field() }}

                    <form>
                       

                         <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your first name">
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your last name">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" class="form-control" name="gender" id="gender" placeholder="Enter your gender">
                        </div>

                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="text" class="form-control" name="dob" id="dob" placeholder="Enter your dob">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="name@gmail.com">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                        </div>

                        <div class="form-group">
                            <label>Street Address</label>
                            <input type="text" class="form-control" name="streetaddress" id="streetaddress" placeholder="Enter your street address">
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city">
                        </div>
                      
                        <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width :50%;">Insert Data</button>
                    </form>    
<br><br><br>
                        <table class ="table table-bordered">
                            <thead class = "thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Street Address</th>
                                    <th>City</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cust as $row)
                                <tr>
                                    <td> {{ $row->id }} </td>
                                    <td> {{ $row->firstname }} </td>
                                    <td> {{ $row->lastname }} </td>
                                    <td> {{ $row->gender }} </td>
                                    <td> {{ $row->dob }} </td>
                                    <td> {{ $row->email }} </td>
                                    <td> {{ $row->phone }} </td>
                                    <td> {{ $row->streetaddress }} </td>
                                    <td> {{ $row->city }} </td>
                                    <td>  
                                      <a href = "{{action('CustomerController@edit', $row['id'])}}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form action = "{{ action('CustomerController@destroy' , $row['id'])}}" method = "POST">
                                         {{ csrf_field() }}
                                         <input type = "hidden" name= "_method" value = "DELETE">
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                                     
                




                    
                </div>
            </div>

        </div>
    </div>


   
@endsection
