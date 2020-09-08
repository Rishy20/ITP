@extends('layouts.main')
@section('content')

<div class="selectProducts"> {{-- Start of selectProducts --}}
    <div class="pg-heading">

        <div class="pg-title">Print Labels</div>

    </div>
    <div class="row">
        <div class="col">
            <div class="section"> {{-- Start of Section 1--}}

                <livewire:select-products />
            </div> {{-- End  of section 1--}}
        </div>

    </div>
</div>{{-- End of addUser --}}

<script>

document.addEventListener("DOMContentLoaded", function() {

    OverlayScrollbars(document.querySelectorAll(".product-overlay"), {});
});
    $(document).ready(function() {
     // Search Products
     $("#prdSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
    });
    $(document).ready(function() {
                $('.mdb-select').materialSelect();
            });
</script>
@endsection
