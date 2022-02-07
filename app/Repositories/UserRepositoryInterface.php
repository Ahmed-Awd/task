<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function get($type = "guest");

    public function show($user);

    public function create($data);

    public function update($user, $data);

    public function delete($user);

    public function changeStatus($user);
}
