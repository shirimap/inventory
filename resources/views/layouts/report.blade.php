@include('includes/sidebar')
@include('sweetalert::alert')
<section class="section">
    <h1 class="section-header">
        <div>Debts
        </div>
    </h1>
</section>



<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- /.form group -->
                            <div class="col-3">
                                <!-- Date and time range -->
                                <div class="form-group">
                                    <label>Total Sales:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                        </div>
                                        <h1><b>{{number_format($pius)}}/=</b></h1>
                                    </div>

                                </div>
                            </div>
                            <!-- /.form group -->
                            <div class="col-3">
                                <!-- Date and time range -->
                                <div class="form-group">
                                    <label>Total Profit:</label>

                                    <div class="input-group">
                                        <h1><b>{{number_format($sikup,2)}}/=</b></h1>
                                    </div>

                                </div>
                            </div>


                            <div class="col-6">
                                <label for=""><br></label>
                                <button type="button" class="btn btn-danger float-right" data-toggle="modal"
                                    data-target="#modal-lg1"><span class="fa fa-download"></span>Download</button>
                                <label for=""><br></label>
                                <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                    data-target="#modal-lg2"><span class="fa fa-search"></span>Search</button>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
        </div>
    </div>
</section>
<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><span class="fa fa-file-text-o"></span> Report</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <!-- <th>Price</th> -->
                                    <th>Total Amount</th>
                                    <th>Profit</th>
                                    <th>Branch</th>
                                    <th>Category</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $q)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><b>{{ $q->product->sbidhaa->name }}</b></td>
                                    <td>{{ $q->product->sbidhaa->type}}</td>
                                    <td> {{ $q->quantity }} </td>
                                    <!-- <td>{{ $q->total_amount }}</td> -->
                                    <td><b>{{number_format($q->amount,2)}}</b></td>
                                    <td><b>{{number_format($q->profit,2)}}</b></td>
                                    <td> {{ $q->product->branch->name }}</td>
                                    <td>{{ $q->product->category->name }}</td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        <!-- /.card-body -->
                    </div><!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
        </div>
    </div>
</section>



<form method="GET" action="generatePDF">
    @csrf
    <div class="modal fade" id="modal-lg1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fa fa-download"></span> Generate Report PDF</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="row">
                        <!-- /.form group -->
                        <div class="col-4">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Date From:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="date" class="form-control float-right" name="fromDate" />
                                </div>

                            </div>
                        </div>
                        <!-- /.form group -->
                        <div class="col-4">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Date To:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="date" class="form-control float-right" id="toDate" name="toDate" />
                                </div>

                            </div>
                        </div>
                        <div class="col-4">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter valid email">
                                </div>

                            </div>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button name="addproduct" class="btn btn-primary"><span
                            class="fa fa-download"></span>Download</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>


<form method="GET" action="report">
    @csrf
    <div class="modal fade" id="modal-lg2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="fa fa-search"></span> Search Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="row">
                        <!-- /.form group -->
                        <div class="col-4">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Date From:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="date" class="form-control float-right" name="fromDate" />
                                </div>

                            </div>
                        </div>
                        <!-- /.form group -->
                        <div class="col-4">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Date To:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="date" class="form-control float-right" id="toDate" name="toDate" />
                                </div>

                            </div>
                        </div>
                        <!-- /.form group -->
                        <div class="col-4">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Select Product:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <select name="product_id" id="" class="form-control">
                                        <option value="">All</option>
                                        @foreach($pd as $p)
                                        <option value="{{$p->id}}">{{$p->sbidhaa->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                        </div>

                    </div>
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button name="addproduct" class="btn btn-primary"><span class="fa fa-search"></span>Search</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>

@include('includes/footer')