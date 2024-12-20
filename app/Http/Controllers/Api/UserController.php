<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index(Request $request): UserCollection
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(UserStoreRequest $request): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('public');
        }

        $user = User::create($validated);

        return new UserResource($user);
    }

    public function show(Request $request, User $user): UserResource
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete($user->foto);
            }

            $validated['foto'] = $request->file('foto')->store('public');
        }

        $user->update($validated);

        return new UserResource($user);
    }

    public function destroy(Request $request, User $user): Response
    {
        $this->authorize('delete', $user);

        if ($user->foto) {
            Storage::delete($user->foto);
        }

        $user->delete();

        return response()->noContent();
    }
}
