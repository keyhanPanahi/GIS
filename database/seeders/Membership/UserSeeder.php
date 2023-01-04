<?php

namespace Database\Seeders\Membership;

use App\Models\Membership\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => '0640779573',
                'password' => Hash::make('ali1234'),
                'first_name' => 'علی',
                'last_name' => 'پناهی',
                'sex_id' => 2,
                'mobile' => '09159387321',
                'status' => 1,
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
