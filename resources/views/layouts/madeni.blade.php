@include('includes/sidebar')
<!-- @include('sweetalert::alert') -->

<section class="section">
    <h1 class="section-header">
        <div>Debts
        </div>
    </h1>
</section>
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
<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><span class="fa fa-th"></span> Debits Available</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment No</th>
                                    <th>Customer</th>
                                    <th>Phone number</th>
                                    <th>Quantity</th>
                                    <th>Debt Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($loan as $q)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$q->order_id}}</td>
                                    <td>{{ $q->order->customer_name }}</td>
                                    <td>{{ $q->order->phonenumber }}</td>
                                    <td><b>{{ $q->order->total_quantity }}</b></td>
                                    <td>{{ $q->amount }}</td>
                                    <td>{{$q->created_at}}</td>

                                    @can('edit-debt')
                                    <td>
                                        <button class="btn btn-sm btn-success toastrDefaultSuccess" >History</button>
                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#modal-md{{$q->order_id}}">Payment</button>
                                    </td>
                                    @endcan
                                    <!-- /.content -->
                                    <!-- /.content-wrapper -->

                                    <div class="modal fade" id="modal-md{{$q->order_id}}">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Debits for
                                                        {{ $q['order']['customer_name'] }}
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="payment" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{$q->order_id}}">
                                                        <div class="row">
                                                            <div class="col col-md-4">
                                                                <label>Total Price</label>
                                                            </div>
                                                            <div class="col col-md-8">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $q['order']['total_amount'] }}" readonly>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col col-md-4">
                                                                <label>Quantity</label>
                                                            </div>
                                                            <div class="col col-md-8">
                                                                <input type="text" min="0" class="form-control"
                                                                    value="{{ $q['order']['total_quantity'] }}"
                                                                    readonly>
                                                            </div>
                                                        </div><br>

                                                        <div class="row">
                                                            <div class="col col-md-4">
                                                                <label>Amount</label>
                                                            </div>
                                                            <div class="col col-md-8">
                                                                <input type="number" min="0" class="form-control"
                                                                    name="paid_amount" placeholder="enter amount paid"
                                                                    required>
                                                            </div>
                                                        </div><br>

                                                        </p>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
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
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>



</section>

@include('includes/footer')