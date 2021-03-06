<!-- TOP BAR -->
        <div class="top-bar navbar-fixed-top">
            <div class="container">
                 
                <div class="clearfix">
                    <a href="<?php echo e(route('home')); ?>" class="topnav-icon">
                        <i class="fa fa-home"></i>
                    </a>
                    <a href="#" class="btn btn-link dropdown-toggle basket" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="count red-bg"><?php echo e($order ? $order->quantity : 0); ?></span>

                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <?php echo $__env->make( 'includes.basket' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </ul>
                    
                    <!-- logo -->
                    <div class="pull-left logo">
                        <h1 class="sr-only">Shop</h1>
                    </div>
                    <!-- end logo -->

                    <div class="pull-right">
                        
                        <!-- top-bar-right -->
                        <div class="top-bar-right">
                            
                            <!-- logged user and the menu -->
                            <div class="logged-user">
                                <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                    <span class="name font-ge-ss-medium padding-0-5"><?php echo e(Auth::user()->username); ?></span> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu font-size-p2" role="menu">
                                    <?php if( Auth::user()->is_admin ): ?>
                                        <li>
                                            <a href="<?php echo e(route( 'admin.dashboard' )); ?>" class="">
                                                <span class="glyphicon glyphicon-cog"></span>
                                                <span class="name font-ge-ss-medium padding-0-5">Admin CP</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                     <li>
                                        <form id="logout-form" class="hidden form-inline" method="POST" action="<?php echo e(url('/logout')); ?>">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                        <a href="#" onclick="event.preventDefault(); event.stopPropagation(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i>
                                            <span class="text padding-l5">Logout</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- end logged user and the menu -->

                        </div>
                        <!-- end top-bar-right -->
                    </div>
                </div>

            </div>
            <!-- /container -->
        </div>