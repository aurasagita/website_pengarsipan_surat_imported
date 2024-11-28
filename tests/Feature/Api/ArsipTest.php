<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Arsip;

use App\Models\Kategorisurat;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArsipTest extends TestCase
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
    public function it_gets_arsips_list(): void
    {
        $arsips = Arsip::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.arsips.index'));

        $response->assertOk()->assertSee($arsips[0]->nomor_surat);
    }

    /**
     * @test
     */
    public function it_stores_the_arsip(): void
    {
        $data = Arsip::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.arsips.store'), $data);

        $this->assertDatabaseHas('arsips', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_arsip(): void
    {
        $arsip = Arsip::factory()->create();

        $kategorisurat = Kategorisurat::factory()->create();

        $data = [
            'nomor_surat' => $this->faker->text(255),
            'judul' => $this->faker->text(255),
            'flie_path' => $this->faker->text(255),
            'waktu_pengarsipan' => $this->faker->dateTime(),
            'kategorisurat_id' => $kategorisurat->id,
        ];

        $response = $this->putJson(route('api.arsips.update', $arsip), $data);

        $data['id'] = $arsip->id;

        $this->assertDatabaseHas('arsips', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_arsip(): void
    {
        $arsip = Arsip::factory()->create();

        $response = $this->deleteJson(route('api.arsips.destroy', $arsip));

        $this->assertModelMissing($arsip);

        $response->assertNoContent();
    }
}
