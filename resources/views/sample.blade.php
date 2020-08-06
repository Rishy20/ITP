@extends('layouts.main')
@section('content')
    {{-- Copy this to every page you code and type your code in this section

        * Do not create <html>,<head>,<body> tags in this section
        * Just start writing only the body of the code because this section is the body of the code

    --}}
    <div class="user">
        <div class="pg-title">
            <h2>Add User</h2>

            <div class="barcode">
                <div class="store-name">
                    <div class="ll">LEATHER LINE</div>
                     <div class="kur">KURUNEGALA</div>
                </div>
                <div class="barcode-img">
                    <?php echo DNS1D::getBarcodeHTML('10000002', 'UPCE',2,40,'black', true); ?>
                </div>


            <div class="pr-details">IPP0032 22ML ATHTHAR SMALL</div>
            <div class="barcode-price">
                <span class="rs">Rs. </span>200.00
            </div>
            </div>



        </div>
    </div>
@endsection
