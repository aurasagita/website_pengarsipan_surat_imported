<?php

namespace App\Http\Controllers\Api;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArsipResource;
use App\Http\Resources\ArsipCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArsipStoreRequest;
use App\Http\Requests\ArsipUpdateRequest;

class ArsipController extends Controller
{
    public function index(Request $request): ArsipCollection
    {
        $this->authorize('view-any', Arsip::class);

        $search = $request->get('search', '');

        $arsips = Arsip::search($search)
            ->latest()
            ->paginate();

        return new ArsipCollection($arsips);
    }

    public function store(ArsipStoreRequest $request): ArsipResource
    {
        $this->authorize('create', Arsip::class);

        $validated = $request->validated();
        if ($request->hasFile('flie_path')) {
            $validated['flie_path'] = $request
                ->file('flie_path')
                ->store('public');
        }

        $arsip = Arsip::create($validated);

        return new ArsipResource($arsip);
    }

    public function show(Request $request, Arsip $arsip): ArsipResource
    {
        $this->authorize('view', $arsip);

        return new ArsipResource($arsip);
    }

    public function update(
        ArsipUpdateRequest $request,
        Arsip $arsip
    ): ArsipResource {
        $this->authorize('update', $arsip);

        $validated = $request->validated();

        if ($request->hasFile('flie_path')) {
            if ($arsip->flie_path) {
                Storage::delete($arsip->flie_path);
            }

            $validated['flie_path'] = $request
                ->file('flie_path')
                ->store('public');
        }

        $arsip->update($validated);

        return new ArsipResource($arsip);
    }

    public function destroy(Request $request, Arsip $arsip): Response
    {
        $this->authorize('delete', $arsip);

        if ($arsip->flie_path) {
            Storage::delete($arsip->flie_path);
        }

        $arsip->delete();

        return response()->noContent();
    }
}
