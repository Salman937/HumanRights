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
                            @foreach($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->name }}</td>
                                    <td>{{ $complaint->mobile_no }}</td>
                                    <td>{{ $complaint->cnic }}</td>
                                    <td>{{ $complaint->details }}</td>
                                    <td>{{ $complaint->complaint_type }}</td>
                                    <td>
                                        @if($complaint->complaint_status == 'Pending')
                                            <span class="label label-default">Pending</span>
                                        @elseif($complaint->complaint_status == 'Completed')
                                            <span class="label label-primary">Completed</span>
                                        @elseif($complaint->complaint_status == 'In Progress')
                                            <span class="label label-success">In Progress</span>
                                        @elseif($complaint->complaint_status == 'Irrelevant')
                                            <span class="label label-info">Irrelevant</span>
                                        @else
                                            <span class="label label-danger">Not Understandable</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('complaint.edit',['id' => $complaint->complaint_id]) }}" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('complaint.destroy', ['id' => $complaint->complaint_id]) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-xs">
                <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
                                        

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
    <link href="{{ asset('public/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('scrpits')
    <!-- data table -->
    <script src="{{ asset('public/js/plugins/dataTables/datatables.min.js') }}"></script>
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