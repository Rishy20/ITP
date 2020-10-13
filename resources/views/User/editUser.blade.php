@extends('layouts.main')
@section('content')

<div class="editUser"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route('user.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit User</div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    User Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    <form method="post" class="needs-validation" action="{{route('user.update',$user->id)}}" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="col">
                                <input type="text" name="test" class="form-control"  value="{{ $user->username }}"  required>
                                <label class="float-label">User name</label>
                                <div class="invalid-feedback">
                                    Please enter a name
                                  </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="display_name" value="{{ $user->display_name }}" placeholder="Display name" required>
                                <label class="float-label">Display name</label>
                                <div class="invalid-feedback">
                                    Please enter a name
                                  </div>
                            </div>
                        </div>

                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Update">
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
                    @php
                        $i = 1;
                    @endphp
                    @if($role)
                    @foreach($role as $r)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roleId" id="radio{{ $i }}" value="{{ $r->id }}" @if($r->id == $user->roleId) checked @endif >
                        <label class="form-check-label" for="radio{{ $i }}">
                            {{ $r->Role_name }}
                        </label>
                    </div>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                    @endif
                    </form>
                </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
    <div class="row secondary-section">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Change Password
                    <hr>
                </div>
                <div class="section-content">
                    <form method="post" action="{{route('user.password',$user->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="oldpass"  placeholder="Enter Old Password">
                                <label class="float-label">Old Password</label>
                            </div>
                            <div class="col"></div>
                        </div>
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="newpass"  placeholder="Enter New Password">
                                <label class="float-label">New Password</label>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="repass" placeholder="Re-enter Password">
                                <label class="float-label">Confirm Password</label>
                            </div>
                        </div>
                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row secondary-section last-section">
        <div class="col-md-9">
            <div class="section"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Change Pin
                    <hr>
                </div>
                <div class="section-content">
                    <form method="post" action="{{route('user.pin',$user->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="oldpin" placeholder="Enter Old PIN">
                                <label class="float-label">Old Pin</label>
                            </div>
                            <div class="col"></div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="newpin" placeholder="Enter New PIN">
                                <label class="float-label">New Pin</label>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="repin" placeholder="Re-enter PIN">
                                <label class="float-label">Re-enter Pin</label>
                            </div>
                        </div>
                        <div class="row submit-row">
                            <div class="col">
                                <input class="btn-submit" type="submit" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>{{-- End of addUser --}}
@endsection
