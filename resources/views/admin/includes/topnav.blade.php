<!-- TOP BAR -->
        <div class="top-bar navbar-fixed-top">
            <div class="container">
                
                <div class="clearfix">
                    <a href="#" class="pull-left toggle-sidebar-collapse"><i class="fa fa-bars"></i></a>
                    <a href="{{ route('home') }}" class="pull-left topnav-icon"><i class="fa fa-home"></i></a>
                    
                    <!-- logo -->
                    <div class="pull-left logo">
                        {{-- <a href="#"><img src="{{ URL::asset( 'images/users/kingadmin-logo-white.png' ) }}" alt="Dr Shady Pharmacy" /></a> --}}
                        <h1 class="sr-only">Shop</h1>
                    </div>
                    <!-- end logo -->

                    <div class="pull-right">
                        
                        <!-- top-bar-right -->
                        <div class="top-bar-right">
                            
                            <div class="notifications">
                                <ul>
                                    <!-- notification: general -->
                                    <li class="notification-item general">
                                        <div class="btn-group">
                                            
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-bell"></i>
                                                @if( $count = count( Auth::user()->unreadNotifications ) )
                                                    <span class="count">{{ $count }}</span>
                                                 @endif
                                                <span class="circle"></span>
                                            </a>
                                           
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="notification-header">
                                                    <span class="">Notifications</span>
                                                </li>
                                                <li class="notifications-wraper">
                                                    <ul>
                                                        @if( $count )
                                                            @foreach( Auth::user()->unreadNotifications as $notification )
                                                                @include( 'admin.includes.notifications.' . snake_case( class_basename( $notification->type ) ), [ 'notification' => $notification ] )
                                                                {{-- <li>
                                                                    <a href="#">
                                                                        <i class="fa fa-comment green-font"></i>
                                                                        <span class="text">New invoice has been made</span>
                                                                        <span class="timestamp">1 minute ago</span>
                                                                    </a>
                                                                </li> --}}
                                                            @endforeach
                                                        @else
                                                            <li class="no-notifications text-center">
                                                                <span href="#">
                                                                    <span class="text">No New Notifications</span>
                                                                </span>
                                                            </li>
                                                        @endif

                                                    </ul>

                                                    <div class="ajax-loader"></div>
                                                </li>
                                                @if( $count )
                                                    <li class="notification-footer">
                                                        <a href="#" id="clear-notifications">Mark As Read</a>
                                                    </li>
                                                @endif   
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- end notification: general -->
                                </ul>
                            </div>

                            <!-- logged user and the menu -->
                            <div class="logged-user">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ URL::asset( 'images/users/default_64.png' ) }}" alt="User Avatar" />
                                        <span class="name font-ge-ss-medium padding-0-5">{{ Auth::user()->username }}</span> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu font-size-p2" role="menu">
                                        <li>
                                            <a href="{{ route( 'admin.users.show', Auth::user()->id ) }}">
                                                <i class="fa fa-user"></i>
                                                <span class="text padding-l5">Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <form id="logout-form" class="hidden form-inline" method="POST" action="{{ url('/logout') }}">
                                                {{ csrf_field() }}
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