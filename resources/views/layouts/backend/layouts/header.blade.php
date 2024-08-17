<div class="navbar-custom">
	<div class="topbar">
		<div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

			<!-- Brand Logo -->
			<div class="logo-box">
				<!-- Brand Logo Light -->
				<a class='logo-light' href='index.html'>
					<h4 class="m-0">POS</h4>
				</a>

				<!-- Brand Logo Dark -->
				<a class='logo-dark' href='index.html'>
					<h4 class="m-0">POS</h4>
				</a>
			</div>

			<!-- Sidebar Menu Toggle Button -->
			<button class="button-toggle-menu">
				<i class="mdi mdi-menu"></i>
			</button>
		</div>

		<ul class="topbar-menu d-flex align-items-center gap-4">



			<style>
				#pos-mode a {
					border: 2px solid rgba(32, 183, 153, 1);
					padding: 4px 18px;
					font-size: 18px;
					font-weight: 600;
					color: rgba(32, 183, 153, 1);
					border-radius: .25rem;
				}
			</style>


			<li class="nav-link" id="pos-mode"> <a href="{{ route('admin.pos.index') }}">POS</a> </li>


			<li class="d-none d-md-inline-block">
				<a class="nav-link" href="#" data-bs-toggle="fullscreen">
					<i class="mdi mdi-fullscreen font-size-24"></i>
				</a>
			</li>


			<li class="nav-link" id="theme-mode">
				<i class="bx bx-moon font-size-24"></i>
			</li>

			<li class="dropdown">
				<a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
					<img src="{{ asset('backend') }}/assets/images/users/avatar-4.jpg" alt="user-image" class="rounded-circle">
					<span class="ms-1 d-none d-md-inline-block">
						{{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-end profile-dropdown ">
					<!-- item-->
					<div class="dropdown-header noti-title">
						<h6 class="text-overflow m-0">Welcome {{ Auth::user()->name }} !</h6>
					</div>
					<div class="dropdown-divider"></div>
					<!-- item-->
					<a class='dropdown-item notify-item' href='{{ route('admin.logout') }}'>
						<i class="fe-log-out"></i>
						<span>Logout</span>
					</a>

				</div>
			</li>

		</ul>
	</div>
</div>
