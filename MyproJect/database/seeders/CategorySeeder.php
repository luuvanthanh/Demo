<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'PHP'],
            ['name' => 'CSS'],
            ['name' => 'JS']
        ];

        DB::table('categories')->insert($data);
    }
}