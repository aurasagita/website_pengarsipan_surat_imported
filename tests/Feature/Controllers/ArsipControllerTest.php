<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Arsip;

use App\Models\Kategorisurat;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArsipControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_arsips(): void
    {
        $arsips = Arsip::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('arsips.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.arsips.index')
            ->assertViewHas('arsips');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_arsip(): void
    {
        $response = $this->get(route('arsips.create'));

        $response->assertOk()->assertViewIs('app.arsips.create');
    }

    /**
     * @test
     */
    public function it_stores_the_arsip(): void
    {
        $data = Arsip::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('arsips.store'), $data);

        $this->assertDatabaseHas('arsips', $data);

        $arsip = Arsip::latest('id')->first();

        $response->assertRedirect(route('arsips.edit', $arsip));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_arsip(): void
    {
        $arsip = Arsip::factory()->create();

        $response = $this->get(route('arsips.show', $arsip));

        $response
            ->assertOk()
            ->assertViewIs('app.arsips.show')
            ->assertViewHas('arsip');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_arsip(): void
    {
        $arsip = Arsip::factory()->create();

        $response = $this->get(route('arsips.edit', $arsip));

        $response
            ->assertOk()
            ->assertViewIs('app.arsips.edit')
            ->assertViewHas('arsip');
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

        $response = $this->put(route('arsips.update', $arsip), $data);

        $data['id'] = $arsip->id;

        $this->assertDatabaseHas('arsips', $data);

        $response->assertRedirect(route('arsips.edit', $arsip));
    }

    /**
     * @test
     */
    public function it_deletes_the_arsip(): void
    {
        $arsip = Arsip::factory()->create();

        $response = $this->delete(route('arsips.destroy', $arsip));

        $response->assertRedirect(route('arsips.index'));

        $this->assertModelMissing($arsip);
    }
}
