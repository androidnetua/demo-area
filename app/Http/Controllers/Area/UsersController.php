<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function user()
    {
        Auth::user()->permissions;
//        return Auth::user();
        return new UserResource(Auth::user());
    }

    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activated' => (bool) $request->activated,
        ]);

        $user->permissions()->sync($request->permissions);

        return (new UserResource($user))->additional([
            'message' => __('area.user_created', ['user' => $user->name]),
        ]);
    }

    public function show(User $user)
    {
        $user->permissions = $user->permissions()->pluck('id');
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        if (! Gate::allows('edit-admin', $user))
            return response()->json(['message' => __('area.user_cant_edit_admin')], 403);

        $data = [
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'activated' => (bool) $request->activated,
        ];
        if($request->password)
            $data['password'] = Hash::make($request->password);

        if($user->id == 1)
            $request->permissions = array_unique(array_merge([1], $request->permissions));

        $user->permissions()->sync($request->permissions);

        $user->update($data);

        return response()->json([
            'message' => __('area.user_updated', ['user' => $user->name])
        ]);
    }

    public function destroy(User $user)
    {
        if (! Gate::allows('delete-admin', $user))
            return response()->json(['message' => __('area.user_cant_delete_admin')], 403);
        if (! Gate::allows('delete-user', $user))
            return response()->json(['message' => __('area.user_cant_delete_yourself')], 403);

        $user->delete();
        return response()->json([
            'message' => __('area.user_deleted', ['user' => $user->name])
        ]);
    }

    public function password(PasswordRequest $request)
    {
        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $user->activated = 1;

        return response()->json($user->save());
    }
}
