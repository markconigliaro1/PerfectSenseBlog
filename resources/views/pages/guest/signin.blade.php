@extends('layouts.default')
@section('title')
Sign In
@stop
@section('content')
<div class="page-header">
	<h1>Sign In</h1>
</div>
<div class="row">
	<div class="col-lg-6">
		<form class="form-vertical" role="form" method="POST" action="{{ route('guest.signin') }}">
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label class="control-label" for="email">Email:</label>
					<input id="email" class="form-control" type="email" name="email" required/>
					@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="control-label">Password:</label>
					<input id="password" class="form-control" type="password" name="password" required/>
					@if ($errors->has('password'))
					<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
			</div><hr>
			<div class="row">
				<div class="col-lg-12 checkbox">
					<label><input type="checkbox" name="remember"/> Remember Me</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 form-group">
					<button class="btn btn-primary btn-block" type="submit">Sign In</button>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		</form>
	</div>
</div>
@stop