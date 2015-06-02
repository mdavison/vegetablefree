<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        User::create([
            'id'            => 1,
            'username'      => 'morgan',
            'username_slug' => str_slug('morgan'),
            'email'         => 'morgan.davison@gmail.com',
            'password'      => bcrypt('password1234'),
            'is_admin'      => 1,
            'is_verified'   => 1

        ]);

        User::create([
            'id'            => 2,
            'username'      => 'John Q. Public',
            'username_slug' => str_slug('John Q. Public'),
            'email'         => 'john@example.com',
            'password'      => bcrypt('password1234'),
            'is_admin'      => 0,
            'is_verified'   => 1

        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}