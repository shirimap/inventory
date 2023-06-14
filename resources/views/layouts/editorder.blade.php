@include('includes/header')
@include('includes/nav')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session()->has('error'))
<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-check"></i> Error!</h5>
               <p color="white">{{ session()->get('error') }}
             </div>
@endif
@if(session()->has('message'))
   <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Taarifa!</h5>
                  <p color="white">{{ session()->get('message') }}
                </div>
@endif
Session::flash('toastr', [
            'type' => 'toastrDefaultSuccess',
            'message' => 'Product added successfully!'
        ]);
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            {{--  <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Weka Kwenye Mkokoteni
                    </h3>
                </div>
                <div class="card-body">



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" style="width: 100%;" name="product">
                                        <option selected disabled>-Chagua Bidhaa-</option>


                                        <option value="">: Aina = : Bei = </option>
                                        @endforeac
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="number" min="0" placeholder="-Weka idadi-" name="quantity"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" name="cartbtn">
                                        <span class="fas fa-shopping-cart"></span> Ongeza kwenye mkokoteni
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>  --}}
                <!-- /.card -->
            </div>
            <!-- /.row -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><span class="fas fa-shopping-cart "></span> Ulivoviweka kwenye Mkokoteni</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/no</th>
                                <th>Jina la Bidhaa</th>
                                <th>Aina</th>
                                <th>Idadi</th>
                                <th>Bei</th>


                                {{--  <th>Jumla</th>  --}}
                                {{--  <th>Kitendo</th>  --}}
                            </tr>
                        </thead>
                        <tbody>

@foreach ($sell as $p )





                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="width: 25%"> {{ $p->product->name }}</td>

                                <td style="width: 25%"> {{ $p->product->type }}</td>
                                {{--  <td> {{ $p->product->quantity }} </td>  --}}
                                {{--  <td style="width: 25%"> {{ $p->net_amount }} </td>
                                <form method="post" action="addToCart/{{ $p->id }}">
                                    @csrf  --}}




                                    <td>
                                        <input  class="form-control" type="hidden" name="quantity" min="0" value="{{ $p->quantity }}">
                                        {{ $p->quantity }}</td>
                                <td style="width: 25%">{{ $p->amount }}</td>
                                {{--  <td>

                                    <button type="submit" class="btn btn-small btn-secondary" data-toggle="modal" data-target="#modal-md3{{ $p->product->id }}">
                                        <span class="fas fa-edit"></span></button>

                                    <button action="submit" class="btn btn-small btn-danger" data-toggle="modal"
                                    data-target="#modal-danger{{ $p->product->id }}"><span class="fa fa-trash"></span></button>


                                </td>  --}}
                                <!-- modal -->
                                <div class="modal fade" id="modal-danger{{ $p->product->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ondoa kwenye mkokoteni</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                    <p>Bidhaa hii itaondolewa kwenye mkokoteni</p>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-light"
                                                    data-dismiss="modal">Funga</button>
                                                    <form method="POST" action="{{ route('remove',$p->product->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="total_quantity" value="{{ $p->quantity }}">
                                                        <input type="hidden" name="id" value="{{ $p->order->id }}">
                                                    <button name="remove" type="submit" class="btn btn-outline-light">Ondoa</button>
                                                </form>
                                            </div>


                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="modal-md3{{ $p->product->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hariri Mkokoteni</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php $total=0;  ?>
                                            <?php $total += $p->quantity ?>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('update.order',$p->id) }}">
                                                    @csrf
                                                <p>


                                                <div class="row">
                                                    <div class="col col-md-4">
                                                        <label>idadi</label>
                                                    </div>
                                                    <div class="col col-md-8">
                                                        <input type="hidden" name="id" value="{{$p->id}}">
                                                        <input type="hidden" name="ido" value="{{$p->order}}">
                                                        <input type="number" min="0" name="quantity" class="form-control"
                                                            value="{{ $p->quantity }}" required>


                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
                                                <button type="submit" class="btn btn-primary">Hariri</button>
                                            </div>
                                        </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </tr>

                            @endforeach





                        </tbody>
                        {{--  <tr>
                            <th colspan="5">Jumla</th>
                            <th colspan="2">
                                <i>/= (Tsh)</i>


                            </th>
                        </tr>  --}}
                    </table> <br>
                    {{--  <a href="/cart"><button class="btn btn-primary btn-block"><span
                            class="fa fa-plus"></span> Onesha Mkokoteni</button></a>  --}}
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



    <form method="post">
        <div class="modal fade" id="modal-md">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Fanya Mauzo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Mteja</label>
                            </div>
                            <div class="col col-md-8">
                                <select name="customername" class="form-control select2">
                                    <option>--</option>

                                    <option>fullname</option>

                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Jumla</label>
                            </div>
                            <div class="col col-md-8">
                                amount

                                <input type="hidden" name="totalmoney" value="">
                                <input type="text" class="form-control" value="" disabled>

                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col col-md-4">
                                <label>Kiasi alichotoa mteja</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" name="checkout" class="form-control"
                                    placeholder="Weka kiasi alichotoa mteja" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Punguzo/Discount</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" name="discount" class="form-control"
                                    placeholder="Weka punguzo" required>
                            </div>
                        </div>

                        <br>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
                        <button name="sell" class="btn btn-primary">Uza</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

</div>


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

<!-- /.content-wrapper -->
@include('includes/footer')

