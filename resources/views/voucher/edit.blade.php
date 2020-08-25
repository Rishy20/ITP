@extends('layouts.main')
@section('content')

<div class="editUser"> {{-- Start of addVoucher --}}
    <div class="pg-heading">
        <a href="{{ route('voucher.index',$voucher->id)}}"><i class="fa fa-arrow-left pg-back"></i></a>
        <div class="pg-title">Edit Voucher</div>
    </div>
    <div class="row">
        <div class="col-md-9">

<div class="section"> {{-- Start of Section--}}
        <div class="section-title">
        Salary Details
         <hr>
          </div>
         <div class="section-content"> {{-- Start of sectionContent--}}
            <form method="post" action="{{route('voucher.update',$voucher->id)}}"> {{-- Start of Form --}}
                @csrf
                 @method('PATCH')
          <div class="row">
              <div class="col">
             <input type="text" id="amount" name="amount" class="form-control" value="{{ $voucher->amount }}"placeholder="Amount" />
             <label for="amount" class="float-label">Amount</label>
                </div>
                 <div class="col">
                    <input type="date" id="exp" name="exp" class="form-control" value="{{ $voucher->exp }}"placeholder="Expiry Date" />
                    <label for="exp" class="float-label">Expiry Date</label>
                </div>
                        
                <div class="row submit-row">
                <div class="col">
                    <input class="btn-submit" type="submit" value="Change">
            </div>
        </div>
    </div> {{-- End  of sectionContent--}}
    </div> {{-- End  of section 1--}}
</div>
</div>{{-- End of addUser --}}
@endsection