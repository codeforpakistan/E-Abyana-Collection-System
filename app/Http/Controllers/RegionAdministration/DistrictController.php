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
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|unique:districts,name',
            'div_id' => 'required|exists:divisions,id', // Ensure it checks the 'id' column of the divisions table
        ], [
            'name.unique' => 'The district name has already been taken.',
            'name.required' => 'The district name is required.',
            'div_id.required' => 'The division is required.',
            'div_id.exists' => 'The selected division does not exist.',
        ]);
    
        // Create a new District record
        District::create([
            'name' => $request->name,
            'div_id' => $request->div_id, // Ensure this matches the column in the districts table
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
   

    
    
    
}