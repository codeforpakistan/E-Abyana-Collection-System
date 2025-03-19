<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tehsil;
use App\Models\Village;
use App\Models\Halqa;
use DB;

class VollageController extends Controller
{
    public function AddVillage()
    {
        // Fetch villages with pagination (10 records per page)
        $villages = DB::table('villages')
            ->join('tehsils', 'villages.tehsil_id', '=', 'tehsils.tehsil_id')
            ->join('districts', 'tehsils.district_id', '=', 'districts.id')
            ->join('divisions', 'districts.div_id', '=', 'divisions.id')
            ->select(
                'villages.village_id as village_id',
                'villages.village_name as village_name',
                'tehsils.tehsil_id as tehsil_id',
                'tehsils.tehsil_name as tehsil_name',
                'districts.id as district_id',
                'districts.name as district_name',
                'divisions.id as division_id',
                'divisions.divsion_name as divsion_name'
            )
            ->paginate(10); // Show 10 records per page
    
        // Fetch supporting data
        $Halqas = Halqa::all(); 
        $tehsils = Tehsil::all(); 
    
        // Return the view with paginated data
        return view('RegionManagments.AddVillage', compact('tehsils', 'villages', 'Halqas'));
    }
    
public function StoreVillage(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'village_name' => 'required|string|unique:villages,village_name', // Ensure tehsil name is unique
        'tehsil_id' => 'required|exists:tehsils,tehsil_id',
        'halqa_id' => 'required|exists:halqa,id', 
    ], [
        'village_name.unique' => 'The Village name has already been taken.', // Custom validation message for uniqueness
        'village_name.required' => 'The Village name is required.', // Custom message for required field
        'tehsil_id.required' => 'The Tehsil is required.', // Custom message for required field
        'tehsil_id.exists' => 'The selected district does not exist.', 
        'halqa_id.required' => 'The Tehsil is required.', 
        'halqa_id.exists' => 'The selected district does not exist.'// Custom message for existing district
    ]);

    // Create a new Tehsil record
    Village::create([
        'village_name' => $request->village_name, // Match form input with column name
        'tehsil_id' => $request->tehsil_id,
        'halqa_id' => $request->halqa_id,
        

    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Tehsil created successfully!');
}
}