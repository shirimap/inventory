@include('includes/sidebar')
@include('sweetalert::alert')

<section class="section">
    <h1 class="section-header">
        <div>Users
        </div>
    </h1>
</section>

<section>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    @can('add-user')
                    <div class="card-header">
                        <h3 class="card-title"><span class="fa fa-th"></span> Users</h3>
                        <button type="button" class="btn btn-success float-right" data-toggle="modal"
                            data-target="#modal-lgg"> <span class="fa fa-plus"></span> Add user</button>
                    </div>
                    @endcan
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Nmae Kamili</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Branch</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $user)
                                @if (!empty($user->branch->name))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender}}</td>
                                    <td>{{ $user->branch->name }}</td>
                                    @foreach($user->getRoleNames() as $v)
                                    <td>{{ $v }}</td>
                                    @endforeach
                                    <td>
                                        @can('edit-user')
                                        <a type="button" class="btn btn-sm btn-primary" style="color:white"
                                            data-toggle="modal" data-target="#modal-secondary{{ $user->id }}"><span
                                                class="fa fa-edit"></span></a>
                                        @endcan
                                        @can('delete-user')
                                        <a type="button" class="btn btn-sm btn-danger" style="color:white"
                                            data-toggle="modal" data-target="#modal-danger{{ $user->id }}"><span
                                                class="fa fa-trash"></span></a>
                                        @endcan
                                    </td>
                                    <div class="modal fade" id="modal-danger{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete User</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="wauzaji/delete/{{ $user->id }}">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <input type="hidden" name="proid" value="{{ $user->id }}">
                                                        <p>Mfanyakazi Huyu atafutwa <b>{{ $user->first_name }}
                                                                {{ $user->last_name }} </b></p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="remove"
                                                        class="btn btn-outline-light">Delete</button>
                                                </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal fade" id="modal-secondary{{ $user->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><span class="fa fa-edit"></span>Edit User
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="wauzaji/edit/{{ $user->id }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="proid" value="{{ $user->id }}">

                                                        <p>
                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>First Name</label>
                                                                <input type="text" name="first_name"
                                                                    class="form-control" value="{{ $user->first_name }}"
                                                                    required>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Second Name</label>
                                                                <input type="text" name="last_name" class="form-control"
                                                                    value="{{ $user->last_name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>Address</label>
                                                                <input type="text" name="address" class="form-control"
                                                                    value="{{ $user->address }}" required>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Phone Number</label>
                                                                <input type="text" name="phone" class="form-control"
                                                                    value="{{ $user->phone }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>Email</label>
                                                                <input type="email" name="email" class="form-control"
                                                                    value="{{ $user->email }}" required>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Gender</label>
                                                                <select class="form-control" name="gender">
                                                                    @if ( $user->gender == 'MME')
                                                                    <option disabled selected>--</option>

                                                                    <option value="MME" selected>{{ $user->gender}}
                                                                    </option>
                                                                    <option value="MKE">MKE</option>
                                                                    @else
                                                                    {{-- <option disabled selected>--</option> --}}

                                                                    <option value="MME">MME</option>
                                                                    <option value="MKE" selected>{{ $user->gender}}
                                                                    </option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col col-md-6">
                                                                <label>Role</label>
                                                                <select class="form-control" name="roles">
                                                                    <option disabled selected value>--</option>
                                                                    @foreach ($roles as $role)
                                                                    @if (!empty($user->roles->first()->name) &&
                                                                    ($role->name
                                                                    == $user->roles->first()->name))
                                                                    <option value="{{ $user->roles->first()->name }}"
                                                                        selected>{{ $user->roles->first()->name }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $role->id }}">{{ $role->name }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col col-md-6">
                                                                <label>Bramch</label>
                                                                <select class="form-control" name="branch">
                                                                    <option disabled selected value>--</option>
                                                                    @foreach ($branch as $role)
                                                                    @if ($role->name == $user->branch->name)
                                                                    <option value="{{ $user->branch->id }}" selected>
                                                                        {{ $user->branch->name }}</option>
                                                                    @else
                                                                    <option value="{{ $role->id }}">{{ $role->name }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="remove"
                                                        class="btn btn-primary">Save</button>

                                                </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <form method="post" action="{{ route('wauzaji.create') }}">
                    @csrf
                    <div class="modal fade" id="modal-lgg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="fas fa-plus"></i> Add User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control"
                                                placeholder="enter first name" required>
                                        </div>
                                        <div class="col col-md-6">
                                            <label>Second Name</label>
                                            <input type="text" name="last_name" class="form-control"
                                                placeholder="enter second name" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="enter address" required>
                                        </div>
                                        <div class="col col-md-6">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="enter phone numer" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Eenter email" required>
                                        </div>
                                        <div class="col col-md-6">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">                                                
                                                <option selected>select gender</option>
                                                <option value="MALE" selected>MALE
                                                </option>
                                                <option value="FEMALE">FEMALE</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label>Role</label>
                                            <select class="form-control" name="roles">
                                                <option disabled selected value>--</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col col-md-6">
                                            <label>Branch</label>
                                            <select class="form-control" name="branch">
                                                <option disabled selected value>--</option>
                                                @foreach ($branch as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button name="add" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('includes/footer')