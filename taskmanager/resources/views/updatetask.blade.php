@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Task</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/task/{{ $task->id }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}


                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $task->description }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="public" {{ $task->public ? 'checked' : '' }} > Public
                                        </label>
                                    </div>


                                @if ($errors->has('public'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public') }}</strong>
                                    </span>
                                @endif
                                </div>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('starttime') ? ' has-error' : '' }}">
                            <label for="starttime" class="col-md-4 control-label">Start Time</label>

                            <div class="col-md-6">
                                <input id="starttime" type="datetime-local" class="form-control" name="starttime" value="{{ Carbon\Carbon::parse($task->starttime)->format('Y-m-d\TH:i:s') }}" required>

                                @if ($errors->has('starttime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('starttime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('endtime') ? ' has-error' : '' }}">
                            <label for="endtime" class="col-md-4 control-label">End Time</label>

                            <div class="col-md-6">
                                <input id="endtime" type="datetime-local" class="form-control" name="endtime" value="{{ Carbon\Carbon::parse($task->endtime)->format('Y-m-d\TH:i:s') }}" required>

                                @if ($errors->has('endtime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endtime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('team_id') ? ' has-error' : '' }}">
                            <label for="team_id" class="col-md-4 control-label">Team task?</label>

                            <div class="col-md-6">
                                
                                <select name="team_id">
                                  <option value="0" selected>No team</option>
                                  <option value="1">Developers</option>
                                  <option value="2">Testers</option>
                                  <option value="3">Business</option>
                                  
                                </select>

                                @if ($errors->has('team_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('team_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                            <label for="status_id" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                                
                                <select name="status_id">
                                  <option value="0" {{(!$task->status)? 'selected' :'' }}>Pending</option>
                                  <option value="1" {{($task->status)? 'selected' :'' }}>Done</option>
                                </select>

                                @if ($errors->has('status_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
