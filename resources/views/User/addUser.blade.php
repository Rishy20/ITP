@extends('layouts.main')
@section('content')

<div class="addUser"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route('user.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Add User</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    User Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" action="{{route('user.store')}}">
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
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <label class="float-label">Password</label>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="repass" placeholder="Re-enter Password">
                                <label class="float-label">Re-enter Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="pin" placeholder="PIN">
                                <label class="float-label">Pin</label>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="repin" placeholder="Re-enter PIN">
                                <label class="float-label">Re-enter Pin</label>
                            </div>
                        </div>
                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Save">
                            </div>
                        </div>
                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}
        </div>
        <div class="col-md-3">
            <div class="section"> {{-- Start of Section 2--}}
                <div class="section-title section-title-sub">
                    Roles
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roleId" id="radio1" value="option1" checked>
                        <label class="form-check-label" for="radio1">
                            Owner
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roleId" id="radio2" value="option2">
                        <label class="form-check-label" for="radio2">
                            Manager
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roleId" id="radio3" value="option3">
                        <label class="form-check-label" for="radio3">
                            Cashier
                        </label>
                    </div>
                    </form>
                </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
</div>{{-- End of addUser --}}
@endsection
