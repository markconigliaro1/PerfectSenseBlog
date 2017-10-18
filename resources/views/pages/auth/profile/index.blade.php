@extends('layouts.default')
@section('title')
{{ $user->getFullName() }}
@stop
@section('content')
<div class="page-header">
	<h1>{{ $user->getFullName() }}</h1>
	<p class="text-muted"><em>{{ $user->getLocation() }}</em></p>
	<p class="text-muted"><em>Joined {{ $user->created_at->diffForHumans() }}</em></p>
</div>
@include('includes.timeline')
@stop