<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-12">
				<form role="form" method="POST" action="{{ route('auth.post.post') }}">
					<div class="row">
						<div class="col-lg-12 form-group{{ $errors->has('post') ? ' has-error' : '' }}">
							<textarea class="form-control" style="resize:none;" rows="4" name="post" placeholder="Create a post here!"></textarea>
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
						<h4 class="media-heading"><a href="{{ route('auth.profile.index', ['username' => $post->user->username]) }}">
							{{ $post->user->getFullName() }}
						</a></h4>
						<p class="text-muted">
							<em>Posted: {{ $post->created_at->diffForHumans() }}</em></p>
						<p>{{ $post->body }}</p>
						<ul class="list-inline">
							<li><a href="#">Like</a></li>•
							<li><a href="#">Dislike</a></li>•
							<li><a role="button" onclick="toggleCommentForm({{$post->id}})">Reply</a></li>
							@auth
							•<li><a href="#">Delete</a></li>
							@endauth
						</ul><hr>
						<form id="comment-form-{{ $post->id }}" 
							style="{{ $errors->has("comment-{$post->id}") ? '' : 'display:none;' }}" 
							role="form" method="POST" action="{{ route('auth.comment.post', ['postID' => $post->id]) }}">
							<div class="row">
								<div class="col-lg-12 form-group{{ $errors->has("comment-{$post->id}") ? ' has-error' : '' }}">
									<textarea class="form-control" style="resize:none;"rows="2" name="comment-{{ $post->id }}" placeholder="Reply to this post..."></textarea>
									@if ($errors->has("comment-{$post->id}"))
									<span class="help-block">{{ $errors->first("comment-{$post->id}") }}</span>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 form-group">
									<button class="btn btn-primary btn-block" type="submit">Comment</button>
								</div>
							</div>
							<input type="hidden" name="_token" value="{{ Session::token() }}"/><hr>
						</form>
						@foreach($post->comments as $comment)
						<div class="media">
							<a class="pull-left" href="{{ route('auth.profile.index', ['username' => $comment->user->username]) }}">
								<img class="media-object" style="width:40px; height:40px;" src="">
							</a>
							<div class="media-body">
								<h5 class="media-heading"><a href="{{ route('auth.profile.index', ['username' => $comment->user->username]) }}">{{ $comment->user->getFullName() }}</a></h5>
								<p class="text-muted">
									<em>Posted: {{ $comment->created_at->diffForHumans() }}</em></p>
								<p>{{ $comment->body }}</p>
								<ul class="list-inline">
									<li><a href="#">Like</a></li>•
									<li><a href="#">Dislike</a></li>
									@auth
									•<li><a href="#">Delete</a></li>
									@endauth
								</ul><hr>
							</div>
						</div>
						@endforeach
					</div>
				</div><hr>
				@endforeach
				{!! $posts->render() !!}
				@endif
			</div>
		</div>
	</div>
</div>