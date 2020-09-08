<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" type="text/css" media="screen" href="{{ public_path('css/styles.css')}}" /> --}}
<style>
    /****** Barcode ******/
.barcode .store-name{
    font-size: 10px;
    font-weight: 800;
    font-family: serif;
}
.ll,.kur{
    font-weight: 800;
    line-height: 1.2;
}
.ll{
    font-size: 14px;
}
.kur{
    font-size: 8px;
    margin-bottom: 4px;
}
.barcode-img{
    text-align: center;
    margin-bottom: 2px;

}
.barcode{
    height: 75px;
    width: 140px;
    text-align: center;
    background-color: white;
    padding: 10px;
    border: 1px solid #777777;
    margin: 10px ;



}
.barcode-content{
    transform: translateX(-5px);
}
.pr-details{
    font-size: 10px;

}
.barcode-price{

    font-weight: 800;
    transform: rotate(-90deg);
    text-align: right;
    position: relative;
    bottom: 6px;
    right: -90px;

}

.barcode-price-print{

    font-weight: bolder;
    -webkit-transform: rotate(-90deg);
    -webkit-backface-visibility: hidden;
    text-align: right;
    font-size: 16px;
    position: relative;
    top:-25px;
    left:68px;

}
.rs{
    font-size: 14px;
    font-weight: 800;
}

/******Barcode Print*******/
.barcode-print{
    background-color: white;
    margin: 0 0px;
    font-family: "Lato", sans-serif;
    font-weight: 700;
}
.barcode-table{
    border-collapse: collapse;
    border-spacing: 0;
}
</style>

</head>
<body class="barcode-print" >


    <table class="barcode-table">

        @foreach($items as $data)


        @for($i = 0; $i < $data['lqty'] ; $i++)
            @if($i%5 == 0)
            <tr>
                @endif
                <td>
                    <div class="barcode mr-5 mb-3">
                        <div class="barcode-content">
                            <div class="store-name">
                                <div class="ll">LEATHER LINE</div>
                                <div class="kur">KURUNEGALA</div>
                            </div>
                            <div class="barcode-img">
                                <?php echo DNS1D::getBarcodeHTML($data['barcode'], 'C128',1.2,40,'black', true); ?>
                            </div>

                            <div class="pr-details">{{ $data['code'] }} {{ $data['name'] }}</div>
                        </div>
                        <div class="barcode-price-print">
                            <span class="rs">Rs. </span>{{ $data['sellingPrice'] }}.00
                        </div>
                    </div>
                </td>
                @if($i%5 == 4)
            </tr>
            @endif
            @endfor
            @endforeach

    </table>
</body>
</html>
