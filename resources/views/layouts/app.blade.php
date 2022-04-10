<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('javascript')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/css/layout.css" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- 2カラムに変更 --}}
        <main class="">
           <div class="row">
                <div class="col-sm-12 col-md-2 p-0">
                    <div class="card">
                        <div class="card-header">
                            スケジュール一覧
                        </div>

                        <div class="card-body my-card-body">
                            @foreach ($travels as $travel)
                            <a href="/?travel={{$travel['title']}}" class="card-text d-block">{{ $travel['title'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                    <div class="col-sm-12 col-md-6 p-0 my-card-body">
                        <div class="card  my-card-body">
                        <div class="card-header d-flex justify-content-between">
                            旅行プラン
                        </div>
                        <div class="card-body my-card-body">
                            <p class="card-text">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Googlemapを使う</th>
                                        <th scope="col">行き先</th>
                                        <th scope="col">内容</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($plans as $plan)
                                    <tr>
                                        <td>
                                           <a href="https://www.google.com/maps/search/?api=1&query={{ $plan['title'] }}">MAP</a>
                                        </td>
                                        <td>
                                        <a href="/edit/{{$plan['id']}}" class="card-text d-block">
                                            {{ $plan['title'] }}
                                        </a>
                                        </td>
                                            <td>
                                                <p class="card-text d-block">
                                                {{ $plan['content'] }}
                                                </p>
                                            </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </p>
                        </div>
                        </div>
                    </div>
                <div class="col-sm-12 col-md-4 p-0">
                @yield('content')
                </div>
           </div>
        </main>
    </div>
</body>
</html>
