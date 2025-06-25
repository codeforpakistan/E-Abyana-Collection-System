<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halqa;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\Divsion;
use DB;
class HalqaController extends Controller
{
    public function Addhalqa()
    {
        // Fetch halqas with pagination (10 records per page)
        $halqas = DB::table('halqa')
            ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
            ->join('districts', 'tehsils.district_id', '=', 'districts.id')
            ->join('divisions', 'districts.div_id', '=', 'divisions.id')
            ->select(
                'halqa.id as id',
                'halqa.halqa_name as halqa_name',
                'tehsils.tehsil_id as tehsil_id',
                'tehsils.tehsil_name as tehsil_name',
                'districts.id as district_id',
                'districts.name as district_name',
                'divisions.id as division_id',
                'divisions.divsion_name as divsion_name'
            )
            ->paginate(10); // Pagination enabled with 10 records per page
    
        $tehsils = Tehsil::all(); 
        $divsions = Divsion::all(); 
        $districts = District::all(); 
    
        return view('RegionManagments.AddHalqa', compact('tehsils', 'districts', 'halqas', 'divsions'));
    }
    
public function getTehsils($districtId)
{
    // Fetch tehsils related to the district ID
    $tehsils = Tehsil::where('district_id', $districtId)->get(['tehsil_id', 'tehsil_name']); // Ensure 'id' and 'tehsil_name' exist in your database

    // Return the response as JSON
    return response()->json($tehsils);
}

public function storeHalqa(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'halqa_name' => 'required|string|unique:halqa,halqa_name',
        'tehsil_id' => 'required|exists:tehsils,tehsil_id',
    ], [
        'halqa_name.unique' => 'The halqa name has already been taken.',
        'halqa_name.required' => 'The halqa name is required.',
        'tehsil_id.required' => 'The tehsil is required.',
        'tehsil_id.exists' => 'The selected tehsil does not exist.',
    ]);

    // Create a new Halqa record
    Halqa::create([
        'halqa_name' => $request->halqa_name,
        'tehsil_id' => $request->tehsil_id,
    ]);

    return redirect()->back()->with('success', 'Halqa created successfully!');
}
public function edithalqa($id)
{
    $halqa = Halqa::findOrFail($id);
    $districts = District::all();
    $tehsils = Tehsil::where('district_id', $halqa->district_id)->get();

    return view('RegionManagments.edit-halqa', compact('halqa', 'districts', 'tehsils'));
}


}
