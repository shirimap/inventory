<!DOCTYPE html>
<html>

<head>
    <title>PROFORMA INVOICE</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        width: 600px;
        margin: 0 auto;
    }

    .logo {
        text-align: center;
        margin-bottom: 20px;
    }


    .invoice-header {
        text-align: right;
        color: ;
    }

    .invoice-header h1 {
        margin: 0;
        color: blue;
    }

    .invoice-body {
        margin-top: 20px;
        margin-bottom: 100px;
    }

    .invoice-table {
        width: 100%;
        border: 1px solid white;
        border-collapse: collapse;
    }

    .invoice-table th {
        padding: 8px;
        border: 1px solid black;

    }

    .invoice-table td {
        padding: 8px;
        border: none;
    }

    /* .invoice-table th {
            background-color: blue;
        } */



    .footer {
        text-align: center;
        /* background-color: blue; */
        padding: 20px 0;
        color: #555;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php $shop = App\Models\ShopInfo::all() ?>
        @foreach($shop as $shop)        

        <div class="logo" align="center">
            <img src="dist/img/logo.jpg" style="width:150px;height:100px; border-radius:20px;">
            <h1 align="center">{{ $shop->name }}</h1>
            <p style="font-size:12px" align="center; margin-top:-10px;"> Address: {{ $shop->address }},location:
                {{ $shop->location }},Tel: {{ $shop->phoneNumber}},
                Mob: {{ $shop->mobile1 }},Email:{{ $shop->email}},Web: {{ $shop->website}}</p>
        </div>
        @endforeach
        @foreach ($o as $o)
        <div class="invoice-header">
            <h1>PINV: {{ str_pad( $o->id,5,'0',STR_PAD_LEFT) }}</h1>
            <p>Date: {{ $date->format('D, d M Y h:i A') }}</p>
        </div>
        
        
        <div class="invoice-body">
            <table class="invoice-table">
                <thead>
                    <tr style="background:blue; color:white;">
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Type</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($s as $q)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $q['product']['sbidhaa'] ['name']}} </th>
                        <th>{{$q['product']['sbidhaa'] ['type']}}</th>
                        
                        <th>{{ $q['quantity']}}</th>
                        <th>{{ number_format($q['product']['amount'],2)}}</th>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="text-align: right;">
                        <td colspan="4">Subtotal:</td>
                        <td align="left"><b>{{ number_format($o->org_amount,2)  }}</b></td>
                    </tr>
                    <tr style="text-align: right;">
                        <td colspan="4">Discount:</td>
                        <td align="left"><b>{{ number_format($o->discount,2) }}</b></td>
                    </tr>
                    <tr style="text-align: right;">
                        <td colspan="4">Total:</td>
                        <td align="left"><b>{{ number_format($o->org_amount,2)  }}</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endforeach
        <div class="footer">
            <b>You Are Most Welcome!!</b>
        </div>
    </div>
</body>

</html>