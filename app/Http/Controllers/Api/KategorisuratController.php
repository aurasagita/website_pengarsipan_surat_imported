<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Kategorisurat;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategorisuratResource;
use App\Http\Resources\KategorisuratCollection;
use App\Http\Requests\KategorisuratStoreRequest;
use App\Http\Requests\KategorisuratUpdateRequest;

class KategorisuratController extends Controller
{
    public function index(Request $request): KategorisuratCollection
    {
        $this->authorize('view-any', Kategorisurat::class);

        $search = $request->get('search', '');

        $kategorisurats = Kategorisurat::search($search)
            ->latest()
            ->paginate();

        return new KategorisuratCollection($kategorisurats);
    }

    public function store(
        KategorisuratStoreRequest $request
    ): KategorisuratResource {
        $this->authorize('create', Kategorisurat::class);

        $validated = $request->validated();

        $kategorisurat = Kategorisurat::create($validated);

        return new KategorisuratResource($kategorisurat);
    }

    public function show(
        Request $request,
        Kategorisurat $kategorisurat
    ): KategorisuratResource {
        $this->authorize('view', $kategorisurat);

        return new KategorisuratResource($kategorisurat);
    }

    public function update(
        KategorisuratUpdateRequest $request,
        Kategorisurat $kategorisurat
    ): KategorisuratResource {
        $this->authorize('update', $kategorisurat);

        $validated = $request->validated();

        $kategorisurat->update($validated);

        return new KategorisuratResource($kategorisurat);
    }

    public function destroy(
        Request $request,
        Kategorisurat $kategorisurat
    ): Response {
        $this->authorize('delete', $kategorisurat);

        $kategorisurat->delete();

        return response()->noContent();
    }
}
