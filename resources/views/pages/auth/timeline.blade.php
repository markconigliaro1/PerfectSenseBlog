@extends('layouts.default')
@section('title')
Timeline
@stop
@section('content')
<div class="page-header">
	<h1>Welcome</h1>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12">
				<form role="form" method="POST" action="{{ route('auth.post.post') }}">
					<div class="row">
						<div class="col-lg-12 form-group{{ $errors->has('post') ? ' has-error' : '' }}">
							<textarea class="form-control" rows="8" name="post" placeholder="Create a post here!"></textarea>
							@if ($errors->has('post'))
							<span class="help-block">{{ $errors->first('post') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 form-group">
							<button class="btn btn-primary btn-block" type="submit">Post</button>
						</div>
					</div>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</form>
			</div>
		</div><hr>
		<div class="row">
			<div class="col-lg-12">
				@if (!$posts->count())
				<p>Your timeline seems pretty boring right now...</p>
				@else
				@foreach($posts as $post)
				<div class="media">
					<a class="pull-left" 
					href="{{ route('auth.profile.index', ['username' => $post->user->username]) }}">
						<img class="media-object" style="width:60px; height:60px;" src="">
					</a>
					<div class="media-body">
						<h4 class="media-heading"><a href="#">
							{{ $post->user->getFullName() }}
						</a></h4>
						<p class="text-muted">
							<em>Posted: {{ $post->getPostTime() }}</em></p>
						<p>{{ $post->body }}</p>
						<ul class="list-inline">
							<li><a href="#">Like</a></li>
							<li>10</li>
						</ul>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@stop