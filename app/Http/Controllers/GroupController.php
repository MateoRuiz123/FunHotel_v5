<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Exception;
use Spatie\Permission\Models\Role;

class GroupController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:group-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // $groups = $user->groups()->get();
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $group = Group::create([
            'name' => $request->name,
        ]);

        $group->users()->attach(auth()->user());

        return redirect()->route('groups.index')->with('success', 'Ficha creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $users = User::all();
        $roles = Role::all();
        $usersWithoutGroup = User::doesntHave('groups')->get();
        return view('groups.show', compact('group', 'users', 'roles', 'usersWithoutGroup'));
    }

    // metodo update para actualizar el name del grupo
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $group->update([
            'name' => $request->name,
        ]);

        return redirect()->route('groups.index')->with('success', 'Ficha actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Ficha eliminada.');
    }

    public function addUser(Request $request, Group $group)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        try {
            // Verificar si el usuario ya está en el grupo actual
            if ($group->users()->where('users.id', $user->id)->exists()) {
                throw new Exception('El usuario ya está en este grupo.');
            }

            // Verificar si el usuario ya está en otro grupo
            if ($user->groups()->exists()) {
                throw new Exception('El usuario ya está en otro grupo.');
            }

            $group->users()->attach($user);

            return redirect()->back()->with('success', 'Usuario agregado al grupo exitosamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al agregar usuario al grupo: ' . $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showAddUserForm(Group $group)
    {
        // Obtener usuarios que no están en ningún grupo
        $users = User::whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('group_user');
        })->get();

        return view('add_user_form', compact('group', 'users'));
    }

    public function removeUser(Request $request, Group $group)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $group->users()->detach($user);

        return redirect()->back()->with('success', 'Usuario eliminado.');
    }

    public function assignRoles(Request $request, Group $group)
    {
        $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        $roleIds = $request->role_ids;

        try {
            $group->roles()->sync($roleIds);

            return redirect()->back()->with('success', 'Roles asignado.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al asignar rol: ' . $e->getMessage());
        }
    }

    public function assignGroupRole(Request $request, Group $group)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        try {
            $group->users()->each(function ($user) use ($role) {
                $user->assignRole($role);
            });

            return redirect()->back()->with('success', 'Roles asignados a todos los usuarios.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al asignar rol: ' . $e->getMessage());
        }
    }

    public function revokeGroupRole(Request $request, Group $group)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($request->role_id);

        try {
            $group->users()->each(function ($user) use ($role) {
                $user->removeRole($role);
            });

            return redirect()->back()->with('success', 'Rol eliminado a todos los usuarios.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar rol: ' . $e->getMessage());
        }
    }
}
