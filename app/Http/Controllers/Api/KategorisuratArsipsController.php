<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Kategorisurat;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArsipResource;
use App\Http\Resources\ArsipCollection;

class KategorisuratArsipsController extends Controller
{
    public function index(
        Request $request,
        Kategorisurat $kategorisurat
    ): ArsipCollection {
        $this->authorize('view', $kategorisurat);

        $search = $request->get('search', '');

        $arsips = $kategorisurat
            ->arsips()
            ->search($search)
            ->latest()
            ->paginate();

        return new ArsipCollection($arsips);
    }

    public function store(
        Request $request,
        Kategorisurat $kategorisurat
    ): ArsipResource {
        $this->authorize('create', Arsip::class);

        $validated = $request->validate([
            'id' => ['required', 'max:255'],
            'nomor_surat' => ['nullable', 'max:255', 'string'],
            'judul' => ['required', 'max:255', 'string'],
            'flie_path' => ['file', 'max:1024', 'nullable'],
            'waktu_pengarsipan' => ['required', 'date'],
        ]);

        if ($request->hasFile('flie_path')) {
            $validated['flie_path'] = $request
                ->file('flie_path')
                ->store('public');
        }

        $arsip = $kategorisurat->arsips()->create($validated);

        return new ArsipResource($arsip);
    }
}
