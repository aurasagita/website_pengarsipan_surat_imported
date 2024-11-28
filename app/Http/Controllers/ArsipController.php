<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Kategorisurat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArsipStoreRequest;
use App\Http\Requests\ArsipUpdateRequest;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Arsip::class);

        $search = $request->get('search', '');

        $arsips = Arsip::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.arsips.index', compact('arsips', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Arsip::class);

        $kategorisurats = Kategorisurat::pluck('nama_kategori', 'id');

        return view('app.arsips.create', compact('kategorisurats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArsipStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Arsip::class);

        $validated = $request->validated();
        if ($request->hasFile('flie_path')) {
            $validated['flie_path'] = $request
                ->file('flie_path')
                ->store('public');
        }

        $arsip = Arsip::create($validated);

        return redirect()
            ->route('arsips.edit', $arsip)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Arsip $arsip): View
    {
        $this->authorize('view', $arsip);

        return view('app.arsips.show', compact('arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Arsip $arsip): View
    {
        $this->authorize('update', $arsip);

        $kategorisurats = Kategorisurat::pluck('nama_kategori', 'id');

        return view('app.arsips.edit', compact('arsip', 'kategorisurats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ArsipUpdateRequest $request,
        Arsip $arsip
    ): RedirectResponse {
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

        return redirect()
            ->route('arsips.edit', $arsip)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Arsip $arsip): RedirectResponse
    {
        $this->authorize('delete', $arsip);

        if ($arsip->flie_path) {
            Storage::delete($arsip->flie_path);
        }

        $arsip->delete();

        return redirect()
            ->route('arsips.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
