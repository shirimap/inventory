@include('includes/sidebar')
@include('sweetalert::alert')

<section class="section">
    <h1 class="section-header">
        <div>Shop
        </div>
    </h1>
</section>

<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                <div class="card-header">
                        <h3 class="card-title"><span class="fa fa-th"></span>Shop Information</h3>                                  
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Jina</th>
                                <th>KAULI MBIU</th>
                                <th>ANUANI</th>
                                <th>ENEO</th>
                                <th>EMAIL</th>
                                <th>NAMBA YA SIMU</th>
                                <th>ACCOUNT NAMBA </th>
                                <th>TIN</th>
                                <th>WEBSITE</th>
                                <th>KITENDO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shop as $shop)
                            <tr>
                                <td>{{ $shop->name }}</td>
                                <td> {{ $shop->slogan }}</td>
                                <td> {{ $shop->address }}</td>
                                <td> {{ $shop->location }}</td>
                                <td> {{ $shop->email }}</td>
                                <td> {{ $shop->phoneNumber }}<br>
                                    {{ $shop->mobile1 }}<br>
                                    {{ $shop->mobile2 }}<br>
                                    {{ $shop->mobile3 }}
                                </td>
                                <td> {{ $shop->AccountNumber1 }}<br>
                                    {{ $shop->AccountNumber2 }}<br>
                                    {{ $shop->AccountNumber3 }}
                                </td>
                                <td> {{ $shop->TIN }}</td>
                                <td> {{ $shop->website }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                                        data-target="#modal-secondary{{ $shop->id }}"><span
                                            class="fa fa-edit"></span></button>
                                    <!-- <button class="btn btn-small btn-danger" data-toggle="modal"
                                        data-target="#modal-danger"><span
                                            class="fa fa-trash"></span></button>  -->
                                </td>
                                <div class="modal fade" id="modal-secondary{{ $shop->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Shop</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('updateShop',$shop->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="proid" value="">
                                                    <p>Duka </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Jina</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $shop->name }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Kauli Mbiu</label>
                                                            <input type="text" name="slogan" class="form-control"
                                                                value="{{ $shop->slogan }}">
                                                        </div>
                                                    </div>
                                                    </p>

                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Anuani</label>
                                                            <input type="text" name="address" class="form-control"
                                                                value="{{ $shop->address }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Eneo</label>
                                                            <input type="text" name="location" class="form-control"
                                                                value="{{ $shop->location }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Barua Pepe</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $shop->email }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-6">
                                                            <label>TIN</label>
                                                            <input type="text" name="TIN" class="form-control"
                                                                value="{{ $shop->TIN }}">
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <label>Tawi Kuu</label>
                                                            <input type="text" name="MainBranch" class="form-control"
                                                                value="{{ $shop->MainBranch }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-12">
                                                            <label>Website</label>
                                                            <input type="text" name="website" class="form-control"
                                                                value="{{ $shop->website }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-3">
                                                            <label>Namba ya simu</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value="{{ $shop->phoneNumber }}">
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <label>Namba ya simu</label>
                                                            <input type="text" name="mobile1" class="form-control"
                                                                value="{{ $shop->mobile1 }}">
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <label>Namba ya simu</label>
                                                            <input type="text" name="mobile2" class="form-control"
                                                                value="{{ $shop->mobile2 }}">
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <label>Namba ya simu</label>
                                                            <input type="text" name="mobile2" class="form-control"
                                                                value="{{ $shop->mobile3 }}">
                                                        </div>
                                                    </div>
                                                    </p>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col col-md-4">
                                                            <label>Account Number</label>
                                                            <input type="text" name="AccountNumber1"
                                                                class="form-control"
                                                                value="{{ $shop->AccountNumber1 }}">
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <label>Account Number</label>
                                                            <input type="text" name="AccountNumber2"
                                                                class="form-control"
                                                                value="{{ $shop->AccountNumber2 }}">
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <label>Account Number</label>
                                                            <input type="text" name="AccountNumber3"
                                                                class="form-control"
                                                                value="{{ $shop->AccountNumber3 }}">
                                                        </div>
                                                    </div>
                                                    </p>

                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Funga</button>
                                                        <button type="submit" name="remove"
                                                            class="btn btn-outline-light">Hariri</button>

                                                    </div>
                                                </form>


                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </section>
    <!-- /.content -->
    <form method="POST" action="#">
        <div class="modal fade" id="modal-md">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ongeza Punguzo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Idadi ya bidhaa</label>
                                <input type="text" name="branchname" class="form-control"
                                    placeholder="Weka jina la tawi...">
                            </div>
                        </div>
                        </p>
                        <p>
                        <div class="row">
                            <div class="col col-md-12">
                                <label>Punguzo (%)</label>
                                <input type="text" name="location" class="form-control"
                                    placeholder="Weka jina la tawi...">
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-default" value="Funga" data-dismiss="modal">
                        <input type="submit" class="btn btn-primary" value="Ongeza">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>



@include('includes/footer')
