@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Users</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
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
                    <td>Owner</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td class="action-icon">
                        <a href="{{ route('user.edit',$us->id) }}"><i class="fas fa-pen"></i></a>
                        <form method="POST" class="dlt-form" action="{{ route('user.destroy',$us->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dlt-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
