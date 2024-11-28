<?php

namespace Database\Seeders;

use App\Models\Arsip;
use Illuminate\Database\Seeder;

class ArsipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arsip::factory()
            ->count(5)
            ->create();
    }
}
