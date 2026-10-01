<?php

namespace Database\Seeders;

use App\Enums\Anime\StatusEnum;
use App\Enums\Enums\Anime\TypeEnum;
use App\Models\Anime;
use Illuminate\Database\Seeder;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anime::factory()->create([
            'title' => 'Black Clover',
            'slug'  => 'black-clover',
            'status' => StatusEnum::Upcoming,
            'type' => TypeEnum::TV,
        ]);
    }
}
