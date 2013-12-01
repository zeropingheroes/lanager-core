<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="/"><img src="{{ asset('/packages/zeropingheroes/lanager-core/vendor/zeropingheroes/lanager/img/logo.png') }}" alt="LANager Logo"></a>

			<div class="nav-collapse collapse">
				<ul class="nav">
					@include('lanager-core::layouts.default.info')
				</ul>
				<ul class="nav pull-right">
					@if(Auth::check())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown"><img src="{{ Auth::user()->avatar }}" alt="Avatar"> {{{ (Auth::user()->username) }}} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('user.show', Auth::user()->id) }}">Profile</a></li>
								<li><a href="{{ route('user.logout') }}">Log Out</a></li>
							</ul>
						</li>
					@else
						<li>
							<a href="{{ $authUrl }}" class="pull-right steam-signin"><img src="{{ asset('/packages/zeropingheroes/lanager-core/vendor/zeropingheroes/lanager/img/sits_small.png') }}"></a>
						</li>
					@endif
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>