@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <i class="fa fa-arrow-left pg-back"></i>
    <div class="pg-title">Create Voucher</div>
</div>

<div class="section"> {{-- Start of Section--}}
    <div class="section-title">
        Vouchers Details
        <hr>
    </div>
    <div class="section-content"> {{-- Start of sectionContent--}}
        {{-- Start of Form --}}
        
        <form method="post" action=" {{route('voucher.store')}}">
            
            @csrf 
           {{--  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
            <div class="row">
                <div class="col">
                    <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount" />
                    <label for="amount" class="float-label">Amount</label>
                </div>
                <div class="col">
                    <input type="date" id="exp" name="exp" class="form-control" placeholder="Expiry Date" />
                    <label for="exp" class="float-label">Expiry Date</label>
                </div>
           
            </div> 
        </div>
        <div class="row submit-row">
            <div class="col">
                <input class="btn-submit" type="submit" value="Create">
            </div>
        </div>
    </form>
    {{-- End of Form --}}
</div> {{-- End  of sectionContent--}}
</div> {{-- End  of section--}}

@endsection