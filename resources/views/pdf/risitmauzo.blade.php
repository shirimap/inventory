{{--  @include('includes/header')
@include('includes/nav')  --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales and Stock Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->


                    <div class="row">
                        <div class="col-12">
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> SALES & STOCKS SHOP.
                                            <small
                                                class="float-right">Tarehe:<b>{{ $date->format('D, d M Y h:i A') }}</b></small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <address>
                                            <strong>Shop Name,</strong>KIMARO SHAPPERS<br>
                                            {{ $sells[0]['product']['branch']['address']}},<br>
                                            Tawi
                                            <b>{{ $sells[0]['product']['branch']['name'] }}-{{ $sells[0]['product']['branch']['location'] }}</b><br>
                                            <b>Namba ya simu:</b>
                                            {{ $sells[0]['product']['branch']['phoneNumber'] }},<br>
                                            <b>Barua pepe:</b> {{ $sells[0]['product']['branch']['email'] }}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <strong>Mteja</strong>
                                        <address>
                                            fullname <b>{{ $sells[0]['customer_name'] }}</b>
                                            <br>
                                            address<br>
                                            phone<br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Namba ya mauzo: </b><b class="text-primary">
                                            INV-{{ str_pad( $sells[0]['order']['id'],5,'0',STR_PAD_LEFT )}} </b><br>
                                        <b>Tarehe ya mauzo:</b>
                                        {{ $sells[0]['order']['created_at']->format('D, d-m-Y h:i A') }}<br>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                


                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/n</th>
                                                    <th>Jina la bidhaa</th>
                                                    <th>Idadi</th>
                                                    <th>Bei</th>
                                                    <th>Jumla</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- here your content -->
                                                <?php $total =0 ?>
                                                <?php $quantity =0 ?>
                                                @foreach($sells as $sell)
                                                <?php $total+=$sell->amount ?>
                                                <?php $quantity+=$sell->quantity ?>
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$sell->product->name}}({{$sell->product->type}})</td>


                                                    <td>{{$sell['quantity']}}</td>
                                                    <td>{{$sell->amount}}</td>
                                                    <td>{{$sell['quantity'] * $sell->amount}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <!-- /.col -->
                                    <div class="col-8">
                                        <p class="lead">Taarifa za mauzo</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Idadi ya Bidhaa:</th>
                                                    <td>
                                                        {{$quantity}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Jumla</th>
                                                    <td>
                                                        <i> {{$sells[0]['order']['total_amount'] + $sells[0]['order']['discount']}}
                                                            /=Tsh</i>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Punguzo: </th>
                                                    <td>{{$sells[0]['order']['discount']}} <i>/=Tsh</i></td>
                                                </tr>
                                                <tr>
                                                    <th>Kiasi Halisi:</th>
                                                    <td>{{$sells[0]['order']['total_amount']}}<i>/=Tsh</i></td>
                                                </tr>
                                                {{--  <tr>
                        <th>Kiasi cha kumrudishia mteja (change):</th>
                        <td>checkoutmoney discount <i>/=Tsh</i></td>
                      </tr>  --}}
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <p class="lead">Mauzo haya yamefanywa na: <b>{{ ucwords(Auth::user()->first_name)}}
                                            {{ ucwords(Auth::user()->last_name)}}</b></p>
                                </div>

                                <!-- this row will not appear when printing -->
                                {{--  <div class="row no-print">
                <div class="col-12">
                  <a href="{{ route('printirisiti') }}" target="" class="btn btn-warning"><i class="fas fa-print"></i>
                                Printi Risiti</a>
                                <a href="javascript:void(0)" class="nav-link" onclick="export2Pdf()">Download PDF</a>
                                <form method="POST" action="{{ route('viewPDF',['id'=>$sells[0]['order']['id']])}}">
                                    @csrf
                                    <button class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Tengeza PDF
                                    </button>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
        </div><!-- /.row -->


        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>