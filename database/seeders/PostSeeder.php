<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all();

        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        $kagawad = Author::where('email', 'kagawad.palparan@bulletin.test')->first();

        Post::create([
            'author_id'    => $kagawad->id,
            'title'        => 'Purok Palparan Clean-up Drive',
            'category'     => 'Announcement',
            'body'         => 'Magandang araw po sa lahat ng residente ng Purok Palparan. '
                            . 'May clean-up drive tayo sa harap ng barangay hall. '
                            . 'Magdala po ng walis at sako. Maraming salamat.',
            'is_published' => true,
            'is_pinned'    => true,
            'published_at' => '2026-03-12 08:00:00',
            'views'        => 0,
        ]);
    }
}