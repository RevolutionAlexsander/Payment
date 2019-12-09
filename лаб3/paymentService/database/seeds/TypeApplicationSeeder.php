<?php

use Illuminate\Database\Seeder;

class TypeApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('type_applications')->count() != 0) {
            return;
        }

        DB::table('type_applications')->insert([
            [
                'id' => 1,
                'name' => 'Одобрена',
            ],
            [
                'id' => 2,
                'name' => 'Не одобрена',
            ],
        ]);
    }
}
