<?php


namespace App\Repositories;


use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemRepository implements ItemRepositoryInterface
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function get()
    {
        return $this->item->paginate(15);
    }

    public function show($item)
    {
        return $this->item->where('id',$item->id)->with('storage.user:id,name')->first();
    }

    public function create($data)
    {
        if(!isset($data['storage_id'])){
            $data['storage_id'] = Auth::user()->storage->id;
        }
        $data['photo'] = imageStore($data['photo']);
        return $this->item->create($data);
    }

    public function update($item, $data)
    {
        if (isset($data['photo'])) {
            $data['photo'] = imageStore($data['photo']);
        }
        $item->update($data);
    }

    public function delete($item)
    {
        $item->delete();
    }
}
