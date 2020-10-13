@extends('layouts.main')
@section('content')

<div class="pg-heading">

    <div class="pg-title">All Vouchers</div>
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
            <a href="{{ route('voucher.report') }}" target="_blank">Export Vouchers</a>
            </div>
            {{-- <div class="add-btn">
                <a href="{{ route('voucher.create') }}">Add Voucher</a>
            </div> --}}
            <thead class="table-head">
                <tr>
                    <th>Voucher No.</th>
                    <th>Amount</th>
                    <th>Expiry Date</th>
                    <th>Redeem Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($voucher as $vou)
                <tr>
                    <td>{{ $vou->id }}</td>
                    <td>{{ $vou->amount }}</td>
                    <td>{{ $vou->exp }}</td>
                    <td>{{ $vou->redeem_status==1?"Redeemed":"Not Redeemed" }}</td>
                    <td class="action-icon">
                        <a  onclick="editVoucher({{$vou->id}})" ><i class="fas fa-pen"></i></a>
                        <button type="submit" class="dlt-btn" id="dlt-btn{{ $vou->id }}"><i class="fas fa-trash-alt"></i></button>
                        <form method="POST" class="dlt-form" id="dlt-form{{ $vou->id }}" action="{{ route('voucher.destroy',$vou->id) }}">
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
{{-- /****** Add Voucher Model ******/ --}}
<div class="full-pg" id="fadeBgVoucher"></div>
<div class="pos-sub-display" id="posSubVoucher">

    <div class="pos-sub-display-title">
        <span class="title">Voucher</span>
        <button class="close-btn" id="closeBtnVoucher"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="pos-sub-display-content">

        <form method="POST" action="{{route('voucher.updateVoucher')}}">
            @csrf
            @method('patch')
            <div class="row">


               <div class="col">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" id="vou_amount" name="amount" class="form-control" />
                    </div>
                   </div>
                   <div class="col">
                    <div class="form-group">
                        <label for="FormControlSelect1">Redeem Status</label>
                        <select name="redeem_status" class="form-control" id="vou_redeem">
                            <option value="1">Redeemed</option>
                            <option value="0">Not Redeemed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col">
                   <div class="form-group">
                       <label>ExpiryDate</label>
                       <input type="date" id="vou_exp" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' + 1 year')); ?>" name="exp" class="form-control" />
                   </div>
               </div>
               <input type="text" name="id" id="vou_id" hidden/>
           </div>
            <div class="action-btn-row">
                <input type="submit" class="add-sub-btn" id="addVoucherBtn" value="Update" />
            </div>
        </form>
    </div>
</div>
{{-- End of Add Voucher Model --}}
<script>
    function editVoucher(id){
    event.preventDefault();
    $('#posSubVoucher').addClass('block');
    $('#fadeBgVoucher').addClass('block');

        var complex = <?php echo json_encode($voucher); ?>;

        complex.forEach(myFunction);

        function myFunction(index,value,array){

            if(array[value]['id'] == id){
                $('#vou_amount').val(array[value]['amount']);
                $('#vou_id').val(id);
                $('#vou_exp').val(moment(array[value]['exp']).format("YYYY-MM-DD"));
                $('#vou_redeem').val(array[value]['redeem_status']);
            }
        }
    }
    $('#closeBtnVoucher').on('click', function() {
                $('#posSubVoucher').removeClass('block');
                $('#fadeBgVoucher').removeClass('block');

            });

</script>
@endsection
