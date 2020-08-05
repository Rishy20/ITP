@extends('layouts.main')
@section('content')
    {{-- Copy this to every page you code and type your code in this section

        * Do not create <html>,<head>,<body> tags in this section
        * Just start writing only the body of the code because this section is the body of the code

    --}}
    <div class="user">
        <div class="pg-title">
            <h2>Add User</h2>


            <?php echo DNS1D::getBarcodeHTML('2000165', 'UPCE',2,40,'black', true); ?>

        </div>
    </div>
@endsection
