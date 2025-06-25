<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Village;
use App\Models\Canal;
use App\Models\Minorcanal;
use App\Models\Distributary;
use App\Models\Divsion;
use DB;
class CanalOutLet extends Controller
{
    public function AddOutlet(){
        $canals = Canal::all(); 
        $minors = Minorcanal::all();
        $divsions = Divsion::all();
        $Distributaries = Distributary::all();
        $outlets = Outlet::with(['canal', 'division', 'minor','distributsry'])->paginate(5);
        return view('RegionManagments.CanalOutlet',compact('canals','outlets','divsions',
        'minors','minors','Distributaries'));
    
}

public function storeOutlet(Request $request)
{


    // Create a new Canal Outlet record
    Outlet::create([
        'outlet_name' => $request->outlet_name,
        'total_no_cca' => $request->total_no_cca,
        'total_no_discharge_cusic' => $request->total_no_discharge_cusic,
        'beneficiaries' => $request->beneficiaries,
        'canal_id' => $request->canal_id,
        'minor_id' => $request->minor_id,
        'distrib_id' => $request->distrib_id,
        'div_id' => $request->div_id,

    ]);

    return redirect()->back()->with('success', 'Canal outlet created successfully!');
}
public function getCanals($division_id)
{
    $canals = Canal::where('div_id', $division_id)->get();
    return response()->json($canals);
}

public function getMinors($canal_id)
{
    $minors = MinorCanal::where('canal_id', $canal_id)->get();
    return response()->json($minors);
}

public function getDistributaries($minor_id)
{
    $distributaries = Distributary::where('minor_id', $minor_id)->get();
    return response()->json($distributaries);
}
public function edit($id)
{
    $outlet = Outlet::findOrFail($id);
    $divsions = Divsion::all();
    $canals = Canal::all();
    $minors = Minorcanal::all();
    $Distributaries = Distributary::all();

    return view('RegionManagments.edit-outlet', compact('outlet', 'divsions', 'canals', 'minors', 'Distributaries'));
}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'div_id' => 'required',
        'canal_id' => 'required',
        'minor_id' => 'required',
        'distrib_id' => 'required',
        'outlet_name' => 'required|string|max:255',
        'total_no_cca' => 'required|numeric',
        'beneficiaries' => 'required|string|max:255',
        'total_no_discharge_cusic' => 'required|numeric',
    ]);

    $outlet = Outlet::findOrFail($id);
    $outlet->update($validated);

    return redirect()->back()->with('success', 'Outlet updated successfully');
}


}