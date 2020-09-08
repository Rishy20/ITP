@extends('layouts.main')
@section('content')

<div class="editPromotion"> 
    <div class="pg-heading">
        <a href="{{ route('promotion.index',$prms->id)}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Promotion</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Promotion Details
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" action="{{route('promotion.update',$prms->id)}}">
                        @csrf
                        @method('PATCH')


                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="promotionname" id="promotionname" value="{{$prms->promotionname }}" placeholder="Promotion Name">
                                <label for="promotionname" class="float-label">Promotion Name</label>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" name="promotiontype" id="promotiontype" value="{{ $prms->promotiontype }}" placeholder="Promotion Type">
                                <label class="float-label">Promotion Type</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="discount" id="discount" value="{{ $prms->discount }}" placeholder="Discount">
                                <label for="discount" class="float-label">Discount</label>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" name="startdate" id="startdate" value="{{ $prms->startdate }}" placeholder="Start Date">
                                <label class="float-label">Start Date</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                            <input type="text" class="form-control" name="enddate" id="enddate" value="{{ $prms->enddate }}" placeholder="End Date">
                                <label for="enddate" class="float-label">End Date</label>
                            </div>
                            
                        </div>

                   
                        {{method_field('PUT')}}

                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Update">
                            </div>
                        </div>
                    </form>
            

     </div>
</div>
@endsection