@extends('layouts.default')
@section('title')
Sign Up
@stop
@section('content')
<div class="page-header">
	<h2>Sign Up</h2>
</div>
<div class="row">
	<div class="col-lg-6">
		<form class="form-vertical" role="form" method="POST" action="{{ route('guest.signup') }}">
			<div class="row">
				<div class="col-lg-6 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
					<label class="control-label" for="first-name">First Name:</label>
					<input id="first-name" class="form-control" type="text" name="first_name" 
					value="{{ Request::old('first_name') ?: '' }}" required/>
					@if ($errors->has('first_name'))
					<span class="help-block">{{ $errors->first('first_name') }}</span>
					@endif
				</div>
				<div class="col-lg-6 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
					<label class="control-label" for="last-name">Last Name:</label>
					<input id="last-name" class="form-control" type="text" name="last_name" 
					value="{{ Request::old('last_name') ?: '' }}" required/>
					@if ($errors->has('last_name'))
					<span class="help-block">{{ $errors->first('last_name') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
					<label class="control-label" for="username">Username:</label>
					<input id="username" class="form-control" type="text" name="username" 
					value="{{ Request::old('username') ?: '' }}" required/>
					@if ($errors->has('username'))
					<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label class="control-label" for="email">Email:</label>
					<input id="email" class="form-control" type="email" name="email" 
					value="{{ Request::old('email') ?: '' }}" required/>
					@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label class="control-label" for="password">Password:</label>
					<input id="password" class="form-control" type="password" name="password" required/>
					@if ($errors->has('password'))
					<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
					<label class="control-label" for="confirm-password">Confirm Password:</label>
					<input id="confirm-password" class="form-control" type="password" name="confirm_password" required/>
					@if ($errors->has('confirm_password'))
					<span class="help-block">{{ $errors->first('confirm_password') }}</span>
					@endif
				</div>
			</div><hr>
			<div class="row">
				<div class="col-md-3 form-group">
					<button class="btn btn-primary btn-block" type="submit">Sign Up</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</div>
@stop