<!-- TOP BAR -->
        <div class="top-bar navbar-fixed-top">
            <div class="container">
                
                <div class="clearfix">
                    <a href="#" class="pull-left toggle-sidebar-collapse"><i class="fa fa-bars"></i></a>
                    <a href="<?php echo e(route('home')); ?>" class="pull-left topnav-icon"><i class="fa fa-home"></i></a>
                    
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
                                <div class="btn-group">
                                    <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo e(URL::asset( 'images/users/default_64.png' )); ?>" alt="User Avatar" />
                                        <span class="name font-ge-ss-medium padding-0-5"><?php echo e(Auth::user()->username); ?></span> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu font-size-p2" role="menu">
                                        <li>
                                            <a href="<?php echo e(route( 'admin.users.show', Auth::user()->id )); ?>">
                                                <i class="fa fa-user"></i>
                                                <span class="text padding-l5">Profile</span>
                                            </a>
                                        </li>
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
                            </div>
                            <!-- end logged user and the menu -->

                        </div>
                        <!-- end top-bar-right -->
                    </div>
                </div>

            </div>
            <!-- /container -->
        </div>