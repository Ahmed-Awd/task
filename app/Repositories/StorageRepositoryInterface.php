<?php

namespace App\Repositories;

interface StorageRepositoryInterface
{
    public function get();

    public function show($storage);

    public function create($data);

    public function update($storage, $data);

    public function delete($storage);
}
