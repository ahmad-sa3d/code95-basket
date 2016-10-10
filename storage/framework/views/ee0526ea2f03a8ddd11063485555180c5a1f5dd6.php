<!-- LEFT SIDEBAR -->
<aside id="sidebar" class="sidebar">
	<!-- main-nav -->
	<div class="sidebar-scroll">
		<nav class="main-nav">
			
			<ul class="main-menu font-ge-ss-medium">
				<li <?php echo e(Request::is( 'admin/dashboard*' ) ? 'class=current' : ''); ?>>
					<a href="<?php echo e(URL::route( 'admin.dashboard' )); ?>">
						<i class="fa fa-dashboard fa-fw text-primary"></i>
						<span class="text">Dashboard</span>
					</a>
				</li>
				
				<li>
					<a href="#" class="js-sub-menu-toggle">
						<i class="fa fa-cog text-primary"></i>
						<span class="text">Settings</span>
						<i class="toggle-icon fa fa-angle-left"></i>
					</a>
					<ul class="sub-menu">
						<li <?php echo e(Request::is( 'admin/users*' ) ? 'class=current' : ''); ?>>
							<a href="<?php echo e(URL::route('admin.users.index')); ?>">
								<i class="fa fa-users"></i>
								<span class="text">Users</span>
							</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#" class="js-sub-menu-toggle">
						<i class="fa fa-edit text-primary"></i>
						<span class="text">Data Management</span>
						<i class="toggle-icon fa fa-angle-left"></i>
					</a>
					<ul class="sub-menu">
						<li <?php echo e(Request::is( 'admin/products*' ) ? 'class=current' : ''); ?>>
							<a href="<?php echo e(URL::route('admin.products.index')); ?>">
								<i class="fa fa-cubes"></i>
								<span class="text">Products</span>
							</a>
						</li>

						<li <?php echo e(Request::is( 'admin/categories*' ) ? 'class=current' : ''); ?>>
							<a href="<?php echo e(URL::route('admin.categories.index')); ?>">
								<i class="fa fa-sitemap"></i>
								<span class="text">Categories</span>
							</a>
						</li>
						
					</ul>
				</li>

				<li>
					<a href="#" class="js-sub-menu-toggle">
						<i class="fa fa-edit text-primary"></i>
						<span class="text">Transactions</span>
						<i class="toggle-icon fa fa-angle-left"></i>
					</a>
					<ul class="sub-menu ">
						<li <?php echo e(Request::is( 'admin/invoices*' ) ? 'class=current' : ''); ?>>
							<a href="<?php echo e(URL::route('admin.invoices.index')); ?>">
								<i class="fa fa-list-alt"></i>
								<span class="text">Invoices</span>
							</a>
						</li>

					</ul>
				</li>

				<li <?php echo e(Request::is( 'admin/docmentation*' ) ? 'class=current' : ''); ?>>
					<a href="<?php echo e(route( 'admin.doc' )); ?>">
						<i class="fa fa-clone text-primary"></i>
						<span class="text">Documentation </span>
					</a>
				</li>

			</ul>

		</nav>
		<!-- /main-nav -->
	</div>
</aside>
<!-- END LEFT SIDEBAR -->