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
                    <form method="post" class="needs-validation" action="{{route('user.store')}}" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required/>
                                <label for="username" class="float-label">Username</label>
                                <div class="invalid-feedback">
                                    Please enter a username
                                  </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="display_name" placeholder="Display name" required>
                                <label class="float-label">Display name</label>
                                <div class="invalid-feedback">
                                    Please enter a name
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>
                                <label class="float-label">Password</label>
                                <div class="invalid-feedback">
                                    Please enter a password
                                  </div>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="repass" id="repass" placeholder="Re-enter Password" required>
                                <label class="float-label">Re-enter Password</label>
                                <div class="invalid-feedback">
                                    Please enter a password
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="password" class="form-control" name="pin" placeholder="PIN" required>
                                <label class="float-label">Pin</label>
                                <div class="invalid-feedback">
                                    Please enter a pin
                                  </div>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" name="repin" placeholder="Re-enter PIN" required>
                                <label class="float-label">Re-enter Pin</label>
                                <div class="invalid-feedback">
                                    Please enter a pin
                                  </div>
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
                    @php
                        $i = 1;
                    @endphp
                    @if($role)
                    @foreach($role as $r)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roleId" id="radio{{ $i }}" value="{{ $r->id }}" @if($i == 1) checked @endif >
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
</div>{{-- End of addUser --}}
@endsection
