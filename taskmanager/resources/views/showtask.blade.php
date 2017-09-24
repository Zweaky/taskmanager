@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Task - Information
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <p class="control-label">Description</p>
                        </div>
                        <div class="col-sm-10">
                            <input id="description" type="text" class="form-control" name="description" value="{{ $task->description}}" readonly="">
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="public" {{ ($task->public) ? 'checked' : '' }} disabled="disabled" readonly=""> Public
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row"  style="margin-bottom: 10px;">
                        <div class="col-sm-2">
                            <p class="control-label">Start:</p>
                        </div>
                        <div class="col-sm-10">
                            <input id="starttime" type="datetime-local" class="form-control" name="starttime" value="{{ Carbon\Carbon::parse($task->starttime)->format('Y-m-d\TH:i:s') }}" readonly="">
                        </div>
                    </div>

                    <div class="row"  style="margin-bottom: 10px;">
                        <div class="col-sm-2">
                            <p class="control-label">End:</p>
                        </div>
                        <div class="col-sm-10">
                            <input id="endtime" type="datetime-local" class="form-control" name="endtime" value="{{ Carbon\Carbon::parse($task->endtime)->format('Y-m-d\TH:i:s') }}" readonly="">
                        </div>
                    </div>

                    <div class="row"  style="margin-bottom: 10px;">
                        <div class="col-sm-2">
                            <p class="control-label">Team:</p>
                        </div>
                        <div class="col-sm-10">
                            
                                <select name="team_id" readonly="" disabled="">
                                  <option value="0" selected>No team</option>
                                  
                                  <option value="1">Developers</option>
                                  <option value="2">Testers</option>
                                  <option value="3">Business</option>
                                  
                                </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
