<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{-- <link rel="icon" href="workspace.png"> --}}
        <title>Lala</title>
        <link rel="stylesheet" href="{{asset('css/signup.css')}}">
    </head>
    <body>
        <div class="sign_up">
            <div class="sign_up_form">
                <h1 class="web_name">LALA</h1>
                <h2 class="form_name">Sign Up</h2>
                <form action="{{ route('signup') }}" method="post">
                    @csrf
                    @error('name')
                    <div class="danger">{{ $message }}</div>
                    @enderror
                    <div class="input_box @error('name') isvalid @enderror">
                        <img class="form_icon" src="{{asset('images/user.png')}}">
                        <input type="text" name="name" placeholder="Username" class="input_bar" value="{{ old('name') }}">
                    </div>
                    @error('email')
                    <div class="danger">{{ $message }}</div>
                    @enderror
                    <div class="input_box @error('email') isvalid @enderror">
                        <img class="form_icon" src="{{asset('images/email.png')}}">
                        <input type="email" name="email" placeholder="Email" class="input_bar" value="{{ old('email') }}" >
                    </div>
                    @error('password')
                    <div class="danger">{{ $message }}</div>
                    @enderror
                    <div class="input_box @error('password') isvalid @enderror">
                        <img class="form_icon" src="{{asset('images/lock.png')}}">
                        <input type="password" name="password" placeholder="Password" class="input_bar" >
                    </div>
                    @error('password_confirmation')
                    <div class="danger">{{ $message }}</div>
                    @enderror
                    <div class="input_box @error('password_confirmation') isvalid @enderror">
                        <img class="form_icon" src="{{asset('images/lock.png')}}">
                        <input type="password" name="password_confirmation" placeholder="Confirm password" class="input_bar" >
                    </div>
                    <input type="submit" value="Sign up">
                </form>
            </div>
            <div class="sign_up_extra">
                <a href="{{ route('signin') }}" class="sign_in_link">SIGN IN</a>
                <p id="ques_acc">Already have an account?</p>
                <img class="background_pic" src="{{asset('images/background_pic.svg')}}">
            </div>
        </div>
    </body>
</html>
