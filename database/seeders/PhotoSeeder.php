<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = config('photos.photos');

        foreach ($photos as $photo) {
            $newPhoto = new Photo($photo);
            $newPhoto['slug'] = Str::slug($photo['title'], '-');
            $newPhoto->save();

        }
    }
}
