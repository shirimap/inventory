@include('includes/sidebar')
@include('sweetalert::alert')


<section class="section">
    <h1 class="section-header">
        <div>P O S
        </div>
    </h1>
</section>

<section>
    <div class="section-body">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><span class="fas fa-shopping-cart "></span>Product List
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-sm  table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Sell Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $p )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td style="width: 150px;"><b>{{ $p->sbidhaa->name }}</b></td>
                                    <td style="width: 150px;"> {{ $p->sbidhaa->type }}</td>
                                    <td> @if($p->category_id == 1)
                                        @if($p->quantity <= $p->sbidhaa->threshold)
                                            <span class="badge badge-danger">{{ $p->quantity }}</span>
                                            @else
                                            <span class="badge badge-info">{{ $p->quantity }}</span>
                                            @endif

                                            @else
                                            @if($p->quantity <= $p->sbidhaa->threshold)
                                                <span class="badge badge-danger">{{ $p->quantity }}</span>
                                                @else
                                                <span class="badge badge-info">{{ $p->quantity }}</span>
                                                @endif
                                                @endif
                                    </td>
                                    <td style="width:100px;">@if($p->category_id == 1)
                                        <b>{{ number_format($p->net_amount) }}</b>
                                        @else
                                        <b>{{ number_format($p->net_amount) }}</b>
                                        @endif
                                    </td>

                                    <form method="post" action="addToCart/{{ $p->id }}">
                                        @csrf
                                        @if($p->category_id == 2)

                                        <td>kupima
                                            <input class="form-control" type="number" name="quantity" min="0" max=""
                                                step="0.5" value="1" style="width: 100%">
                                        </td>

                                        @else
                                        <td style="width: 20%"> <input class="form-control" type="number" min="0"
                                                name="quantity" max="" value="1" style="width: 100%">
                                        </td>
                                        @endif
                                        </td>
                                        <td>
                                            @can('add-cart')
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <span class="fas fa-plus"></span></button>
                                            @endcan
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><span class="fas fa-shopping-cart"></span> Choosen To Cart</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example" class="table table-sm table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Sell Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0 ?>
                                <?php $quantity = 0 ?>
                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                <?php $total += $details['net_amount'] ?>
                                <?php $quantity += $details['quantity'] ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td>{{ number_format($details['pprofit']) }}</td>
                                    <td>{{ number_format($details['net_amount']) }}</td>
                                    <td>
                                        @can('add-cart')
                                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modal-md3{{ $details['id'] }}">
                                            <span class="fa fa-edit"></span></button>
                                        @endcan
                                        @can('add-order')
                                        <button action="submit" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#modal-danger{{ $details['id'] }}"><span
                                                class="fa fa-trash"></span></button>
                                        @endcan                                    
                                    </td>
                                </tr>
                                @endforeach
                                <form action="checkout" method="POST">
                                    @csrf
                                    <div class="modal fade" id="modal-md">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Payment</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Total Amount</label>
                                                        <div class="col-sm-8">
                                                            @foreach(session('cart') as $id => $details )
                                                            <input type="hidden" name="product[]"
                                                                value="{{ $details['id'] }}">
                                                            <input type="hidden" name="quantity[]"
                                                                value="{{ $details['quantity'] }}">
                                                            <input type="hidden" name="pprofit[]"
                                                                value="{{ $details['pprofit'] }}">
                                                            <input type="hidden" name="amount[]"
                                                                value="{{ $details['net_amount'] }}">
                                                            @endforeach
                                                            <input type="number" class="form-control"
                                                                name="total_amount" value="{{ $total }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Quantity</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control"
                                                                name="total_quantity" value="{{ $quantity }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Payment</label>
                                                        <div class="col-sm-8">
                                                            <select name="status" class="form-control" required>
                                                                <option value="">...</option>
                                                                <option value="IMEUZWA">cash</option>
                                                                <option value="MKOPO">mkopo</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Customer Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="customer_name" class="form-control"
                                                                placeholder="Enter customer Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Phone Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="phonenumber"
                                                                placeholder="Enter Phone number">
                                                        </div>
                                                    </div>

                                                    @can('add-discount')
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Discount</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" min="0" value="0" name="discount"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    @endcan
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">VAT %</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" min="0" value="0" name="vat"
                                                                class="form-control">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="sell"
                                                        class="btn btn-primary">Submit</button>
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
                                                    <h4 class="modal-title">Add Order</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Total Amount</label>
                                                        <div class="col-sm-8">
                                                            @foreach(session('cart') as $id => $details )
                                                            <input type="hidden" name="product[]"
                                                                value="{{ $details['id'] }}">
                                                            <input type="hidden" name="quantity[]"
                                                                value="{{ $details['quantity'] }}">
                                                            <input type="hidden" name="pprofit[]"
                                                                value="{{ $details['pprofit'] }}">
                                                            <input type="hidden" name="amount[]"
                                                                value="{{ $details['net_amount'] }}">
                                                            @endforeach
                                                            <input type="number" class="form-control"
                                                                name="total_amount" value="{{ $total }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Quantity</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" class="form-control"
                                                                name="total_quantity" value="{{ $quantity }}" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group row" style="display:none;">
                                
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Customer Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="customer_name" class="form-control"
                                                                placeholder="Enter customer Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Phone Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="phonenumber"
                                                                placeholder="Enter Phone number">
                                                        </div>
                                                    </div>

                                                    @can('add-discount')
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Discount</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" min="0" value="0" name="discount"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    @endcan
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">VAT %</label>
                                                        <div class="col-sm-8">
                                                            <input type="number" min="0" value="0" name="vat"
                                                                class="form-control">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="sell"
                                                        class="btn btn-primary">Submit</button>
                                                </div>

                                            </div>
                                            <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                </form>
@endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total:</b></td>
                                    <td>{{ number_format($total) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>


        </div>


    </div>
</section>

@include('includes/footer')