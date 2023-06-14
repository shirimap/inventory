@include('includes/sidebar')
@section('bidhaa', 'active')
@include('sweetalert::alert')

<section class="section">
    <h1 class="section-header">
        <div>Products
        </div>
    </h1>
</section>

<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="nav-icon fa fa-th"></i> Products Available 
                    
                        @can('add-product')
                        <button type="button" class="btn btn-secondary float-right" data-toggle="modal"
                            data-target="#modal-lg-file">
                            <span class="fa fa-file"></span> Upload File</button>
                        <button type="button" class="btn btn-success float-right" data-toggle="modal"
                            data-target="#modal-lg1">
                            <span class="fa fa-plus"></span> Add Product</button>
                        @endcan
                    </h3>                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-sm  table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Buy Price</th>
                                    <th>Sell Price</th>
                                    <th>Quantity</th>
                                    <th>Profit</th>
                                    <!-- <th>Discount %</th> -->
                                    <th>Total Amount</th>
                                    <!-- <th>Branch</th> -->
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $p)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td><b>{{ $p->sbidhaa->name }}</b></td>
                                    <td>{{$p->sbidhaa->type}}</td>
                                    <td>{{number_format($p->bprice)}}</td>
                                    @if ($p->discount > 0 )
                                    <td><strike
                                            style="text-decoration-thickness: 2px; text-decoration-color: red; ">{{ number_format($p->amount) }}</span></strike>
                                        <br>
                                        {{ number_format($p->net_amount) }}
                                    </td>

                                    @else
                                    <td>
                                        @if($p->category_id == 1) <b>{{number_format($p->net_amount)}}</b>
                                        @else
                                        <b>{{number_format($p->net_amount)}}</b>
                                        @endif
                                    </td>

                                    @endif
                                    <td>
                                        @if($p->category_id == 1)
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
                                    <td>
                                        @if($p->pprofit <= 0) <b style="color:red;">{{number_format($p->pprofit) }}</b>
                                            @else
                                            {{ number_format($p->pprofit) }}
                                            @endif

                                    </td>
                                    {{--<td>{{ $p->discount }}%</td>--}}
                                    <td><b>{{number_format($p->capital) }}</b></td>
                                    {{--<td>{{ $p->branch->name }}</td>--}}

                                    <td>{{$p->created_at->format('d-m-Y h:i A') }}</td>
                                    <td>{{$p->updated_at->format('d-m-Y h:i A') }}</td>
                                    <td>
                                        @can('edit-product')
                                        <a type="button" class="btn btn-sm btn-primary" style="color:white;"
                                            data-toggle="modal" data-target="#modal-secondaryy{{ $p->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('delete-product')
                                        <a type="button" class="btn btn-sm btn-danger" style="color:white;"
                                            data-toggle="modal" data-target="#modal-danger{{ $p->id }}"><i
                                                class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                    <div class="modal fade" id="modal-danger{{ $p->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete product</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="bidhaa/delete/{{ $p->id }}">
                                                        {{ csrf_field() }}

                                                        <input type="hidden" name="proid" value="{{ $p->id }}">
                                                        <p>Bidhaa Hii itafutwa <b>{{ $p->name }} yenye aina hii
                                                                {{ $p->type }}
                                                            </b></p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="remove"
                                                        class="btn btn-outline-light">Save</button>

                                                </div>
                                                </form>


                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal fade" id="modal-secondaryy{{ $p->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><span class="fa fa-edit"></span>Edit Product
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="bidhaa/edit/{{ $p->id }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="proid" value="{{ $p->id }}">
                                                        <div class="row">
                                                            <div class="col col-md-12">
                                                                <label>Select Product</label>
                                                                <select name="sbidhaa" class="form-control">

                                                                    @foreach ($data as $role)
                                                                    @if ($role->id == $p->sbidhaa->id)
                                                                    <option value="{{ $p->sbidhaa->id }}" selected>
                                                                        {{ $p->sbidhaa->name }}-{{ $p->sbidhaa->type }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $role->id }}">
                                                                        {{ $role->name }}-{{ $role->type }}</option>
                                                                    @endif
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>Buying Price</label>
                                                                <input type="number" name="bprice" class="form-control"
                                                                    value="{{ $p->bprice }}" required>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Selling Price</label>
                                                                <input type="number" name="amount" class="form-control"
                                                                    value="{{ $p->amount }}" required>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Quantity</label>
                                                                <input type="number" name="quantity"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Tawi</label>
                                                                <select class="form-control" name="branch">
                                                                    <option>{{ $p->branch->name }}</option>
                                                                    @foreach ($branch as $role)
                                                                    @if ($role->id == $p->branch->id)
                                                                    <option value="{{ $p->branch->id }}" selected>
                                                                        {{ $p->branch->name }}-{{ $p->branch->location }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $role->id }}">
                                                                        {{ $role->name }}-{{ $role->location }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>Category</label>
                                                                <select class="form-control" name="category"
                                                                    onchange="enanbleCategory(this)">
                                                                    <option disabled selected value>
                                                                        {{ $p->category->name }}
                                                                    </option>
                                                                    @foreach ($categories as $t)
                                                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            @if($p->category_id==2)
                                                            <div class="col col-md-6">
                                                                <label>Quantity(Per each)</label>
                                                                <input type="number" name="sub_quantity" min="0"
                                                                    step="0.25" value="{{ $p->sub_quantity }}"
                                                                    class="form-control"
                                                                    required>
                                                            </div>

                                                            @can('add-discount')
                                                            <div class="col col-md-6">
                                                                <label>Discount</label>
                                                                <input type="number" name="discount"
                                                                    class="form-control" value="{{ $p->discount }}"
                                                                    required>
                                                            </div>
                                                            @else
                                                            <div class="col col-md-6">
                                                                <label>Discount</label>
                                                                <input type="number" name="discount"
                                                                    class="form-control" value="{{ $p->discount }}"
                                                                    required>
                                                            </div>
                                                            @endcan
                                                            
                                                        </div>
                                                        @endif
                                                        <div class="col col-md-6">
                                                                <label>Discount</label>
                                                                <input type="number" name="discount"
                                                                    class="form-control" value="{{ $p->discount }}"
                                                                    required>
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

            </div>
        </div>
        <!-- /.content -->
        <form method="post" action="bidhaa/create">
            @csrf
            <div class="modal fade" id="modal-lg1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="fa fa-plus"></span> Add Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label>Select Product</label>
                                    <select name="sbidhaa" class="form-control">
                                        <option>---</option>
                                        @foreach($data as $p)
                                        <option value="{{$p->id}}"> {{$p->name}} --- {{$p->type}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label>Buy Price</label>
                                    <input type="number" name="bprice" class="form-control"
                                        placeholder="Weka Bei ya Kununua...">
                                </div>

                                <div class="col col-md-6">
                                    <label>Sell Price</label>
                                    <input type="number" name="amount" class="form-control"
                                        placeholder="Weka Bei ya Kuuza...">
                                </div>

                                <div class="col col-md-6">
                                    <label>Quantity</label>
                                    <input type="number" min="0" name="quantity" class="form-control"
                                        placeholder="Weka idadi ya bidhaa...">
                                </div>
                                <div class="col col-md-6">
                                    <label>Branch</label>
                                    <select class="form-control" name="branch">
                                        <option disabled selected value>---</option>
                                        @foreach ($branch as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}-{{ $role->location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-6">
                                    <label>Category</label>
                                    <select class="form-control" name="category" id="mySelect"
                                                        onchange="showInput()">
                                        <option disabled selected value>---</option>
                                        @foreach ($categories as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-6 d-nones" id="otherInputContainer" style="display:none;">
                                    <label>Quantity(Per each)</label>
                                    <input type="number" name="sub_quantity" min="0" step="0.25" value="0"
                                        class="form-control" placeholder="weka punguzo la bidhaa..." required>

                                </div>


                                @can('add-discount')
                                <div class="col col-md-6">
                                    <label>Discount</label>
                                    <input type="number" name="discount" min="0" max="100" value="0"
                                        class="form-control" placeholder="weka punguzo la bidhaa..." required>
                                </div>
                                @endcan

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

        <form method="POST" action="/upload" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="modal-lg-file">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label>Choose File (*SCV)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file" id="exampleInputFile">
                                            {{-- <label class="custom-file-label" for="exampleInputFile">Chagua
                                        file</label> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="fileadd"
                                class="btn btn-primary toastrDefaultSuccess">Upload</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </form>

    </div>
</section>
<script>
function showInput() {
    var selectElement = document.getElementById("mySelect");
    var otherInputContainer = document.getElementById("otherInputContainer");
 
  
    if (selectElement.value === "2") {
        otherInputContainer.style.display = "block";
  
    }
    else {
    otherInputContainer.style.display = "none"; 

    }

}
</script>

@include('includes/footer')