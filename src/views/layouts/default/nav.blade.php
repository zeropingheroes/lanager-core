<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="/">
				<img src="{{ asset('packages/zeropingheroes/lanager-core/img/logo.png') }}" alt="LANager Logo">
			</a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-header navbar-right">
			<ul class="nav navbar-nav">
				@if(Auth::check())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">	<img src="{{ Auth::user()->avatar }}" alt="Avatar"> {{{ (Auth::user()->username) }}} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>{{ link_to_route('user.show', 'Profile',  Auth::user()->id) }}</li>
							<li>{{ link_to_route('user.logout', 'Log Out') }}</li>
						</ul>
					</li>
				@else
					<li>
						<a href="{{ $authUrl }}" class="pull-right steam-signin"><img src="{{ asset('/packages/zeropingheroes/lanager-core/img/sits_small.png') }}"></a>
					</li>
				@endif
			</ul>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="{{ Request::is('shout*') ? 'active' : '' }}">
					{{ link_to_route('shout.index', 'Shouts') }}
				</li>
				<li class="{{ Request::is('user*') ? 'active' : '' }}">
					{{ link_to_route('user.index', 'People') }}
				</li>
				@include('lanager-core::layouts.default.info')
			</ul>
		</div>
	</div>
</div>