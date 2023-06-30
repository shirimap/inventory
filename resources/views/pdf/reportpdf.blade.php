<html>
<head>
    <title>sale report</title>
    <style>
    body {
        margin: 10px;
        font-family: Arial, sans-serif;
    }

    .total {
        background-color: rgb(201, 201, 201);
        color: rgb(0, 0, 0);
        font-weight: bold;
    }

    .zrb {
        /* background-color: rgb(182, 193, 208); */
        color: rgb(19, 19, 19);
        font-weight: bold;
        font-size: 30px;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #ddd;
    }

    .table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: blue;
        color: white;
    }

    .subTitle {
        font-size: 18px;
    }

    small {
        float: right;
        font-size: 10px;
        padding-top: 10px;
    }

    .main-footer {
        padding: 10px;
    }
    </style>
</head>

<body style="font-size: 9pt">
    <table style="border-collapse:collapse; width:100%">
        <thead>
            <tr>
                <th style="text-align:center;" colspan="17" height="70">
                    <strong class="zrb">KIMARO SHAPPERS COMPANY LTD</strong><br>
                    <strong class="subTitle">SALES REPORT FOR MWANANYAMALA BRANCH</strong><br>                    
                         <strong><H2>From: {{$fromDate}}  To: {{$toDate}} </H2> </strong>

                </th>
            </tr>
        </thead>
    </table>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>S/NO:</th>
                <th>PRODUCT NAME</th>
                <th>TYPE</th>
                <th>QUANTITY</th>
                <th>TOTAL PRICE</th>
                <th>PROFIT</th>
                <th>BRANCH</th>
                <th>CATEGORY</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($query as $q)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $q->product->sbidhaa->name }}</td>
                <td>{{ $q->product->sbidhaa->type }}</td>
                <td> {{ $q->quantity }} </td>
                <td align="right">{{ number_format($q->amount,2) }}</td>   
                <td align="right">{{number_format($q->profit,2)}}</td>             
                <td> {{ $q->product->branch->name }}</td>
                <td>{{ $q->product->category->name }}</td>                        
            </tr>
            @endforeach
            <tr>
                <td colspan="6" rowspan="3"></td>
                <td align='right'><b>Debit Paid:</b></td>
                <td>{{number_format($b,2)}} /=</td>
            </tr>
            <tr>
            
                <td align='right'><b>Total Profit:</b></td>
                <td>{{number_format($sikup,2)}} /=</td>
            </tr>
            <tr>
            
                <td align='right'><b>Total Sales:</b></td>
                <td>{{number_format($pius,2)}} /=</td>
            </tr>
        </tbody>   
  
    </table> 

    
</body>

</html>