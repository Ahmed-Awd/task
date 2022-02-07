<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    private User $user;

    public function __construct(User  $user)
    {
        $this->user = $user;
    }

    public function get($type = "guest")
    {
        return $this->user->where('type',$type)->paginate(15);
    }

    public function show($user)
    {
        return $user;
    }

    public function create($data)
    {
        $data['password']  = Hash::make($data['password']);
        return $this->user->create($data);
    }

    public function update($user, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
    }

    public function delete($user)
    {
        $user->delete();
    }

    public function changeStatus($user)
    {
        $user->is_disabled = !$user->is_disabled;
        $user->save();
    }

}
