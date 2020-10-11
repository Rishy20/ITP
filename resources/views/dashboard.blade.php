@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Dashboard</div>
</div>

<div class="ministats">
    <div class="row">
        <div class="col">
        <div class="stats-amnt" id="stats-amnt-1">Rs.{{$totsales==''?0:number_format($totsales,2)}}</div>
            <div class="stats-name">Total Sales</div>
            <i class="fas fa-shopping-cart stats-icon" id="stats-icon-1"></i>
        </div>
        <div class="col">
            <div class="stats-amnt" id="stats-amnt-2">Rs.{{$grossprofit==''?0:number_format($grossprofit,2)}}</div>
            <div class="stats-name">Gross Profit</div>
            <i class="fas fa-percentage stats-icon" id="stats-icon-2"></i>
        </div>
        <div class="col">
        <div class="stats-amnt" id="stats-amnt-3">{{$totproducts==''?0:$totproducts}}</div>
            <div class="stats-name">No.of Products Sold</div>
            <i class="fas fa-tags stats-icon" id="stats-icon-3"></i>
        </div>
        <div class="col">
            <div class="stats-amnt" id="stats-amnt-4">Rs.{{$totexpenses==''?0:number_format($totexpenses,2)}}</div>
            <div class="stats-name">Expenses</div>
            <i class="fas fa-dollar-sign stats-icon" id="stats-icon-4"></i>
        </div>
    </div>
</div>
<div class="section-dashboard">
    <canvas id="myChart" width="350" height="95"></canvas>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script>
    var arr = <?php echo json_encode($day); ?>;
    var sales = JSON.parse(arr);
    console.log( moment().subtract(1, 'days').format("MM/DD"));
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [moment().subtract(9, 'days').format("MM/DD"), moment().subtract(8, 'days').format("MM/DD"), moment().subtract(7, 'days').format("MM/DD"), moment().subtract(6, 'days').format("MM/DD"), moment().subtract(5, 'days').format("MM/DD"), moment().subtract(4, 'days').format("MM/DD"),moment().subtract(3, 'days').format("MM/DD"),moment().subtract(2, 'days').format("MM/DD"),moment().subtract(1, 'days').format("MM/DD"),moment().subtract(0, 'days').format("MM/DD")],
            datasets: [{
                label: '# of Sales',
                data: [sales[0][0]['scount'], sales[1][0]['scount'], sales[2][0]['scount'], sales[3][0]['scount'], sales[4][0]['scount'], sales[5][0]['scount'],sales[6][0]['scount'],sales[7][0]['scount'],sales[8][0]['scount'],sales[9][0]['scount']],
                backgroundColor: [
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',

                ],
                borderColor: [
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                    'rgb(146, 192, 226)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endsection
