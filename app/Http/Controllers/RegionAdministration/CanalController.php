<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canal;
use App\Models\Divsion;
use App\Models\village;
use App\Models\Minorcanal;
use App\Models\CanalBranch;
use App\Models\Distributary;

class CanalController extends Controller
{
    public function AddCanal(){
        $villages = Village::all(); 
        $divsions = Divsion::all();  
        $canals = Canal::with('village', 'division')->paginate(10);
        return view('RegionManagments.AddCanal', compact('villages', 'canals','divsions'));
    }
    
    public function storeCanal(Request $request)
    {
        // Create a new Canal record
        Canal::create([
            'canal_name' => $request->canal_name,
           // 'village_id' => $request->village_id,
           'c_type' => $request->c_type,
            'div_id' => $request->div_id,
            //'no_outlet' => $request->no_outlet,
           // 'no_outlet_ls' => $request->no_outlet_ls,
           // 'no_outlet_rs' => $request->no_outlet_rs,
            'total_no_cca' => $request->total_no_cca,
            'total_no_discharge_cusic' => $request->total_no_discharge_cusic,
        ]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Canal created successfully!');
    }
    
    public function Addminor(){
       
        $minorCanals = Minorcanal::with('canal', 'division')->paginate(10);
         $canals = Canal::all();
         $divsions = Divsion::all();
        return view('RegionManagments.AddMinor-Canal',compact('divsions','canals','minorCanals'));
    }
    public function storeMinor(Request $request)
    {
        // Create a new Canal record
        Minorcanal::create([
            'minor_name' => $request->minor_name,
            'canal_id' => $request->canal_id,
            'div_id' => $request->div_id,
           // 'no_outlet' => $request->no_outlet,
           // 'no_outlet_ls' => $request->no_outlet_ls,
           // 'no_outlet_rs' => $request->no_outlet_rs,
            'total_no_cca' => $request->total_no_cca,
            'total_no_discharge_cusic' => $request->total_no_discharge_cusic,
        ]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Canal created successfully!');
    }
    public function AddDistributary(){
        
        $Distributaries = Distributary::with(['canal', 'division', 'minor'])->paginate(10);
        $minors = Minorcanal::all();
         $canals = Canal::all();
         $divsions = Divsion::all();
        return view('RegionManagments.Distributary',compact('divsions','canals','minors','Distributaries'));
    }
    public function storeDistributaries(Request $request)
    {
  
    
        // Create a new Canal record
        Distributary::create([
            'name' => $request->name,
            'canal_id' => $request->canal_id,
            'minor_id' => $request->minor_id,
            'div_id' => $request->div_id,
            //'no_outlet' => $request->no_outlet,
            //'no_outlet_ls' => $request->no_outlet_ls,
           // 'no_outlet_rs' => $request->no_outlet_rs,
            'total_no_cca' => $request->total_no_cca,
            'total_no_discharge_cusic' => $request->total_no_discharge_cusic,
        ]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Canal created successfully!');
    }
public function getCanals(Request $request)
{
    $canals = Canal::where('div_id', $request->div_id)->get();
    return response()->json($canals);
}

public function distributary(Request $request)
{
    $canals = Canal::where('div_id', $request->div_id)->get();
    return response()->json($canals);
}


public function getMinors(Request $request)
{
    $minors = Minorcanal::where('canal_id', $request->canal_id)->get();
    return response()->json($minors);
}
public function fetchCanals(Request $request)
{
    $canals = Canal::where('div_id', $request->division_id)->get();
    return response()->json($canals);
}

// Fetch minor canals based on selected canal
public function fetchMinorCanals(Request $request)
{
    $minors = MinorCanal::where('id', $request->canal_id)->get();
    return response()->json($minors);
}

// Fetch distributary canals based on selected minor canal
public function fetchDistributaryCanals(Request $request)
{
    $distributaries = Distributary::where('id', $request->minor_id)->get();
    return response()->json($distributaries);
}
public function edit($id)
{
    $canal = Canal::findOrFail($id);
    $villages = Village::all();
    $divisions = Divsion::all();
    return view('RegionManagments.edit-canal', compact('canal', 'villages', 'divisions'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'div_id' => 'required',
        'canal_name' => 'required',
        'c_type' => 'required',
        'total_no_cca' => 'required|numeric',
        'total_no_discharge_cusic' => 'required|numeric',
    ]);

    $canal = Canal::findOrFail($id);
    $canal->div_id = $request->div_id;
    $canal->canal_name = $request->canal_name;
    $canal->c_type = $request->c_type;
    $canal->total_no_cca = $request->total_no_cca;
    $canal->total_no_discharge_cusic = $request->total_no_discharge_cusic;
    $canal->save();

    return redirect()->route('AddCanal')->with('success', 'Canal updated successfully');
}
public function editminor($id)
{
    $minorCanal = MinorCanal::findOrFail($id);
    $divisions = Divsion::all();
    $canals = Canal::all();

    return view('RegionManagments.edit-minor',compact('minorCanal', 'divisions', 'canals'));
}
public function updateminor(Request $request, $id)
{
    $request->validate([
        'div_id' => 'required',
        'canal_id' => 'required',
        'minor_name' => 'required',
        'total_no_cca' => 'required|integer',
        'total_no_discharge_cusic' => 'required|integer',
    ]);

    $minorCanal = MinorCanal::findOrFail($id);
    $minorCanal->update($request->all());

    return redirect()->route('AddMinor-Canal')->with('success', 'Minor Canal updated successfully');
}
public function editdistributary($id)
{
    $distributary = Distributary::findOrFail($id);
    $minors = Minorcanal::all();
    $divisions = Divsion::all();
    $canals = Canal::all();
    return view('RegionManagments.edit-distributary',compact('minors', 'divisions', 'canals','distributary'));
}

public function updatedistributary(Request $request, $id)
{
    $request->validate([
        'div_id' => 'required',
        'canal_id' => 'required',
        'minor_id' => 'required',
        'name' => 'required|string|max:255',
        'total_no_cca' => 'required|integer',
        'total_no_discharge_cusic' => 'required|integer',
    ]);

    $distributary = Distributary::findOrFail($id);
    $distributary->update($request->all());
    return redirect()->route('Distributary')->with('success', 'Minor updated successfully');
}

public function Addbranch(){
    $branches = CanalBranch::with(['canal', 'division', 'minor', 'distributary'])->get();
    $canals = Canal::all(); 
    $minors = Minorcanal::all();
    $divsions = Divsion::all();
    $Distributaries = Distributary::all();
    return view('RegionManagments.AddBranch',compact('divsions','canals','minors','Distributaries','branches'));
}
public function store(Request $request)
{
    CanalBranch::create([
        'branch_name' => $request->branch_name,
        'canal_id' => $request->canal_id,
        'div_id' => $request->div_id,
        'minor_id' => $request->minor_id,
        'distrib_id' => $request->distrib_id,
        //'no_outlet' => $request->no_outlet,
        //'no_outlet_ls' => $request->no_outlet_ls,
        //'no_outlet_rs' => $request->no_outlet_rs,
        'total_no_cca' => $request->total_no_cca,
        'total_no_discharge_cusic' => $request->total_no_discharge_cusic,
    ]);
    return redirect()->back()->with('success', 'Canal Branch inserted successfully!');
}
}