<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSignUpRequest;
use App\Services\Contracts\UserServiceInterface;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function signupUser(UserSignUpRequest $request)
    {
        $this->userService->create($request->all());
        return response()->json([
            'message' => 'Successfully Registered'
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();
 
            return response()->json([
                'message' => 'Successfully Login'
            ]);
        }

        throw new \Exception('Invalid Email Or Password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Successfully Logout'
        ]);
    }
}
