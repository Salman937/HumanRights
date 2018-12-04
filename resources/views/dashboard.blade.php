@extends('layouts.template')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Complents</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $all_complants->all_complants }}</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Pending Complants</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $pending_complaints->pending_complaints }}</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>In-Progress Complaints</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $in_progress_complaints->in_progress_complaints }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Irrelevant Complaints</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $irrelevant_complaints->irrelevant_complaints }}</h1>
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
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Districts</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $all_districts->all_districts }}</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Announcements</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $announcements->announcements }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
