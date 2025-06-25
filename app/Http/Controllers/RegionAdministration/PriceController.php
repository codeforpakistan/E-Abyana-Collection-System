<?php

namespace App\Http\Controllers\RegionAdministration;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cropprice;
use App\Models\PriceRevenue;

class PriceController extends Controller
{
    
    public function Addrates(){
    $PriceRevenue = PriceRevenue::all();
    return view('RegionManagments.Addrates', compact('PriceRevenue'));

    }
    public function Addprice(){
    
        $Cropprice = Cropprice::all();
        return view('RegionManagments.Addprice',compact('Cropprice'));
        
   
}
 public function Storeprice(Request $request)
{
    
    $validated = $request->validate([
        'final_crop' => 'required|string|max:255',
         'crop_type' => 'required|string|max:255',
        
    ]);

    // Store in the database
    Cropprice::create([
        'final_crop' => $request->final_crop,
        'crop_type' => $request->crop_type,
    ]);
    // Flash success message
    Session()->flash('success', 'Data Has Been Submitted Successfully');


    
    return redirect()->back();
}
public function edit($id)
{
    $cropprice = CropPrice::findOrFail($id);
    return view('RegionManagments.edit-price', compact('cropprice'));
}
public function rates_edit($id)
{
    $PriceRevenue = PriceRevenue::findOrFail($id);
    return view('RegionManagments.edit-rates', compact('PriceRevenue'));
}

public function rates_update(Request $request, $id)
{
    $PriceRevenue = PriceRevenue::findOrFail($id);
    $PriceRevenue->update([
        'crop_type' => $request->crop_type,
        'flow' => $request->flow,
        'LIS' => $request->LIS,
        't_well' => $request->t_well,
        'jhallar' => $request->jhallar,
     
    ]);

    return redirect()->route('Addrates')->with('success', 'Rate Updated Successfully!');
    
}

public function update(Request $request, $id)
{
    $request->validate([
        'crop_type' => 'required',
        'final_crop' => 'required',
    ]);

    $cropprice = CropPrice::findOrFail($id);
    $cropprice->update([
        'crop_type' => $request->crop_type,
        'final_crop' => $request->final_crop,
    ]);

    return redirect()->route('Addprice')->with('success', 'Crop Updated Successfully!');
    
}

public function Storerates(Request $request)
{
    try {
        PriceRevenue::create([
            'crop_type' => $request->crop_type,
            'flow' => $request->flow,
            'LIS' => $request->LIS,
            't_well' => $request->t_well,
            'jhallar' => $request->jhallar,
        ]);
        Session::flash('success', 'Data has been submitted successfully.');
    } catch (\Exception $e) {
        Session::flash('error', 'Something went wrong. Please try again. Error: ' . $e->getMessage());
    }
    return redirect()->back();
}

}
