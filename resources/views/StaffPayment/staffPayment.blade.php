@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
  <div class="pg-title">Salary Payment</div>
</div>

<div class="section" style="height: 50%;width:50%"> {{-- Start of Section--}}
  <div class="section-title">
      Payment for Employee's
      <hr>
  </div>
  <div class="section-content" > {{-- Start of sectionContent--}}
      {{-- Start of Form --}}

    <form method="post" action="" >
              @csrf
              <div class="row">
                  <div class="col">
                      <input type="text" id="paymentId" name="paymentId" class="form-control" placeholder="Payment ID" />
                      <label for="paymentId" class="float-label">Payment ID</label>
                  </div>
                  <div class="col">
                      <input type="text" class="form-control" name="display_name" placeholder="staffID">
                      <label class="float-label">Satff ID</label>
                  </div>
              </div>
              <div class="row">
                <div class="col">
                  <input type="text" id="vendorId" name="vendorId" class="form-control" placeholder="Vendor ID" />
                  <label for="vendorId" class="float-label">Staff ID</label>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="display_name" placeholder="Date">
                    <label class="float-label">Date</label>
                </div>
              </div>
              


              <hr>

              <table id="myTable" class="table hover table-striped table-borderless table-hover all-table">
                <div class="add-btn">
                  <a href="">+ Add Employee</a>
                </div>
                <thead class="table-head">
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1 Data 1</td>
                        <td>Row 1 Data 2</td>
                        <td class="action-icon">
                            <a href="#"><i class="fas fa-pen"></i></a>
                            <a href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>


              <div class="row submit-row">
                  <div class="col">
                      <input class="btn-submit" type="submit" value="Save">
                  </div>
              </div>

              
          </form>


        </div> {{-- End  of sectionContent--}}
      </div> {{-- End  of section--}}
      

@endsection