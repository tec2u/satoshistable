<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_settings')->insert([
            [
                'id' => 1,
                'project_id' => 1,
                'background_menu' => '#2179cf',
                'background_top' => '#022a51',
                'background_footer' => '#022a51',
                'logo' => '/images/logo.png',
                'background_box' => '#2179cf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'text_btn_menu' => '#ffff',
                'background_btn_menu' => '#11477d',
                'background_btn_menu_hover' => '#133251',
            ],
            [
                'id' => 2,
                'project_id' => 2,
                'background_menu' => '#000000',
                'background_top' => '#000000',
                'background_footer' => '#ddd',
                'logo' => '/projetos/2/images/logo.png',
                'background_box' => '#000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'text_btn_menu' => '#ffff',
                'background_btn_menu' => '#000000',
                'background_btn_menu_hover' => '#000000',
            ],
        ]);
    }
}
