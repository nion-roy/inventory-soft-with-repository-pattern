<div class="main-menu">
	<!-- Brand Logo -->
	<div class="logo-box">
		<!-- Brand Logo Light -->
		<a class='logo-light' href='{{ route('admin.dashboard') }}'>
			<h4 class="text-white">Point Of Seles</h4>
		</a>

		<!-- Brand Logo Dark -->
		<a class='logo-dark' href='{{ route('admin.dashboard') }}'>
			<h4 class="text-white">POS</h4>
		</a>
	</div>

	<!--- Menu -->
	<div data-simplebar>
		<ul class="app-menu">

			<li class="menu-title">Menu</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.dashboard' ? 'active' : '' }}">
				<a class='menu-link waves-effect waves-light' href='{{ route('admin.dashboard') }}'>
					<span class="menu-icon"><i class="bx bx-home-smile"></i></span>
					<span class="menu-text"> Dashboards </span>
				</a>
			</li>

			<li class="menu-title">Components</li>

			<li class="menu-item">
				<a href="{{ route('admin.pos.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-adjust"></i></span>
					<span class="menu-text"> POS </span>
				</a>
			</li>


			{{-- <li class="menu-title">Transaction</li>

			<li class="menu-item">
				<a href="{{ route('admin.pos.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-notepad"></i></span>
					<span class="menu-text"> Expenses </span>
				</a>
			</li>

			<li class="menu-item">
				<a href="{{ route('admin.pos.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-package"></i></span>
					<span class="menu-text"> Sales List </span>
				</a>
			</li> --}}

			<li class="menu-title">Purchase</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.order.index' ? 'active' : '' }}">
				<a href="{{ route('admin.order.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-purchase-tag"></i></span>
					<span class="menu-text"> Orders </span>
				</a>
			</li>

			<li class="menu-title">Interface</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.category.index' || request()->route()->getName() == 'admin.category.create' || request()->route()->getName() == 'admin.category.edit' ? 'active' : '' }}">
				<a href="{{ route('admin.category.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-category"></i></span>
					<span class="menu-text"> Category </span>
				</a>
			</li>


			<li class="menu-item {{ request()->route()->getName() == 'admin.brand.index' || request()->route()->getName() == 'admin.brand.create' || request()->route()->getName() == 'admin.brand.edit' ? 'active' : '' }}">
				<a href="{{ route('admin.brand.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-bold"></i></span>
					<span class="menu-text"> Brands </span>
				</a>
			</li>


			<li class="menu-item {{ request()->route()->getName() == 'admin.product.index' || request()->route()->getName() == 'admin.product.create' || request()->route()->getName() == 'admin.product.edit' ? 'active' : '' }}">
				<a href="{{ route('admin.product.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-list-ul"></i></span>
					<span class="menu-text"> Product </span>
				</a>
			</li>


			<li class="menu-title">Manage Users</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.customer.index' || request()->route()->getName() == 'admin.customer.create' || request()->route()->getName() == 'admin.customer.edit' ? 'active' : '' }}">
				<a href="{{ route('admin.customer.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-user-plus"></i></span>
					<span class="menu-text"> Customers </span>
				</a>
			</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.user.index' || request()->route()->getName() == 'admin.user.create' || request()->route()->getName() == 'admin.user.edit' ? 'active' : '' }}">
				<a href="{{ route('admin.user.index') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-user"></i></span>
					<span class="menu-text">All Users</span>
				</a>
			</li>


			{{-- <li class="menu-item {{ request()->route()->getName() == 'admin.user.index' || request()->route()->getName() == 'admin.user.create' || request()->route()->getName() == 'admin.user.edit' ? 'active' : '' }}">
				<a href="#menuUsers" data-bs-toggle="collapse" class="menu-link waves-effect waves-light collapsed" aria-expanded="false">
					<span class="menu-icon"><i class="bx bxs-user"></i></span>
					<span class="menu-text"> Users </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse" id="menuUsers">
					<ul class="sub-menu">
						<li class="menu-item">
							<a class="menu-link" href="">
								<span class="menu-text">Roles & Permissions</span>
							</a>
						</li>
						<li class="menu-item {{ request()->route()->getName() == 'admin.user.index' || request()->route()->getName() == 'admin.user.create' || request()->route()->getName() == 'admin.user.edit' ? 'active' : '' }}">
							<a class="menu-link" href="{{ route('admin.user.index') }}">
								<span class="menu-text">All Users</span>
							</a>
						</li>
					</ul>
				</div>
			</li> --}}


			{{-- <li class="menu-title">Transaction</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.payment-method.index' || request()->route()->getName() == 'admin.payment-method.create' || request()->route()->getName() == 'admin.payment-method.edit' ? 'active' : '' }}">
				<a href="#menuTransaction" data-bs-toggle="collapse" class="menu-link waves-effect waves-light collapsed" aria-expanded="false">
					<span class="menu-icon"><i class="bx bxs-bank"></i></span>
					<span class="menu-text"> Accounts </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse {{ request()->route()->getName() == 'admin.payment-method.index' || request()->route()->getName() == 'admin.payment-method.create' || request()->route()->getName() == 'admin.payment-method.edit' ? 'show' : '' }}" id="menuTransaction">
					<ul class="sub-menu">
						<li class="menu-item">
							<a class="menu-link" href="index.html">
								<span class="menu-text"> Account </span>
							</a>
						</li>
						<li class="menu-item">
							<a class="menu-link" href="index.html">
								<span class="menu-text"> Deposit </span>
							</a>
						</li>
						<li class="menu-item">
							<a class="menu-link" href="index.html">
								<span class="menu-text"> Expenses </span>
							</a>
						</li>
						<li class="menu-item {{ request()->route()->getName() == 'admin.payment-method.index' || request()->route()->getName() == 'admin.payment-method.create' || request()->route()->getName() == 'admin.payment-method.edit' ? 'active' : '' }}">
							<a class="menu-link" href="{{ route('admin.payment-method.index') }}">
								<span class="menu-text"> Payment Methods </span>
							</a>
						</li>
					</ul>
				</div>
			</li> --}}

			<li class="menu-title">Settings</li>

			<li class="menu-item {{ request()->route()->getName() == 'admin.payment-method.index' || request()->route()->getName() == 'admin.payment-method.create' || request()->route()->getName() == 'admin.payment-method.edit' ? 'active' : '' }}">
				<a href="#menuSetting" data-bs-toggle="collapse" class="menu-link waves-effect waves-light collapsed" aria-expanded="false">
					<span class="menu-icon"><i class="bx bx-cog"></i></span>
					<span class="menu-text"> General Settings </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse {{ request()->route()->getName() == 'admin.payment-method.index' || request()->route()->getName() == 'admin.payment-method.create' || request()->route()->getName() == 'admin.payment-method.edit' ? 'show' : '' }}" id="menuSetting">
					<ul class="sub-menu">
						<li class="menu-item">
							<a class="menu-link" href="{{ route('admin.tax.index') }}">
								<span class="menu-text"> Tax </span>
							</a>
						</li>

						<li class="menu-item {{ request()->route()->getName() == 'admin.payment-method.index' || request()->route()->getName() == 'admin.payment-method.create' || request()->route()->getName() == 'admin.payment-method.edit' ? 'active' : '' }}">
							<a class="menu-link" href="{{ route('admin.payment-method.index') }}">
								<span class="menu-text"> Payment Methods </span>
							</a>
						</li>

					</ul>
				</div>
			</li>


			<li class="menu-item">
				<a href="#systemSetting" data-bs-toggle="collapse" class="menu-link waves-effect waves-light collapsed" aria-expanded="false">
					<span class="menu-icon"><i class="bx bx-cog"></i></span>
					<span class="menu-text"> System Settings </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse" id="systemSetting">
					<ul class="sub-menu">
						<li class="menu-item">
							<a class="menu-link" href="{{ route('admin.email.edit') }}">
								<span class="menu-text"> Email</span>
							</a>
						</li>
					</ul>
				</div>
			</li>



			<li class="menu-item">
				<a href="{{ route('admin.logout') }}" class="menu-link waves-effect waves-light">
					<span class="menu-icon"><i class="bx bx-exit"></i></span>
					<span class="menu-text"> Logout </span>
				</a>
			</li>

		</ul>
	</div>
</div>
