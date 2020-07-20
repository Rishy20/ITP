@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Enter the Page heading here</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn"> {{-- Add button --}}
                <a>Add User</a> {{-- Enter the name of the add btn --}}
            </div>
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Row 1 Data 1</td>
                    <td>Row 1 Data 2</td>
                    <td>
                        {{-- Start of toggle switch --}}
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                        {{-- End of toggle switch --}}
                    </td>
                    <td class="action-icon">
                        <a href="#"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        <a href="#"><i class="fas fa-trash-alt"></i></a>{{-- Delete icon --}}
                    </td>
                </tr>
            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
