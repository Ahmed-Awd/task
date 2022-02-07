<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Repositories\ItemRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{


    private ItemRepositoryInterface $itemRepository;

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->authorizeResource(Item::class);
    }

    public function index(): JsonResponse
    {
        $data = $this->itemRepository->get();
        return response()->json(['data' => $data]);
    }


    public function store(StoreItemRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->itemRepository->create($data);
        return response()->json(['message' => "Item created successful"]);
    }


    public function show(Item $item): JsonResponse
    {
        $record = $this->itemRepository->show($item);
        return response()->json(['record' => $record]);
    }


    public function update(UpdateItemRequest $request, Item $item): JsonResponse
    {
        $data = $request->validated();
        $this->itemRepository->update($item,$data);
        return response()->json(['message' => "Item updated successful"]);
    }


    public function destroy(Item $item): JsonResponse
    {
        $this->itemRepository->delete($item);
        return response()->json(['message' => "Item deleted successful"]);
    }
}
