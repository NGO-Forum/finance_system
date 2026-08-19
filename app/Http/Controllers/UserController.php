<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['role', 'department'])
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        $users->appends($request->all());

        return view('users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();

        return view('users.create', compact('roles', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'position' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'role_id' => 'required',
            'department_id' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'position' => $request->position,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'is_active' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();

        return view('users.edit', compact(
            'user',
            'roles',
            'departments'
        ));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'position' => 'nullable',
            'phone' => 'nullable',
            'role_id' => 'required',
            'department_id' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
