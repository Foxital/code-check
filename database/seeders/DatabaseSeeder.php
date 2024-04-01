<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'sakul',
            'email' => 'sakul@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'sakul',
            'email' => 'sakulfr@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('settings')->insert([
            'page' => 'feature image',
            'val' => '',
            'status' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'page' => 'headscript',
            'val' => '',
            'status' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'page' => 'bodyscript',
            'val' => '',
            'status' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'page' => 'referral',
            'val' => '100',
            'status' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'page' => 'login bonus',
            'val' => '100',
            'status' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'page' => 'for use',
            'val' => '10',
            'status' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('settings')->insert([
            'page' => 'Shipping Over Price',
            'val' => '1000',
            'status' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
