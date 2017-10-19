<div class="row">
	<div class="col-lg-8">
		<!-- Create Post Section -->
		@if (Auth::check() AND Auth::user()->canPost())
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Create a Post</h2>
			</div>
			<div class="panel-body">
				<form role="form" method="POST" action="{{ route('auth.post.post') }}">
					<div class="row">
						<div class="col-lg-12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="control-label">Title</label>
							<input id="title" class="form-control" type="text" name="title" required/>
							@if ($errors->has('title'))
							<span class="help-block">{{ $errors->first('title') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 form-group{{ $errors->has('body') ? ' has-error' : '' }}">
							<label for="body" class="control-label">Body:</label>
							<textarea id="body" class="form-control" style="resize:none;" rows="4" name="body" required/></textarea>
							@if ($errors->has('body'))
							<span class="help-block">{{ $errors->first('body') }}</span>
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
		<!-- Timeline section -->
		<div class="row">
			<div class="col-lg-12">
				@if (!$posts->count())
				<p>There are no posts.</p>
				@else
				@foreach($posts as $post)
				<!-- Post section -->
				<div class="media">
					<div class="media-left">
						<img class="media-object" style="width:60px; height:60px;" src="">
					</div>
					<div class="media-body">
						<!-- Post panel section -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">{{ $post->user->getFullName() }}</h4>
							</div>
							<div class="panel-body">
								<h2>{{ $post->title }}</h2>
								<p class="text-muted"><em>Posted: {{ $post->created_at->diffForHumans() }}</em></p>
								<p>{{ $post->body }}</p>
							</div>
							<div class="panel-footer">
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
								</ul>
								@auth
								<!-- Comment form section -->
								<form id="comment-form-{{ $post->id }}" 
									style="{{ $errors->has("comment-{$post->id}") ? '' : 'display:none;' }}" 
									role="form" method="POST" action="{{ route('auth.comment.post', ['postID' => $post->id]) }}"><hr>
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
									<input type="hidden" name="_token" value="{{ Session::token() }}"/>
								</form>
								@endauth
							</div>
						</div>
						@foreach($post->comments as $comment)
						<div class="media">
							<div class="media-left">
								<img class="media-object" style="width:40px; height:40px;" src="">
							</div>
							<div class="media-body">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h5 class="panel-title">{{ $comment->user->getFullName() }}</h5>
									</div>
									<div class="panel-body">
										<p class="text-muted"><em>Posted: {{ $comment->created_at->diffForHumans() }}</em></p>
										<p>{{ $comment->body }}</p>
									</div>
									<div class="panel-footer">
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
										</ul>
									</div>
								</div>
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