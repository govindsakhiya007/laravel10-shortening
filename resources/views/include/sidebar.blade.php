<div class="sticky">
	<aside class="app-sidebar">
		<div class="main-sidebar-header active">
			<a class="header-logo active" href="#">
				<img src="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" class="main-logo  desktop-logo" alt="logo">
				<img src="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" class="main-logo  desktop-dark" alt="logo">
				<img src="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" class="main-logo  mobile-logo" alt="logo">
				<img src="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" class="main-logo  mobile-dark" alt="logo">
			</a>
		</div>
		<div class="main-sidemenu">
			<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
			<ul class="side-menu">
				<li class="slide is-expanded">
					<a class="side-menu__item {{ Request::segment(1) == 'urls' ? 'active' : '' }}" href="{{ route('urls.index') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg>
						<span class="side-menu__label">Shortened URLs</span>
					</a>
				</li>
				<li class="slide is-expanded">
					<a class="side-menu__item {{ Request::segment(1) == 'upgrade-plan' ? 'active' : '' }}" href="{{ route('upgrade.plan') }}">
						<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg>
						<span class="side-menu__label">Plans</span>
					</a>
				</li>
			</ul>
			<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
		</div>
	</aside>
</div>