<!DOCTYPE html>
<html>
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ public_path('css/styles.css')}}" />

</head>
<body class="barcode-print" onload="window.print()">

    <table class="barcode-table">

        @foreach($product as $data)
        @for($i = 0; $i < $data->Qty; $i++)

            @if($i%4 == 0)
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
                                <?php echo DNS1D::getBarcodeHTML($data->barcode, 'C128',1.2,40,'black', true); ?>
                            </div>

                            <div class="pr-details">{{ $data->pcode }} {{ $data->name }}</div>
                        </div>
                        <div class="barcode-price-print">
                            <span class="rs">Rs. </span>{{ $data->sellingPrice }}.00
                        </div>
                    </div>
                </td>
                @if($i%4 == 3)
            </tr>
            @endif
            @endfor
            @endforeach

    </table>
</body>
</html>
