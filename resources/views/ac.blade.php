@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Enter the page heading</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Enter the name of the Section
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}
        <form method="post" action="">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" />
                    <label for="username" class="float-label">Username</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="display_name" placeholder="Display name">
                    <label class="float-label">Display name</label>
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
