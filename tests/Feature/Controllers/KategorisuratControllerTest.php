<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Kategorisurat;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategorisuratControllerTest extends TestCase
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
    public function it_displays_index_view_with_kategorisurats(): void
    {
        $kategorisurats = Kategorisurat::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('kategorisurats.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.kategorisurats.index')
            ->assertViewHas('kategorisurats');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_kategorisurat(): void
    {
        $response = $this->get(route('kategorisurats.create'));

        $response->assertOk()->assertViewIs('app.kategorisurats.create');
    }

    /**
     * @test
     */
    public function it_stores_the_kategorisurat(): void
    {
        $data = Kategorisurat::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('kategorisurats.store'), $data);

        $this->assertDatabaseHas('kategorisurats', $data);

        $kategorisurat = Kategorisurat::latest('id')->first();

        $response->assertRedirect(route('kategorisurats.edit', $kategorisurat));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_kategorisurat(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();

        $response = $this->get(route('kategorisurats.show', $kategorisurat));

        $response
            ->assertOk()
            ->assertViewIs('app.kategorisurats.show')
            ->assertViewHas('kategorisurat');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_kategorisurat(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();

        $response = $this->get(route('kategorisurats.edit', $kategorisurat));

        $response
            ->assertOk()
            ->assertViewIs('app.kategorisurats.edit')
            ->assertViewHas('kategorisurat');
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

        $response = $this->put(
            route('kategorisurats.update', $kategorisurat),
            $data
        );

        $data['id'] = $kategorisurat->id;

        $this->assertDatabaseHas('kategorisurats', $data);

        $response->assertRedirect(route('kategorisurats.edit', $kategorisurat));
    }

    /**
     * @test
     */
    public function it_deletes_the_kategorisurat(): void
    {
        $kategorisurat = Kategorisurat::factory()->create();

        $response = $this->delete(
            route('kategorisurats.destroy', $kategorisurat)
        );

        $response->assertRedirect(route('kategorisurats.index'));

        $this->assertModelMissing($kategorisurat);
    }
}
