<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/signin.css')}}" />
    <title>Sign in Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form class="sign-in-form" action="{{route('signin.authenticate')}}" method="post">
                    @csrf
                    <h1 class="name-project">LALA</h1>
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Email" name='email' value="{{old('email')}}" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name='password' />
                    </div>
                    @if (Session::has('error'))
                    <div>
                        <p>
                            {{ Session::get('error') }}
                        </p>
                    </div>
                    @endif
                    <input type="submit" value="Login" class="btn solid" />
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    {{-- <button class="btn transparent" id="sign-up-btn"> --}}
                        <a href="{{ route('signup') }}" class="btn transparent px-32 py-8" id="sign-up-btn">Sign up</a>
                    {{-- </button> --}}
                    <p>
                        This is LALA website , Create a new account to visit our website
                    </p>
                </div>
                <img src="{{asset('images/undraw_Team_spirit_re_yl1v.svg')}}" class="image" />
            </div>
        </div>
    </div>
</body>

</html>
