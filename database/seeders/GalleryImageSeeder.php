<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'title'       => 'Main Temple Shrine',
                'description' => 'The sacred main shrine of Kshipreshwar DHAM adorned with flowers',
                'image_url'   => 'https://images.unsplash.com/photo-1545558014-8692077e9b5c?w=800',
                'category'    => 'temple',
                'featured'    => true,
                'order'       => 1,
            ],
            [
                'title'       => 'Morning Aarti Ceremony',
                'description' => 'Devotees participating in the sacred morning aarti',
                'image_url'   => 'https://images.unsplash.com/photo-1518638150340-f706e86654de?w=800',
                'category'    => 'events',
                'featured'    => true,
                'order'       => 2,
            ],
            [
                'title'       => 'Temple Festival',
                'description' => 'Annual Navratri festival celebrations at the temple',
                'image_url'   => 'https://images.unsplash.com/photo-1600420986489-21e2b3b5e2d0?w=800',
                'category'    => 'festivals',
                'featured'    => true,
                'order'       => 3,
            ],
            [
                'title'       => 'Sacred Ganga Ghat',
                'description' => 'Peaceful ghats near the temple for holy dip',
                'image_url'   => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?w=800',
                'category'    => 'nature',
                'featured'    => true,
                'order'       => 4,
            ],
            [
                'title'       => 'Temple Architecture',
                'description' => 'Intricate carvings and architecture of the ancient temple',
                'image_url'   => 'https://images.unsplash.com/photo-1563766012200-e52e94a78e0c?w=800',
                'category'    => 'temple',
                'featured'    => true,
                'order'       => 5,
            ],
            [
                'title'       => 'Prasad Distribution',
                'description' => 'Holy prasad being distributed to devotees after puja',
                'image_url'   => 'https://images.unsplash.com/photo-1609791049969-79a97088ab15?w=800',
                'category'    => 'events',
                'featured'    => true,
                'order'       => 6,
            ],
            [
                'title'       => 'Diwali Illumination',
                'description' => 'Temple beautifully lit during Diwali celebrations',
                'image_url'   => 'https://images.unsplash.com/photo-1605101100278-5d1deb2b6498?w=800',
                'category'    => 'festivals',
                'featured'    => false,
                'order'       => 7,
            ],
            [
                'title'       => 'Meditation Garden',
                'description' => 'Tranquil garden area for meditation and prayer',
                'image_url'   => 'https://images.unsplash.com/photo-1474440692490-2e83ae13ba29?w=800',
                'category'    => 'nature',
                'featured'    => false,
                'order'       => 8,
            ],
            [
                'title'       => 'Evening Prayer',
                'description' => 'Devotees engaged in evening prayer at the temple',
                'image_url'   => 'https://images.unsplash.com/photo-1538909248533-b3f59e30cfa6?w=800',
                'category'    => 'events',
                'featured'    => false,
                'order'       => 9,
            ],
        ];

        foreach ($images as $image) {
            GalleryImage::create($image);
        }
    }
}
