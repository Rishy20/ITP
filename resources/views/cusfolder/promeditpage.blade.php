@extends('layouts.main')
@section('content')

            
    <div class="container">
        <div class="jumbotron">

                 <form method="POST" action="{{action('PromotionController@update' ,$id)}}">

                    {{ csrf_field() }}

                    <form>
                       

                         <div class="form-group">
                            <label>Promotion Name</label>
                            <input type="text" class="form-control" name="promotionname" id="promotionname" value="{{$prms->promotionname }}" placeholder="Enter your promotion name">
                        </div>

                        <div class="form-group">
                            <label>Promotion Type</label>
                            <input type="text" class="form-control" name="promotiontype" id="promotiontype" value="{{$prms->promotiontype }}" placeholder="Enter your promotion type">
                        </div>

                        <div class="form-group">
                            <label>Discount</label>
                            <input type="text" class="form-control" name="discount" id="discount" value="{{$prms->discount }}" placeholder="Enter discount">
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" class="form-control" name="startdate" id="startdate" value="{{$prms->startdate }}" placeholder="Enter your start date">
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="text" class="form-control" name="enddate" id="enddate" value="{{$prms->enddate }}" placeholder="Enter your end date">
                        </div>
                      
                        {{ method_field('PUT') }}
                      
                        <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width :50%;">Update Data</button>
                   
                   
                </form>   
        </div>      
    </div>   


@endsection