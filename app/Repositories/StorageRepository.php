<?php


namespace App\Repositories;


use App\Models\Storage;

class StorageRepository implements StorageRepositoryInterface
{
    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function get()
    {
        return $this->storage->paginate(15);
    }

    public function show($storage)
    {
        return $this->storage->where('id',$storage->id)->with('items:id,name,storage_id,photo')->first();
    }

    public function create($data)
    {
        return $this->storage->create($data);
    }

    public function update($storage, $data)
    {
        $storage->update($data);
    }

    public function delete($storage)
    {
        $storage->delete();
    }
}
