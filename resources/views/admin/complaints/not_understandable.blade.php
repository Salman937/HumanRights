@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    @include('include.error')
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Cnic</th>
                            <th>Complaint Description</th>
                            <th>Complaint Type</th>
                            <th>Complaint Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($not_understandable_complaints as $not_understandable_complaint)
                                <tr>
                                    <td>{{ $not_understandable_complaint->name }}</td>
                                    <td>{{ $not_understandable_complaint->mobile_no }}</td>
                                    <td>{{ $not_understandable_complaint->cnic }}</td>
                                    <td>{{ $not_understandable_complaint->details }}</td>
                                    <td>{{ $not_understandable_complaint->complaint_type }}</td>
                                    <td>
                                        @if($not_understandable_complaint->status_id == 5)
                                            <span class="label label-danger">Not Understandable</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection

@section('styles')
    <!-- data table  -->
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('scrpits')
    <!-- data table -->
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                "order": [],
                pageLength: 25,
                responsive: true,
            });
        });
    </script>
@endsection