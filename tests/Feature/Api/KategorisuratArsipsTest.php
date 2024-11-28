<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Arsip;
use App\Models\Kategorisurat;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategorisuratArsipsTest extends TestCase
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
    public function it_gets_kategorisurat_arsips(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();
        $arsips = Arsip::factory()
            ->count(2)
            ->create([
                'kategorisurat_id' => $kategorisurat->id,
            ]);

        $response = $this->getJson(
            route('api.kategorisurats.arsips.index', $kategorisurat)
        );

        $response->assertOk()->assertSee($arsips[0]->nomor_surat);
    }

    /**
     * @test
     */
    public function it_stores_the_kategorisurat_arsips(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();
        $data = Arsip::factory()
            ->make([
                'kategorisurat_id' => $kategorisurat->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.kategorisurats.arsips.store', $kategorisurat),
            $data
        );

        $this->assertDatabaseHas('arsips', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $arsip = Arsip::latest('id')->first();

        $this->assertEquals($kategorisurat->id, $arsip->kategorisurat_id);
    }
}
