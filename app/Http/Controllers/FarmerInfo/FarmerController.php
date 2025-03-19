<?php

namespace App\Http\Controllers\FarmerInfo;
use Illuminate\Support\Facades\Session;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Village;
use App\Models\Outlet;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\canal;
use App\Models\Divsion;
use App\Models\Crop;
use App\Models\Farmer;

class FarmerController extends Controller
{
    public function AddFarmer(){
        $villages = Village::all(); 
        $districts = District::all();
        $tehsils = Tehsil::all();
        $divsions = Divsion::all(); 
        $canals = canal::all();  
        $crops = Crop::all();
        $Outlets = Outlet::all(); 
        return view('FarmerInformation.AddFarmer',compact('villages',
        'districts',
        'tehsils','divsions','canals','crops','Outlets'));
   
}
public function storeFarmer(Request $request)
{

    
    $validatedData = $request->validate([
        'serial_number' => 'required|string|max:255',
        'registration_date' => 'required|date',
        'assessment_number' => 'required|string|max:255',
        'patwari_name' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'tenant_name' => 'nullable|string|max:255',
        'cultivators_info' => 'required|string',
        'marla' => 'required|integer|min:0',
        'kanal' => 'required|integer|min:0',
        'previous_crop' => 'required|string|max:255',
        'snowing_date' => 'required|date',
        'village_id' => 'required|exists:villages,village_id',
        'division_id' => 'required|exists:divisions,division_id',
        'tehsil_id' => 'required|exists:tehsils,tehsil_id',
        'district_id' => 'required|exists:districts,id',
        'canal_id' => 'required|exists:canals,id',
        'crop_id' => 'required|exists:crops,crop_id',
        'outlet_id' => 'required|exists:outlets,id',
        'water_outlet' => 'required|string|max:255',
        'plat_boundary_number' => 'required|string|max:255',
    ]);

    try {
        // Insert data into the database
        Farmer::create($validatedData);
        Session::flash('success', 'Data Has Been Submitted Successfully');
    } catch (\Exception $e) {
        Session::flash('error', 'Error in inserting data: ' . $e->getMessage());
    }

    // Redirect back to the form (or another page)
    return redirect()->back(); 
}

}
