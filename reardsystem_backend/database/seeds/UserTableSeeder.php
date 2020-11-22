<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'fname' => "Admin",
           'lname' => "Admin",
           'bday' => date('Y-m-d', strtotime('2000-08-05')),
           'login' => "admin",
           'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
    }
}
