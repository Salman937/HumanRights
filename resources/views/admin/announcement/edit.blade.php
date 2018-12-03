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
                    <form action="{{ route('announcement.update',[$announcement->id]) }}" method="post" class="form-horizontal">
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
                                <input type="text" placeholder="Title" required name="title" class="form-control" value="{{ $announcement->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" placeholder="Description" required name="description" class="form-control" value="{{ $announcement->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <img src="{{ $announcement->image }}" width="70px" height="60px" style="border-radius: 3px; margin-bottom: 1%;" alt="{{ $announcement->image }}">
                                <input type="hidden" name="pre_image" value="{{ $announcement->image }}">
                            </div>
                            <label class="col-sm-2 control-label">New Image <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="file" required name="image" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Update Announcement</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection