<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{ route('home') }}" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edukate</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                @foreach ($links['links'] as $link)
                    @if (!($link['name'] == 'Pages'))
                        <a href="{{ route($link['route']) }}"
                            class="nav-item nav-link  {{ !Route::is($link['active']) ?: 'active' }} ">{{ __($link['name']) }}</a>
                    @else
                        <div class="nav-item dropdown">
                            {{-- <span>akjfdkajsdlfjlsk {{__('Home')}}</span> --}}
                            <a href="#"
                                class="nav-link dropdown-toggle {{ !Route::is($link['active']) ?: 'active' }}"
                                data-toggle="dropdown">{{ __($link['name']) }}</a>
                            <div class="dropdown-menu m-0">
                                @foreach ($links['pages'] as $page)
                                    <a href="{{ route($page['route']) }}"
                                        class="dropdown-item {{ !Route::is($page['active']) ?: 'active' }}">{{ __($page['name']) }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @if (!(Auth::user() || Auth::guard('admin')->user() || Auth::guard('instructor')->user()))
                <a href="{{ route('login') }}"
                    class="btn btn-primary py-2 px-4 d-none d-lg-block">{{ __('Join Us') }}</a>
            @else
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <a onclick="this.parentNode.submit()"
                        class="btn btn-primary py-2 px-4 d-none d-lg-block">{{ __('Logout') }}</a>
                </form>
            @endif
        </div>
    </nav>
</div>
