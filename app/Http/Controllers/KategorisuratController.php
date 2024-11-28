<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Kategorisurat;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\KategorisuratStoreRequest;
use App\Http\Requests\KategorisuratUpdateRequest;

class KategorisuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Kategorisurat::class);

        $search = $request->get('search', '');

        $kategorisurats = Kategorisurat::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.kategorisurats.index',
            compact('kategorisurats', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Kategorisurat::class);

        return view('app.kategorisurats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategorisuratStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Kategorisurat::class);

        $validated = $request->validated();

        $kategorisurat = Kategorisurat::create($validated);

        return redirect()
            ->route('kategorisurats.edit', $kategorisurat)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Kategorisurat $kategorisurat): View
    {
        $this->authorize('view', $kategorisurat);

        return view('app.kategorisurats.show', compact('kategorisurat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Kategorisurat $kategorisurat): View
    {
        $this->authorize('update', $kategorisurat);

        return view('app.kategorisurats.edit', compact('kategorisurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        KategorisuratUpdateRequest $request,
        Kategorisurat $kategorisurat
    ): RedirectResponse {
        $this->authorize('update', $kategorisurat);

        $validated = $request->validated();

        $kategorisurat->update($validated);

        return redirect()
            ->route('kategorisurats.edit', $kategorisurat)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Kategorisurat $kategorisurat
    ): RedirectResponse {
        $this->authorize('delete', $kategorisurat);

        $kategorisurat->delete();

        return redirect()
            ->route('kategorisurats.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
