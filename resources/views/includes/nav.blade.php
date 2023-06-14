<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a>
            </li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="ion ion-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><i class="ion ion-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning badge-sm navbar-badge">{{ session('outOfStockCount') }}</span>
        </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">View All</a>
                    </div>
                </div>
                <div class="dropdown-list-content">
                    @if(Session::has('notification'))
                    @foreach(Session::get('notification') as $product)
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="alert alert-warning alert-sm">
                            <img alt="image" src="../dist/img/avatar/avatar-1.jpeg"
                                class="rounded-circle dropdown-item-img">
                            <div class="dropdown-item-desc">
                                <b> {{ $product->name }}</b> This product is out of stock<b>The remain in stock is
                                    {{ $product->quantity }}</b>
                                <div class="time">{{ $product->out_of_stock_at }}</div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                </div>


            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                <i class="ion ion-android-person d-lg-none"></i>
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->first_name }} </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item has-icon" data-toggle="modal" data-target="#modal-lg">
                    <i class="ion ion-android-person"></i> Profile
                </a>
                <a href="#" class="dropdown-item has-icon" data-toggle="modal" data-target="#modal-default">
                    <i class="ion ion-ios-locked"></i> change Password
                </a>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon">
                    <i class="ion ion-log-out"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="changepassword" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col col-md-12">
                            <label>Old Password</label>
                            <input type="text" name="old" class="form-control" placeholder="Old password">
                        </div>
                        <div class="col col-md-12">
                            <label>
                                <p>New Password</p>
                            </label>
                            <input type="text" name="new" class="form-control" placeholder="New passsword">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form action="changeinfo" method="POST">
    @csrf
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Profile Details</h4>
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
                                value="{{ Auth::user()->first_name }}" required>
                        </div>
                        <div class="col col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ Auth::user()->last_name }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}"
                                required>
                        </div>
                        <div class="col col-md-6">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                required>
                        </div>
                        <div class="col col-md-6">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option>--</option>
                                @if(Auth::user()->gender == "MME")
                                <option value="MME" selected>MALE</option>
                                <option value="MKE">FEMALE</option>
                                @else
                                <option value="MME">MALE</option>
                                <option value="MKE" selected>FEMALE</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>