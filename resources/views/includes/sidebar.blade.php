@include('includes/header')
@include('includes/nav')
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <!-- <div class="sidebar-brand">
            <a href="index.html">Kimaro Shappers Ltd</a>
        </div> -->
        <div class="sidebar-user">
            <?php $shop = App\Models\ShopInfo::all() ?>
            @foreach($shop as $shop)
            <div class="sidebar-user-picture">
                <img alt="image" src="../dist/img/logo.jpg">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name"><marquee behavior="" direction="">{{$shop->name}}</marquee> </div>
                <div class="user-role">
                    {{$shop->slogan}}
                </div>
            </div>
            @endforeach
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard')}}"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>
            @can('user-management')
            <li class="menu-header">Shop Management</li>
            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-home"></i><span>Shop
                        Management</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{ route('matawi') }}"><i class="ion ion-ios-circle-outline"></i> Branch</a></li>
                    <li><a href="{{ route('jukumu') }}"><i class="ion ion-ios-circle-outline"></i> Roles</a></li>
                    <li><a href="{{ route('wauzaji') }}"><i class="ion ion-ios-circle-outline"></i> Users</a></li>
                </ul>
            </li>
            @endcan
            @can('view-product')
            <li class="{{ Request::is('sajilbidhaa') || Request::is('bidhaa') ? 'active' : '' }}">
                <a href="#"
                    class="has-dropdown {{ Request::is('sajilbidhaa') || Request::is('bidhaa') ? 'active' : '' }}">
                    <i class="ion ion-social-pinterest"></i><span>Inventory</span>
                </a>
                <ul class="menu-dropdown">
                    <li class="{{ Request::is('sajilbidhaa') ? 'active' : '' }}">
                        <a href="{{ route('sajilbidhaa') }}"><i class="ion ion-ios-circle-outline"></i> Register</a>
                    </li>
                    <li class="{{ Request::is('bidhaa') ? 'active' : '' }}">
                        <a href="{{ route('bidhaa') }}"><i class="ion ion-ios-circle-outline"></i> Products</a>
                    </li>
                </ul>
            </li>

            @endcan
            @can('add-cart')
            <li class="{{Request::is('mauzo')?'active':''}}">
                <a href="{{ route('mauzo') }}"><i class="ion ion-clipboard"></i><span>Sales</span></a>
            </li>
            @endcan
            @can('view-sell')
            <li class="{{Request::is('mauzomuuzaji')?'active':''}}">
                <a href="{{ route('mauzomuuzaji') }}"><i class="ion ion-android-time"></i><span>Sales History</span></a>
            </li>
            @endcan

            @can('add-order')
            <li class="{{Request::is('order')?'active':''}}">
                <a href="{{ route('order') }}"><i class="ion ion-android-time"></i><span>Order history</span></a>
            </li>
            @endcan

            @can('view-debt')
            <li class="{{Request::is('madeni')?'active':''}}">
                <a href="{{ route('madeni') }}"><i class="ion ion-android-remove-circle"></i><span>Debts</span></a>
            </li>
            @endcan

            @can('view-expenses')
            <li class="{{Request::is('matumizi')?'active':''}}">
                <a href="{{ route('matumizi') }}"><i class="ion ion-ios-box"></i><span>Expenses</span></a>
            </li>
            @endcan

            @can('generate-report')
            <li class="menu-header">Report</li>
            <li class="{{Request::is('report')?'active':''}}">
                <a href="{{ route('report')}}"><i class="ion ion-ios-list"></i> Report</a>
            </li>
            @endcan

            @can('setting')
            <li class="menu-header">Setting</li>
            <li class="{{Request::is('punguzo')?'active':''}}">
                <a href="{{ route('punguzo') }}"><i class="ion ion-ios-gear"></i> Setting</a>
            </li>
            @endcan


        </ul>

    </aside>
</div>
<div class="main-content">