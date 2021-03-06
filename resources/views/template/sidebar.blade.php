<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center"> <span>
                        <img alt="image" class="img-circle" src="{{ asset('images/user-default.png') }}" height="100"/>
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                            {{Auth::user()->name}}
                        </strong> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="<?= Request::segment(1)== "home"?"active":"";?>">
                <a href="{{route('home')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?= Request::segment(1)== "complaint" || Request::segment(1)== "comp" ?"active":"";?>">
                <a href="#">
                    <i class="fa fa-list-alt"></i> 
                    <span class="nav-label">All Complaints</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="<?= Request::segment(1)== "complaint"?"active":"";?>">
                        <a href="{{ route('complaint.index') }}">Complaints</a>
                    </li>
                    <li class="<?= Request::segment(2)== "pending"?"active":"";?>">
                        <a href="{{ route('pending') }}">Pending</a>
                    </li>
                    <li class="<?= Request::segment(2)== "inprogress"?"active":"";?>">
                        <a href="{{ route('inprogress') }}">In Progress</a>
                    </li>
                    <li class="<?= Request::segment(2)== "irrelevant"?"active":"";?>">
                        <a href="{{ route('irrelevant') }}">Irrelevant</a>
                    </li>
                    <li class="<?= Request::segment(2)== "not_understandable"?"active":"";?>">
                        <a href="{{ route('not_understandable') }}">Not Understandable</a>
                    </li>
                    <li class="<?= Request::segment(2)== "completed"?"active":"";?>">
                        <a href="{{ route('completed') }}">Completed</a>
                    </li>
                </ul>
            </li>
            <li class="<?= Request::segment(1)== "awareness"?"active":"";?>">
                <a href="{{ route('awareness.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Awareness</span></a>
            </li>
            <li class="<?= Request::segment(1)== "announcement"?"active":"";?>">
                <a href="{{ route('announcement.index') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span class="nav-label">Announcements</span></a>
            </li>
            <li class="<?= Request::segment(1)== "district"?"active":"";?>">
                <a href="{{ route('district.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Districts</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Categories</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('category.index') }}">First Cateory</a></li>
                    <li><a href="{{ route('subcategory.index') }}">Secound Cateory</a></li>
                    <li><a href="{{ route('third.category') }}">Third Cateory</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('phone.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Phone Directory</span></a>
            </li>
        </ul>

    </div>
</nav>