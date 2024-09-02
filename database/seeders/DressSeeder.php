<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Dress;
use Illuminate\Database\Seeder;

class DressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dress::factory()
            ->count(200)
            ->create();
    }
}
