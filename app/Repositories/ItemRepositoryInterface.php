<?php

namespace App\Repositories;

interface ItemRepositoryInterface
{
    public function get();

    public function show($item);

    public function create($data);

    public function update($item, $data);

    public function delete($item);
}
