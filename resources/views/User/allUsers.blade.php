@extends('layouts.main')
@section('content')


<div class="pg-heading">

    <div class="pg-title">All Users</div>
</div>

@if(session('message'))
<div class="message">
    <div class="message-success">
        <i class="far fa-check-circle message-icon"></i>
        <span class="message-text">Success!</span>
        <span class="message-text-sub">You're awesome!!!</span>

    </div>
</div>
{{ Session::forget('message') }}
@endif

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a href="{{ route('user.report') }}" target="_blank">Export User</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('role.create') }}">Add User Role</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('user.create') }}">Add User</a>
            </div>

            <thead class="table-head">
                <tr>
                    <th>Username</th>
                    <th>Display Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $us)


                <tr>
                    <td>{{ $us->username }}</td>
                    <td>{{ $us->display_name }}</td>
                    <td>{{ $us->Role_name }}</td>
                    <td>
                        @livewire('toggle-switch',['s'=>$us->status,'id'=>$us->id])

                    </td>
                    <td class="action-icon">
                        <a href="{{ route('user.edit',$us->id) }}"><i class="fas fa-pen"></i></a>
                        <button class="dlt-btn" id="dlt-btn{{ $us->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $us->id }}"  action="{{ route('user.destroy',$us->id) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
