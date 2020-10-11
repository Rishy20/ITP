<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        .report {
            padding: 15px 0px;
            font-family: sans-serif;
        }

        .store-title {
            text-align: center;
            color: #939393;
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            padding-top: 6px;
            color: #646363;
            letter-spacing: 1.1px;
            text-align: right;
        }


        .pg-title {
            font-size: 34px;
            position: relative;
            top: -35px;
            font-weight: 600;
            color: #3a3a3a;
            letter-spacing: 1.2px;

        }

        .today {
            position: absolute;
            right: 20px;
            top: 68px;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #8d8d8d;
        }

        .period {
            top: -28px;
            position: relative;
            font-weight: 600;
            color: #8d8d8d;
            font-size: 20px;
            padding-left: 5px;
            letter-spacing: 1.5px;
        }

        .all-table {
            padding: 40px 0px;
            text-align: center;
            width: 100%;
            letter-spacing: 1.5px;
            color: #3a3a3a;
        }

        .all-table td {
            letter-spacing: 2px;
        }

        .all-table th {
            font-weight: 600;
        }

        .all-table td,
        .all-table th {
            padding: 15px;
            font-size: 18px;
        }

        .table-head {
            background-color: #5c8bab;
            color: white;
        }

        .table-striped>tbody>tr:nth-child(even)>td,
        .table-striped>tbody>tr:nth-child(even)>th {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-striped>tbody>tr:nth-child(odd)>td {
            background-color: white;
        }

        .hr {
            margin-top: 15px;
            border: 1.5px solid #c2c2c2;
        }

    </style>
</head>
<body>
    <div class="report">
        @php
        date_default_timezone_set('Asia/Colombo');
        @endphp
        <div class="store-title">
            <div class="title">LEATHER LINE</div>
            <div class="today">{{ date("d-m-Y") }}</div>
        </div>
        <div class="pg-title">
            DAY-END REPORT
        </div>
        <div class="period">
            <span class="from">{{ (date('d-m-Y', strtotime($date))) }}</span>
        </div>
        <hr class="hr">
        <table class="all-table table-striped">

            <tr class="table-head">
                <th>Description</th>
                <th>Data</th>
            </tr>
            <tbody>
            <tr>
                <th>Sales</th>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left">Total Sales (incl. Tax)</td>
                <td style="text-align: right">{{ $sales_info['total_sales_incl_tax'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">Total Sales (excl. Tax)</td>
                <td style="text-align: right">{{ $sales_info['total_sales_excl_tax'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">No. of Items Sold</td>
                <td style="text-align: right">{{ $sales_info['total_qty'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">Gross Profit</td>
                <td style="text-align: right">{{ $sales_info['gross_profit'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">Net Profit</td>
                <td style="text-align: right">{{ $sales_info['net_profit'] }}</td>
            </tr>
            <tr>
                <th>Exchanges</th>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left">Total Exchanges</td>
                <td style="text-align: right">{{ $other_info['total_exchanges'] }}</td>
            </tr>
            <tr>
                <th>Discounts</th>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left">Total Discounts</td>
                <td style="text-align: right">{{ $other_info['total_discount'] }}</td>
            </tr>
            <tr>
                <th>Inventory</th>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left">Total Items in Inventory</td>
                <td style="text-align: right">{{ $inventory_info['total_qty'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">Total Inventory Value</td>
                <td style="text-align: right">{{ $inventory_info['total_value'] }}</td>
            </tr>
            <tr>
                <th>Payments</th>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left">Salary Payments</td>
                <td style="text-align: right">{{ $payment_info['salary_pays'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">Payments to Vendors</td>
                <td style="text-align: right">{{ $payment_info['vendor_pays'] }}</td>
            </tr>
            <tr>
                <td style="text-align: left">Total Payments</td>
                <td style="text-align: right">{{ $payment_info['total_pays'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
