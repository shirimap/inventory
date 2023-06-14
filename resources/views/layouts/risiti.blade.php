
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales and Stock Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{URL::asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="{{URL::asset('plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('tcal.css')}}" />
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<link rel="stylesheet" href="{{URL::asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('bower_components/Ionicons/css/ionicons.min.css')}}">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown user user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                    <?php $shop = App\Models\ShopInfo::all() ?>
            @foreach($shop as $shop)
            <img src="{{$shop->logo}}" class="user-image img-circle elevation-2 alt=">

        @endforeach
                    <span class="hidden-xs">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}</span>

                    {{--  <br>@if (empty(Auth::user()->branch->name))
                    <span class="brand-text font-weight-light"></span>
                    @else
                    <span class="brand-text font-weight-light">{{ Auth::user()->branch->name }}</span>
                    @endif  --}}
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Wasifu</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-lock mr-2"></i> Badili password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-lg">
                        <i class="fas fa-file mr-2"></i> Badili taarifa
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">

            <?php $shop = App\Models\ShopInfo::all() ?>
            @foreach($shop as $shop)
            <img src="{{$shop->logo}}" class="brand-image img-circle elevation-3" alt="AdminLTE Logo" style="opacity: .8">
            <span class="brand-text font-weight-light" style="font-size: 10px">{{ $shop->name }}</span>
        @endforeach

            <br>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <ul class="navbar-nav ml-auto">
                <br>
                {{--  <li class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{URL::asset('../../dist/img/user2-160x160.jpg')}}" class="user-image img-circle elevation-2 alt=">

                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><span
                                class="brand-text font-weight-light">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}</span>
                            <br>@if (empty(Auth::user()->branch->name))
                            <span class="brand-text font-weight-light"></span>
                            @else
                            <span class="brand-text font-weight-light">{{ Auth::user()->branch->name }}</span>
                            @endif</a>
                    </div>

                </li>  --}}
            </ul>

            <!-- Sidebar Menu -->
            <nav>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                    <li class="nav-item ">
                        <a href="{{ route( 'dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('mauzo') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart "></i>
                            <p>
                                Mauzo
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bidhaa') }}" class="nav-link">
                            <i class="nav-icon fa fa-product-hunt"></i>
                            <p>
                                Bidhaa
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usimamizi wa Duka
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('matawi') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Matawi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('jukumu') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jukumu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('wauzaji') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Wauzaji</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('mauzomuuzaji') }}" class="nav-link">
                            <i class="nav-icon fa  fa-bar-chart"></i>
                            <p>
                                Historia ya mauzo
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('report') }}" class="nav-link">
                            <i class="nav-icon fa fa-folder-open"></i>
                            <p>
                                Ripoti
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('punguzo') }}" class="nav-link">
                            <i class="nav-icon fa fa-line-chart"></i>
                            <p>
                                Mfumo
                            </p>
                        </a>
                    </li>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Badili password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="changepassword" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col col-md-12">
                                    <label>Password ya zamani</label>
                                    <input type="text" name="old" class="form-control" placeholder="Password ya zamani">
                                </div>
                                <div class="col col-md-12">
                                    <label><p>Password mpya</p></label>
                                    <input type="text" name="new" class="form-control" placeholder="Password mpya">
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
                                <button type="submit" class="btn btn-primary">Badili</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form action="changeinfo" method="POST">
            @csrf
         <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Badili taarifa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>
                    <div class="row">
                      <div class="col col-md-6">
                        <label>Jina la kwanza</label>
                        <input type="text" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" required>
                      </div>
                      <div class="col col-md-6">
                        <label>Jina la Pili</label>
                        <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-6">
                        <label>Anwani</label>
                        <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}" required>
                      </div>
                      <div class="col col-md-6">
                        <label>Namba ya simu</label>
                        <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-6">
                        <label>Barua pepe</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                      </div>
                      <div class="col col-md-6">
                        <label>Jinsia</label>
                        <select class="form-control" name="gender">
                          <option>--</option>
                          @if(Auth::user()->gender == "MME")
                          <option value="MME" selected>MME</option>
                          <option value="MKE">MKE</option>
                          @else
                          <option value="MME">MME</option>
                          <option value="MKE" selected>MKE</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
                  <button type="submit" class="btn btn-primary">Ongeza</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          </form>

            @include('includes/script')

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
              <li class="breadcrumb-item"><a href="#">Nyumbani </a></li>
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
                    <small class="float-right">Tarehe:<b>{{ $date->format('D, d M Y h:i A') }}</b></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>Shop Name,</strong>GIRRAFE SHAPPERS<br>
                    {{ $sells[0]['product']['branch']['address']}},<br>
                    Tawi <b>{{ $sells[0]['product']['branch']['name'] }}-{{ $sells[0]['product']['branch']['location'] }}</b><br>
                    <b>Namba ya simu:</b> {{ $sells[0]['product']['branch']['phoneNumber'] }},<br>
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
                  <a href="{{ route('printirisiti') }}" target="" class="btn btn-warning"><i class="fas fa-print"></i> Printi Risiti</a>
                  {{--  <a href="javascript:void(0)" class="nav-link" onclick="export2Pdf()">Download PDF</a>  --}}
                 <form method="POST" action="{{ route('viewPDF',['id'=>$sells[0]['order']['id']])}}">
                    @csrf
                  <button class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Tengeza PDF
                  </button>
                 </form>
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



<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{URL::asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{URL::asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{URL::asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{URL::asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{URL::asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{URL::asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{URL::asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Leo'       : [moment(), moment()],
          'Jana'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Siku 7 zilizopita' : [moment().subtract(6, 'days'), moment()],
          'Siku 30 zilizopita': [moment().subtract(29, 'days'), moment()],
          'Mwezi huu'  : [moment().startOf('month'), moment().endOf('month')],
          'Mwezi uliopita'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })


</script>

{{--  <script>
    const export2Pdf = async () => {

      let printHideClass = document.querySelectorAll('.print-hide');
      printHideClass.forEach(item => item.style.display = 'none');
      await fetch('http://localhost:8000/export-pdf', {
        method: 'GET'
      }).then(response => {
        if (response.ok) {
          response.json().then(response => {
            var link = document.createElement('a');
            link.href = response;
            link.click();
            printHideClass.forEach(item => item.style.display='');
          });
        }
      }).catch(error => console.log(error));
    }
  </script>  --}}

</body>
</html>

@include('includes/footer')
