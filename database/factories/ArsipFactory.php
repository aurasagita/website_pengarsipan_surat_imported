<?php

namespace Database\Factories;

use App\Models\Arsip;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArsipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Arsip::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_surat' => $this->faker->text(255),
            'judul' => $this->faker->text(255),
            'flie_path' => $this->faker->text(255),
            'waktu_pengarsipan' => $this->faker->dateTime(),
            'kategorisurat_id' => \App\Models\Kategorisurat::factory(),
        ];
    }
}
