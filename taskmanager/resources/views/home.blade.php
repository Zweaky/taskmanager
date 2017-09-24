@extends('layouts.app')

@section('content')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
	<div class="panel panel-default panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Welcome back <b>{{ Auth()->user()->name }}</b></h3>
	  </div>
	  <div class="panel-body">
	    <h1>Home sweet home</h1>
		<p>This is a demo site created with Laravel 5.4</p>
		
		<!-- ALERTS -->
		@if (session()->has('alert'))
		<div class="alert {{ session('type') }}" role="alert">
			 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<p><strong>{{ session('msg') }}</strong></p>
		</div>
		@endif
		<!-- END ALERTS -->
		
		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default">
                	<div class="panel-heading">Actual information:</div>

                	<div class="panel-body">
                		<div class="row" style="margin-bottom: 10px;">
	                        <div class="col-sm-2">
	                            <p class="control-label">User:</p>
	                        </div>
	                        <div class="col-sm-10">
	                            <input id="label_username" type="text" class="form-control" name="description" value="{{ Auth()->user()->name }}" readonly="readonly">
	                        </div>
	                    </div>

	                    <div class="row" style="margin-bottom: 10px;">
	                        <div class="col-sm-2">
	                            <p class="control-label">Email:</p>
	                        </div>
	                        <div class="col-sm-10">
	                            <input id="label_email" type="text" class="form-control" name="description" value="{{ Auth()->user()->email }}" readonly="readonly">
	                        </div>
	                    </div>

	                    <div class="row" style="margin-bottom: 10px;">
	                        <div class="col-sm-2">
	                            <p class="control-label">Last update:</p>
	                        </div>
	                        <div class="col-sm-10">
	                            <input id="label_email" type="text" class="form-control" name="description" value="{{ Carbon\Carbon::parse(Auth()->user()->updated_at)->format('Y-m-d \a\t H:i:s') }}" readonly="readonly">
	                        </div>
	                    </div>
                	</div>
                </div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-default">
                	<div class="panel-heading">Stats:</div>

                	<div class="panel-body">
                		<table class="table table-hover">
							<tr class="text-center">
								<th width="33%">Tasks</td>
								<th width="33%">Done</td>
								<th width="33%">Pending</td>
							</tr>
							
							<tr>
								<td>{{ $parameters['tasks_all_count'] }}</td>
								<td>{{ $parameters['tasks_done_count'] }}</td>
								<td>{{ $parameters['tasks_pending_count'] }}</td>
							</tr>
							
						</table>
                	</div>
                </div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default">
                	<div class="panel-heading">Change information:</div>

                	<div class="panel-body">
                		<form class="form-horizontal" method="POST" action="/user/info">
	                        {{ csrf_field() }}
	                        {{ method_field('PUT') }}
	                        
	                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
	                            <label for="username" class="col-md-4 control-label">Name:</label>

	                            <div class="col-md-6">
	                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" >

	                                @if ($errors->has('username'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('username') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">Email:</label>

	                            <div class="col-md-6">
	                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  >

	                                @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary btn-block">
	                                    Update information
	                                </button>
	                            </div>
	                        </div>
	                    </form>
                	</div>
                </div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-default panel-warning">
                	<div class="panel-heading">Change password:</div>

                	<div class="panel-body">
                		<form class="form-horizontal" method="POST" action="/user/credentials">
	                        {{ csrf_field() }}
	                        {{ method_field('PUT') }}

	                        <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
	                            <label for="oldpassword" class="col-md-4 control-label">Old password:</label>

	                            <div class="col-md-6">
	                                <input id="oldpassword" type="password" class="form-control" name="oldpassword" value="{{ old('oldpassword') }}" required >

	                                @if ($errors->has('oldpassword'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('oldpassword') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">New password:</label>

	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required >

	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password2" class="col-md-4 control-label">Repeat:</label>

	                            <div class="col-md-6">
	                                <input id="password2" type="password" class="form-control" name="password2" value="{{ old('password2') }}" required >

	                                @if ($errors->has('password2'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password2') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary btn-block btn-warning">
	                                    Change password
	                                </button>
	                            </div>
	                        </div>
	                    </form>
                	</div>
                </div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
                	<div class="panel-heading">Graph ChatJS:</div>

                	<div class="panel-body">
                		<div class="row" style="margin-bottom: 10px;">
	                        <div class="col-sm-2">
	                            <p class="control-label">Select a Year:</p>
	                        </div>
	                        <div class="col-sm-10">
	                        	<select id="combo_years" style="min-width: 15%;">
                                  <!--option value="2017" selected>2017</option>
                                  <option value="2016">2016</option>
                                  <option value="2015">2015</option-->
                                </select>
	                        </div>
	                    </div>

	                    <div id="graph_container">
                			<canvas id="myChart" width="400" height="100"></canvas>
                		</div>
						<script>
						
						$("#combo_years").change(function(){
							year = $("#combo_years option:selected").val();
							getData(year);
						});

						var ajaxCall = $.ajax({
								
							url: 'http://'+ window.location.host +'/task/years',
							
							/*
							data:{
								nroexpediente: $('#edit_nroexpediente').val(),
								anio: $('#edit_anio').val()
							},
							*/
							
							type: 'GET',
							
							async: true,
							
							beforeSend: function(jqXHR) {
								jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
							},
							
							timeout: 5000
						});
						
						ajaxCall.done(function(response) {
							response = JSON.parse(response);
							
							for (i in response) {
								$("#combo_years").append('<option value="'+ response[i].year +'">'+response[i].year+'</option>');
							}

							$("#combo_years").val(response[0].year);
							getData(response[0].year);
							
						});
						
						//FAIL
						ajaxCall.fail(function(response) {
							console.log("ERROR AJAX INICIAL");
							console.log(response);
							console.log("END AJAX");
						});

						function updateData(data) {
							
							data = JSON.parse(data);

							myChart.data.datasets[0].data = data;
							
							myChart.update();
						}

						function getData(year) {
							var ajaxCall = $.ajax({
								
								url: 'http://'+ window.location.host +'/task/year/' + year,
								
								/*
								data:{
									nroexpediente: $('#edit_nroexpediente').val(),
									anio: $('#edit_anio').val()
								},
								*/
								
								type: 'GET',
								
								async: true,
								
								beforeSend: function(jqXHR) {
									jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
								},
								
								timeout: 5000
							});
							
							ajaxCall.done(function(response) {
								updateData(response);
							});
							
							//FAIL
							ajaxCall.fail(function(response) {
								console.log("ERROR AJAX");
								console.log(response);
								console.log("END AJAX");
							});	
						}
						
						var ctx = document.getElementById("myChart").getContext('2d');
						var myChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
						        datasets: [{
						            label: 'Tasks p/month',
						            data: [],
						            backgroundColor: [
						                'rgba(255, 99, 132, 0.2)',
						                'rgba(54, 162, 235, 0.2)',
						                'rgba(255, 206, 86, 0.2)',
						                'rgba(75, 192, 192, 0.2)',
						                'rgba(153, 102, 255, 0.2)',
						                'rgba(255, 99, 132, 0.2)',
						                'rgba(54, 162, 235, 0.2)',
						                'rgba(255, 206, 86, 0.2)',
						                'rgba(75, 192, 192, 0.2)',
						                'rgba(153, 102, 255, 0.2)',
						                'rgba(255, 159, 64, 0.2)',
						                'rgba(255, 159, 64, 0.2)'
						            ],
						            borderColor: [
						            	'rgba(255,99,132,1)',
						                'rgba(54, 162, 235, 1)',
						                'rgba(255, 206, 86, 1)',
						                'rgba(75, 192, 192, 1)',
						                'rgba(153, 102, 255, 1)',
						                'rgba(255, 159, 64, 1)',
						                'rgba(255,99,132,1)',
						                'rgba(54, 162, 235, 1)',
						                'rgba(255, 206, 86, 1)',
						                'rgba(75, 192, 192, 1)',
						                'rgba(153, 102, 255, 1)',
						                'rgba(255, 159, 64, 1)'
						            ],
						            borderWidth: 1
						        }]
						    },
						    options: {
						        scales: {
						            yAxes: [{
						                ticks: {
						                    beginAtZero:true
						                }
						            }]
						        }
						    }
						});
						</script>
                	</div>
                </div>
			</div>
		</div>
	  </div>
	</div>
	
@endsection