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
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-1">
                            <form method="post" action="{{ route('complaint.update',['id' => $complaint->id]) }}">
                                
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label >Complaint Status</label>
                                    <select name="comp_status" class="form-control" id="">
                                        @if($complaint->status_id == 1)
                                            <option value="{{ $complaint->status_id }}">Pending</option>
                                        @elseif($complaint->status_id == 2)
                                            <option value="{{ $complaint->status_id }}">Completed</option>
                                        @elseif($complaint->status_id == 3)
                                            <option value="{{ $complaint->status_id }}">In Progress</option>
                                        @elseif($complaint->status_id == 4)
                                            <option value="{{ $complaint->status_id }}">Irrelevant</option>
                                        @elseif($complaint->status_id == 5)
                                            <option value="{{ $complaint->status_id }}">Not Understandable</option>
                                        @else
                                            <option value="{{ $complaint->status_id }}">Completed</option>
                                        @endif
                                        @foreach($complaint_status as $comp_status)
                                            <option value="{{ $comp_status->id }}">{{ $comp_status->complaint_status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Complaint Type</label>
                                    <input type="text" name="complaint_type" class="form-control" value='{{ $complaint->complaint_type }}'>
                                </div>
                                <div class="form-group">
                                    <label>Sub Complaint Type</label>
                                    <input type="text" name="sub_complaint_type" class="form-control" value='{{ $complaint->sub_complaint_type }}'>
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control" value='{{ $complaint->subject }}'>
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea name="dept_name" name="details" class="form-control" rows="7">{{ $complaint->details }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input type="text" name="dept_name" class="form-control" value='{{ $complaint->dept_name}}'>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
