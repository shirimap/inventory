@include('includes/header')
@include('includes/nav')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><span class="fa fa-file-text-o"></span> Risiti </h1>

            {{--  <a href="{{ route('historiamauzo') }}" class="btn btn-primary"><span class="fa fa-arrow-left"></span> Rudi</a>

            <a href="{{ route('mauzomuuzaji') }}" class="btn btn-primary"><span class="fa fa-arrow-left"></span> Rudi</a>  --}}

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
              <li class="breadcrumb-item active">Risiti</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
                    {{--  <small class="float-right">Tarehe:<b>{{ $date->format('D, d M Y h:i A') }}</b></small>  --}}
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>Shop Name,</strong><br>
                    P.O.BOx 2022,<br>
                    Tawi <b>{{ $sells[0]['product']['branch']['name'] }}-{{ $sells[0]['product']['branch']['location'] }}</b><br>
                    <b>Namba ya simu:</b> (+255) 656-556-002,<br>
                    <b>Barua pepe:</b> info@shop.com
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
                  <b>Tarehe ya mauzo:</b> {{ $sells[0]['order']['created_at']->format('D, d-m-Y h:i A') }}<br>
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
                         <i>                      {{$sells[0]['order']['total_amount'] + $sells[0]['order']['discount']}}
                            /=Tsh</i>

                        </td>
                      </tr>
                      <tr>
                        <th>Punguzo: </th>
                        <td>{{$sells[0]['order']['discount']}}  <i>/=Tsh</i></td>
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
              	<p class="lead">Mauzo haya yamefanywa na: <b>{{ ucwords(Auth::user()->first_name)}} {{ ucwords(Auth::user()->last_name)}}</b></p>
              </div>

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{ route('printirisiti') }}"  class="btn btn-warning"><i class="fas fa-print"></i> Printi Risiti</a>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Tengeza PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <footer class="main-footer">
    <strong>Mwisho wa risiti <a href="#"></a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
  </div>
<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
</body>
</html>
