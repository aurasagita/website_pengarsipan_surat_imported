<?php

namespace Database\Seeders;

use App\Models\Kategorisurat;
use Illuminate\Database\Seeder;

class KategorisuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategorisurat::factory()
            ->count(5)
            ->create();
    }
}
