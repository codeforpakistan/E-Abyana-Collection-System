<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\Divsion;
class TahsilController extends Controller
{
    public function AddTahsil(){
        $tehsils = Tehsil::with('district.division')->paginate(10); 

        $districts = District::all();
        $divsions = Divsion::all();  
        return view('RegionManagments.AddTahsil', compact('districts','tehsils','divsions'));
}
public function getDistricts($divisionId)
{
    $districts = District::where('div_id', $divisionId)->get();

    if ($districts->isEmpty()) {
        return response()->json(['message' => 'No districts found'], 404);
    }

    return response()->json($districts);

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
    Tehsil::create([
        'tehsil_name' => $request->tehsil_name, // Match form input with column name
        'district_id' => $request->district_id,
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Tehsil created successfully!');
}
public function deletetehsil(Request $request)
   {
       if ($request->has('ids')) {
           $ids = array_keys($request->ids); // Extract the IDs from the request
           District::whereIn('id', $ids)->delete(); // Delete the districts with these IDs
           return redirect()->back()->with('success', 'Selected districts deleted successfully!');
       }
       return redirect()->back()->with('error', 'No districts selected.');
   }
   public function edittehsil($id)
{
    $tehsil = Tehsil::findOrFail($id);
    $divsions = Divsion::all();
    $districts = District::where('div_id', $tehsil->div_id)->get();

    return view('RegionManagments.edit-tehsil', compact('tehsil', 'divsions', 'districts'));
}


}
