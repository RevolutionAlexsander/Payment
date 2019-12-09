<?php

use Illuminate\Database\Seeder;

class TypeAutopaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('type_autopayments')->count() != 0) {
            return;
        }

        DB::table('type_autopayments')->insert([
            [
                'id' => 1,
                'name' => 'Через неделю',
                'number' => '7',
            ],
            [
                'id' => 2,
                'name' => 'Через месяц',
                'number' => '31',
            ],
        ]);
    }
}
