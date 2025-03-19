<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Village;
use App\Models\canal;
use App\Models\Minorcanal;
use App\Models\Distributary;
use App\Models\Divsion;
class CanalOutLet extends Controller
{
    public function AddOutlet(){
        $canals = canal::all(); 
        $minors = Minorcanal::all();
        $canals = Canal::all();
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

}