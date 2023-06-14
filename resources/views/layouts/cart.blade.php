@include('includes/header')
@include('includes/nav')

@include()

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- alert -->

                <!-- /alert -->
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-shopping-cart"></i> Fanya Mauzo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Nyumbani</a></li>
                        <li class="breadcrumb-item active">Mauzo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p color="white">{{ session()->get('error') }}
        </div>
        @endif
        @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <p color="white">{{ session()->get('message') }}
        </div>
        @endif
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <!-- /.row -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><span class="fas fa-shopping-cart "></span> Ulivoviweka kwenye Mkokoteni</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/no</th>
                                <th>Jina la Bidhaa</th>
                                <th>Aina</th>
                                <th>Idadi</th>
                                <th>Bei</th>
                                <!-- <th>Punguzo</th> -->
                                <th>Jumla</th>
                                <th>Kitendo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0 ?>
                            <?php $quantity = 0 ?>
                            <?php $sub_quantity = 0?>
                            <?php $fullName = ucwords(Auth::user()->first_name)." ". ucwords(Auth::user()->last_name) ?>
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $details )
                            <?php

                            $total+=($details['net_amount'] * $details['quantity'])+($details['sub_amount']* $details['sub_quantity']) ?>

                            <?php $quantity+=$details['quantity'] ?>
                            <tr>
                                <td style="width: 4%">{{ $loop->iteration }} </td>
                                <td style="width: 15%"> {{ $details['name'] }} </td>

                                <td style="width: 15%"> {{ $details['type'] }} </td>
                                <td style="width: 10%">
                                    @if($details['category_id'] == 2 and $details['quantity'] > 0)
                                    {{$details['quantity'] }}.{{ $details['sub_quantity'] }}
                                    @elseif($details['category_id'] == 2)
                                    {{$details['sub_quantity'] }}
                                    @else
                                    {{ $details['quantity'] }}
                                    @endif

                                </td>

                                <td>

                                    @if($details['category_id'] == 2 and $details['quantity'] > 0)
                                    {{ $details['net_amount'] }} {{ $details['sub_amount'] }}
                                    @elseif($details['category_id'] == 2)
                                    {{ $details['sub_amount'] }}
                                    @else
                                    {{ $details['net_amount'] }}
                                    @endif
                                </td>




                                <td>
                                    @if($details['category_id'] == 2 and $details['quantity'] > 0)
                                    {{ ($details['net_amount'] * $details['quantity'])+($details['sub_amount']* $details['sub_quantity']) }}
                                    @elseif($details['category_id'] == 2)
                                    {{ $details['sub_amount']* $details['sub_quantity'] }}
                                    @else
                                    {{ $details['net_amount'] * $details['quantity'] }}
                                    @endif

                                </td>

                                <td>
                                    @can('futa-mkokoteni')
                                    <button action="submit" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#modal-danger{{ $details['id'] }}"><span
                                            class="fa fa-trash"></span></button>
                                    @endcan
                                    @can('hariri-mkokoteni')
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#modal-md3{{ $details['id'] }}">
                                        <span class="fa fa-edit"></span></button>

                                    @endcan

                                </td>

                                <!-- modal -->
                                <div class="modal fade" id="modal-danger{{ $details['id'] }}">
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
                                                <form method="post" action="deleteCart">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $details['id'] }}">
                                                    <p>Bidhaa hii itaondolewa kwenye mkokoteni</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-light"
                                                    data-dismiss="modal">Funga</button>
                                                <button name="remove" class="btn btn-outline-light">Ondoa</button>
                                                </form>
                                            </div>


                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="modal-md3{{ $details['id'] }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hariri Mkokoteni</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="updateCart">
                                                    @csrf
                                                    <p>

                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Jumla</label>
                                                        </div>
                                                        <div class="col col-md-8">


                                                            <input type="hidden" name="id" value="{{$details['id']}}">
                                                            <input type="text" name="amount" class="form-control"
                                                                value="{{$total}}" disabled>

                                                        </div>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>idadi</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="number" min="0" name="quantity"
                                                                class="form-control" value="{{ $details['quantity'] }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    @if($details['category_id'] == 2)
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>kipimo</label>
                                                        </div>
                                                        <div class="col col-md-8">
                                                            <input type="number" min="0" step="0.25" name="sub_quantity"
                                                                class="form-control"
                                                                value="{{ $details['sub_quantity'] }}" required>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    </p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Funga</button>
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
                        <tr>
                            <th colspan="5">Jumla</th>
                            <th colspan="2">
                                <i>Tsh {{ $total }}/= </i>


                            </th>
                        </tr>
                    </table> <br>
                    @can('fanya-mauzo')

                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-md"><span
                            class="fa fa-plus"></span> Fanya Mauzo</button>
                    @endcan
                    @can('ongeza-order')

                    <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#modal-mdd"><span
                            class="fa fa-plus"></span> Order</button>
                    @endcan


                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <form action="checkout" method="POST">
        @csrf
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
                                <input type="text" class="form-control" name="customer_name"
                                    placeholder="Jina la mteja">
                            </div>
                        </div>
                        <!-- <div class="row">

                            <div class="col col-md-4">
                                <label>Anuani</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="address" placeholder="Anuani">
                            </div>
                        </div> -->
                        <br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Namba ya simu</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="phonenumber" placeholder="Namba Ya simu">
                            </div>
                        </div>
                        <br>
                        <!-- 
                        <div class="row">
                            <div class="col col-md-4">
                                <label>TIN</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="TIN" placeholder="TIN">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>VRN</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="VRN" placeholder="VRN">
                            </div>
                        </div><br> -->
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Jumla</label>
                            </div>
                            <div class="col col-md-8">

                                @foreach(session('cart') as $id => $details )
                                <input type="hidden" name="product[]" value="{{ $details['id'] }}">
                                <input type="hidden" name="sub_quantity[]" value="{{ $details['sub_quantity'] }}">
                                <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">
                                <input type="hidden" name="amount[]" value="{{ $details['net_amount'] }}">
                                @endforeach
                                <input type="text" name="total_amount" class="form-control" value=" {{ $total }}"
                                    readonly>

                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Idadi ya Bidhaa</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" name="total_quantity" class="form-control"
                                    value="{{ $quantity }}" readonly>
                            </div>
                        </div><br>
                        <div class="row">
                            @can('ongeza-punguzo')
                            <div class="col col-md-4">
                                <label>Punguzo/Discount</label>
                            </div>

                            <div class="col col-md-8">
                                <input type="number" min="0" value="0" name="discount" class="form-control">
                            </div>
                            @endcan
                        </div><br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>VAT %</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" value="0" name="vat" class="form-control">
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>

                        <button type="submit" name="sell" class="btn btn-primary">Uza</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    <form action="makeorder" method="POST">
        @csrf
        <div class="modal fade" id="modal-mdd">
            <div class="modal-dialog modal-mdd">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Order</h4>
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
                                <input type="text" class="form-control" name="customer_name"
                                    placeholder="Jina la mteja">
                            </div>
                        </div><br>
                        <!-- <div class="row">

                            <div class="col col-md-4">
                                <label>Anuani</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="address" placeholder="Anuani">
                            </div>
                        </div>
                        <br> -->
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Namba ya simu</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="phonenumber" placeholder="Namba Ya simu">
                            </div>
                        </div>
                        <br>
                        <!-- 
                        <div class="row">
                            <div class="col col-md-4">
                                <label>TIN</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="TIN" placeholder="TIN">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>VRN</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="text" class="form-control" name="VRN" placeholder="VRN">
                            </div>
                        </div><br> -->
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Jumla</label>
                            </div>
                            <div class="col col-md-8">

                                @foreach(session('cart') as $id => $details )
                                <input type="hidden" name="product[]" value="{{ $details['id'] }}">
                                <input type="hidden" name="sub_quantity[]" value="{{ $details['sub_quantity'] }}">
                                <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">
                                <input type="hidden" name="amount[]" value="{{ $details['net_amount'] }}">
                                @endforeach
                                <input type="text" name="total_amount" class="form-control" value=" {{ $total }}"
                                    readonly>

                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>Idadi ya Bidhaa</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" name="total_quantity" class="form-control"
                                    value="{{ $quantity }}" readonly>
                            </div>
                        </div><br>
                        <div class="row">
                            @can('ongeza-punguzo')
                            <div class="col col-md-4">
                                <label>Punguzo/Discount</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" value="0" name="discount" class="form-control">
                            </div>
                            @endcan
                        </div><br>
                        <div class="row">
                            <div class="col col-md-4">
                                <label>VAT %</label>
                            </div>
                            <div class="col col-md-8">
                                <input type="number" min="0" value="0" name="vat" class="form-control">
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>

                        <button type="submit" name="sell" class="btn btn-primary">Uza</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

    @endif
</div>
<!-- /.content-wrapper -->
{{--  @include('includes/footer')  --}}