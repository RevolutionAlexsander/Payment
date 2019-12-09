<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->count() != 0) {
            return;
        }

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Банк',
                'email' => 'bank@mail.ru',
                'password' => Hash::make('123456'),
                'api_token' => Str::random(60),
                'phone' => null,
                'created_at' => null,
                'updated_at' => null,
            ]

        ]);
    }
}
