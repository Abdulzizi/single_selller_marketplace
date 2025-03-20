<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'id' => '9ad1d6ab-e234-433c-871b-73a8b7ff3a61',
        //     'user_roles_id' => 'f9e49521-4a4a-4b3b-b0ca-73f36c8aef47',
        //     'name' => 'admin',
        //     'email' => 'jawadazizi052@gmail.com',
        //     'password' => Hash::make('devGanteng'),
        //     'updated_security' => date('Y-m-d H:i:s'),
        // ]);

        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'user_roles_id' => 'f9e49521-4a4a-4b3b-b0ca-73f36c8aef47',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('devGanteng'),
            'updated_security' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'id' => '375dfe0f-6ccf-4b78-b38f-ed17eb50d0c3',
            'user_roles_id' => 'c3b33c4a-8f7c-49c4-aece-5b4f6f4a5f5e',
            'name' => 'client 1',
            'email' => 'cli@cli.com',
            'password' => Hash::make('devGanteng'),
            'updated_security' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'id' => '9c6a6f4d-51e4-45a8-8a7c-5a9c9d6c2c3c',
            'user_roles_id' => '75d055eb-f4a4-4f47-acbd-d202b19a71fc',
            'name' => 'Seller',
            'email' => 'seller@sel.co.id',
            'password' => Hash::make('devGanteng'),
            'updated_security' => date('Y-m-d H:i:s'),
        ]);

        DB::table('user_roles')->insert([
            'id' => 'f9e49521-4a4a-4b3b-b0ca-73f36c8aef47',
            'name' => 'Super Admin',
            'access' => json_encode([
                'user' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true,
                ],
                'roles' => [
                    'view' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true,
                ],
            ]),
        ]);

        DB::table('user_roles')->insert([
            'id' => '75d055eb-f4a4-4f47-acbd-d202b19a71fc',
            'name' => 'Seller',
            'access' => json_encode([
                'user' => [
                    'view' => true,
                    'create' => true,
                    'update' => false,
                    'delete' => false,
                ],
                'roles' => [
                    'view' => true,
                    'create' => false,
                    'update' => false,
                    'delete' => false,
                ],
            ]),
        ]);

        DB::table('user_roles')->insert([
            'id' => 'c3b33c4a-8f7c-49c4-aece-5b4f6f4a5f5e',
            'name' => 'Client',
            'access' => json_encode([
                'user' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false,
                ],
                'roles' => [
                    'view' => false,
                    'create' => false,
                    'update' => false,
                    'delete' => false,
                ],
            ]),
        ]);
    }
}
