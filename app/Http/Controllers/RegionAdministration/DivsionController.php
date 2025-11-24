<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Divsion;
class DivsionController extends Controller
{
    public function AddDivsion(Request $request)
    {
        $perPage =100;
        $query = Divsion::orderBy('id', 'asc');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('divsion_name', 'like', '%' . $request->search . '%');
        }
    
        $divsions = $query->paginate($perPage);
    
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.divsion_data', compact('divsions'))->render(),
                'next_page' => $divsions->nextPageUrl()
            ]);
        }
    
        return view('RegionManagments.AddDivsion', compact('divsions'));
    }
    
    
    
public function StoreDivsion(Request $request)
{
    // Validation
    $validated = $request->validate([
        'divsion_name' => 'required|string|max:255',
        
    ]);

    // Store in the database
    Divsion::create([
        'divsion_name' => $request->divsion_name,

    ]);
    // Flash success message
    Session()->flash('success', 'Data Has Been Submitted Successfully');


    
    return redirect()->back();
}
public function destroy($id)
{
    $Divsion = Divsion::findOrFail($id);
    $Divsion->delete();

    return redirect()->back()->with('success', 'Division deleted successfully.');
}

public function edit_division($id)
{
    $division = Divsion::findOrFail($id);

    return view('RegionManagments.edit-division', compact('division'));
}

public function update_division(Request $request, $id)
{
    $division = Divsion::findOrFail($id);
    $division->divsion_name = $request->divsion_name;
    $division->save();
    //return redirect()->back()->with('success', 'Division updated successfully');
    return redirect()->route('AddDivsion')->with('success', 'Division updated successfully');

}

}
