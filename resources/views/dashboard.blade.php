@extends('layouts.template')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-success pull-right">Monthly</span> --}}
                        <h5>All Complents</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $all_complants->all_complants }}</h1>
                        {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-info pull-right">Annual</span> --}}
                        <h5>Pending Complants</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $pending_complaints->pending_complaints }}</h1>
                        {{-- <div class="stat-percent font-bold text-info">&nbsp; <i class="fa fa-level-up"></i></div> --}}
                        {{-- <small>New orders</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-primary pull-right">Today</span> --}}
                        <h5>In-Progress Complaints</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $in_progress_complaints->in_progress_complaints }}</h1>
                        {{-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> --}}
                        {{-- <small>New visits</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-danger pull-right">Low value</span> --}}
                        <h5>Irrelevant Complaints</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $irrelevant_complaints->irrelevant_complaints }}</h1>
                        {{-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> --}}
                        {{-- <small>In first month</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-danger pull-right">Low value</span> --}}
                        <h5>Completed Complaints</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $completed_complaints->completed_complaints }}</h1>
                        {{-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> --}}
                        {{-- <small>In first month</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-danger pull-right">Low value</span> --}}
                        <h5>All Districts</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $all_districts->all_districts }}</h1>
                        {{-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> --}}
                        {{-- <small>In first month</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{-- <span class="label label-danger pull-right">Low value</span> --}}
                        <h5>Announcements</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $announcements->announcements }}</h1>
                        {{-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> --}}
                        {{-- <small>In first month</small> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
