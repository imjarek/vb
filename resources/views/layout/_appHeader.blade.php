<header class="main-header">
    <a href="{{ route('home') }}" class="logo">
        <span class="logo-mini">
            <img src="{{ asset('img/mini-logo.png') }}" alt="">
            {{--<b>CH</b>B--}}
        </span>
        <span class="logo-lg">
            <img src="{{ asset('img/logo.png') }}" alt="">
            <b>Chat</b>Bot
        </span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="pe-7s-keypad"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="flag-icon {{ str_replace(['en', 'ru'], ['flag-icon-us', 'flag-icon-ru'], LaravelLocalization::getCurrentLocale()) }} flag-icon-squared" style="width: 1.5em"></i>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{$localeCode}}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, []) }}">
                                    <i class="flag-icon {{ $properties['icon'] }} flag-icon-squared"></i>
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-config"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('profile') }}"><i class="pe-7s-user"></i> {{ trans('user.profile') }}</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                                {{ csrf_field() }}
                            </form>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="pe-7s-power"></i> {{ trans('user.logout') }}
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>