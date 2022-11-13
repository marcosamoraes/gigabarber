<!-- Sidemenu -->
<div class="sticky">
	<div class="main-menu main-sidebar main-sidebar-sticky side-menu">
		<div class="main-sidebar-header main-container-1 active">
			<div class="sidemenu-logo">
				<a class="main-logo" href="index.html">
					<img src="{{env('APP_URL')}}/app/assets/img/4youvip_negativa_fundotransparente3.png" class="header-brand-img desktop-logo" alt="logo">
					<img src="{{env('APP_URL')}}/assets/admin/img/brand/icon-light.png" class="header-brand-img icon-logo" alt="logo">
					<img src="{{env('APP_URL')}}/assets/admin/img/brand/logo.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
					<img src="{{env('APP_URL')}}/assets/admin/img/brand/icon.png" class="header-brand-img icon-logo theme-logo" alt="logo">
				</a>
			</div>
			<div class="main-sidebar-body main-body-1">
				<div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
				<ul class="menu-nav nav">
					<li class="nav-item {{request()->is('admin.dashboard') ? 'active' : false}}">
						<a class="nav-link" href="{{route('admin.dashboard')}}">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-home sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Dashboard</span>
						</a>
					</li>
					<li class="nav-item {{request()->is('admin.clients.*') ? 'active' : false}}">
						<a class="nav-link" href="{{route('admin.clients.index')}}">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-write sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Acompanhantes</span>
						</a>
					</li>
					<li class="nav-item {{request()->is('admin.categories.*') ? 'active' : false}}">
						<a class="nav-link" href="{{route('admin.categories.index')}}">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-write sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Categorias</span>
						</a>
					</li>
					<li class="nav-item {{request()->is('admin.tags.*') ? 'active' : false}}">
						<a class="nav-link" href="{{route('admin.tags.index')}}">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-write sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Tags</span>
						</a>
					</li>
					<li class="nav-item {{request()->is('admin.plans.*') ? 'active' : false}}">
						<a class="nav-link" href="{{route('admin.plans.index')}}">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-write sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Planos</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{route('admin.logout')}}">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-power-off sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Sair</span>
						</a>
					</li>
				</ul>
				<div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
			</div>
		</div>
	</div>
</div>
<!-- End Sidemenu -->