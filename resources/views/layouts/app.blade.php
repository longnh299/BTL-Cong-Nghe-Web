<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
            <link rel="icon" href="{{asset('images/web_logo.png')}}">
        <title>Lala</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <nav>
            <div id="nav-left" class="nav-items">
                <a href={{route('index')}}>
                    <img id="web-logo" src="{{asset('images/web_logo.png')}}">
                </a>
                <h1 id="web-title">LALA</h1>
            </div>
            <div id="nav-center" class="nav-items">
                <form method="post" action="{{route('board.search')}}" class="d-flex">
                    @csrf
                    <img id="search-icon" src="{{asset('images/search-icon.svg')}}">
                    <input type="text" name="query" placeholder="Search" id="search-bar"></input>
                </form>
            </div>
            <div id="nav-right" class="nav-items">
                <img id="user-avatar" src="{{asset('images/user-avatar.png')}}">
                <p class="text-white mx-4">{{Auth::user()->email}}</p>
                <a id="logout-button" href="{{route('logout')}}">Logout</a>
            </div>
        </nav>
        @yield('content')
        <script type="text/javascript" src={{asset('js/app.js')}}></script>
    </body>

</html>
