<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('login', 'Admin')->first();

        if (!$admin) {
            $admin = new User();
            $admin->name = 'Администратор';
            $admin->login = 'Admin';
            $admin->password = Hash::make('KorokNET');
            $admin->FIO = 'Администратор портала';
            $admin->number = '8(000)000-00-00';
            $admin->email = 'admin@koroki.ru';
            $admin->role = 'admin';
            $admin->save();
        }
    }
}
