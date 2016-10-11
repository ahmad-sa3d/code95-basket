<?php $__env->startSection( 'title', 'Documentation' ); ?>

<?php $__env->startSection( 'content' ); ?>
	
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<i class="fa fa-clone"></i>
				Navigation Sidebar
			</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<figure class="thumbnail">
						<img src="<?php echo e(url()->asset('images/documentation/sidebar.png')); ?>" alt="" class="">
					</figure>
				</div>
				<div class="col-sm-8">
					<h4 class="label label-primary font-size-p1">Dashboard</h4>
					<p class="padding-l10">
						Contains Basic System <code>statistics</code>
					</p>

					<h4 class="label label-primary font-size-p1">Settings</h4>
					<p class="padding-l10">
						This Section Contains Application Settings,
						You can Manage System <code>Users</code> From This Section
					</p>

					<h4 class="label label-primary font-size-p1">Data management</h4>
					<p class="padding-l10">
						This Section Contains Application Data Settings,
						Like <code>Products</code> and <code>Categories</code>
					</p>

					<h4 class="label label-primary font-size-p1">Transactions</h4>
					<p class="padding-l10">
						This Section Contains Financial Transactions,
						Like <code>Invoices</code>
					</p>
				</div>
			</div>
		</div>
	</div>

	
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4 class="panel-title">
				<i class="fa fa-dashboard"></i>
				Dashboard
			</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<figure class="thumbnail">
						<img src="<?php echo e(url()->asset('images/documentation/dashboard.png')); ?>" alt="" class="">
					</figure>
				</div>
				<div class="col-sm-8">
					<h4 class="label label-primary font-size-p1">Dashboard</h4>
					<p class="padding-l10">
						Contains Day System <code>statistics</code>
						<ul class="list-group">
							
							<li class="list-group-item">
								How Many sales
							</li>

							<li class="list-group-item">
								Top Seller User, How many And Total Money Of sales he had done for today
							</li>

							<li class="list-group-item">
								How Many Diffrent Products Are Sold
							</li>

							<li class="list-group-item">
								Top 5 Products, And how many and Total money Of its Sales 
							</li>

							<li class="list-group-item">
								Critical Products Status, For out of stock products and products that its instock Quantity is 5 or less.
							</li>
						</ul>
					</p>

				</div>
			</div>
		</div>
	</div>

	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				<i class="fa fa-user"></i>
				Settings / User
			</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<figure class="thumbnail">
						<img src="<?php echo e(url()->asset('images/documentation/users.png')); ?>" alt="" class="">
					</figure>
				</div>
				<div class="col-sm-8">
					<p class="">
						Listing And Managing <code>Users</code>
						<ul class="list-group">
							
							<li class="list-group-item">
								<code>Plus Icon</code> To Add new user
							</li>

							<li class="list-group-item">
								<code>User Icon</code> To Display User Information
							</li>

							<li class="list-group-item">
								<code>Edit Icon</code> To Edit User, And User Settings as activating, make admin
							</li>

							<li class="list-group-item">
								<code>Trash Icon</code> To Delete User, Only if user has no activity related to him
								<br />
								Note that you cannot delete yourself
							</li>
						</ul>
					</p>

				</div>
			</div>
		</div>
	</div>

	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4 class="panel-title">
				<i class="fa fa-cubes"></i>
				Data Management / Products
			</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<figure class="thumbnail">
						<img src="<?php echo e(url()->asset('images/documentation/products.png')); ?>" alt="" class="">
					</figure>
				</div>
				<div class="col-sm-8">
					<p class="">
						Listing And Managing <code>Products</code>
						<ul class="list-group">
							
							<li class="list-group-item">
								<code>Plus Icon</code> To Add new product, Note that Product must have at least one category, and may not have discount value
							</li>

							<li class="list-group-item">
								<code>Products Icon</code> To Display Product Information
							</li>

							<li class="list-group-item">
								<code>Edit Icon</code> To Edit Product, Remember that Product must have at least one category, and may not have discount value
							</li>

							<li class="list-group-item">
								<code>Trash Icon</code> To Delete Product, Only if product has no activity related to it, Like Sales
							</li>
						</ul>
					</p>

				</div>
			</div>
		</div>
	</div>

	
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h4 class="panel-title">
				<i class="fa fa-sitemap"></i>
				Data Management / Categories
			</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<figure class="thumbnail">
						<img src="<?php echo e(url()->asset('images/documentation/categories.png')); ?>" alt="" class="">
					</figure>
				</div>
				<div class="col-sm-8">
					<p class="">
						Listing Categories In Its Hirearchy And Managing <code>Categories</code>
						<ul class="list-group">
							
							<li class="list-group-item">
								<code>Plus Icon</code> To Add new Category
							</li>

							<li class="list-group-item">
								<code>Sitemap Icon</code> To Display Category Information
							</li>

							<li class="list-group-item">
								<code>Edit Icon</code> To Edit Category .

							<li class="list-group-item">
								<code>Trash Icon</code> To Delete Category, Only if Category has no Products or Sub Categories
							</li>
						</ul>
					</p>

				</div>
			</div>
		</div>
	</div>

	
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h4 class="panel-title">
				<i class="fa fa-money"></i>
				Transactions / Invoices
			</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-4">
					<figure class="thumbnail">
						<img src="<?php echo e(url()->asset('images/documentation/invoices.png')); ?>" alt="" class="">
					</figure>
				</div>
				<div class="col-sm-8">
					<p class="">
						Listing And Displaying <code>Invoices</code>
						<ul class="list-group">
							
							<li class="list-group-item">
								<code>Money Icon</code> To View Invoice Details, and there You Can Print Invoice Only By Pressing Print Icon
							</li>

						</ul>
					</p>

				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_master' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>