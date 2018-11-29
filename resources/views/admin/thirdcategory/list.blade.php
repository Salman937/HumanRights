@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    <div class="ibox-tools">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" href="#modal-form"> Add Third Category</a>
                    </div>
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>First Category</th>
                            <th>Secound Category</th>
                            <th>Third Category</th>
                            <th>Category Slug</th>
                            <th>image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($third_category as $cat)
                              <tr class="gradeX">
                                <td>{{$cat->parent_cat}}</td>
                                <td>{{$cat->sec_cat}}</td>
                                <td>{{$cat->category}}</td>
                                <td>{{$cat->category_slug}}</td>
                                <td><img src="{{ $cat->image }}" alt="{{ $cat->image }}" width="70px" height="50px" style="border-radius:15px;"></td>
                                <td>
                                    <a href="{{ route('thirdcat.edit', [ 'id' => $cat->id]) }}" class="btn btn-primary btn-xs" title="Edit Colour"><i class="fa fa-pencil"> </i> </a>

                                    <a href="{{ route('thirdcat.destroy', ['id' => $cat->id ]) }}" onclick=" return confirm('Are you sure you want to delete this record');" class="btn btn-danger btn-xs" title="Delete Colour"><i class="fa fa-trash"> </i> </a>
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
                        <h3 class="m-t-none m-b">Add Third Category (Sub Category Sub)</h3>
                        <p>&nbsp;</p>
                        <form action="{{ route('third_category.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>First Category <span class="text-danger">*</span></label>
                                <select name="head_category" id="head_category" required class="form-control head_category">
                                    <option selected disabled >Select First Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Secound Category <span class="text-danger">*</span></label>
                                <select name="secound_cat" id="secound_cat" required class="form-control secound_cat">
                                    <option selected disabled >Select Secound Category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category <span class="text-danger">*</span></label> 
                                <input type="text" placeholder="Enter Category Name" required name="category" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Third Category image <span class="text-danger">*</span></label> 
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
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
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
<script>
$(document).ready(function(){
    $('body').on('change','.head_category',function(){
        var first_cat = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        data:{id:first_cat},
        type:'POST',
        url:"{{ route('get.cat') }}",
        success: function(return_data)
        {
            var data= jQuery.parseJSON(return_data);
            if(!jQuery.isEmptyObject(data))
            {
                $('.secound_cat')
                .find('option')
                .remove()
                .end()
                .append('<option disabled selected>Select Secound Category</option>');
              $.each( data, function( index, value ){
               $('.secound_cat').append($('<option value="'+value['id']+'">'+value['category']+'</option>'));
              });
            }
        },
    });
});
});
</script>
@endsection