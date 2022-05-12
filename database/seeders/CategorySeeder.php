<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $count = 100000;
      for ($i = 0; $i < $count; $i++) {
          $category = new Category();
          $cat_name = Str::random();
          $category->title = $cat_name;
          $category->slug = $cat_name.$i;
          $category->save();
      }
    }
}
