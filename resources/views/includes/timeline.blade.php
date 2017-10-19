<div class="row">
	<div class="col-lg-8">
		@if (Auth::check() AND Auth::user()->canPost())
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
		@endif
		<div class="row">
			<div class="col-lg-12">
				@if (!$posts->count())
				<p>There are no posts.</p>
				@else
				@foreach($posts as $post)
				<div class="media">
					<a class="media-left" 
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
							<li>Likes ({{ $post->likes->count() }})</li>
							@if (Auth::check() AND Auth::user()->canComment())
							<li><a role="button" onclick="toggleCommentForm({{$post->id}})">Reply</a></li>•
							@if (!Auth::user()->hasLikedPost($post))
							<li><a href="{{ route('auth.post.like', ['postID' => $post->id]) }}">Like</a></li>
							@else
							<li><a href="{{ route('auth.post.unlike', ['postID' => $post->id]) }}">Unlike</a></li>
							@endif
							•<li><a href="{{ route('auth.post.delete', ['postID' => $post->id]) }}">Delete</a></li>
							@endif
						</ul><hr>
						@auth
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
								<div class="col-lg-12">
									<p>Commenting as {{ Auth::user()->getFullName() }}</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 form-group">
									<button class="btn btn-primary btn-block" type="submit">Comment</button>
								</div>
							</div>
							<input type="hidden" name="_token" value="{{ Session::token() }}"/><hr>
						</form>
						@endauth
						@foreach($post->comments as $comment)
						<div class="media">
							<a class="media-left" href="{{ route('auth.profile.index', ['username' => $comment->user->username]) }}">
								<img class="media-object" style="width:40px; height:40px;" src="">
							</a>
							<div class="media-body">
								<h5 class="media-heading"><a href="{{ route('auth.profile.index', ['username' => $comment->user->username]) }}">{{ $comment->user->getFullName() }}</a></h5>
								<p class="text-muted">
									<em>Posted: {{ $comment->created_at->diffForHumans() }}</em></p>
								<p>{{ $comment->body }}</p>
								<ul class="list-inline">
									<li>Likes ({{ $comment->likes->count() }})</li>
									@auth
									@if (!Auth::user()->hasLikedPost($comment))
									<li><a href="{{ route('auth.post.like', ['postID' => $comment->id]) }}">Like</a></li>
									@else
									<li><a href="{{ route('auth.post.unlike', ['postID' => $comment->id]) }}">Unlike</a></li>
									@endif
									•<li><a href="{{ route('auth.post.delete', ['postID' => $comment->id]) }}">Delete</a></li>
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