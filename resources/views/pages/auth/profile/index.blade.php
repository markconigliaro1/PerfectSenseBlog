@extends('layouts.default')
@section('title')
{{ $user->getFullName() }}
@stop
@section('content')
<div class="page-header">
	<div class="media">
		<div class="media-left media-bottom">
			<img class="media-object" style="width:160px; height:160px;" src="">
		</div>
		<div class="media-body media-bottom">
			<h1 class="media-heading">{{ $user->getFullName() }}</h1>
			<ul class="list-inline">
				<li class="text-muted"><em>{{ $user->getLocation() }}</em></li>•
				<li class="text-muted"><em>Joined {{ $user->created_at->diffForHumans() }}</em></p></li>
			</ul>
		</div>
	</div>
</div>
@include('includes.timeline')
@stop