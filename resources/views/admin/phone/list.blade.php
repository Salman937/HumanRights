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
                        <a data-toggle="modal" class="btn btn-primary btn-xs" href="#modal-form"> Add Phone Directory</a>
                    </div>
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Office Number</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $sno = 1; ?>
                            @foreach($phone as $ann)
                              <tr class="gradeX">
                                <td>{{ $ann->name }}</td>
                                <td>{{ $ann->designation }}</td>
                                <td>{{ $ann->office_number }}</td>
                                <td>
                                    <form action="{{ URL::route('phone.edit', [$ann->id]) }}" method="POST">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"> </i></button>
                                    </form>

                                    <form action="{{ URL::route('phone.destroy', [$ann->id]) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button onclick=" return confirm('Are you sure you want to delete this record');" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"> </i></button>
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
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Add Phone Directory</h3>
                        <p>&nbsp;</p>
                        <form action="{{ route('phone.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label> 
                                <input type="text" placeholder='Enter Name' required name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Designation <span class="text-danger">*</span></label> 
                                <input type="text" placeholder='Enter Designation' required name="designation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Office Number <span class="text-danger">*</span></label> 
                                <input type="text" placeholder='Enter Office Number' required name="office_number" class="form-control">
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