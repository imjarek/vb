<aside class="main-sidebar">
    <div class="sidebar">
        <div class="user-panel text-center">
            <div class="image">
                <img src="{{ Auth::user()->urlLogo() }}" style="width: 50px" class="img-circle" alt="">
            </div>
            <div class="info">
                <p>{{ Auth::user()->fio() }}</p>
                {{--<a href="#" onclick="event.preventDefault()">{{ Auth::user()->role }}</a>--}}
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">{{ mb_strtoupper(trans('sidebar.menu')) }}</li>

            <li class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ trans('sidebar.home') }}</span>
                </a>
            </li>

            <li class="{{ strpos(Route::currentRouteName(), 'bots.vk') === 0 ? 'active' : '' }}">
                <a href="{{ route('bots.vk') }}">
                    <i class="fa fa-vk"></i> <span>{{ trans('sidebar.vk_bots') }}</span>
                </a>
            </li>

            <li class="{{ Route::currentRouteName() === 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile') }}">
                    <i class="fa fa-address-card-o"></i> <span>{{ trans('sidebar.profile') }}</span>
                </a>
            </li>

            @if(Auth::user()->hasRole('admin'))

                <li class="header">{{ mb_strtoupper(trans('sidebar.administration')) }}</li>

                <li class="{{ strpos(Route::currentRouteName(), 'users') !== false ? 'active' : '' }}">
                    @if($countUsersNew = $VC_MainSidebar->get('countUsersNew', 0))
                        <a href="{{ route('users.new') }}">
                            <i class="fa fa-users"></i> <span>{{ trans('sidebar.users') }}</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-yellow">{{ $countUsersNew }}</small>
                            </span>
                        </a>
                    @else
                        <a href="{{ route('users') }}">
                            <i class="fa fa-users"></i> <span>{{ trans('sidebar.users') }}</span>
                        </a>
                    @endif
                </li>

                <li class="{{ strpos(Route::currentRouteName(), 'admin.bots.vk') !== false ? 'active' : '' }}">
                    <a href="{{ route('admin.bots.vk.trash') }}">
                        <i class="fa fa-trash"></i> <span>{{ trans('sidebar.vk_trash') }}</span>
                        @if($countVkTrash = $VC_MainSidebar->get('countVkTrash', 0))
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red">{{ $countVkTrash }}</small>
                            </span>
                        @endif
                    </a>
                </li>

            @endif


            {{--<li class="header">LABELS</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle color-green"></i> <span>Important</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle color-red"></i> <span>Warning</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle color-yellow"></i> <span>Information</span></a></li>--}}
        </ul>
    </div>
</aside>