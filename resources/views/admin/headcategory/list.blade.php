@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    <div class="ibox-tools">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" href="#modal-form"> Add First Category</a>
                    </div>
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>Category Slug</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                              <tr class="gradeX">
                                <td>{{$cat->category}}</td>
                                <td>{{$cat->category_slug}}</td>
                                <td>
                                    <form action="{{ URL::route('category.edit', [$cat->id]) }}" method="POST">
                                        <input type="hidden" name="_method" value="get">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"> </i></button>
                                    </form>

                                    <form action="{{ URL::route('category.destroy', [$cat->id]) }}" method="POST">
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