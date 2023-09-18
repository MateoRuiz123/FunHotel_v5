<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname'=>'required',
            'birthday'=>'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $input = $request->except('roles');
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->estado = User::Activo;
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'surname'=>'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'same:confirm-password',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $input = $request->except(['password', 'roles']);
        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->input('password'));
        }

        $user->estado = $request->input('estado');
        $user->roles()->sync($request->input('roles'));
        $user->update($input);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }

    public function show()
    {
        $users = User::all();
        $roles = Role::all();

        return view('users.assign-roles', compact('users', 'roles'));
    }
    public function saveRoles(Request $request)
    {
        $users = $request->input('users', []);
        $roles = $request->input('roles', []);

        foreach ($users as $userId) {
            $user = User::findOrFail($userId);
            $user->syncRoles($roles);
        }

        // return redirect()->back()->with('success', 'Roles assigned successfully.');
        return redirect()->route('users.index')->with('success', 'Roles asignados correctamente');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Usuario o contraseña incorrectos',
        ], 401);
    }

}
