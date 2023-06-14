<html>
<head>
    <title></title>
    <style>
    body {
        margin: 10px;
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
        background-color: #04aaaa;
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

<body style="font-size: 7pt">
    <table style="border-collapse:collapse; width:100%">
        <thead>
            <tr>
                <th style="text-align:center;" colspan="17" height="70">
                    <strong class="zrb">KIMARO SHAPPERS COMPANY LTD</strong><br>
                    <strong class="subTitle">RIPORI YA MAUZO TAWI LA MWANANYAMALA</strong><br>

                    Ripoti ya mwezi
                    <strong>August 2023</strong>
                    <strong>From  To 20 Sept 2023 </strong>

                </th>
            </tr>
        </thead>
    </table>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Sn</th>
                <th>JIna</th>
                <th>Aina</th>
                <th>idadi</th>
                <th>kiasi</th>
                <th>Tawi</th>
                <th>Kipengele</th>
                <th>Mfanyakazi</th>
                <th>Tarehe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($query as $q)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $q->product->sbidhaa->name }}</td>
                <td>{{ $q->product->sbidhaa->type }}</td>
                <td> {{ $q->quantity }} </td>
                <td>{{ $q->amount }}</td>                
                <td> {{ $q->product->branch->name }}</td>
                <td>{{ $q->product->category->name }}</td>
                <td>jina</td>
                <td>tarehe</td>
               {{-- <td>{{ $q->order->user->first_name }}</td>  --}} 
               {{-- <td>{{ $q->created_at->format('d/m/Y') }}</td>  --}} 
            </tr>
            @endforeach
        </tbody>
        <tfooter>
            <tr>
                <th colspan="7"></th>
                <td align='right'><b>Sales:</b></td>
                <td>Tsh {{$pius}}/=</td>
            </tr>
        </tfooter>
    </table>
    
    <script type="text/javascript">
    window.addEventListener("load", window.print());
    </script>
    
</body>

</html>