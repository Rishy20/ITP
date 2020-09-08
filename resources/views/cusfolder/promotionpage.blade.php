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
                    <h5 class="card-title">Promotion Details</h5>

                    
                    <form method="POST" action="{{action('PromotionController@store')}}">

                    {{ csrf_field() }}

                <form>
                       

                       <div class="form-group">
                          <label>Promotion Name</label>
                          <input type="text" class="form-control" name="promotionname" id="promotionname" placeholder="Enter promotion name">
                      </div>

                      <div class="form-group">
                          <label>Promotion Type</label>
                          <input type="text" class="form-control" name="promotiontype" id="promotiontype" placeholder="Enter promotion type">
                      </div>

                      <div class="form-group">
                          <label>Discount</label>
                          <input type="text" class="form-control" name="discount" id="discount" placeholder="Enter discount">
                      </div>

                      <div class="form-group">
                          <label>Start Date</label>
                          <input type="text" class="form-control" name="startdate" id="startdate" placeholder="Enter start date">
                      </div>

                      <div class="form-group">
                          <label>End Date</label>
                          <input type="text" class="form-control" name="enddate" id="enddate" placeholder="Enter end date">
                      </div>

                      <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width :50%;">Insert Data</button>

                    </form>  
 <br><br><br>
                        <table class ="table table-bordered">
                            <thead class = "thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Promotion Name</th>
                                    <th>Promotion Type</th>
                                    <th>Discount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prms as $row)
                                <tr>
                                    <td> {{ $row->id }} </td>
                                    <td> {{ $row->promotionname }} </td>
                                    <td> {{ $row->promotiontype }} </td>
                                    <td> {{ $row->discount }} </td>
                                    <td> {{ $row->startdate }} </td>
                                    <td> {{ $row->enddate }} </td>
                                    <td>  
                                      <a href = "{{action('PromotionController@edit', $row['id'])}}" class="btn btn-success">Edit</a>
                                    </td>

                                    <td>
                                        <form action = "{{ action('PromotionController@destroy' , $row['id'])}}" method = "POST">
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