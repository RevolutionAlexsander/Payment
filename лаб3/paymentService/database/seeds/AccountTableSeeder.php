<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('accounts')->count() != 0) {
            return;
        }

        DB::table('accounts')->insert([
            [
                'id' => 1,
                'number_account' => 29121998,
                'frozen' => 0,
                'debt' => 0,
                'balance' => 100000,
                'date_opening' => \Carbon\Carbon::now(),
                'date_closing' => \Carbon\Carbon::now()->addYears(3),
                'type_credit_id' => null,
                'user_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ]

        ]);
    }
}
