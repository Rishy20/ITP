@extends('layouts.main')
@section('content')

<div class="showSales"> {{-- Start of addUser --}}
    <div class="pg-heading">
        <a href="{{ route('sale.index')}}"><i class="fa fa-arrow-left pg-back"></i></a>
        @foreach($sale as $s)
    <div class="pg-title">Sale #{{$s->id}}</div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="section"> {{-- Start of Section 1--}}
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
                            <th scope="col">Discount</th>


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
                                <td>Rs.{{number_format($p->price,2)}}</td>
                                <td>Rs.{{number_format($p->discount,2)}}</td>
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
        <div class="col-md-4">
            <div class="section"> {{-- Start of Section 2--}}
                <div class="section-title section-title-sub">
                    Sale Information
                    <hr>
                </div>
                <div class="section-content"> {{-- Start of sectionContent--}}
                    @foreach($sale as $sale)
                    <div class="row">
                        <div class="col col-left">Sale Id</div>
                    <div class="col col-right">{{$sale->id}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Salesman</div>
                    <div class="col col-right">{{$sale->fname.' '.$sale->lname}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Customer</div>
                        <div class="col col-right">{{$sale->firstname .' '.$sale->lastname}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Mobile</div>
                        <div class="col col-right">{{$sale->phone}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Amount</div>
                    <div class="col col-right">Rs.{{number_format($sale->amount,2)}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Discount</div>
                        <div class="col col-right">Rs.{{number_format($sale->discount,2)}}</div>
                    </div>
                    <div class="row">
                        @php
                            $s = strtotime($sale->updated_at);
                            $date = date('m/d/Y', $s);
                            $time = date('H:i:s', $s);
                        @endphp
                        <div class="col col-left">Date</div>
                        <div class="col col-right">{{$date}}</div>
                    </div>
                    <div class="row">
                        <div class="col col-left">Time</div>
                    <div class="col col-right">{{$time}}</div>
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
