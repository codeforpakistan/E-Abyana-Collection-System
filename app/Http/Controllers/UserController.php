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
->paginate(10); // Change 10 to the number of items per page

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
    $roleId = $request->input('role_id');
    $divId = ($roleId == 12) ? null : $request->input('div_id');

    $districtId=$request->input('district_id');
    $tehsilId=$request->input('tehsil_id');
    $halqaId=$request->input('halqa_id');

    if($roleId==15 || $roleId==16){
    $divId=null;
    $tehsilId=null;
    $halqaId=null;
    }elseif($roleId==1){
    $divId=null;
    $districtId=null;
    $tehsilId=null;
    $halqaId=0;
    }

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->password),
        'phone_number' => $request->input('phone_number'),
        'role_id' => $request->input('role_id'),
        'halqa_id' => $halqaId,
        'div_id' => $divId,
        'district_id' => $districtId,
        'tehsil_id' => $tehsilId,
    ]);

    // If role is 15, insert multiple halqas for this user
    if ($roleId == 15) {
        $halqaIds = $request->input('halqa_multiple', []);

        if (!empty($halqaIds)) {
            $data = [];
            foreach ($halqaIds as $hId) {
                $data[] = [
                    'user_id'  => $user->id,
                    'halqa_id' => $hId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('zilladar_halqas')->insert($data);
        }
    }

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
    $user = User::findOrFail($id); // Fetch user or fail if not found

    $roles = Role::all();
    $Halqas = Halqa::all();
    $districts = District::all();
    $divsions = Divsion::all();
    $tehsils = Tehsil::all();

    return view('UserManagement.Edituser', compact('user', 'roles', 'Halqas', 'districts', 'tehsils', 'divsions'));
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
