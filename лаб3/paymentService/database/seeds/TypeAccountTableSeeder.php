<?php

use Illuminate\Database\Seeder;

class TypeAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('type_accounts')->count() != 0) {
            return;
        }

        DB::table('type_accounts')->insert([
            [
                'id' => 1,
                'name' => 'Дебитовый',
            ],
            [
                'id' => 2,
                'name' => 'Кредитовый',
            ],
        ]);
    }
}
