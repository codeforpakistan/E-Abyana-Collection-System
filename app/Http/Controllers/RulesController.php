<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RulesController extends Controller
{
    public function Add(){
        $roles = Role::all(); 
        return view('UserManagement.AddRoles', ['roles' => $roles]);
    
        
   
}
public function StoreRoles(Request $request)
{
    // Validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        
    ]);

    // Store in the database
    Role::create($validated);

    // Flash success message
    Session()->flash('success', 'Data Has Been Submitted Successfully');


    
    return redirect()->back();
}
}
