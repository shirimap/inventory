<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['whole','Measured'];
        foreach ($categories as $categories) {
            Category::create(['name' => $categories]);
       }
    }
}
