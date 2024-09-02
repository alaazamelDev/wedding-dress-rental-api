<?php

namespace Database\Seeders;

use App\Infrastructure\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->create([
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@example.com',
            'birth_date' => Carbon::createFromDate(2001),
        ]);

    }
}
