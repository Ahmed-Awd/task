<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStorageRequest;
use App\Models\Storage;
use App\Repositories\StorageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StorageController extends Controller
{

    private StorageRepositoryInterface $storageRepository;

    public function __construct(StorageRepositoryInterface $storageRepository)
    {
        $this->storageRepository = $storageRepository;
        $this->authorizeResource(Storage::class);
    }

    public function index(): JsonResponse
    {
        $data = $this->storageRepository->get();
        return response()->json(['data' => $data]);
    }


    public function store(Request $request): JsonResponse
    {
        return response()->json(['message' => "every user got one storage you cannot create another one"]);
    }


    public function show(Storage $storage): JsonResponse
    {
        $record = $this->storageRepository->show($storage);
        return response()->json(['record' => $record]);
    }


    public function update(UpdateStorageRequest $request, Storage $storage): JsonResponse
    {
        $data = $request->validated();
        $this->storageRepository->update($storage,$data);
        return response()->json(['message' => "storage updated successful"]);
    }


    public function destroy(Storage $storage): JsonResponse
    {
        $this->storageRepository->delete($storage);
        return response()->json(['message' => "storage deleted successful"]);
    }
}
