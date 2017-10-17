@extends('layouts.default')
@section('title')
Profile Settings
@stop
@section('content')
<div class="page-header">
	<h1>Profile Settings</h1>
</div>
<div class="row">
	<div class="col-lg-6">
		<form class="form-vertical" role="form" method="POST" action="#">
			<div class="row">
				<div class="col-lg-6 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
					<label for="first-name" class="control-label">First Name:</label>
					<input id="first-name" class="form-control" type="text" name="first_name" 
					value="{{ Request::old('first_name') ?: Auth::user()->first_name }}" required/>
					@if ($errors->has('first_name'))
					<span class="help-block">{{ $errors->first('first_name') }}</span>
					@endif
				</div>
				<div class="col-lg-6 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
					<label for="last-name" class="control-label">Last Name:</label>
					<input id="last-name" class="form-control" type="text" name="last_name" 
					value="{{ Request::old('last_name') ?: Auth::user()->last_name }}" required/>
					@if ($errors->has('last_name'))
					<span class="help-block">{{ $errors->first('last_name') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label for="username" class="control-label">Username:</label>
					<input id="username" class="form-control" type="text" name="username" 
					value="{{ Request::old('username') ?: Auth::user()->username }}" required/>
					@if ($errors->has('username'))
					<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">Email:</label>
					<input id="email" class="form-control" type="email" name="email" 
					value="{{ Request::old('email') ?: Auth::user()->email }}" required/>
					@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('location') ? ' has-error' : '' }}">
					<label for="location" class="control-label">Location:</label>
					<input id="location" class="form-control" type="text" name="location" 
					value="{{ Request::old('location') ?: Auth::user()->location }}"/>
					@if ($errors->has('location'))
					<span class="help-block">{{ $errors->first('location') }}</span>
					@endif
				</div>
			</div><hr>
			<div class="row">
				<div class="col-md-3 form-group">
					<button class="btn btn-primary btn-block" type="submit">Update</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</div>
@stop