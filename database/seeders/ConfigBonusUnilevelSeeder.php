<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigBonusUnilevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'level' => 1, 'value_percent' => 20.00],
            ['id' => 2, 'level' => 2, 'value_percent' => 15.00],
            ['id' => 3, 'level' => 3, 'value_percent' => 10.00],
            ['id' => 4, 'level' => 4, 'value_percent' => 5.00],
            ['id' => 5, 'level' => 5, 'value_percent' => 5.00],
            ['id' => 6, 'level' => 6, 'value_percent' => 5.00],
            ['id' => 7, 'level' => 7, 'value_percent' => 2.00],
            ['id' => 8, 'level' => 8, 'value_percent' => 2.00],
            ['id' => 9, 'level' => 9, 'value_percent' => 2.00],
            ['id' => 10, 'level' => 10, 'value_percent' => 2.00],
            ['id' => 11, 'level' => 11, 'value_percent' => 2.00],
            ['id' => 12, 'level' => 12, 'value_percent' => 2.00],
            ['id' => 13, 'level' => 13, 'value_percent' => 2.00],
            ['id' => 14, 'level' => 14, 'value_percent' => 2.00],
            ['id' => 15, 'level' => 15, 'value_percent' => 1.00],
            ['id' => 16, 'level' => 16, 'value_percent' => 1.00],
            ['id' => 17, 'level' => 17, 'value_percent' => 1.00],
            ['id' => 18, 'level' => 18, 'value_percent' => 1.00],
            ['id' => 19, 'level' => 19, 'value_percent' => 1.00],
            ['id' => 20, 'level' => 20, 'value_percent' => 1.00],
        ];

        foreach ($data as $item) {
            DB::table('config_bonusunilevel')->updateOrInsert(
                ['id' => $item['id']], // Condição para identificar o registro
                [
                    'level' => $item['level'],
                    'value_percent' => $item['value_percent'],
                    'user_activated' => 0,
                    'status' => 1,
                    'minimum_users' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
