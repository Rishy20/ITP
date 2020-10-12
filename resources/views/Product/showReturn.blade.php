@extends('layouts.main')
@section('content')

<div class="showSales"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route('return.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        @foreach($returns as $r)
    <div class="pg-title">Return #{{$r->id}}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-8 ">
            <div class="section mb-4"> {{-- Start of Section 1--}}
                <div class="section-title">
                    Product Information
                    <hr>
                </div>
                <div class="section-content selectProductsContent">
                    <div class="item-display backend">
                    <table class="table table-striped " id="selectedProducts">

                        <tr class="item-table-head">

                            <th scope="col">#</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Colour</th>
                            <th scope="col" style="width: 100px">Qty</th>
                            <th scope="col">Price</th>


                        </tr>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($product as $p)
                            <tr class="item-table-row">
                                <td>{{$i}}</td>
                                <td>{{$p->pcode}}</td>
                                <td>{{$p->name}}</td>
                                <td>{{$p->size}}</td>
                                <td>{{$p->color}}</td>
                                <td>{{$p->qty}}</td>
                                <td>Rs.{{number_format($p->costPrice,2)}}</td>
                            </tr>

                            @php
                                $i++;
                            @endphp
                        @endforeach

                    </table>
                    </div>


                </div> {{-- End  of sectionContent--}}
            </div> {{-- End  of section 1--}}
        </div>
        <div class="col-md-4 ">
            <div class="section mb-4"> {{-- Start of Section 2--}}
                <div class="section-title section-title-sub">
                    Return Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    @foreach($returns as $returns)
                    <div class="row">
                        <div class="col col-left">Return Id</div>
                    <div class="col col-right">{{$returns->id}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Vendor</div>
                    <div class="col col-right">{{$returns->first_name.' '.$returns->last_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Date</div>
                        <div class="col col-right">{{$returns->date}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Amount</div>
                        <div class="col col-right">Rs.{{number_format($total,2)}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Remarks</div>
                    </div>
                    <div class="row" id="remarks-row">
                        <div class="col ">
                            <div class="return-remarks">
                                {{$returns->remarks}}
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>{{-- End of sectionContent--}}
            </div>{{-- End of section 2--}}
        </div>
    </div>
</div>{{-- End of addUser --}}
<script>


</script>
@endsection
