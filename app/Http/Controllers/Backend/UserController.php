<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate();
        if (\request()->has('search')){
            $search = request()->search;
            $users = User::where('username', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")->latest()->paginate();
        }
        return view('users.index', compact('users'));
    }

    public function deletedUsers()
    {
        $users = User::onlyTrashed()->latest()->paginate();
        if (\request()->search){
            $search = request()->search;
            $users = User::where('username', $search)->orWhere('email',$search)->onlyTrashed()->latest()->paginate();
        }
        return view('users.deleted', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        User::create(['password' => Hash::make($request->password)] + $request->validated());

        return back()->with('message', 'User created!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return back()->with('message', 'User updated!');
    }

    public function destroy(User $user)
    {
        if (auth()->id() == $user->id){
            return back()->with('warning', 'Are you deleting yourself?');
        }

        $user->delete();

        return back()->with('message', 'User deleted! Restore from deleted list.');
    }

    public function deletePermanently($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $user->forceDelete();

        return back()->with('message', 'User deleted permanently!');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $user->restore();

        return back()->with('message', 'User restored!');
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('message', 'User password updated!');
    }
}
