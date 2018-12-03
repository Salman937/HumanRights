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
                        <a data-toggle="modal" class="btn btn-primary btn-xs" href="#modal-form"> Add Announcement</a>
                    </div>
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($announcement as $ann)
                              <tr class="gradeX">
                                <td>{{$ann->title}}</td>
                                <td>{{$ann->description}}</td>
                                <td><img src="{{$ann->image}}" alt="{{$ann->image}}"  width="70px" height="50px" style="border-radius:15px;"></td>
                                <td>
                                    <form action="{{ URL::route('announcement.edit', [$ann->id]) }}" method="POST">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"> </i></button>
                                    </form>

                                    <form action="{{ URL::route('announcement.destroy', [$ann->id]) }}" method="POST">
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
                        <h3 class="m-t-none m-b">Add Announcement</h3>
                        <p>&nbsp;</p>
                        <form action="{{ route('announcement.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label> 
                                <input type="text" placeholder="Title" required name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label> 
                                <input type="text" placeholder="Description" required name="description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Image <span class="text-danger">*</span></label> 
                                <input type="file" required name="image" class="form-control">
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