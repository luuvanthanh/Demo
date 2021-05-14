<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = DB::table('categories')->get();
        if (!empty($categories)) {
            $date = date('Y-m-d H:i:s');
            foreach ($categories as $category) {
                $dataInsert = [
                    'name' => Str::random(10),
                    'content' => Str::random(10),
                    'category_id' => $category->id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
                DB::table('posts')->insert($dataInsert);
            }
        }
    }
}
