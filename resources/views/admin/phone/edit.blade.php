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
                    <form action="{{ route('phone.update',[$phone->id]) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" placeholder='Enter Name' required name="name" value="{{ $phone->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Designation <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" placeholder='Enter Designation' value="{{ $phone->designation }}" required name="designation" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Office Number <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" placeholder="Enter Office Number" value="{{ $phone->office_number }}" required name="office_number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Update District</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection