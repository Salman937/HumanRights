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
                    <form action="{{ route('thirdcat.update' ,['id' => $third_category->id]) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Category <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select name="head_category" id="head_category" class="form-control">
                                    <option selected disabled >Select head Category</option>
                                      @foreach($fi_category as $first_cat)
                                        <option value="{{ $first_cat->id }}" @if($first_category->id == $first_cat->id) selected="selected" @endif >{{ $first_cat->category }}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Secound Category <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select name="sec_category" id="sec_category" class="form-control">
                                    <option selected disabled >Select Secound Category</option>
                                    @foreach($sc_category as $sc_cat)
                                        <option value="{{ $sc_cat->id }}" @if($secound_category->id == $sc_cat->id) selected="selected" @endif >{{ $sc_cat->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Third Category <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="category" value="{{ $third_category->category }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <img src="{{ $third_category->image }}" width="50px" height="50px" style="border-radius: 3px; margin-bottom: 1%;" alt="{{ $third_category->image }}">
                                <input type="hidden" name="pre_image" value="{{ $third_category->image }}">
                            </div>
                            <label class="col-sm-2 control-label">Image <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="new_image">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Update Third Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection