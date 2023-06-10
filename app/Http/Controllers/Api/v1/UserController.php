<?php

namespace App\Http\Controllers\Api\v1;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\loginRequest;
use App\Repository\UserRepositoryInterface;
use App\Repository\UserRepository;

class UserController extends Controller
{

    private $userRepository;

     public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    
    }

    public function register(RegisterRequest $request)
    {
    
       $data = $request->validated();

       $user = $this->userRepository->create($data);
       $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
        'user' => $user,
        'token' => $token,
       ]);

    }

    public function login(loginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            return response()->json([
                'user' => $user,
                'token' => $user->createToken('API Token')->plainTextToken,
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
