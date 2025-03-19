<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function AddPermission()
    {
        $permissions = Permission::all(); 
        return view('UserManagement.AddPermission', ['permissions' => $permissions]);
    }
    public function StorePermission(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            
        ]);
    
        // Store in the database
        Permission::create($validated);
    
        // Flash success message
        Session()->flash('success', 'Data Has Been Submitted Successfully');

    
        
        return redirect()->back();
    }
}
