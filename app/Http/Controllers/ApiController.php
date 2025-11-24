<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Divsion;
use App\Models\AssignRoles;
use App\Models\District;
use App\Models\Tehsil;
use App\Models\village;
use App\Models\Canal;
use App\Models\Outlet;
use App\Models\Halqa;
use App\Models\Irrigator;
use App\Models\Crop;
use App\Models\LandRecord;
use App\Models\Cropprice;
use App\Models\Distributary;
use App\Models\Minorcanal;
use App\Models\CanalBranch;
use App\Models\PriceRevenue;

use DB;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
public function make_login(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt login using Laravel Auth
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials',
        ], 401);
    }

    // Auth successful
    $user = Auth::user();

    // Create token for API
    $token = $user->createToken('api-token')->plainTextToken;

    // Return user data and token
    return response()->json([
        'status' => 'success',
        'message' => 'Login successful',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'halqa_id' => $user->halqa_id,
            'role_id' => $user->role_id,
            'district_id' => $user->district_id,
            'div_id' => $user->div_id,
            'tehsil_id' => $user->tehsil_id,
        ],
        'token' => $token,
    ], 200);
}

    public function storeRoles(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Store the role in the database
    $role = Role::create($validated);

    // Return a JSON response with a success message
    return response()->json([
        'success' => true, // Added for clarity
        'message' => 'Role has been created successfully',
        'data' => $role,
    ], 201);
}

  public function storePermission(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Create the permission
        $permission = Permission::create($validated);
    
        // Return a success message
        return response()->json([
            'success' => true,
            'message' => 'Permission has been created successfully.',
            'data' => $permission,
        ], 201); // 201 Created
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

        return response()->json([
            'message' => 'Permissions have been assigned to the role successfully',
            'data' => $role,
        ], 201);
    }
    
public function storeUser(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|max:255',
        'phone_number' => 'nullable|string|max:15',
        'role_id' => 'required|exists:roles,id',
        'halqa_id' => 'nullable|exists:halqa,id',
    ]); // Ensure the validation array is properly closed

    // Create a new user record
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'phone_number' => $validated['phone_number'] ?? null,
        'role_id' => $validated['role_id'],
        'halqa_id' => $validated['halqa_id'] ?? null,
    ]);

    // Return a JSON response
    return response()->json([
        'success' => true,
        'message' => 'User created successfully',
        'user' => $user,
    ], 201);
}


    public function listUsers()
    {
        // Retrieve all users with related roles and halqas
        $users = User::with(['role', 'halqa'])->get();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'User list fetched successfully.',
            'data' => $users,
        ], 200);
    }


public function StoreDivsion(Request $request)
{
    // Validation
    $validated = $request->validate([
        'divsion_name' => 'required|string|max:255',
        
    ]);

    // Store in the database

    $divsion = Divsion::create($validated);

    // Flash success message
    return response()->json([
        'message' => 'Permission has been created successfully',
        'data' => $divsion,
    ], 201);
}
public function storeDistrict(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|string|unique:districts,name',
        'div_id' => 'required|exists:divisions,id', // Ensure it checks the 'id' column of the divisions table
    ], [
        'name.unique' => 'The district name has already been taken.',
        'name.required' => 'The district name is required.',
        'div_id.required' => 'The division is required.',
        'div_id.exists' => 'The selected division does not exist.',
    ]);

    // Create a new District record
    $district = District::create([
        'name' => $validated['name'],
        'div_id' => $validated['div_id'], // Ensure this matches the column in the districts table
    ]);

    // Return a JSON response with the created district
    return response()->json([
        'success' => true,
        'message' => 'District created successfully!',
        'data' => $district,
    ], 201); // HTTP 201 for resource creation
}

public function StoreTehsil(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'tehsil_name' => 'required|string|unique:tehsils,tehsil_name', // Ensure tehsil name is unique
        'district_id' => 'required|exists:districts,id', // Ensure district exists
    ], [
        'tehsil_name.unique' => 'The tehsil name has already been taken.', // Custom validation message for uniqueness
        'tehsil_name.required' => 'The tehsil name is required.', // Custom message for required field
        'district_id.required' => 'The district is required.', // Custom message for required field
        'district_id.exists' => 'The selected district does not exist.', // Custom message for existing district
    ]);

    // Create a new Tehsil record
  $tehsil= Tehsil::create([
        'tehsil_name' => $request->tehsil_name, // Match form input with column name
        'district_id' => $request->district_id,
    ]);
    return response()->json([
        'success' => true,
        'message' => 'District created successfully!',
        'data' => $tehsil,
    ], 201); // HTTP 201 for resource creation
}

public function storeHalqa(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'halqa_name' => 'required|string|unique:halqas,halqa_name', // Only validate halqa_name
    ], [
        'halqa_name.unique' => 'The halqa name has already been taken.',
        'halqa_name.required' => 'The halqa name is required.',
    ]);

    try {
        // Create a new Halqa record
        $halqa = Halqa::create([
            'halqa_name' => $validatedData['halqa_name'],
        ]);

        return response()->json([
            'message' => 'Halqa created successfully!',
            'data' => $halqa,
        ], 201); // 201 Created
    } catch (\Exception $e) {
        // Log the error for internal tracking (optional)
        \Log::error('Error creating Halqa: '.$e->getMessage());

        return response()->json([
            'message' => 'An error occurred while creating the halqa.',
            'error' => $e->getMessage(),
        ], 500); // 500 Internal Server Error
    }
}

public function getDivisions()
{
    try {
        $divisions = Divsion::all(); // Fetch all divisions
        return response()->json([
            'message' => 'Divisions retrieved successfully.',
            'data' => $divisions
        ], 200); // 200 OK
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to retrieve divisions.',
            'error' => $e->getMessage()
        ], 500); // 500 Internal Server Error
    }
}

public function handleCanals(Request $request, $id = null)
{
    if ($request->isMethod('get')) {
        // Fetch canal by ID if provided, otherwise return all canals
        if ($id) {
            $canal = Canal::find($id);
            if (!$canal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Canal not found.',
                ], 404); // 404 Not Found
            }
            return response()->json([
                'success' => true,
                'data' => $canal,
            ], 200); // 200 OK
        } else {
            $canals = Canal::with('village:village_id,village_name')->get();

            return response()->json([
                'success' => true,
                'data' => $canals,
            ], 200); // 200 OK
        }
    } elseif ($request->isMethod('post')) {
        // Validate and insert a new canal
        $validated = $request->validate([
            'canal_name' => 'required|string|unique:canals,canal_name',
            'village_id' => 'required|exists:villages,village_id',
        ]);

        $canal = Canal::create([
            'canal_name' => $validated['canal_name'],
            'village_id' => $validated['village_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Canal created successfully!',
            'data' => $canal,
        ], 201); // 201 Created
    } elseif ($request->isMethod('put')) {
        // Validate and update canal
        $request->validate([
            'canal_name' => 'required|string|unique:canals,canal_name,' . $id,
            'village_id' => 'required|exists:villages,village_id',
        ]);

        $canal = Canal::find($id);
        if (!$canal) {
            return response()->json([
                'success' => false,
                'message' => 'Canal not found.',
            ], 404); // 404 Not Found
        }

        $canal->update([
            'canal_name' => $request->canal_name,
            'village_id' => $request->village_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Canal updated successfully!',
        ], 200); // 200 OK
    } elseif ($request->isMethod('delete')) {
        // Delete canal by ID
        $canal = Canal::find($id);
        if (!$canal) {
            return response()->json([
                'success' => false,
                'message' => 'Canal not found.',
            ], 404); // 404 Not Found
        }

        $canal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Canal deleted successfully!',
        ], 200); // 200 OK
    }

    return response()->json([
        'success' => false,
        'message' => 'Method not allowed.',
    ], 405); // 405 Method Not Allowed
}






// public function storeOutlet(Request $request)
// {

//     $validated = $request->validate([
//         'outlet_name' => 'required|string|unique:outlets,outlet_name',
//         'canal_id' => 'required|exists:canals,canal_id',
//     ], [
//         'outlet_name.required' => 'The outlet name is required.',
//         'outlet_name.unique' => 'The outlet name must be unique.',
//         'canal_id.required' => 'The canal ID is required.',
//         'canal_id.exists' => 'The selected canal does not exist.',
//     ]);

//     try {
        
//         $outlet = Outlet::create([
//             'outlet_name' => $validated['outlet_name'],
//             'canal_id' => $validated['canal_id'],
//         ]);

    
//         return response()->json([
//             'success' => true,
//             'message' => 'Canal outlet created successfully!',
//             'outlet' => $outlet,
//         ], 201);
//     } catch (\Exception $e) {
        
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed to create canal outlet. Please try again later.',
//             'error' => $e->getMessage(),
//         ], 500);
//     }

// }
public function getDistricts()
{
    try {
        // Fetch districts with their associated divisions
        $districts = District::with('division')->get();

        // Return a JSON response with the fetched data
        return response()->json([
            'message' => 'Districts fetched successfully!',
            'data' => $districts,
        ], 200); // HTTP 200: OK
    } catch (\Exception $e) {
        // Handle errors and return a JSON response
        return response()->json([
            'message' => 'An error occurred while fetching districts.',
            'error' => $e->getMessage(),
        ], 500); // HTTP 500: Internal Server Error
    }
}
// public function getOutlets(Request $request)
// {
//     // Start building the query with the Outlet model
//     $query = Outlet::with('canal:id,canal_name');
//  // Ensure correct fields and relationships are referenced

//     // Optionally filter outlets by canal_id
//     if ($request->has('canal_id')) {
//         $query->where('canal_id', $request->query('canal_id'));
//     }

//     // Fetch the outlets
//     $outlets = $query->get();

//     // Return the data as a JSON response
//     return response()->json([
//         'success' => true,
//         'message' => 'Canal outlets retrieved successfully!',
//         'data' => $outlets,
//     ]);
// }


public function getTahsilData()
{
    // Fetch all tehsils with their associated districts and divisions
    $tehsils = Tehsil::with('district.division')->get();

    // Fetch all districts
    $districts = District::all(); // Adjust based on your District model

    // Fetch all divisions
    $divisions = Divsion::all(); // Adjust based on your Division model

    
    $response = [
        'tehsils' => $tehsils,
        'districts' => $districts,
        'divisions' => $divisions,
    ];

  
    return response()->json($response);
}

public function getHalqaData()
{
   
    $halqas = Halqa::with('district.division')->get();

   
    $tehsils = Tehsil::all();
    $districts = District::all();
    $divisions = Divsion::all(); 

   
    $response = [
        'halqas' => $halqas,
        'tehsils' => $tehsils,
        'districts' => $districts,
        'divisions' => $divisions,
    ];

  
    return response()->json($response);
}


    public function getVillagesWithTehsil()
    {
        $villages = village::with('halqa')->get();

       
        return response()->json($villages);
    }

    public function StoreVillage(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'village_name' => 'required|string|unique:villages,village_name',

            'halqa_id' => 'required|exists:halqa,id', 
        ], [
            'village_name.unique' => 'The Village name has already been taken.',
            'village_name.required' => 'The Village name is required.',
          
            'halqa_id.required' => 'The Halqa is required.',
            'halqa_id.exists' => 'The selected Halqa does not exist.',
        ]);
    
        try {
            // Create the village
            $village = village::create([
                'village_name' => $validatedData['village_name'],
        
                'halqa_id' => $validatedData['halqa_id'],
            ]);
    
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Village created successfully!',
                'data' => $village,
            ], 201); // HTTP 201 Created
    
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the village.',
                'error' => $e->getMessage(),
            ], 500); // HTTP 500 Internal Server Error
        }
    }

public function getVillageByID($village_id)
{
    $village_name = Village::where('village_id', $village_id)->value('village_name');

    if (!$village_name) {
        return response()->json(['error' => 'Village not found.'], 404);
    }

    return response()->json(['village_name' => $village_name]);
}
    
public function storeIrrigator(Request $request)
{
    try {
        $validated = $request->validate([
            'irrigator_name' => 'required|string|max:255',
            'irrigator_khata_number' => 'required|integer',
            'cnic' => 'nullable|string|max:255',
            'irrigator_f_name' => 'required|string|max:255',
            'irrigator_mobile_number' => 'nullable|string|max:255',
            'village_id' => 'required|exists:villages,village_id',
            'canal_id' => 'required|exists:canals,id',
            'div_id' => 'required|exists:divisions,id',
        ]);

        $duplicate = Irrigator::where('irrigator_khata_number', $request->irrigator_khata_number)
            ->where('village_id', $request->village_id)
            ->exists();

        if ($duplicate) {
            return response()->json([
                'success' => false,
                'error' => 'The irrigator with the same khata number already exists in this village.'
            ], 422);
        }

        $irrigator = Irrigator::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Irrigator Created successfully.',
            'data' => $irrigator
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'Something went wrong. Please try again later.'
        ], 500);
    }
}


    // public function getIrrigators(Request $request)
    // {
     
     
    //  $halqa_id =auth()->user()->halqa_id;
    //     // Build the Irrigators query
    //     $query = DB::table('irrigators')
    //         ->join('villages', 'irrigators.village_id', '=', 'villages.village_id')
    //         ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
    //         ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
    //         ->join('districts', 'tehsils.district_id', '=', 'districts.id')
    //         ->join('divisions', 'districts.div_id', '=', 'divisions.id')
    //         ->select(
    //             'irrigators.id', 
    //             'irrigators.irrigator_name', 
    //             'irrigators.irrigator_khata_number', 
    //             'irrigators.irrigator_mobile_number', 
    //             'villages.village_id AS village_id',
    //             'villages.village_name AS village_name',
    //             'villages.halqa_id',
    //             'halqa.halqa_name AS halqa_name',
    //             'tehsils.tehsil_id AS tehsil_id',
    //             'tehsils.tehsil_name AS tehsil_name',
    //             'districts.id AS district_id',
    //             'districts.name AS district_name',
    //             'divisions.id AS div_id',
    //             'divisions.divsion_name AS divsion_name'
    //         );

    //     // Apply condition if halqa_id is present
    //     // if ($halqa_id > 0) {
    //     //     $query->where('villages.halqa_id', '=', $halqa_id);
    //     // }
        
    //     $query->when(auth()->user()->halqa_id > 0, (function($q){
    //         return $q->where('villages.halqa_id',auth()->user()->halqa_id);
    //     }));

    //     $irrigators = $query->get();

    //     // Fetch related data
    //     $villages = $halqa_id > 0 ? Village::where('halqa_id', '=', $halqa_id)->get() : Village::all();
    //     $halqas = $halqa_id > 0 ? Halqa::where('id', '=', $halqa_id)->get() : Halqa::all();

    //     // Return a JSON response
    //     return response()->json([
    //         'success' => true,
    //         'irrigators' => $irrigators,
    //         'villages' => $villages,
    //         'halqas' => $halqas,
    //     ]);
    // }

public function getIrrigators(Request $request)
{
    $halqa_id = auth()->user()->halqa_id;


    $query = DB::table('irrigators')
        ->join('villages', 'irrigators.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('divisions', 'districts.div_id', '=', 'divisions.id')
        ->join('canals', 'irrigators.canal_id', '=', 'canals.id')
        ->select(
            'irrigators.id', 
            'irrigators.irrigator_name', 
             'irrigators.irrigator_f_name', 
            'irrigators.irrigator_khata_number', 
            'irrigators.irrigator_mobile_number', 
            'villages.village_id AS village_id',
            'villages.village_name AS village_name',
            'villages.halqa_id',
            'halqa.halqa_name AS halqa_name',
            'tehsils.tehsil_id AS tehsil_id',
            'tehsils.tehsil_name AS tehsil_name',
            'districts.id AS district_id',
            'districts.name AS district_name',
            'divisions.id AS div_id',
            'divisions.divsion_name AS divsion_name',
            'irrigators.canal_id',
            'canals.canal_name',
            'canals.c_type'
        )
      ->orderByRaw('CAST(irrigators.irrigator_khata_number AS UNSIGNED) ASC');

    // Apply filter based on halqa_id
if ($halqa_id > 0) {
        $query->where('villages.halqa_id', $halqa_id);
    }
   
    $irrigators = $query->get();

    // Return response based on data availability
    if ($irrigators->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => $halqa_id > 0 
                ? 'No irrigators found for the selected halqa_id.' 
                : 'No irrigators found.',
        ], 404); // 404 Not Found
    }

    return response()->json([
        'success' => true,
        'irrigators' => $irrigators,
    ]);
}



    public function getRoles()
{
    $roles = Role::all(); // Fetch all roles
    return response()->json([
        'success' => true,
        'roles' => $roles
    ], 200); // Return JSON response
}

public function getPermissions()
{
    $permissions = Permission::all(); // Fetch all permissions
    return response()->json([
        'success' => true,
        'permissions' => $permissions
    ], 200); // Return JSON response
}

public function storesurvey(Request $request)
{
    try {
        // Handle canalType logic like in web controller
        if ($request->canalType == 'canal') {
            $request->merge([
                'outlet_id' => $request->canal_outlet_id,
                'minor_id' => null,
                'distri_id' => null,
            ]);
        } elseif ($request->canalType == 'minor_canal') {
            $request->merge([
                'outlet_id' => $request->minor_outlet_id,
                'minor_id' => $request->canal_minor_id,
                'distri_id' => null,
            ]);
        } elseif ($request->canalType == 'distributory') {
            $request->merge([
                'outlet_id' => $request->distri_outlet_id,
                'minor_id' => $request->distri_minor_id,
                'distri_id' => $request->distri_id,
            ]);
        }

       // Updated validation rules
        $validatedData = $request->validate([
            'khasra_number' => 'required|string',
            'tenant_name' => 'required|string',
            'registration_date' => 'required|date',
            'cultivators_info' => 'required|string',
            'snowing_date' => 'required|date',
            'land_assessment_marla' => 'required|string',
            'land_assessment_kanal' => 'required|string',
            'previous_crop' => 'required|string|max:255',
            'date' => 'nullable|date',
            'session_date' => 'required|string',
            'width' => 'numeric|min:0',
            'length' => 'numeric|min:0',
            'area_marla' => 'nullable|numeric|min:0',
            'area_kanal' => 'nullable|numeric|min:0',
            'double_crop_marla' => 'required|string',
            'double_crop_kanal' => 'required|string',
            'identifable_area_marla' => 'required|string',
            'identifable_area_kanal' => 'required|string',
            'irrigated_area_marla' => 'required|numeric|min:0',
            'irrigated_area_kanal' => 'required|numeric|min:0',
            'land_quality' => 'required|string',
            'irrigator_khata_number' => 'required|string',
            'village_id' => 'required|exists:villages,village_id',
            'irrigator_id' => 'required|exists:irrigators,id',
            'canal_id' => 'required|exists:canals,id',
            'minor_id' => 'nullable|numeric',
            'distri_id' => 'nullable|numeric',
            'branch_id' => 'nullable|numeric',
            'crop_id' => 'required|exists:crops,id',
            'outlet_id' => 'required|numeric',
            'finalcrop_id' => 'nullable|exists:cropprices,id',
            'crop_price' => 'nullable|string',
            'is_billed' => 'required|numeric',
            'review' => 'required|string',
            'status' => 'required|numeric',
            'patwari_user_id' => 'required|numeric',
        ]);

        // Store data
        $landRecord = LandRecord::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data has been submitted successfully!',
            'data' => $landRecord,
        ], 201);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage(),
        ], 500);
    }
}



public function manageCrop(Request $request, $id = null)
{
    if ($request->isMethod('get')) {
        // Fetch a specific crop by ID or all crops
        if ($id) {
            $crop = Crop::find($id);
            if (!$crop) {
                return response()->json([
                    'success' => false,
                    'message' => 'Crop not found.',
                ], 404); // 404 Not Found
            }
            return response()->json([
                'success' => true,
                'data' => $crop,
            ], 200); // 200 OK
        } else {
            $crops = Crop::all();
            return response()->json([
                'success' => true,
                'data' => $crops,
            ], 200); // 200 OK
        }
    } elseif ($request->isMethod('post')) {
        // Validate and create a new crop
        $validated = $request->validate([
            'crop_name' => 'required|string|max:255',
        ]);

        $crop = Crop::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Crop created successfully!',
            'data' => $crop,
        ], 201); // 201 Created
    } elseif ($request->isMethod('put')) {
        // Validate and update an existing crop
        $validated = $request->validate([
            'crop_name' => 'required|string|max:255',
        ]);

        $crop = Crop::find($id);
        if (!$crop) {
            return response()->json([
                'success' => false,
                'message' => 'Crop not found.',
            ], 404); // 404 Not Found
        }

        $crop->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Crop updated successfully!',
            'data' => $crop,
        ], 200); // 200 OK
    } elseif ($request->isMethod('delete')) {
        // Delete crop by ID
        $crop = Crop::find($id);
        if (!$crop) {
            return response()->json([
                'success' => false,
                'message' => 'Crop not found.',
            ], 404); // 404 Not Found
        }

        $crop->delete();

        return response()->json([
            'success' => true,
            'message' => 'Crop deleted successfully!',
        ], 200); // 200 OK
    }

    return response()->json([
        'success' => false,
        'message' => 'Method not allowed.',
    ], 405); // 405 Method Not Allowed
}

//*********************************************************************************************
public function getLandSurveys(Request $request)
{
    try {
        $halqa_id = auth()->user()->halqa_id;

$query_survey = DB::table('cropsurveys')
    ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
    ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
    ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
    ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
    ->where('cropsurveys.status', 0)
    ->select(
        'cropsurveys.crop_survey_id', 
        'irrigators.id as irrigator_id',
        'irrigators.irrigator_name', 
        'irrigators.irrigator_f_name', 
        'irrigators.irrigator_khata_number', 
        'cropsurveys.cultivators_info', 
        'cropprices.id as final_crop_id',
        'cropprices.final_crop', 
        'cropsurveys.crop_price', 
        'cropsurveys.date',
        'cropsurveys.area_marla', 
        'cropsurveys.area_kanal',
        'villages.village_name'
    );

        if ($halqa_id > 0) {
            $query_survey->where('villages.halqa_id', '=', $halqa_id);
        }

        $survey_data = $query_survey->get();

        if ($survey_data->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No survey data found.',
                'data' => []
            ], 404);
        }

        // Group by irrigator_id
        $grouped = $survey_data->groupBy('irrigator_id')->map(function ($items, $key) {
            return [
                'irrigator_id' => $key,
                'irrigator_name' => $items[0]->irrigator_name ?? '',
                'irrigator_khata_number' => $items[0]->irrigator_khata_number ?? '',
                'surveys' => $items
            ];
        })->values(); // Re-index to avoid object keys

        return response()->json([
            'success' => true,
            'message' => 'Grouped survey data retrieved successfully.',
            'data' => $grouped
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error while fetching survey data.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function getSurveyById($id)
{
    try {
        $survey = DB::table('cropsurveys')
            ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
            ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
            ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
            ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
            ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
            ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
            ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
            ->select(
                'cropsurveys.crop_survey_id', 
                'irrigators.irrigator_name', 
                'irrigators.irrigator_khata_number', 
                'cropsurveys.cultivators_info', 
                'cropprices.final_crop', 
                'cropsurveys.crop_price', 
                'cropsurveys.date', 
                'cropsurveys.width', 
                'cropsurveys.length', 
                'cropsurveys.area_marla', 
                'cropsurveys.area_kanal',
                'cropsurveys.session_date',

                'cropsurveys.khasra_number',
                'cropsurveys.tenant_name',
                'cropsurveys.registration_date',
                'cropsurveys.snowing_date',
                'cropsurveys.land_assessment_marla',
                'cropsurveys.land_assessment_kanal',
                'cropsurveys.previous_crop',
                'cropsurveys.double_crop_marla',
                'cropsurveys.double_crop_kanal',
                'cropsurveys.identifable_area_marla',
                'cropsurveys.identifable_area_kanal',
                'cropsurveys.irrigated_area_marla',
                 'cropsurveys.irrigated_area_kanal',
                'cropsurveys.land_quality',

                'villages.village_name',
                'halqa.halqa_name',
                'canals.canal_name',
                'crops.crop_name',
                'outlets.outlet_name'
            )
            ->where('cropsurveys.crop_survey_id', $id)
            ->first();

        if (!$survey) {
            return response()->json([
                'success' => false,
                'message' => 'Survey not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Survey retrieved successfully.',
            'data' => $survey
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while retrieving the survey.',
            'error' => $e->getMessage()
        ], 500);
    }
}


//*****************************************************************************************

public function handleCropPrice(Request $request, $id = null)
{
    if ($request->isMethod('get')) {
        // Fetch specific crop price by ID or all crop prices
        if ($id) {
            $cropPrice = Cropprice::find($id);
            if (!$cropPrice) {
                return response()->json([
                    'success' => false,
                    'message' => 'Crop price not found.',
                ], 404); // 404 Not Found
            }
            return response()->json([
                'success' => true,
                'data' => $cropPrice,
            ], 200); // 200 OK
        } else {
            $cropPrices = Cropprice::all();
            return response()->json([
                'success' => true,
                'data' => $cropPrices,
            ], 200); // 200 OK
        }
    } elseif ($request->isMethod('post')) {
        // Validate and create a new crop price
        $validated = $request->validate([
            'crop_price' => 'required|string|max:255',
            'final_crop' => 'required|string|max:255',
        ]);

        $cropPrice = Cropprice::create([
            'crop_price' => $validated['crop_price'],
            'final_crop' => $validated['final_crop'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Crop price created successfully!',
            'data' => $cropPrice,
        ], 201); // 201 Created
    } elseif ($request->isMethod('put')) {
        // Validate and update an existing crop price
        $validated = $request->validate([
            'crop_price' => 'required|string|max:255',
            'final_crop' => 'required|string|max:255',
        ]);

        $cropPrice = Cropprice::find($id);
        if (!$cropPrice) {
            return response()->json([
                'success' => false,
                'message' => 'Crop price not found.',
            ], 404); // 404 Not Found
        }

        $cropPrice->update([
            'crop_price' => $validated['crop_price'],
            'final_crop' => $validated['final_crop'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Crop price updated successfully!',
            'data' => $cropPrice,
        ], 200); // 200 OK
    } elseif ($request->isMethod('delete')) {
        // Delete crop price by ID
        $cropPrice = Cropprice::find($id);
        if (!$cropPrice) {
            return response()->json([
                'success' => false,
                'message' => 'Crop price not found.',
            ], 404); // 404 Not Found
        }

        $cropPrice->delete();

        return response()->json([
            'success' => true,
            'message' => 'Crop price deleted successfully!',
        ], 200); // 200 OK
    }

    return response()->json([
        'success' => false,
        'message' => 'Method not allowed.',
    ], 405); // 405 Method Not Allowed
}
public function handleOutlet(Request $request, $id = null)
{
    if ($request->isMethod('get')) {
        // Fetch specific outlet by ID or all outlets
        if ($id) {
            $outlet = Outlet::find($id);
            if (!$outlet) {
                return response()->json([
                    'success' => false,
                    'message' => 'Outlet not found.',
                ], 404); // 404 Not Found
            }
            return response()->json([
                'success' => true,
                'data' => $outlet,
            ], 200); // 200 OK
        } else {
            $outlets = Outlet::with('canal:id,canal_name')->get();
            return response()->json([
                'success' => true,
                'data' => $outlets,
            ], 200); // 200 OK
        }
    } elseif ($request->isMethod('post')) {
        // Validate and create a new outlet
        $validated = $request->validate([
            'outlet_name' => 'required|string|max:255|unique:outlets,outlet_name',
            'canal_id' => 'required|exists:canals,id',
        ]);

        $outlet = Outlet::create([
            'outlet_name' => $validated['outlet_name'],
            'canal_id' => $validated['canal_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Outlet created successfully!',
            'data' => $outlet,
        ], 201); // 201 Created
    } elseif ($request->isMethod('put')) {
        // Validate and update an existing outlet
        $validated = $request->validate([
            'outlet_name' => 'required|string|max:255|unique:outlets,outlet_name,' . $id,
            'canal_id' => 'required|exists:canals,id',
        ]);

        $outlet = Outlet::find($id);
        if (!$outlet) {
            return response()->json([
                'success' => false,
                'message' => 'Outlet not found.',
            ], 404); // 404 Not Found
        }

        $outlet->update([
            'outlet_name' => $validated['outlet_name'],
            'canal_id' => $validated['canal_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Outlet updated successfully!',
            'data' => $outlet,
        ], 200); // 200 OK
    } elseif ($request->isMethod('delete')) {
        // Delete outlet by ID
        $outlet = Outlet::find($id);
        if (!$outlet) {
            return response()->json([
                'success' => false,
                'message' => 'Outlet not found.',
            ], 404); // 404 Not Found
        }

        $outlet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Outlet deleted successfully!',
        ], 200); // 200 OK
    }

    return response()->json([
        'success' => false,
        'message' => 'Method not allowed.',
    ], 405); // 405 Method Not Allowed
}

public function getSurveyBill($id)
    {
        // Fetch all records from cropsurveys for the given irrigator_id
        $surveys = DB::table('cropsurveys')
            ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
            ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
            ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
            ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
            ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
            ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
            ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
            ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
            ->join('districts', 'tehsils.district_id', '=', 'districts.id')
            ->join('divisions', 'districts.div_id', '=', 'divisions.id')
            ->select(
                'cropsurveys.crop_survey_id', 
                'cropsurveys.cultivators_info', 
                'cropsurveys.crop_price', 
                'cropsurveys.date', 
                'cropsurveys.width', 
                'cropsurveys.length', 
                'cropsurveys.area_marla', 
                'cropsurveys.area_kanal',
                'cropsurveys.session_date',
                'cropsurveys.khasra_number',
                'cropsurveys.tenant_name',
                'cropsurveys.registration_date',
                'cropsurveys.snowing_date',
                'cropsurveys.land_assessment_marla',
                'cropsurveys.land_assessment_kanal',
                'cropsurveys.previous_crop',
                'cropsurveys.double_crop_marla',
                'cropsurveys.double_crop_kanal',
                'cropsurveys.identifable_area_marla',
                'cropsurveys.identifable_area_kanal',
                'cropsurveys.irrigated_area_marla',
                'cropsurveys.irrigated_area_kanal',
                'cropsurveys.land_quality',
                
                // Single record fields from related tables
                'irrigators.id', 
                'irrigators.irrigator_name', 
                'irrigators.irrigator_khata_number',
                'cropprices.final_crop', 
                'villages.village_name',
                'halqa.halqa_name',
                'canals.canal_name',
                'crops.crop_name',
                'outlets.outlet_name',
                'tehsils.tehsil_name',
                'districts.name',
                'divisions.divsion_name',
            )
            ->where('cropsurveys.irrigator_id', $id)
            ->get();

        if ($surveys->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Survey not found.'
            ], 404);
        }

        // Extract unique related data (from the first survey)
        $relatedData = $surveys->first();

        return response()->json([
            'success' => true,
            'message' => 'Surveys retrieved successfully.',
            'surveys' => $surveys,
            'relatedData' => $relatedData,
        ], 200);
    }
    public function apiGetMinors(Request $request)
    {
        $query = Minorcanal::query();
    
        if ($request->has('canal_id')) {
            $query->where('canal_id', $request->canal_id);
        }
    
        if ($request->has('div_id')) {
            $query->where('div_id', $request->div_id);
        }
    
        $minors = $query->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Minor canals fetched successfully.',
            'data' => $minors
        ]);
    }

public function apiGetDistributariesByCanal($canal_id)
{
    $distributaries = Minorcanal::where('canal_id', $canal_id)->get();

    return response()->json([
        'status' => true,
        'message' => 'Distributaries for the given Canal fetched successfully.',
        'data' => $distributaries
    ]);
}

public function apiGetMinorByDistry($minor_id)
{
    $minors = Distributary::where('minor_id', $minor_id)->get();

    return response()->json([
        'status' => true,
        'message' => 'Minors for the given Distry fetched successfully.',
        'data' => $minors
    ]);
}

public function apiGetBranchByMinor($distrib_id)
{
    $branches = CanalBranch::where('distrib_id', $distrib_id)->get();

    return response()->json([
        'status' => true,
        'message' => 'Branches for the given Minor fetched successfully.',
        'data' => $branches
    ]);
}

public function apiGetOutletByCanal($canal_id)
{
        $Outlets = Outlet::where('canal_id', $canal_id)
    ->where(function($query) {
        $query->whereNull('minor_id')->orWhere('minor_id', '');
    })
    ->where(function($query) {
        $query->whereNull('distrib_id')->orWhere('distrib_id', '');
    })
    ->where(function($query) {
        $query->whereNull('branch_id')->orWhere('branch_id', '');
    })
    ->get();

    return response()->json([
        'status' => true,
        'message' => 'Outlet for the given Canal fetched successfully.',
        'data' => $Outlets
    ]);
}

public function apiGetOutletByDistry($minor_id)
{
    $Outlets = Outlet::where('minor_id', $minor_id)->get();

    return response()->json([
        'status' => true,
        'message' => 'Outlet for the given Distry fetched successfully.',
        'data' => $Outlets
    ]);
}

public function apiGetOutletByMinor($distrib_id)
{
    $Outlets = Outlet::where('distrib_id', $distrib_id)->get();

    return response()->json([
        'status' => true,
        'message' => 'Outlet for the given Minor fetched successfully.',
        'data' => $Outlets
    ]);
}

public function apiGetOutletByBranch($branch_id)
{
    $Outlets = Outlet::where('branch_id', $branch_id)->get();

    return response()->json([
        'status' => true,
        'message' => 'Outlet for the given Branch fetched successfully.',
        'data' => $Outlets
    ]);
}


    
    public function apiGetDistributaries(Request $request)
    {
        $query = Distributary::query();
    
        // Optional filters
        if ($request->has('canal_id')) {
            $query->where('canal_id', $request->canal_id);
        }
    
        if ($request->has('minor_id')) {
            $query->where('minor_id', $request->minor_id);
        }
    
        if ($request->has('div_id')) {
            $query->where('div_id', $request->div_id);
        }
    
        $distributaries = $query->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Distributaries fetched successfully.',
            'data' => $distributaries
        ]);
    }
    
    public function apiGetCanalBranches(Request $request)
    {
        $query = CanalBranch::query();
    
        // Optional filters
        if ($request->has('canal_id')) {
            $query->where('canal_id', $request->canal_id);
        }
    
        if ($request->has('div_id')) {
            $query->where('div_id', $request->div_id);
        }
    
        if ($request->has('minor_id')) {
            $query->where('minor_id', $request->minor_id);
        }
    
        if ($request->has('distrib_id')) {
            $query->where('distrib_id', $request->distrib_id);
        }
    
        $branches = $query->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Canal branches fetched successfully.',
            'data' => $branches
        ]);
    }
    
    public function apiGetCanals(Request $request)
    {
        $query = Canal::query();
    
        // Optional filters
        if ($request->has('div_id')) {
            $query->where('div_id', $request->div_id);
        }
    
        if ($request->has('c_type')) {
            $query->where('c_type', $request->c_type);
        }
    
        $canals = $query->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Canals fetched successfully.',
            'data' => $canals
        ]);
    }
public function apiGetcroplist()
{
    $croplist = Cropprice::all();

    return response()->json([
        'status' => true,
        'message' => 'CropList fetched successfully.',
        'data' => $croplist
    ]);
}


public function apiGetrevenueModel()
{
    $PriceRevenue = PriceRevenue::all();

    return response()->json([
        'status' => true,
        'message' => 'PriceRevenue fetched successfully.',
        'data' => $PriceRevenue
    ]);
}
public function forward_survey_single($crop_survey_id)
{
    $cropsurvey = LandRecord::find($crop_survey_id);

    if (!$cropsurvey) {
        return response()->json([
            'status' => 'error',
            'message' => 'Crop survey record not found.',
        ], 404);
    }

    $cropsurvey->review = 'Patwari forwarded the survey';
    $cropsurvey->status = 1;
    $cropsurvey->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Survey Forwarded Successfully.',
    ], 200);
}

public function delete_survey_single($crop_survey_id)
{
    $cropsurvey = LandRecord::find($crop_survey_id);

    if (!$cropsurvey) {
        return response()->json([
            'status' => 'error',
            'message' => 'Crop survey record not found.',
        ], 404);
    }
    $cropsurvey->delete();
    return response()->json([
        'status' => 'success',
        'message' => 'Survey Deleted Successfully.',
    ], 200);
}

public function delete_irrigator($id)
{
    $irrigator = Irrigator::find($id);

    if (!$irrigator) {
        return response()->json([
            'status' => 'error',
            'message' => 'Irrigator record not found.',
        ], 404);
    }
    $irrigator->delete();
    return response()->json([
        'status' => 'success',
        'message' => 'Irrigator Deleted Successfully.',
    ], 200);
}

public function EditSurvey($id)
{
    try {
        $session_crops = Crop::all();
        $crop_details = Cropprice::all();
        $PriceRevenue = PriceRevenue::all();

        $priceRateData = [];
        foreach ($PriceRevenue as $rate) {
            $priceRateData[$rate->crop_type] = [
                'flow' => $rate->flow,
                'LIS' => $rate->LIS,
                't_well' => $rate->t_well,
                'jhallar' => $rate->jhallar,
            ];
        }

        $survey = DB::table('cropsurveys')
            ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
            ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
            ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
            ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
            ->leftJoin('canals', 'cropsurveys.canal_id', '=', 'canals.id')
            ->leftJoin('minorcanals', 'cropsurveys.minor_id', '=', 'minorcanals.id')
            ->leftJoin('distributaries', 'cropsurveys.distri_id', '=', 'distributaries.id')
            ->leftJoin('canal_branch', 'cropsurveys.branch_id', '=', 'canal_branch.id')
            ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
            ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
            ->select(
                'cropsurveys.*',
                'irrigators.irrigator_name', 
                'irrigators.irrigator_khata_number', 
                'cropprices.final_crop', 
                'cropprices.crop_type', 
                'villages.village_name',
                'halqa.halqa_name',
                'canals.canal_name',
                'canals.c_type as canal_type',
                'crops.crop_name as session_crop_name',
                'outlets.outlet_name',
                'minorcanals.minor_name',
                'distributaries.name as distributary_name',
                'canal_branch.branch_name'
            )
            ->where('cropsurveys.crop_survey_id', $id)
            ->first();

        if (!$survey) {
            return response()->json(['message' => 'Survey not found.'], 404);
        }

        // Determine water source type
        $waterSourceType = '';
        if (!is_null($survey->canal_id) && is_null($survey->minor_id) && is_null($survey->distri_id)) {
            $waterSourceType = 'Canal';
        } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && is_null($survey->distri_id)) {
            $waterSourceType = 'Canal + Minor Canal';
        } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && !is_null($survey->distri_id) && is_null($survey->branch_id)) {
            $waterSourceType = 'Distributary';
        } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && !is_null($survey->distri_id) && !is_null($survey->branch_id)) {
            $waterSourceType = 'Branch';
        }

        return response()->json([
            'survey' => $survey,
            'waterSourceType' => $waterSourceType,
            'price_rate_data' => $priceRateData,
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong.', 'details' => $e->getMessage()], 500);
    }
}

public function UpdateSurvey(Request $request, $crop_survey_id)
{
    try {
        $crop_survey = LandRecord::findOrFail($crop_survey_id);

        $validatedData = $request->validate([
            'crop_id' => 'required',
            'khasra_number' => 'required',
            'tenant_name' => 'required',
            'registration_date' => 'required',
            'cultivators_info' => 'required',
            'snowing_date' => 'required',
            'session_date' => 'required',

            'land_assessment_marla' => 'required',
            'land_assessment_kanal' => 'required',
            'previous_crop' => 'required',

            'date' => 'nullable',
            'length' => 'nullable',
            'width' => 'nullable',
            'area_marla' => 'nullable',
            'area_kanal' => 'nullable',

            'finalcrop_id' => 'required',
            'outlet_id' => 'required',
            'crop_price' => 'required',

            'double_crop_marla' => 'nullable',
            'double_crop_kanal' => 'nullable',

            'irrigated_area_marla' => 'nullable',
            'irrigated_area_kanal' => 'nullable',

            'identifable_area_marla' => 'nullable',
            'identifable_area_kanal' => 'nullable',

            'land_quality' => 'nullable',
            'patwari_user_id' => 'required|numeric|max:255',
        ]);

        // Assign default values to nullable fields
        $validatedData['length'] = $request->input('length', 0);
        $validatedData['width'] = $request->input('width', 0);
        $validatedData['area_marla'] = $request->input('area_marla', 0);
        $validatedData['area_kanal'] = $request->input('area_kanal', 0);
        $validatedData['double_crop_marla'] = $request->input('double_crop_marla', 0);
        $validatedData['double_crop_kanal'] = $request->input('double_crop_kanal', 0);
        $validatedData['irrigated_area_marla'] = $request->input('irrigated_area_marla', 0);
        $validatedData['irrigated_area_kanal'] = $request->input('irrigated_area_kanal', 0);
        $validatedData['identifable_area_marla'] = $request->input('identifable_area_marla', 0);
        $validatedData['identifable_area_kanal'] = $request->input('identifable_area_kanal', 0);
        $validatedData['land_quality'] = $request->input('land_quality', 'N/A');

        $crop_survey->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'Details updated successfully!',
            'data' => $crop_survey
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong! Try again.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function editIrrigator($id,$halqa_id){

    $irrigator = DB::table('irrigators')
        ->join('villages', 'irrigators.village_id', '=', 'villages.village_id')
        ->select('irrigators.*', 'villages.village_name')
        ->where('irrigators.id', $id)
        ->first();

        $villages = $halqa_id > 0 
        ? Village::where('halqa_id', $halqa_id)->get() 
        : Village::all();

    return response()->json([
        'status' => true,
        'message' => 'Irrigator data fetched successfully.',
        'data' => [
            'irrigator' => $irrigator,
            'villages' => $villages
        ]
    ]);
}

public function updateIrrigator(Request $request, $id)
{
    $validatedData = $request->validate([
        'village_id' => 'required|exists:villages,village_id',
        'irrigator_name' => 'required|string|max:255',
        'irrigator_khata_number' => 'required|max:255',
        'irrigator_mobile_number' => 'nullable|string|max:50',
        'irrigator_f_name' => 'required|string|max:255',
        'cnic' => 'nullable|string|max:255',
    ]);
    $irrigator = Irrigator::find($id);

    if (!$irrigator) {
        return response()->json([
            'status' => false,
            'message' => 'Irrigator not found.'
        ], 404);
    }
    $irrigator->update($validatedData);

    return response()->json([
        'status' => true,
        'message' => 'Irrigator updated successfully.',
        'data' => $irrigator
    ]);
}


public function surveyForwardMultiple(Request $request)
{
    $irrigatorIds = $request->input('irrigator_ids');

    if (empty($irrigatorIds)) {
        return response()->json([
            'success' => false,
            'message' => 'No surveys selected!'
        ], 400);
    }

    try {
        // Update LandRecord table
        LandRecord::whereIn('crop_survey_id', $irrigatorIds)->update([
            'status' => 1,
            'review' => 'Forwarded by Patwari'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Forwarding successful for the selected records!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Database update failed!',
            'error' => $e->getMessage() // optional: helpful for debugging
        ], 500);
    }
}

public function irrigator_by_outlet($village_id)
{
$irrigators = DB::table('irrigators')
    ->where('village_id', $village_id)
    ->select([
        'id',
        'irrigator_name',
        'irrigator_khata_number',
    ])
    ->orderByRaw('CAST(irrigator_khata_number AS UNSIGNED) ASC')
    ->get();


    // Check if irrigators found
    if ($irrigators->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No irrigators found for the selected village and outlet.',
        ], 404);
    }

    // Return irrigators
    return response()->json([
        'success' => true,
        'irrigators' => $irrigators,
    ]);
}

 public function checkUpdate(Request $request)
    {
        $latest = AppVersion::orderBy('version_code', 'desc')->first();

        if (!$latest) {
            return response()->json([
                'message' => 'No version found',
            ], 404);
        }

        return response()->json([
            'latest_version' => $latest->version_code,
            'version_name'   => $latest->version_name,
            'apk_url'        => asset($latest->apk_url),
            'force_update'   => (bool)$latest->force_update,
        ]);
    }

}

