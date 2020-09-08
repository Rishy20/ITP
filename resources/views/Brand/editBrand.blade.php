@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Add Brand</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Brand Information
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}
        <form method="post" action="{{route('brand.update',$brand->id)}}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col">
                <input type="text"  name="name"  value="{{$brand->name}}"class="form-control" placeholder="Brand Name" />
                    <label  class="float-label">Brand Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <textarea class="form-control" name="description" placeholder="Brand Description">{{$brand->description}}</textarea>
                    <label class="float-label">Brand Description</label>
                </div>
            </div>

            <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Save">
                </div>
            </div>
        </form>
        {{-- End of Form --}}
    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection

{{--
    Important points to consider
    * The labels should be below the input box
    * All the input boxes should have a placeholder
    * The class name of the label should be "float-label"
    * The class name of the submit button should be "btn-submit"
    * The row containing the submit button should have a class of submit-row
--}}
