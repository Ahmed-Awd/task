<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\StorageRepository;
use App\Repositories\StorageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private StorageRepositoryInterface $storageRepository;


    public function __construct(UserRepositoryInterface $userRepository,StorageRepositoryInterface $storageRepository)
    {
        $this->userRepository = $userRepository;
        $this->storageRepository = $storageRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['type'] = "guest";
        $user = $this->userRepository->create($data);
        $user->assignRole('guest');
        $this->storageRepository->create(["name" => $user->name." storage","user_id" => $user->id]);
        $user->sendEmailVerificationNotification();
        return response()->json(["message" => "account created successfully ,please activate it via link in email"]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'],"type" => $data['role']])) {
            $user = User::where('email', $data['email'])->first();
            if ($user->is_disabled == true) {
                return response()->json(['message' => "your account is disabled by admin , please contact us"], 401);
            }
            if ($user->email_verified_at == null) {
                return response()->json(['message' => "please verify your account first"], 401);
            }
            $token = $user->createToken('auth_token', ['*'], $data['notification_token'] ?? null)->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' =>$user ,
                'role' =>$data['role'] ,
            ]);
        }
        return response()->json(['message' => "invalid login details"], 401);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update([
                "password" => bcrypt($data['password']),
            ]);
            return response()->json(['message' =>"password changed successfully"]);
        }
        return response()->json(['message' => "invalid old password"], 403);
    }
}
