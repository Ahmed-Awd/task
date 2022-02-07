<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\StorageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private StorageRepositoryInterface $storageRepository;

    public function __construct(UserRepositoryInterface $userRepository, StorageRepositoryInterface $storageRepository)
    {
        $this->userRepository = $userRepository;
        $this->storageRepository = $storageRepository;
        $this->authorizeResource(User::class);
    }

    public function index(): JsonResponse
    {
        $data = $this->userRepository->get();
        return response()->json(['data' => $data], 200);
    }


    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['email_verified_at'] = Carbon::now()->timestamp;
        $user = $this->userRepository->create($data);
        $data['type'] == "admin" ?   $user->assignRole('admin') :  $user->assignRole('guest');
        $this->storageRepository->create(["name" => $user->name." storage","user_id" => $user->id]);
        return response()->json(['message' => "user created successful"]);
    }


    public function show(User $user): JsonResponse
    {
        $record = $this->userRepository->show($user);
        return response()->json(['record' => $record]);
    }


    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();
        $this->userRepository->update($user,$data);
        return response()->json(['message' => "user updated successful"]);
    }


    public function destroy(User $user): JsonResponse
    {
        $this->userRepository->delete($user);
        return response()->json(['message' => "user deleted successful"]);
    }
}
