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
					<li class="{{ Request::is('shout*') ? 'active' : '' }}">
						{{ link_to_route('shout.index', 'Shouts') }}
					</li>
					<li class="{{ Request::is('user*') ? 'active' : '' }}">
						{{ link_to_route('user.index', 'People') }}
					</li>
					@include('lanager-core::layouts.default.info')
				</ul>
				<ul class="nav pull-right">
					@if(Auth::check())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown"><img src="{{ Auth::user()->avatar }}" alt="Avatar"> {{{ (Auth::user()->username) }}} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to_route('user.show', 'Profile',  Auth::user()->id) }}</li>
								<li>{{ link_to_route('user.logout', 'Log Out') }}</li>
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