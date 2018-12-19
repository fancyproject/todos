<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::where('email','admin@admin.com')->first();
        if($user) {
            return;
        }
//        if($user)

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
    }
}
