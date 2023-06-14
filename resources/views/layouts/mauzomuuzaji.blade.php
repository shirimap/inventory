@include('includes/sidebar')
@include('sweetalert::alert')
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
                        <h3 class="card-title"><span class="fa fa-th"></span> Sales List</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Profit</th>
                                    <th>Small Price</th>
                                    <th>Total</th>
                                    <th>Disc</th>
                                    <th>Total Price</th>
                                    <th>VAT % </th>
                                    <th>Net Price</th>
                                    <th>Invoice</th>
                                    <th>Seller</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($group as $sel=> $sell)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    @foreach ($sell as $p)

                                    <td>
                                        @foreach ($p as $q)
                                        {{--  <?php $quantity += $q['quantity'] ?>  --}}
                                        <b>{{ $q['product']['sbidhaa']['name']}}</b> <br><br>

                                        @endforeach

                                    </td>
                                    {{--  <td> {{ $p->sum('quantity') }}</td> --}}
                                    <td>
                                        @foreach ($p as $q)
                                        {{ $q['quantity'] }}<br><br>
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach ($p as $q)
                                        {{ $q['total_amount'] }} <br><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($p as $q)
                                        {{ $q['profit'] }} <br><br>
                                        @endforeach
                                    </td>


                                    <td>
                                        @foreach ($p as $q)
                                        <b> {{ $q['total_amount'] * $q['quantity'] }}</b> <br><br>
                                        @endforeach
                                    </td>

                                    {{--  <?php $total += $q['order']['total_amount'] ?>  --}}
                                    <td>{{ $q['order']['org_amount']+$q['order']['discount']}}</td>
                                    <td>{{ $q['order']['discount'] }}</td>
                                    <td><b>{{ $q['order']['org_amount']}}</td>
                                    <td>{{ $q['order']['vat'] }}</td>
                                    <td><b>{{ $q['order']['total_amount'] }}</b></td>
                                    <td>INV-{{ str_pad( $q['order']['id'],5,'0',STR_PAD_LEFT )}}</td>
                                    {{--<td>{{ $q['order']['customer_name']}}</td>--}}
                                    <td>{{ $q['order']['user']['first_name']}}</td>
                                    <td>{{ $q['order']['created_at']->format('d/m/Y') }}<br>{{ $q['order']['created_at']->format('h:m a') }}
                                    </td>


                                    @endforeach


                                    <td>
                                        @can('generate-invoive')
                                        <a href="{{ route('viewPDF',$sel) }}" target="" class="btn btn-sm btn-warning"><i
                                                class="fas fa-print"></i></a>
                                        @endcan
                                        @can('delete-sell')
                                        {{--  <a href="{{ route('risiti',$sel) }}" target="" class="btn btn-sm btn-warning"><i
                                            class="fas fa-print"></i></a> --}}
                                        <a href="delete/{{$sel}}"
                                            onclick="return confirm('Are you sure to want to delete it?')"><button
                                                type="button" class="btn btn-sm btn-danger"><span class="fa fa-trash"
                                                    aria-hidden="true"
                                                    style="color: black;font-size:16px;"></span></button></a>
                                        @endcan
                                    </td>


                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
</section>

@include('includes/footer')