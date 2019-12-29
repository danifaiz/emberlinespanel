<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => "Amusement"
            ],
            [
                'name' => "Graphics"
            ],
            [
                'name' => "Architecture"
            ],
            [
                'name' => "Interiors"
            ],
            [
                'name' => "Branding"
            ],
            [
                'name' => "Kiosks"
            ],
            [
                'name' => "UI/UX"
            ],
            [
                'name' => "3D"
            ],
            [
                'name' => "Animation"
            ],
            [
                'name' => "VM"
            ]
            
        ]);
    }
}
