<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name'     => 'Ramesh Sharma',
                'location' => 'Indore, MP',
                'message'  => 'Visiting Kshipreshwar DHAM has been a truly transformative experience. The divine energy here is palpable, and the priests are incredibly knowledgeable and welcoming. My entire family felt blessed.',
                'rating'   => 5,
                'active'   => true,
            ],
            [
                'name'     => 'Priya Agarwal',
                'location' => 'Bhopal, MP',
                'message'  => 'The Navratri celebrations at this temple are beyond magnificent. The aarti, the decorations, the chanting — everything creates an atmosphere of pure devotion. We come every year without fail.',
                'rating'   => 5,
                'active'   => true,
            ],
            [
                'name'     => 'Suresh Patel',
                'location' => 'Ujjain, MP',
                'message'  => 'This temple is a spiritual haven. The architecture is breathtaking, and the serene environment allows you to truly connect with the divine. The booking system made our visit hassle-free.',
                'rating'   => 5,
                'active'   => true,
            ],
            [
                'name'     => 'Anita Verma',
                'location' => 'Ratlam, MP',
                'message'  => 'Our family\'s pooja here was conducted with great reverence and proper Vedic rituals. The pandit ji was extremely helpful. We felt the blessings of the divine throughout our visit.',
                'rating'   => 5,
                'active'   => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
