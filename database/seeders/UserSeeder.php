<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $user = User::create([
                'name' => 'super admin',
                'email' => 'admin@task.com',
                'password' => bcrypt('123456'),
                'type' => "admin",
                'email_verified_at' => Carbon::now(),
            ]);
            $user->assignRole('admin');
        } catch (\Exception $exception) {
            //do nothing
        }
    }
}
