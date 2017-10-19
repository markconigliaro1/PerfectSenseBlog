<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Navigation brand and responsive toggle -->
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" 
			data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
        		<span class="sr-only">Toggle Navigation</span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
      		<span class="navbar-brand">Perfect Sense Blog</span>
		</div>
		<!-- Navigation links and dropdowns -->
		<div id="nav-collapse" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ route('home') }}">Home</a></li>
			</ul>
			<ul class="nav navbar-right navbar-nav">
				<!-- Authenticated only elements -->
				@auth
				<li class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" 
					aria-haspopup="true" aria-expanded="false">{{ Auth::user()->getFullName() }} <span class="caret"></span></a>
          			<ul class="dropdown-menu">
            			<li><a href="{{ route('auth.profile.settings', ['username' => Auth::user()->username]) }}">Settings</a></li>
            			<li class="divider" role="separator"></li>
            			<li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
          			</ul>
				</li>
				@endauth
				<!-- Guest only elements -->
				@guest	
				<li><a href="{{ route('guest.signup') }}">Sign Up</a></li>
				<li><a href="{{ route('guest.signin') }}">Sign In</a></li>
				@endguest			
			</ul>
		</div>
	</div>
</nav>