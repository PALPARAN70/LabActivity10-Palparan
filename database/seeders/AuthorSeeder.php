<?php

namespace Database\Seeders;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Author::create([
        'name'     => 'Kagawad Luis Palparan',              // ← your real name
        'position' => 'Kagawad',
        'email'    => 'kagawad.palparan@bulletin.test',     // ← your lastname, lowercase
    ]);

    Author::factory()->count(4)->create();
}
}
