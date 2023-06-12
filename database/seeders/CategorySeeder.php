<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // use Query Builder
        for ($i = 1 ; $i <=10; $i++) {
        DB::table('categories')->insert([
            'name' => 'category' . $i,
            'created_at' => now(),
        ]);
    }
    }
}
