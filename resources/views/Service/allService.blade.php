@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">All Services</div>
</div>

<div class="section"> {{-- Start of Section--}}

    <div class="section-content"> {{-- Start of sectionContent--}}

        <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
            <div class="add-btn">
                <a>Add Service</a>
            </div>
            <thead class="table-head">
                <tr>
                    <th>Service ID</th>
                    <th>Customer ID</th>
                    <th>Date</th>
                    <th>Return Date</th>
                    <th>Service Description</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SE85</td>
                    <td>CID581</td>
                    <td>12/04/2020</td>
                    <td>06/04/2020</td>
                    <td>New heel change</td>
                    <td>Rs.850.00</td>
                    <td class="action-icon">
                        <a href="#"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        <a href="#"><i class="fas fa-trash-alt"></i></a> {{-- Delete icon --}}
                    </td>

                </tr>
                <tr>
                    <td>SE87</td>
                    <td>CID582</td>
                    <td>10/05/2020</td>
                    <td>08/04/2020</td>
                    <td>Color Damage</td>
                    <td>Rs.1000.00</td>

                    <td class="action-icon">
                        <a href="#"><i class="fas fa-pen"></i></a> {{-- Edit icon --}}
                        <a href="#"><i class="fas fa-trash-alt"></i></a> {{-- Delete icon --}}
                    </td>
                </tr>
            </tbody>
        </table>

    </div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection
