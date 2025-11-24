<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Divsion;
class DistrictController extends Controller
{
    public function AddDistrict(){
        $districts = District::with('division')->get(); 
        $divsions = Divsion::all();  
        return view('RegionManagments.AddDistrict')->with('districts',$districts)->with('divsions',$divsions);
    }
  
    public function StoreDistrict(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:districts,name',
            'div_id' => 'required|exists:divisions,id',
        ], [
            'name.unique' => 'The district name has already been taken.',
            'name.required' => 'The district name is required.',
            'div_id.required' => 'The division is required.',
            'div_id.exists' => 'The selected division does not exist.',
        ]);
        District::create([
            'name' => $request->name,
            'div_id' => $request->div_id,
        ]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'District created successfully!');
    }
    
   // In DistrictController.php
   public function delete(Request $request)
   {
       if ($request->has('ids')) {
           $ids = array_keys($request->ids); // Extract the IDs from the request
           District::whereIn('id', $ids)->delete(); // Delete the districts with these IDs
           return redirect()->back()->with('success', 'Selected districts deleted successfully!');
       }
       return redirect()->back()->with('error', 'No districts selected.');
   }
   public function edit($id)
{
    $district = District::findOrFail($id);
    $divsions = Divsion::all();
    return view('RegionManagments.edit-district', compact('district', 'divsions'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'div_id' => 'required|integer',
        'name' => 'required|string|max:255',
    ]);

    $district = District::findOrFail($id);
    $district->div_id = $request->div_id;
    $district->name = $request->name;

    $district->save();

    return redirect()->route('AddDistrict')->with('success', 'District updated successfully!');
}
public function getByDivision($division_id)
{
    $districts = District::where('div_id', $division_id)->get();

    return response()->json($districts);
}
    
}