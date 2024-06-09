<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = [
        //     'urban landscapes',
        //     'rural landscapes',
        //     'seascapes',
        //     'mountain landscapes',
        //     'desert landscapes',
        //     'sunrise/sunset',
        //     'nightscapes',
        //     'seasonal landscapes',
        //     'weather phenomena',
        //     'wildlife',
        //     'flora',
        //     'street life',
        //     'cultural events',
        //     'architecture',
        //     'portraits',
        //     'candid photography',
        //     'documentary',
        //     'black and white',
        //     'abstract',
        //     'macro',
        // ];
        $categories = config('categories.categories');

        foreach ($categories as $key => $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category, '-');
            $newCategory->save();
        }
    }
}
