<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\AssignRoles;

class AssignRController extends Controller
{

    public function AddAssignRoles(){
              $roles = Role::all();
              $Permissions = Permission::all(); 
              $assignedRoles = AssignRoles::with(['role', 'permission'])->get();

        return view('UserManagement.AssignRoles_Permission',compact('roles','Permissions','assignedRoles'));
    }
    public function storeAssignRoles(Request $request)
    {
        // Validate the request data
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|array',
            'name.*' => 'exists:permissions,id',
        ]);

        // Get the selected role
        $role = Role::find($request->role_id);

        // Attach the selected permissions to the role
        $role->permissions()->sync($request->name);

        return redirect()->back()->with('success', 'Permissions assigned successfully.');
    }

}
