@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    @include('include.error')
                    <div class="ibox-tools">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" href="#modal-form"> Add First Category</a>
                    </div>
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
                                    <td>
                                        @if($complaint->complaint_status == 'pending')
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
                                    <td>{{ $complaint->complaint_type }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-xs">
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
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Add First Category (Head Category)</h3>
                        <p>&nbsp;</p>
                        <form action="{{ route('category.store') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Category <span class="text-danger">*</span></label> 
                                <input type="text" placeholder="Enter Category Name" required name="category" class="form-control">
                            </div>
                            <p>&nbsp;</p>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong></button>
                            </div>
                        </form>
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