<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Village;
use App\Models\Crop;
class CropController extends Controller
{
    public function AddCrop(){
     
        return view('RegionManagments.AddCrop');
   
}
public function storeCrop(Request $request)
{
    // Validate the incoming request
  

    // Debug: Check if data is coming through correctly
    // dd($request->all());

    // Insert crop data
    Crop::create([
        'crop_name' => $request->crop_name,

    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Crop added successfully!');
}


}
