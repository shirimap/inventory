@include('includes/sidebar')
<section class="section">
    <h1 class="section-header">
        <div>Register Product
        </div>
    </h1>
</section>

<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fa fa-th"></i> Registered Products
                            @can('add-product')
                            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                data-target="#modal-lg1">
                                <span class="fa fa-plus"></span> Register Product</button>
                            @endcan
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Threshold</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $p)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><b>{{$p->name}}</b></td>
                                    <td>{{$p->type}}</td>
                                    <td>{{$p->threshold}}</td>
                                    <td>{{$p->created_at}}</td>
                                    <td>
                                        <form action="sajilbidhaa/delete/{{ $p->id }}" method="POST"
                                            class="delete-form">
                                            {{ csrf_field() }}
                                            @can('edit-product')
                                            <a type="button" class="btn btn-sm btn-primary"
                                                style="color:white;" data-toggle="modal"
                                                data-target="#modal-secondaryy{{ $p->id }}"><i
                                                    class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('delete-product')
                                            <button type="submit" class="btn btn-sm btn-danger delete-button"><i
                                                    class="fas fa-trash"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                    <div class="modal fade" id="modal-secondaryy{{ $p->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><span class="fa fa-edit"></span>Edit
                                                        Registered
                                                        Product</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="sajilbidhaa/edit/{{ $p->id }}">
                                                        {{ csrf_field() }}

                                                        <input type="hidden" name="proid" value="{{ $p->id }}">

                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>Product Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $p->name }}" required>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Type</label>
                                                                <input type="text" name="type" class="form-control"
                                                                    value="{{ $p->type }}" required>
                                                            </div>
                                                            <div class="col col-md-12">
                                                                <label>Stock Level</label>
                                                                <input type="number" name="threshold"
                                                                    class="form-control" value="{{ $p->threshold }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="remove"
                                                        class="btn btn-primary">Update</button>

                                                </div>
                                                </form>


                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.content -->
                <form method="post" action="sajilbidhaa/add">
                    @csrf
                    <div class="modal fade" id="modal-lg1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><span class="fa fa-plus"></span> Register New Product</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="enter product name">
                                        </div>
                                        <div class="col col-md-6">
                                            <label>Type</label>
                                            <input type="text" name="type" class="form-control"
                                                placeholder="enter product type">
                                        </div>
                                        <div class="col col-md-12">
                                            <label>Stock Level</label>
                                            <input type="number" name="threshold" class="form-control"
                                                placeholder="enter the threshold for product" required>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button name="addproduct" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </form>
            </div>
        </div>
    </div>
</section>




@include('includes/footer')
