<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('user-profile.png') }} " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name  }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <hr/>

        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ Request::routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-list"></i> <span>Category</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.buyers.*') ? 'active' : '' }}">
                <a href="{{ route('admin.buyers.index') }}">
                    <i class="fa fa-map"></i> <span>Buyers</span>
                </a>
            </li>
            <li class="{{ Request::routeIs('admin.samples.*') ? 'active' : '' }}">
                <a href="{{ route('admin.samples.index') }}">
                    <i class="fa fa-file"></i> <span>Samples</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('admin.sample-types.*') ? 'active' : '' }}">
                <a href="{{ route('admin.sample-types.index') }}">
                    <i class="fa fa-cubes"></i> <span>Sample Types</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('admin.item-types.*') ? 'active' : '' }}">
                <a href="{{ route('admin.item-types.index') }}">
                    <i class="fa fa-cubes"></i> <span>Item Types</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('admin.inquiries.*') ? 'active' : '' }}">
                <a href="{{ route('admin.inquiries.index') }}">
                    <i class="fa fa-cubes"></i> <span>Inquiries</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
