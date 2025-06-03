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
        $perPage = 5;
        $query = Divsion::orderBy('id', 'asc');
    
        // 🔍 Apply Search Filter
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

    return redirect()->back()->with('success', 'User deleted successfully.');
}

}
