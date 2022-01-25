<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Service\Auth\SignupService;

class SignupController extends Controller
{
    protected $signupService;
    public function __construct(SignupService $signupService)
    {
        $this->middleware('guest')->except('logout');
        $this->signupService = $signupService;
    }
    public function showSignupForm()
    {
        return view('pages/signup');
    }
    public function signUp(SignupRequest $request)
    {
        $this->signupService->create($request);
        return redirect()->route('boards');
    }
}
