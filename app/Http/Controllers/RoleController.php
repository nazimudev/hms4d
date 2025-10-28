<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    // Role Page
    public function index()
    {
        // $roles = Role::orderBy('id', 'desc')->paginate(5);
        $page = request()->get('page', 1); // default page = 1
        $roles = Cache::remember("roles_page_{$page}", 60, function () {
            return Role::orderBy('id', 'desc')->paginate(5);
        });
        // 🔹 সব পারমিশন আনছি (category না থাকলে 'General' দেখাবে)
        $permissions = Permission::select('id', 'name', 'display_name', 'description')
            ->get()
            ->map(function ($perm) {
                $category = explode('.', $perm->name)[0] ?? 'General';
                $perm->category = ucfirst($category);
                return $perm;
            });
            return Inertia::render('users/Role', [
                'permissions' => $permissions,
                'roles' => $roles
            ]);
    }

    public function checkRole()
    {

        $roles = Role::all();
        return response()->json($roles);
    }

    // User Role Create
    public function storeRole(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'display_name' => 'required|string',
            'description' => 'nullable|string|max:40'
        ]);

        try {
            Role::create($data);
            $pages = ceil(Role::count() / 5);
            for ($i = 1; $i <= $pages; $i++) {
                Cache::forget("roles_page_{$i}");
            }
            return back()->with('success', 'Role Create Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        $pages = ceil(Role::count() / 5);
        for ($i = 1; $i <= $pages; $i++) {
            Cache::forget("roles_page_{$i}");
        }

        return redirect()->back()->with('success', 'Role deleted successfully!');
    }

    // Permission Page
    public function permission()
    {
        return Inertia::render('users/Permission');
    }

    // Assign Role to users
    public function users()
    {
        return User::all();
    }

    public function roles($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $assigned = $user->roles->pluck('id');

        return response()->json([
            'roles' => $roles,
            'assigned' => $assigned
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return response()->json(['message' => 'Role Assign Success']);
    }

    //
    public function indexRole()
    {
        return Role::all();
    }

    public function permissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $assigned = $role->permissions->pluck('id');
        return response()->json([
            'permissions' => $permissions,
            'assigned' => $assigned
        ]);
    }

    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);
        return response()->json(['success' => 'Permissions updated successfully']);
    }
}
