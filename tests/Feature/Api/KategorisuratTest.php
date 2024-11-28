<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Kategorisurat;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategorisuratTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_kategorisurats_list(): void
    {
        $kategorisurats = Kategorisurat::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.kategorisurats.index'));

        $response->assertOk()->assertSee($kategorisurats[0]->nama_kategori);
    }

    /**
     * @test
     */
    public function it_stores_the_kategorisurat(): void
    {
        $data = Kategorisurat::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.kategorisurats.store'), $data);

        $this->assertDatabaseHas('kategorisurats', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_kategorisurat(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();

        $data = [
            'nama_kategori' => $this->faker->text(255),
            'keterangan' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.kategorisurats.update', $kategorisurat),
            $data
        );

        $data['id'] = $kategorisurat->id;

        $this->assertDatabaseHas('kategorisurats', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_kategorisurat(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();

        $response = $this->deleteJson(
            route('api.kategorisurats.destroy', $kategorisurat)
        );

        $this->assertModelMissing($kategorisurat);

        $response->assertNoContent();
    }
}
