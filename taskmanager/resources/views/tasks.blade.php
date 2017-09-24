@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Tasks</h3>
	  </div>
	  <div class="panel-body">
	    <h1 style="display:inline;">Tasks for user : {{ auth()->user()->name }} </h1>
		<a href="/task/create" class="btn btn-primary pull-right">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			New Task
		</a>
		
		<table class="table table-hover">
			<tr>
				<th width="5%">Date</td>
				<th width="5%">At</td>
				<th width="50%">Description</td>
				<th width="10%">Actions</td>
				<th width="5%">Public</td>
				<th width="5%">Staus</td>
			</tr>

			@foreach($tasks as $task)
			<tr>
				<td>{{ Carbon\Carbon::parse($task->starttime)->format('d/m/Y') }}</td>
				<td>{{ Carbon\Carbon::parse($task->starttime)->format('H:i') }}</td>
				<td> <a href="/task/{{$task->id}}">{{ $task->description}}</a></td>
				<td>
					<a data-toggle="modal" data-target="#modal_delete" data-task-id="{{ $task->id }}" class="btn btn-danger btn-sm">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
					<a href="/task/{{$task->id}}/edit" class="btn btn-warning btn-sm">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					<input type="checkbox" id="public" value="public" name="public" {{ $task->public ? 'checked' : '' }} disabled>
				</td>
				<td>{{ $task->status? 'Done':'Pending'}}</td>
			</tr>
			@endforeach
		</table>
	  </div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="modal_delete">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="modal_delete_title">Confirmation</h4>
	      </div>
	      <div class="modal-body">
	        Are you sure ?
	      </div>
	      <div class="modal-footer">
	      		<form id="form_delete" class="form-horizontal" method="POST" action="/task/">
	                {{ csrf_field() }}
	                {{ method_field('DELETE') }}
	                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	        		<button type="submit" class="btn btn-danger">Yes, delete</button>
          		</form>
	      </div>
	    </div>
	  </div>
	</div>

@endsection

@section('appjs')

	<script type="text/javascript">
		$('#modal_delete').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); 
		var recipient = button.data('task-id');
		$('#form_delete')[0].action = '/task/' + recipient;
		/*
		var modal = $(this)
		modal.find('.modal-body input').val(recipient)
		*/
		});
	</script>

@endsection