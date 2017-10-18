@extends('layouts.default')
@section('title')
Timeline
@stop
@section('content')
<div class="page-header">
	<h1>Welcome Back, {{ Auth::user()->first_name }}!</h1>
</div>
@include('includes.timeline')
@stop