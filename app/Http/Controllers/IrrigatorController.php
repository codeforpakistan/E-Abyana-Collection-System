<?php

namespace App\Http\Controllers;
use App\Models\Irrigator;
use Illuminate\Http\Request;
use App\Models\village;
use App\Models\Outlet;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\Canal;
use App\Models\Divsion;
use App\Models\Crop;
use App\Models\Halqa;
use App\Models\PreviousArrear;
use DB;
class IrrigatorController extends Controller
{
public function AddIrrigator(Request $request)
{
    $halqa_id = session('halqa_id');
    $district_id = session('district_id');
    $village_id = $request->get('village_id');

    // Main query with survey_count
    $query = DB::table('irrigators')
        ->join('villages', 'irrigators.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('divisions', 'districts.div_id', '=', 'divisions.id')
        // Left join to count cropsurveys where status = 1
        ->leftJoin(DB::raw("(SELECT irrigator_id, COUNT(*) AS survey_count 
                             FROM cropsurveys 
                             WHERE status = 1 
                             GROUP BY irrigator_id) AS cs"), 
                   'irrigators.id', '=', 'cs.irrigator_id')
        ->select(
            'irrigators.id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_f_name',
            'irrigators.irrigator_khata_number',
            'irrigators.cnic',
            'irrigators.irrigator_mobile_number',
            'irrigators.canal_id',
            'villages.village_id AS village_id',
            'villages.village_name AS village_name',
            'villages.halqa_id',
            'halqa.halqa_name AS halqa_name',
            'tehsils.tehsil_id AS tehsil_id',
            'tehsils.tehsil_name AS tehsil_name',
            'districts.id AS district_id',
            'districts.name AS district_name',
            'divisions.id AS div_id',
            'divisions.divsion_name AS divsion_name',
            DB::raw('IFNULL(cs.survey_count, 0) AS survey_count')
        );

    if ($halqa_id > 0) {
        $query->where('villages.halqa_id', '=', $halqa_id);
    }

    if ($village_id) {
        $query->where('villages.village_id', '=', $village_id);
    }

    $Irrigators = $query->get();

    if ($request->ajax()) {
        return view('AddIrragtorPartialTable', compact('Irrigators'))->render();
    }

    // First load view
    $villages = $halqa_id > 0 ? village::where('halqa_id', $halqa_id)->get() : village::all();
    $Halqas = $halqa_id > 0 ? Halqa::where('id', $halqa_id)->get() : Halqa::all();

    $districts = District::all();
    $tehsils = Tehsil::all();
    if ($halqa_id > 0) {
        $get_district = District::find($district_id);
        $divsions = Divsion::where('id', $get_district->div_id)->get();
    } else {
        $divsions = Divsion::all();
    }
    $canals = Canal::all();

    return view('AddIrragtor', compact(
        'villages', 'canals', 'districts', 'tehsils', 'divsions', 'Halqas', 'Irrigators'
    ));
}


public function AddArrearsView(Request $request)
{
    $halqa_id = session('halqa_id');
    $district_id = session('district_id');
    $village_id = $request->get('village_id');

    $query = DB::table('irrigators')
        ->join('villages', 'irrigators.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('divisions', 'districts.div_id', '=', 'divisions.id')
        ->select(
            'irrigators.id',
            'irrigators.irrigator_name',
             'irrigators.irrigator_f_name',
            'irrigators.irrigator_khata_number',
            'irrigators.cnic',
            'irrigators.irrigator_mobile_number',
            'irrigators.canal_id',
            'villages.village_id AS village_id',
            'villages.village_name AS village_name',
            'villages.halqa_id',
            'halqa.halqa_name AS halqa_name',
            'tehsils.tehsil_id AS tehsil_id',
            'tehsils.tehsil_name AS tehsil_name',
            'districts.id AS district_id',
            'districts.name AS district_name',
            'divisions.id AS div_id',
            'divisions.divsion_name AS divsion_name'
        );
        
    $query->whereNotIn('irrigators.id', function ($subquery) {
        $subquery->select('irrigator_id')->from('previous_arrears');
    });

    if ($halqa_id > 0) {
        $query->where('villages.halqa_id', '=', $halqa_id);
    }

    if ($village_id) {
        $query->where('villages.village_id', '=', $village_id);
    }

    $Irrigators = $query->get();

    if ($request->ajax()) {
        return view('AddArrearsIrragtorPartialTable', compact('Irrigators'))->render();
    }

    // First load view
    $villages = $halqa_id > 0 ? village::where('halqa_id', $halqa_id)->get() : village::all();
    $Halqas = $halqa_id > 0 ? Halqa::where('id', $halqa_id)->get() : Halqa::all();

    $districts = District::all();
    $tehsils = Tehsil::all();
    if($halqa_id > 0){
     $get_district = District::find($district_id);
     $divsions = Divsion::where('id', $get_district->div_id)->get();
    }else{
     $divsions = Divsion::all();
    }
    $canals = Canal::all();

    return view('AddArrearsView', compact('villages', 'canals', 'districts', 'tehsils', 'divsions', 'Halqas', 'Irrigators'));
}

public function StoreArrears(Request $request)
{
    try {
        $request->validate([
            'previous_arrears' => 'required|numeric',
            'irrigator_id' => 'required|integer|exists:irrigators,id',
            'div_id' => 'required|integer|exists:divisions,id',
        ]);

        PreviousArrear::create([
            'previous_arrears' => $request->previous_arrears,
            'irrigator_id' => $request->irrigator_id,
            'div_id' => $request->div_id,
        ]);

        return response()->json([
            'success' => 'Arrear added successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Something went wrong. Please try again later.',
        ], 500);
    }
}



    public function Search(Request $request)
    {
        $query = DB::table('irrigators')
            ->select('id', 'irrigator_name', 'irrigator_khata_number', 'cnic', 'irrigator_mobile_number');
    
        if ($request->ajax()) {
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('irrigator_name', 'LIKE', "%$search%")
                      ->orWhere('irrigator_khata_number', 'LIKE', "%$search%")
                      ->orWhere('cnic', 'LIKE', "%$search%")
                      ->orWhere('irrigator_mobile_number', 'LIKE', "%$search%");
                });
            }
    
            $Irrigators = $query->get();
            return view('partials.irrigators_list', compact('Irrigators'))->render();
        }
    
        $Irrigators = $query->paginate(60);
        return view('AddIrragtor', compact('Irrigators'));
    }
    
    
public function StoreIrrgator(Request $request)
{
    try {
        $validated = $request->validate([
            'irrigator_name' => 'required|string|max:255',
            'irrigator_khata_number' => 'required|integer',
            'cnic' => 'nullable|string|max:255',
            'irrigator_f_name' => 'required|string|max:255',
            'irrigator_mobile_number' => 'nullable|string|max:255',
            'village_id' => 'required|exists:villages,village_id',
            'canal_id' => 'required|exists:canals,id',
            'div_id' => 'required|exists:divisions,id',
        ]);

        $request->validate([
            'previous_arrears' => 'nullable|numeric',
        ]);

        $duplicate = Irrigator::where('irrigator_khata_number', $request->irrigator_khata_number)
            ->where('village_id', $request->village_id)
            ->exists();

        if ($duplicate) {
            return response()->json([
                'error' => 'The irrigator with the same khata number already exists in this village.'
            ], 422);
        }

        $irrigator = Irrigator::create($validated);

        if ($request->previous_arrears !== null && $request->previous_arrears !== '') {
            PreviousArrear::create([
                'previous_arrears' => $request->previous_arrears,
                'irrigator_id' => $irrigator->id,
                'div_id' => $request->div_id,
            ]);
        }


        return response()->json([
            'success' => 'Data has been submitted successfully.'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Something went wrong. Please try again later.',
            'message' => $e->getMessage(),
        ], 500);
    }
}


public function Districts($divisionId)
{
    $districts = District::where('div_id', $divisionId)->get();
    return response()->json($districts);
}

public function Canals($villageID)
{
    $canals_data = canal::where('village_id', $villageID)->get();
    return response()->json($canals_data);
}


public function Tehsils($districtId)
{
    // Fetch tehsils related to the district ID
    $tehsils = Tehsil::where('district_id', $districtId)->get(['tehsil_id', 'tehsil_name']); // Ensure 'id' and 'tehsil_name' exist in your database

    // Return the response as JSON
    return response()->json($tehsils);
}
public function Halqa($tehsilId)
{
    // Fetch halqas related to the tehsil ID
    $halqas = Halqa::where('tehsil_id', $tehsilId)->get(['id', 'halqa_name']);

    // Return the response as JSON
    return response()->json($halqas);
}
public function Village($halqaId)
{
    // Fetch villages related to the Halqa ID
    $villages = village::where('halqa_id', $halqaId)->get(['village_id', 'village_name']);

    // Return the response as JSON
    return response()->json($villages);
}

public function ListIrrigator(){
    
    $Irrigators = DB::table('irrigators')
    ->join('villages', 'irrigators.village_id', '=', 'villages.village_id')
    ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
    ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
    ->join('districts', 'tehsils.district_id', '=', 'districts.id')
    ->join('divisions', 'districts.div_id', '=', 'divisions.id')
    ->select(
        'irrigators.id',                   
        'irrigators.irrigator_name',    
        'irrigators.irrigator_f_name',     
        'irrigators.irrigator_khata_number',
        'irrigators.irrigator_mobile_number',
        'villages.village_id AS village_id',
        'villages.village_name AS village_name',
        'halqa.id AS halqa_id',
        'halqa.halqa_name AS halqa_name',
        'tehsils.tehsil_id AS tehsil_id',
        'tehsils.tehsil_name AS tehsil_name',
        'districts.id AS district_id',
        'districts.name AS district_name',
        'divisions.id AS div_id',
        'divisions.divsion_name AS divsion_name'
    )
    ->get();
    return view('AddIrragtor',compact('Irrigators'));

}
public function AddSurvey($id, Request $request)
{
 $survey=Irrigator::find($id);

 return view('LandRecord/LandRecord')->with('survey',$survey);
}

public function destroy($id)
{
    $irrigator = Irrigator::findOrFail($id);
    $irrigator->delete();

    return redirect()->back()->with('success', 'Irrigator deleted successfully.');
}
public function editIrrigator($id)
{
    $halqa_id = session('halqa_id'); 
    $irrigator = Irrigator::findOrFail($id);
   // $villages = village::all();
    $villages = $halqa_id > 0 ? village::where('halqa_id', $halqa_id)->get() : village::all();
    return view('edit-irrigator', compact('irrigator', 'villages'));
}
public function update(Request $request, $id)
{
    $irrigator = Irrigator::findOrFail($id);

    $validatedData = $request->validate([
        'village_id' => 'required|exists:villages,village_id',
        'irrigator_name' => 'required|string|max:255',
        'irrigator_khata_number' => 'required|max:255',
        'irrigator_mobile_number' => 'nullable|string|max:50',
        'irrigator_f_name' => 'required|string|max:255',
        'cnic' => 'nullable|string|max:255',
    ]);

    $irrigator->update($validatedData);

    return redirect()->back()->with('success', 'Irrigator updated successfully!');
}

}

