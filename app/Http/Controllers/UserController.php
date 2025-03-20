<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\District;
use App\Models\Halqa;
use App\Models\Tehsil;
use App\Models\Divsion;
use Illuminate\Support\Facades\Hash;
use DB;
class UserController extends Controller
{
    public function AddUser(){
        $roles = Role::all(); 
        $Halqas = Halqa::all(); 
        $districts = District::all();
        $tehsils = Tehsil::all();
        $divsions = Divsion::all(); 
    
        $usersWithRoles = DB::table('users')
            ->leftJoin('assign_roles', 'users.role_id', '=', 'assign_roles.role_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.name as user_name',
                'users.email',
                'users.phone_number',
                'roles.name as role_name'
            )
            ->groupBy('users.id', 'users.name', 'users.email', 'users.phone_number', 'roles.name') // Grouping to remove duplicates
            ->get();
    
        return view('UserManagement.AddUser', [
            'roles' => $roles,
            'Halqas' => $Halqas,
            'usersWithRoles' => $usersWithRoles,
            'districts' => $districts,
            'divsions' => $divsions,
            'tehsils' => $tehsils
        ]);
    }
    
public function Halqa($tehsilId)
{
    // Fetch halqas related to the tehsil ID
    $halqas = Halqa::where('tehsil_id', $tehsilId)->get(['id', 'halqa_name']);

    // Return the response as JSON
    return response()->json($halqas);
}
public function storeUser(Request $request)
{
    // Validate incoming data
 
    // Create a new user record
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->password),

        'phone_number' => $request->input('phone_number'),
        'role_id' => $request->input('role_id'),
        'halqa_id' => $request->input('halqa_id'),
        'div_id' => $request->div_id,
        'district_id' => $request->district_id,
        'tehsil_id' => $request->tehsil_id,
    ]);

    // Assign role to user
  

    return redirect()->back()->with('success', 'User added successfully.');
}
public function destroy($id)
{
    $users = User::findOrFail($id);
    $users->delete();

    return redirect()->back()->with('success', 'User deleted successfully.');
}
public function editUser($id)
{
    $user = User::findOrFail($id); // Fetch the exam by ID
    $roles = Role::all(); 
    $Halqas = Halqa::all(); 
    $districts = District::all();
    $tehsils = Tehsil::all();// Fetch all levels for the dropdown
    return view('UserManagement.Edituser', compact('user' ,'roles','Halqas',
'districts','tehsils'));
}
public function updateUser(Request $request, $id)
{
    // Validate incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone_number' => 'nullable|string|max:20',
        'role_id' => 'required|exists:roles,id',
        'halqa_id' => 'nullable|exists:halqa,id',
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Update user record
    $user->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone_number' => $request->input('phone_number'),
        'role_id' => $request->input('role_id'),
        'halqa_id' => $request->input('halqa_id'),
    ]);

    // Update password if provided
    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($request->password)]);
    }

    return redirect()->back()->with('success', 'User updated successfully.');
}

}
