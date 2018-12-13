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
                    <form action="{{ route('awareness.update',[$awareness->id]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        {{-- <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="category" value="{{ $announcement->cat_name }}">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" placeholder="Title" required name="title" value="{{ $awareness->title }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" placeholder="Description" required value="{{ $awareness->description }}" name="description" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Previous Image </label> 
                            <div class="col-sm-7">
                                <img src="{{ $awareness->image }}" width="70px" height="50px" style="border-radius: 3px; margin-bottom: 1%;" alt="{{ $awareness->image }}">
                                <input type="hidden" name="pre_image" value="{{ $awareness->image }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image </label> 
                            <div class="col-sm-7">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Update Awareness</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection