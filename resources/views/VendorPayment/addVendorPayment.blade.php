@extends('layouts.main')
@section('content')

<div class="pg-heading">
  <a href="{{ route('vendorPayment.index') }}"><i class="fa fa-arrow-left pg-back"></i></a>
  <div class="pg-title">Vendor Payment</div>
</div>

<div class="section" > {{-- Start of Section--}}
  <div class="section-title">
      Payment for Vendor's
      <hr>
  </div>
  <div class="section-content" > {{-- Start of sectionContent--}}
      {{-- Start of Form --}}

    <form method="post" class="needs-validation" action="{{ route('vendorPayment.store') }}" novalidate>
              @csrf
              <div class="row">
                <div class="col">
                  <input type="text" id="vendorId" name="vendorID" class="form-control" placeholder="Vendor ID"  required/>
                  <label for="vendorId" class="float-label">Vendor ID</label>
                  <div class="invalid-feedback">
                    Please fill out this field
                </div>
                </div>
                  <div class="col">
                      <input type="text" class="form-control" name="paymentType" placeholder="Payment Type" required>
                      <label class="float-label">Payment Type</label>
                      <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col">
                  <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" required/>
                  <label for="paymentId" class="float-label">Amount</label>
                  <div class="invalid-feedback">
                    Please fill out this field
                </div>
              </div>
                <div class="col">
                    <input type="date" class="form-control" name="date" placeholder="Date" required>
                    <label class="float-label">Date</label>
                    <div class="invalid-feedback">
                        Please fill out this field
                    </div>
                </div>
              </div>



              <hr>
              <div class="form-group">
                <input type="search" name="add_products" id="add_products" class="form-control input-lg" placeholder="Enter Vendor Name..." style="width: 50%" />

              </div>
              <br>

              <table class="table hover table-striped table-borderless table-hover all-table">
                <thead class="table-head">
                    <tr>
                        <th>Vendor ID</th>
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
