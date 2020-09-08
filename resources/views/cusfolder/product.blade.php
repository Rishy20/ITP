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

                    
                    <form method="POST" action="{{action('ProductController@store')}}">

                    {{ csrf_field() }}

                <form>
                       

                       <div class="form-group">
                          <label>Promotion ID</label>
                          <input type="text" class="form-control" name="promotionid" id="promotionid" placeholder="Enter promotion id">
                      </div>

                      <div class="form-group">
                          <label>Product ID</label>
                          <input type="text" class="form-control" name="productid" id="productid" placeholder="Enter product id">
                      </div>


                      <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width :50%;">Insert Data</button>

                    </form>
                </div>
        </div>
    </div>
</div>                  

@endsection