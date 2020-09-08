@extends('layouts.main')
@section('content')

<div class="pg-heading">
    <div class="pg-title">Dashboard</div>
</div>

<div class="ministats">
    <div class="row">
        <div class="col">
            <div class="stats-amnt" id="stats-amnt-1">Rs.500000.00</div>
            <div class="stats-name">Total Sales</div>
            <i class="fas fa-shopping-cart stats-icon" id="stats-icon-1"></i>
        </div>
        <div class="col">
            <div class="stats-amnt" id="stats-amnt-2">Rs.100000.00</div>
            <div class="stats-name">Gross Profit</div>
            <i class="fas fa-percentage stats-icon" id="stats-icon-2"></i>
        </div>
        <div class="col">
            <div class="stats-amnt" id="stats-amnt-3">100</div>
            <div class="stats-name">No.of Products Sold</div>
            <i class="fas fa-tags stats-icon" id="stats-icon-3"></i>
        </div>
        <div class="col">
            <div class="stats-amnt" id="stats-amnt-4">Rs.5000.00</div>
            <div class="stats-name">Expenses</div>
            <i class="fas fa-dollar-sign stats-icon" id="stats-icon-4"></i>
        </div>
    </div>
</div>
<div class="section-dashboard">
    <canvas id="myChart" width="350" height="95"></canvas>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['09/01', '09/02', '09/03', '09/04', '09/05', '09/06','09/07','09/08','09/09','09/10'],
            datasets: [{
                label: '# of Sales',
                data: [200, 180, 170, 195, 160, 150,120,130,150,200],
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
