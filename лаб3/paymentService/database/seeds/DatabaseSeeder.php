<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TypeAccountTableSeeder::class);
        $this->call(TypeAutopaymentTableSeeder::class);
        $this->call(TypeApplicationSeeder::class);
        $this->call(AccountTableSeeder::class);
    }
}
