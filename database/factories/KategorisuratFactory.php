<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Kategorisurat;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategorisuratFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kategorisurat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kategori' => $this->faker->text(255),
            'keterangan' => $this->faker->text(255),
        ];
    }
}
