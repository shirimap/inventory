@include('includes/sidebar')
<section class="section">
    <h1 class="section-header">
        <div>Sales
        </div>
    </h1>
</section>

<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order List</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Number</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Customer</th>
                                    <th>Seller</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($o as $o)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b> PINV-{{ str_pad( $o->id,5,'0',STR_PAD_LEFT )}}</b></td>
                                    <td>{{ $o->total_quantity}}</td>
                                    <td><b>{{ number_format($o->total_amount)}}</b></td>
                                    <td>{{ ucwords($o->customer_name)}}</td>
                                    <td>{{ ucwords(Auth::user()->first_name)}}</td>

                                    <td>{{ $o['created_at']->format('d/m/Y') }}<br>{{ $o['created_at']->format('h:m a') }}
                                    </td>
                                    <td>
                                        <form action="delete/{{$o->id}}" method="POST" class="delete-form">
                                            {{ csrf_field() }}
                                            @can('generate-preInvoice')
                                            <a href="{{ route('previewPDF',$o->id) }}" target=""
                                                class="btn btn-sm btn-warning"><i class="fas fa-download"></i></a>
                                            @endcan
                                            @can('delete-order')
                                            <button type="submit" class="btn btn-sm btn-danger delete-button"><i
                                                    class="fas fa-trash"></i> </button>
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
        </div>
    </div>
</section>

@include('includes/footer')