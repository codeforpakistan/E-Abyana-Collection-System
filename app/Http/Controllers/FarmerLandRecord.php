<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\village;
use App\Models\Outlet;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\Canal;
use App\Models\Divsion;
use App\Models\Irrigator;
use App\Models\Crop;
use App\Models\Farmer;
use App\Models\Halqa;
use App\Models\LandRecord;
use App\Models\Cropprice;
use App\Models\Minorcanal;
use App\Models\Distributary;
use App\Models\CanalBranch;
use App\Models\PriceRevenue;

use DB;

class FarmerLandRecord extends Controller
{
    public function dashboard()
    {
        $totalIrrigators = DB::table('irrigators')->count();
        $totalCanals = DB::table('canals')->count();
        $totalDistry = DB::table('minorcanals')->count();
        $totalMinor = DB::table('distributaries')->count();
        $totalOutlets = DB::table('outlets')->count();

        $totalCropSurveyAmount = DB::table('cropsurveys')
            ->where('is_billed', 1)
            ->whereNotNull('area_marla')
            ->whereNotNull('area_kanal')
            ->where('area_marla', '!=', '')
            ->where('area_kanal', '!=', '')
            ->selectRaw('SUM(((area_marla / 20) + area_kanal) * crop_price) as total')
         ->value('total');
        $totalCropSurveyAmount = $totalCropSurveyAmount > 0 ? $totalCropSurveyAmount : 0;

        return view('dashboard', compact('totalIrrigators', 'totalCanals','totalDistry','totalMinor', 'totalOutlets','totalCropSurveyAmount'));
    }
public function LandRecord($id, $abs, $village_id, $canal_id, $div_id, Request $request)
{
        $villages = village::find($village_id);

        if (!$villages) {
            return redirect()->back()->withErrors(['error' => 'Village not found']);
        }

        $survey = Irrigator::find($id);
        $districts = District::all();
        $tehsils = Tehsil::all();
        $divsions = Divsion::all();
        $divsions1 = Divsion::where('id', $div_id)->first();
        $canals = Canal::where('id', $canal_id)->first();
        $crops = Crop::all();
        $Outlets = Outlet::all();
        $Halqas = Halqa::all();
        $cropprice = Cropprice::all();
        $PriceRevenue = PriceRevenue::all();

        $priceRateData = [];
        foreach ($PriceRevenue as $rate) {
            $priceRateData[$rate->crop_type] = [
                'flow' => $rate->flow,
                'LIS' => $rate->LIS,
                't_well' => $rate->t_well,
                'jhallar' => $rate->jhallar,
            ];
        }
    
        return view('LandRecord.LandRecord', compact(
            'villages',
            'districts',
            'tehsils',
            'divsions',
            'divsions1',
            'canals',
            'crops',
            'Outlets',
            'Halqas',
            'survey',
            'cropprice',
            'PriceRevenue',
            'priceRateData'

        ));
    }
public function EditSurvey($id)
{
    $session_crops = Crop::all();
    $crop_details = Cropprice::all();
     $PriceRevenue = PriceRevenue::all();

        $priceRateData = [];
        foreach ($PriceRevenue as $rate) {
            $priceRateData[$rate->crop_type] = [
                'flow' => $rate->flow,
                'LIS' => $rate->LIS,
                't_well' => $rate->t_well,
                'jhallar' => $rate->jhallar,
            ];
        }
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->leftJoin('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->leftJoin('minorcanals', 'cropsurveys.minor_id', '=', 'minorcanals.id')
        ->leftJoin('distributaries', 'cropsurveys.distri_id', '=', 'distributaries.id')
        ->leftJoin('canal_branch', 'cropsurveys.branch_id', '=', 'canal_branch.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.id as final_crop_id', 
            'cropprices.final_crop', 
            'cropprices.crop_type', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            'cropsurveys.created_at',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',

           
            'villages.village_name',
            'halqa.halqa_name',
            'canals.id as canal_id',
            'canals.canal_name',
            'canals.c_type as canal_type',
            'crops.id as session_crop_id',
            'crops.crop_name as session_crop_name',
            'outlets.outlet_name',
            'minorcanals.minor_name',
            'distributaries.name as distributary_name',
            'canal_branch.id as branch_id',
            'canal_branch.branch_name',
            'cropsurveys.canal_id',
            'cropsurveys.minor_id',
            'cropsurveys.distri_id'
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();

    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }

    // Determine water source type
    $waterSourceType = '';
    if (!is_null($survey->canal_id) && is_null($survey->minor_id) && is_null($survey->distri_id)) {
        $waterSourceType = 'Canal';
    } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && is_null($survey->distri_id)) {
        $waterSourceType = 'Canal + Minor Canal';
    } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && !is_null($survey->distri_id) && is_null($survey->branch_id)) {
        $waterSourceType = 'Distributary';
    } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && !is_null($survey->distri_id) && !is_null($survey->branch_id)) {
        $waterSourceType = 'Branch';
    }

    return view('LandRecord.edit-servey', compact('survey', 'waterSourceType','session_crops','crop_details','PriceRevenue','priceRateData'));
}

public function UpdateSurvey(Request $request, $crop_survey_id){

try {
        $crop_survey = LandRecord::findOrFail($crop_survey_id);

        // Validate required and optional fields
       $validatedData = $request->validate([
            'crop_id' => 'required',
            'khasra_number' => 'required',
            'tenant_name' => 'required',
            'registration_date' => 'required',
            'cultivators_info' => 'required',
            'snowing_date' => 'required',
        
            'land_assessment_marla' => 'required',
            'land_assessment_kanal' => 'required',
            'previous_crop' => 'required',
        
            'date' => 'nullable',
            'length' => 'nullable',
            'width' => 'nullable',
            'area_marla' => 'nullable',
            'area_kanal' => 'nullable',
        
            'finalcrop_id' => 'required',
            'crop_price' => 'required',
        
            'double_crop_marla' => 'nullable',
            'double_crop_kanal' => 'nullable',
        
            'irrigated_area_marla' => 'nullable',
            'irrigated_area_kanal' => 'nullable',
        
            'identifable_area_marla' => 'nullable',
            'identifable_area_kanal' => 'nullable',
        
            'land_quality' => 'nullable',
        ]);

        // Set default values for nullable fields
        $validatedData['length'] = $request->input('length', 0);
        $validatedData['width'] = $request->input('width', 0);
        $validatedData['area_marla'] = $request->input('area_marla', 0);
        $validatedData['area_kanal'] = $request->input('area_kanal', 0);
        $validatedData['double_crop_marla'] = $request->input('double_crop_marla', 0);
        $validatedData['double_crop_kanal'] = $request->input('double_crop_kanal', 0);
        $validatedData['irrigated_area_marla'] = $request->input('irrigated_area_marla', 0);
        $validatedData['irrigated_area_kanal'] = $request->input('irrigated_area_kanal', 0);
        $validatedData['identifable_area_marla'] = $request->input('identifable_area_marla', 0);
        $validatedData['identifable_area_kanal'] = $request->input('identifable_area_kanal', 0);
        $validatedData['land_quality'] = $request->input('land_quality', 'N/A');

        // Update survey
        $crop_survey->update($validatedData);

        // Redirect with success
        return redirect()->route('edit.survey', ['id' => $crop_survey_id])
                         ->with('success', 'Details Updated successfully!');
    } catch (\Exception $e) {
        // Redirect with error
        return redirect()->back()->with('error', 'Somthing Went Wrong!, Try Again Error: ' . $e->getMessage());
    }

}

public function FarmerDistricts($divisionId)
{
    $districts = District::where('div_id', $divisionId)->get();
    return response()->json($districts);
}
public function FarmerTehsils($districtId)
{
    // Fetch tehsils related to the district ID
    $tehsils = Tehsil::where('district_id', $districtId)->get(['tehsil_id', 'tehsil_name']); // Ensure 'id' and 'tehsil_name' exist in your database

    // Return the response as JSON
    return response()->json($tehsils);
}
public function get_outlet($canal_id){
    $canals = Outlet::where('canal_id', $canal_id)->get();
    return response()->json($canals);
}
//---------------------------------------------------
public function get_minor_canal1($canal_id){
    $minor_canals = Minorcanal::where('canal_id', $canal_id)->get();
    return response()->json($minor_canals);
}
public function get_outlet_by_minor($minor_id){
    $outlets_by_minor = Outlet::where('minor_id', $minor_id)->get();
    return response()->json($outlets_by_minor);
}
//----------------------------------------------------
public function get_minor_canals_for_distri($canal_id){
    $minor_canals_for_distri = Minorcanal::where('canal_id', $canal_id)->get();
    return response()->json($minor_canals_for_distri);
}
public function get_distributories_by_minor($minor_id){
    $distri_by_minor = Distributary::where('minor_id', $minor_id)->get();
    return response()->json($distri_by_minor);
}
public function get_outlets_by_distributory($distri_id){
    $outlets_by_distri = Outlet::where('distrib_id', $distri_id)->get();
    return response()->json($outlets_by_distri);
}

public function get_branches_by_distributory($distri_id){
    $branches_by_distri = CanalBranch::where('distrib_id', $distri_id)->get();
    return response()->json($branches_by_distri);
}
public function get_outlet_by_branch($branch_id){
    $outlet_by_branch = Outlet::where('branch_id', $branch_id)->get();
    return response()->json($outlet_by_branch);
}


public function storeFarmer(Request $request)
{
    if ($request->canalType == 'canal') {
        $request->merge([
            'outlet_id' => $request->canal_outlet_id,
            'minor_id' => null,
            'distri_id' => null,
        ]);
    } elseif ($request->canalType == 'minor_canal') {
        $request->merge([
            'outlet_id' => $request->minor_outlet_id,
            'minor_id' => $request->canal_minor_id,
            'distri_id' => null,
        ]);
    } elseif ($request->canalType == 'distributory') {
        $request->merge([
            'outlet_id' => $request->distri_outlet_id,
            'minor_id' => $request->distri_minor_id,
            'distri_id' => $request->distri_id,
        ]);
    }

    $validatedData = $request->validate([
        'khasra_number' => 'required|string|max:255',
        'tenant_name' => 'required|string|max:255',
        'registration_date' => 'required|date',
        'cultivators_info' => 'required|string|max:255',
        'snowing_date' => 'required|date',
        'land_assessment_marla' => 'required|string|max:255',
        'land_assessment_kanal' => 'required|string|max:255',
        'previous_crop' => 'required|string|max:255',
        'date' => 'nullable|date',
        'session_date' => 'required|string|max:255',
        'width' => 'numeric|min:0',
        'length' => 'numeric|min:0',
        'area_marla' => 'nullable|numeric|min:0',
        'area_kanal' => 'nullable|numeric|min:0',
        'double_crop_marla' => 'required|string|max:255',
        'double_crop_kanal' => 'required|string|max:255',
        'identifable_area_marla' => 'required|string|max:255',
        'identifable_area_kanal' => 'required|string|max:255',
        'irrigated_area_marla' => 'required|numeric|min:0',
        'irrigated_area_kanal' => 'required|numeric|min:0',
        'land_quality' => 'required|string|max:255',
        'irrigator_khata_number' => 'required|string|max:255',
        'village_id' => 'required|exists:villages,village_id',
        'irrigator_id' => 'required|exists:irrigators,id',
        'canal_id' => 'required|exists:canals,id',
        'minor_id' => 'nullable|numeric|max:255',
        'distri_id' => 'nullable|numeric|max:255',
        'branch_id' => 'nullable|numeric|max:255',
        'crop_id' => 'required|exists:crops,id',
        'outlet_id' => 'required|numeric|max:255',
        'finalcrop_id' => 'nullable|exists:cropprices,id',
        'crop_price' => 'nullable|string|max:255',
        'is_billed' => 'required|numeric|max:255',
        'review' => 'required|string|max:255',
        'status' => 'required|numeric|max:255',
    ]);

    LandRecord::create($validatedData);
    session()->flash('success', 'Data has been submitted successfully!');
    return redirect()->back();
}

public function surveyReviewForward(Request $request, $crop_survey_id)
{
    $validatedData = $request->validate([
        'review' => 'required|string|max:255',
    ]);
    $cropsurvey = LandRecord::findOrFail($crop_survey_id);
    $cropsurvey->review = $validatedData['review'];
    $cropsurvey->status = 2;
    $cropsurvey->save();
    session()->flash('success', 'Survey review has been updated successfully!');
    return redirect()->route('ListLandSurveyZilladar');
}
public function surveyReviewReverse(Request $request, $crop_survey_id)
{
    $validatedData = $request->validate([
        'review' => 'required|string|max:255',
    ]);
    $cropsurvey = LandRecord::findOrFail($crop_survey_id);
    $cropsurvey->review = $validatedData['review'];
    $cropsurvey->status = 0;
    $cropsurvey->save();
    session()->flash('success', 'Survey review has been updated successfully!');
    return redirect()->route('ListLandSurveyZilladar');
}

public function surveyReviewForwardCollector(Request $request, $crop_survey_id)
{
    $validatedData = $request->validate([
        'review' => 'required|string|max:255',
    ]);
    $cropsurvey = LandRecord::findOrFail($crop_survey_id);
    $cropsurvey->review = $validatedData['review'];
    $cropsurvey->status = 3;
    $cropsurvey->save();
    session()->flash('success', 'Survey review has been updated successfully!');
    return redirect()->route('ListLandSurveyCollector');
}
public function surveyReviewReverseCollector(Request $request, $crop_survey_id)
{
    $validatedData = $request->validate([
        'review' => 'required|string|max:255',
    ]);
    $cropsurvey = LandRecord::findOrFail($crop_survey_id);
    $cropsurvey->review = $validatedData['review'];
    $cropsurvey->status = 1;
    $cropsurvey->save();
    session()->flash('success', 'Survey review has been updated successfully!');
    return redirect()->route('ListLandSurveyCollector');
}
public function surveyReviewForwardPatwari(Request $request, $crop_survey_id)
{
    $validatedData = $request->validate([
        'review' => 'required|string|max:255',
    ]);
    $cropsurvey = LandRecord::findOrFail($crop_survey_id);
    $cropsurvey->review = $validatedData['review'];
    $cropsurvey->status = 1;
    $cropsurvey->save();
    session()->flash('success', 'Survey review has been updated successfully!');
    return redirect()->route('ListLandSurvey');
}


public function ListBills()
{
    $halqa_id = session('halqa_id');
    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.status'
        );

      if ($halqa_id > 0) {
        $survey_get =$query_survey->where('villages.halqa_id', '=', $halqa_id)
      ->where('cropsurveys.status', '=', 3)
      ->where('cropsurveys.is_billed', '=', 1)
      ->get();
       }else{
        $survey_get = $query_survey
        ->where('cropsurveys.status', '=', 3)
        ->where('cropsurveys.is_billed', '=', 1)
        ->get();
       }
    $grouped_survey_bill_eligible = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.ListIrrigatorsBills', compact('grouped_survey_bill_eligible'));
}
public function LandSurvey()
{
    $halqa_id = session('halqa_id');
    $div_id = session('div_id'); // Get division ID from session

    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id') 
        ->join('districts', 'tehsils.district_id', '=', 'districts.id') 
        ->join('divisions', 'districts.div_id', '=', 'divisions.id') 
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->leftJoin('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->leftJoin('minorcanals', 'cropsurveys.minor_id', '=', 'minorcanals.id')
        ->leftJoin('distributaries', 'cropsurveys.distri_id', '=', 'distributaries.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.cultivators_info',
            'cropprices.final_crop',
            'cropsurveys.crop_price',
            'cropsurveys.date',
            'cropsurveys.width',
            'cropsurveys.length',
            'cropsurveys.area_marla',
            'cropsurveys.area_kanal',
            'cropsurveys.status',
            'halqa.id as halqa_id',
            'tehsils.tehsil_name',
            'districts.name as district_name',
            'divisions.divsion_name',
            'crops.crop_name',
            'outlets.outlet_name',
            'canals.canal_name',
            'minorcanals.minor_name',
            'distributaries.name as distributary_name',
            'cropsurveys.canal_id',
            'cropsurveys.minor_id',
            'cropsurveys.distri_id'
        )
        ->where('cropsurveys.status', '=', 0); // Only fetch pending surveys

    // Filter based on session values
    if ($halqa_id == 0 && $div_id == 0) {
        // Admin - show all
    } elseif ($div_id > 0) {
        $query_survey->where('districts.div_id', '=', $div_id);
    } elseif ($halqa_id > 0) {
        $query_survey->where('villages.halqa_id', '=', $halqa_id);
    }

    $survey_get = $query_survey->get();

    // Optional: add water source type (like in viewSurvey)
    $survey_get->transform(function ($item) {
        if (!is_null($item->canal_id) && is_null($item->minor_id) && is_null($item->distri_id)) {
            $item->water_source_type = 'Canal';
        } elseif (!is_null($item->canal_id) && !is_null($item->minor_id) && is_null($item->distri_id)) {
            $item->water_source_type = 'Canal + Minor Canal';
        } elseif (!is_null($item->canal_id) && !is_null($item->minor_id) && !is_null($item->distri_id)) {
            $item->water_source_type = 'Distributary';
        } else {
            $item->water_source_type = 'N/A';
        }
        return $item;
    });

    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.ListLandSurvey', compact('grouped_survey'));
}



public function IrrigatorsForApproval()
{
    // $halqa_id = session('halqa_id');
    // return view('LandRecord.ListLandSurvey', compact('halqa_id'));
    // return view('LandRecord.ListLandSurvey', ['halqa_id' => $halqa_id]);
    
    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            DB::raw('SUM(((area_marla / 20) + area_kanal) * crop_price) AS total_bill_amount'),
            'cropsurveys.status'
        )
        ->where('cropsurveys.status', '=', 3)
        ->where('cropsurveys.is_billed', '=', 0)
        ->groupBy('cropsurveys.irrigator_id', 'irrigators.irrigator_name', 'irrigators.irrigator_khata_number', 'villages.village_name', 'cropsurveys.status')
        ->get();
    
    $grouped_survey_bill_eligible = $query_survey;

    return view('LandRecord.ListIrrigatorsApprovalName', compact('grouped_survey_bill_eligible'));
}
 
 public function IrrigatorsForBills()
{
    //$halqa_id = session('halqa_id');
    //return view('LandRecord.ListLandSurvey', compact('halqa_id'));
    // return view('LandRecord.ListLandSurvey', ['halqa_id' => $halqa_id]);
    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.status'
        );

       // if ($halqa_id > 0) {
         //   $query_survey->where('villages.halqa_id', '=', $halqa_id)
        //                 ->where('cropsurveys.status', '=', 1);
       // }

   $survey_get = $query_survey
    ->where('cropsurveys.status', '=', 3)
    ->where('cropsurveys.is_billed', '=', 1)
    ->get();
    $grouped_survey_bill_eligible = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.ListIrrigatorsBillsName', compact('grouped_survey_bill_eligible'));
}



public function LandSurveyZilladar()
{
    $halqa_id = session('halqa_id');
    $district_id = session('district_id');

    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.cultivators_info',
            'cropprices.final_crop',
            'cropsurveys.crop_price',
            'cropsurveys.date',
            'cropsurveys.width',
            'cropsurveys.length',
            'cropsurveys.area_marla',
            'cropsurveys.area_kanal',
            'cropsurveys.status'
        )
        ->where('cropsurveys.status', '=', 1);

    // **1️⃣ If Admin (halqa_id = 0), show all records**
    if ($halqa_id == 0) {
        // No extra filters needed, already getting all records
    }
    // **2️⃣ If Zilladar (halqa_id > 0), filter district-wise**
    else {
        $query_survey->where('districts.id', '=', $district_id);
    }

    $survey_get = $query_survey->get();
    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.ListLandSurveyZilladar', compact('grouped_survey'));
}



public function LandSurveyCollector()
{
    $halqa_id = session('halqa_id');
    $district_id = session('district_id');

    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.cultivators_info',
            'cropprices.final_crop',
            'cropsurveys.crop_price',
            'cropsurveys.date',
            'cropsurveys.width',
            'cropsurveys.length',
            'cropsurveys.area_marla',
            'cropsurveys.area_kanal',
            'cropsurveys.status'
        )
        ->where('cropsurveys.status', '=', 2); // Only show surveys with status = 2

    // **1️⃣ If Admin (halqa_id = 0), show all records**
    if ($halqa_id == 0) {
        // No extra filters needed, already getting all records
    }
    // **2️⃣ If Collector (halqa_id > 0), filter by district**
    else {
        $query_survey->where('districts.id', '=', $district_id);
    }

    $survey_get = $query_survey->get();
    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.ListLandSurveyCollector', compact('grouped_survey'));
}



public function surveyView($id)
{
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->leftJoin('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->leftJoin('minorcanals', 'cropsurveys.minor_id', '=', 'minorcanals.id')
        ->leftJoin('distributaries', 'cropsurveys.distri_id', '=', 'distributaries.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.final_crop', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',

            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
            'minorcanals.minor_name',
            'distributaries.name as distributary_name',
            'cropsurveys.canal_id',
            'cropsurveys.minor_id',
            'cropsurveys.distri_id'
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();

    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }

    // Determine water source type
    $waterSourceType = '';
    if (!is_null($survey->canal_id) && is_null($survey->minor_id) && is_null($survey->distri_id)) {
        $waterSourceType = 'Canal';
    } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && is_null($survey->distri_id)) {
        $waterSourceType = 'Canal + Minor Canal';
    } elseif (!is_null($survey->canal_id) && !is_null($survey->minor_id) && !is_null($survey->distri_id)) {
        $waterSourceType = 'Distributary';
    }

    return view('LandRecord.viewSurvey', compact('survey', 'waterSourceType'));
}

   





public function surveyViewForwardPatwari($id) {
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.final_crop', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            'cropsurveys.review',
            'cropsurveys.status',

            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();
    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }
    return view('LandRecord.viewSurveyPatwariForward', compact('survey'));
}

public function surveyViewForward($id) {
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.final_crop', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            'cropsurveys.review',
            'cropsurveys.status',

            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();
    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }
    return view('LandRecord.viewSurveyForward', compact('survey'));
}

public function surveyViewReverse($id) {
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.final_crop', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            'cropsurveys.review',
            'cropsurveys.status',

            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();
    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }
    return view('LandRecord.viewSurveyReverse', compact('survey'));
}

public function surveyViewForwardCollector($id) {
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.final_crop', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            'cropsurveys.review',

            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();
    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }
    return view('LandRecord.viewSurveyCollectorForward', compact('survey'));
}
public function surveyViewReverseCollector($id) {
    $survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.irrigator_id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_khata_number', 
            'cropsurveys.cultivators_info', 
            'cropprices.final_crop', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            'cropsurveys.review',

            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
        )
        ->where('cropsurveys.crop_survey_id', $id)
        ->first();
    if (!$survey) {
        return redirect()->back()->with('error', 'Survey not found.');
    }
    return view('LandRecord.viewSurveyCollectorReverse', compact('survey'));
}


public function surveyBillView($id) {
    // Fetch all records from cropsurveys for the given irrigator_id
    $surveys = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('divisions', 'districts.div_id', '=', 'divisions.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.cultivators_info', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            
            // Single record fields from related tables
            'irrigators.id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_f_name', 
            'irrigators.irrigator_khata_number',
            'cropprices.final_crop', 
            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
            'tehsils.tehsil_name',
            'districts.name',
            'divisions.divsion_name',
        )
        ->where('cropsurveys.irrigator_id', $id)
        ->where('cropsurveys.status', '=', 3)
        ->where('cropsurveys.is_billed', '=', 1)
        ->get();

    if ($surveys->isEmpty()) {
        return redirect()->back()->with('error', 'Survey not found.');
    }

    $relatedData = $surveys->first();

    return view('LandRecord.viewBill', [
        'surveys' => $surveys,
        'relatedData' => $relatedData,
    ]);
}


public function surveyBillApprovalView($id) {
    // Fetch all records from cropsurveys for the given irrigator_id
    $surveys = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('divisions', 'districts.div_id', '=', 'divisions.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.cultivators_info', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            
            // Single record fields from related tables
            'irrigators.id', 
            'irrigators.irrigator_name', 
            'irrigators.irrigator_f_name', 
            'irrigators.irrigator_khata_number',
            'cropprices.final_crop', 
            'cropsurveys.session_date',
            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
            'tehsils.tehsil_name',
            'districts.name',
            'divisions.divsion_name',
        )
        ->where('cropsurveys.irrigator_id', $id)
        ->where('cropsurveys.status', '=', 3)
        ->where('cropsurveys.is_billed', '=', 0)
        ->get();

    if ($surveys->isEmpty()) {
        return redirect()->back()->with('error', 'Survey not found.');
    }

    // Extract unique related data (from the first survey)
    $relatedData = $surveys->first();

    return view('LandRecord.viewBill', [
        'surveys' => $surveys,
        'relatedData' => $relatedData, 
    ]);
}

public function surveyApproved($irrigator_id) {
    LandRecord::where('irrigator_id', $irrigator_id)
        ->where('status', 3)
        ->update(['is_billed' => 1]);

    session()->flash('success', 'Approval Successful for matching records.');
    return redirect()->route('ListIrrigatorsForApprovals'); 
}

public function surveyBillMultiple(Request $request)
{
    $request->validate([
        'irrigator_ids' => 'required|array',
    ]);

    $irrigatorIds = $request->input('irrigator_ids');

    $surveys = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->join('canals', 'cropsurveys.canal_id', '=', 'canals.id')
        ->join('crops', 'cropsurveys.crop_id', '=', 'crops.id')
        ->join('outlets', 'cropsurveys.outlet_id', '=', 'outlets.id')
        ->join('tehsils', 'halqa.tehsil_id', '=', 'tehsils.tehsil_id')
        ->join('districts', 'tehsils.district_id', '=', 'districts.id')
        ->join('divisions', 'districts.div_id', '=', 'divisions.id')
        ->select(
            'cropsurveys.crop_survey_id', 
            'cropsurveys.cultivators_info', 
            'cropsurveys.crop_price', 
            'cropsurveys.date', 
            'cropsurveys.width', 
            'cropsurveys.length', 
            'cropsurveys.area_marla', 
            'cropsurveys.area_kanal',
            'cropsurveys.session_date',
            'cropsurveys.khasra_number',
            'cropsurveys.tenant_name',
            'cropsurveys.registration_date',
            'cropsurveys.snowing_date',
            'cropsurveys.land_assessment_marla',
            'cropsurveys.land_assessment_kanal',
            'cropsurveys.previous_crop',
            'cropsurveys.double_crop_marla',
            'cropsurveys.double_crop_kanal',
            'cropsurveys.identifable_area_marla',
            'cropsurveys.identifable_area_kanal',
            'cropsurveys.irrigated_area_marla',
            'cropsurveys.irrigated_area_kanal',
            'cropsurveys.land_quality',
            'irrigators.id as irrigator_id',  
            'irrigators.irrigator_name', 
            'irrigators.irrigator_f_name', 
            'irrigators.irrigator_khata_number',
            'cropprices.final_crop', 
            'villages.village_name',
            'halqa.halqa_name',
            'canals.canal_name',
            'crops.crop_name',
            'outlets.outlet_name',
            'tehsils.tehsil_name',
            'districts.name',
            'divisions.divsion_name'
        )
        ->whereIn('cropsurveys.irrigator_id', $irrigatorIds)
        ->where('cropsurveys.status', '=', 3)
        ->where('cropsurveys.is_billed', '=', 1)
        ->get();

    $relatedData = $surveys->first();

    return view('LandRecord.viewBillAll', [
        'surveys' => $surveys,
        'relatedData' => $relatedData, 
    ]);
}


public function surveyApproveMultiple(Request $request) {
    $irrigatorIds = $request->input('irrigator_ids');

    if (empty($irrigatorIds)) {
        return response()->json(['success' => false, 'message' => 'No irrigators selected!']);
    }

    try {
        LandRecord::whereIn('irrigator_id', $irrigatorIds)
            ->where('status', 3)
            ->update(['is_billed' => 1]);

        return response()->json(['success' => true, 'message' => 'Approval successful for selected records!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Database update failed!']);
    }
}

public function destroy($id)
{
    $landRecord = LandRecord::findOrFail($id);
    $landRecord->delete();

    return redirect()->back()->with('success', 'Irrigator deleted successfully.');
}
////////farwarded///////
public function forwardedpatwari()
{
    $halqa_id = session('halqa_id');

    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.cultivators_info',
            'cropprices.final_crop',
            'cropsurveys.crop_price',
            'cropsurveys.date',
            'cropsurveys.width',
            'cropsurveys.length',
            'cropsurveys.area_marla',
            'cropsurveys.area_kanal',
            'cropsurveys.status'
        );

    // Apply filtering
    if ($halqa_id > 0) {
        $query_survey->where('villages.halqa_id', '=', $halqa_id);
    }

    // Exclude status = 0 and fetch only status 1, 2, 3
    $query_survey->whereIn('cropsurveys.status', [1, 2, 3]);

    // Execute query
    $survey_get = $query_survey->get();

    // Group data by irrigator_id
    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.listforwardedpatwari', compact('grouped_survey'));
}
public function forwardedzilladar()
{
    $halqa_id = session('halqa_id');

    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.cultivators_info',
            'cropprices.final_crop',
            'cropsurveys.crop_price',
            'cropsurveys.date',
            'cropsurveys.width',
            'cropsurveys.length',
            'cropsurveys.area_marla',
            'cropsurveys.area_kanal',
            'cropsurveys.status'
        );

    // Apply filtering
    if ($halqa_id > 0) {
        $query_survey->where('villages.halqa_id', '=', $halqa_id);
    }

    // Exclude status = 0 and fetch only status 1, 2, 3
    $query_survey->whereIn('cropsurveys.status', [ 2, 3]);

    // Execute query
    $survey_get = $query_survey->get();

    // Group data by irrigator_id
    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.listforwardedpatwari', compact('grouped_survey'));
}

public function forwardedcollector()
{
    $halqa_id = session('halqa_id');

    $query_survey = DB::table('cropsurveys')
        ->join('villages', 'cropsurveys.village_id', '=', 'villages.village_id')
        ->join('halqa', 'villages.halqa_id', '=', 'halqa.id')
        ->join('irrigators', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->join('cropprices', 'cropsurveys.finalcrop_id', '=', 'cropprices.id')
        ->select(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.crop_survey_id',
            'cropsurveys.cultivators_info',
            'cropprices.final_crop',
            'cropsurveys.crop_price',
            'cropsurveys.date',
            'cropsurveys.width',
            'cropsurveys.length',
            'cropsurveys.area_marla',
            'cropsurveys.area_kanal',
            'cropsurveys.status'
        );

    // Apply filtering
    if ($halqa_id > 0) {
        $query_survey->where('villages.halqa_id', '=', $halqa_id);
    }

    // Exclude status = 0 and fetch only status 1, 2, 3
    $query_survey->whereIn('cropsurveys.status', [ 3]);

    // Execute query
    $survey_get = $query_survey->get();

    // Group data by irrigator_id
    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.listforwardedcollector', compact('grouped_survey'));
}
//************************ REPORTS ************************************************/
public function ReportViewNaksha5()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->join('irrigators', 'irrigators.div_id', '=', 'divisions.id')
        ->join('cropsurveys', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->groupBy('divisions.id', 'divisions.divsion_name')
        ->get();
    
    $dropdown_session_year = DB::table('cropsurveys')
        ->select('session_date')
        ->distinct()
        ->orderBy('session_date', 'desc')
        ->get();

    return view('Reports.DemandReport', compact('dropdown_divisions', 'dropdown_session_year'));
}

public function ReportViewJinswaar()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->join('irrigators', 'irrigators.div_id', '=', 'divisions.id')
        ->join('cropsurveys', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->groupBy('divisions.id', 'divisions.divsion_name')
        ->get();
    
    $dropdown_session_year = DB::table('cropsurveys')
        ->select('session_date')
        ->distinct()
        ->orderBy('session_date', 'desc')
        ->get();

    return view('Reports.JinswaarReport', compact('dropdown_divisions', 'dropdown_session_year'));
}

public function ReportNaksha5Data(Request $request)
{
    $division_id = $request->division_id;
    $session_year = $request->session_year;

    $records = DB::table('cropsurveys')
        ->join('irrigators', 'irrigators.id', '=', 'cropsurveys.irrigator_id')
        ->join('divisions', 'divisions.id', '=', 'irrigators.div_id')
        ->where('irrigators.div_id', $division_id)
        ->where('cropsurveys.session_date', $session_year)
        ->where('cropsurveys.status', 3)
        ->where('cropsurveys.is_billed', 1)
        ->select(
            'divisions.id as division_id',
            'divisions.divsion_name',
            'cropsurveys.crop_id',
            DB::raw('SUM((cropsurveys.area_kanal + (cropsurveys.area_marla / 20)) / 8) as total_acres'),
            DB::raw('SUM(cropsurveys.crop_price) as total_abyana')
        )
        ->groupBy('divisions.id', 'divisions.divsion_name', 'cropsurveys.crop_id')
        ->get();

    // Structure results grouped by division
    $grouped = $records->groupBy('division_id');

    return response()->json([
        'html' => view('Reports.PartialDemandReport', compact('grouped'))->render()
    ]);
}

public function ReportJinswaarData(Request $request)
{
    $division_id = $request->division_id;
    $session_year = $request->session_year;

    $records = DB::table('cropsurveys')
        ->leftJoin('canals', 'canals.id', '=', 'cropsurveys.canal_id')
        ->leftJoin('minorcanals', 'minorcanals.id', '=', 'cropsurveys.minor_id')
        ->leftJoin('distributaries', 'distributaries.id', '=', 'cropsurveys.distri_id')
        ->leftJoin('canal_branch', 'canal_branch.id', '=', 'cropsurveys.branch_id')
        ->leftJoin('outlets', 'outlets.id', '=', 'cropsurveys.outlet_id')
        ->leftJoin('crops', 'crops.id', '=', 'cropsurveys.crop_id')
        ->leftJoin('cropprices', 'cropprices.id', '=', 'cropsurveys.finalcrop_id')
        ->leftJoin('divisions', 'divisions.id', '=', 'canals.div_id')
        ->where('cropsurveys.status', 3)
        ->where('cropsurveys.is_billed', 1)
        ->where('canals.div_id', $division_id)
        ->where('cropsurveys.session_date', $session_year)
        ->select(
            'divisions.divsion_name',
            'outlets.outlet_name',
            'cropprices.final_crop as final_crop',
            'crops.crop_name as season',
            'canals.canal_name',
            'minorcanals.minor_name',
            'distributaries.name as distry_name',
            'canal_branch.branch_name',
            DB::raw('
                CASE 
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NULL AND cropsurveys.distri_id IS NULL AND cropsurveys.branch_id IS NULL THEN canals.canal_name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NULL AND cropsurveys.branch_id IS NULL THEN minorcanals.minor_name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NOT NULL AND cropsurveys.branch_id IS NULL THEN distributaries.name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NOT NULL AND cropsurveys.branch_id IS NOT NULL THEN canal_branch.branch_name
                    ELSE "Unknown"
                END as channel_name
            '),
            DB::raw('SUM(((cropsurveys.area_kanal * 20) + cropsurveys.area_marla) / 160) as total_acres'),
            DB::raw('SUM(((cropsurveys.crop_price * 8) * ((cropsurveys.area_kanal * 20) + cropsurveys.area_marla) / 160)) as total_abyana')
        )
        ->groupBy(
            'divisions.divsion_name',
            'outlets.outlet_name',
            'cropprices.final_crop',
            'crops.crop_name',
            'canals.canal_name',
            'minorcanals.minor_name',
            'distributaries.name',
            'canal_branch.branch_name',
            'cropsurveys.canal_id',
            'cropsurveys.minor_id',
            'cropsurveys.distri_id',
            'cropsurveys.branch_id'
        )
        ->get();

    // Group by division for frontend rendering
    $grouped = $records->groupBy('divsion_name');

    return response()->json([
        'html' => view('Reports.PartialJinswaarReport', compact('grouped'))->render()
    ]);
}

public function ReportViewMoqabilataan()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->join('irrigators', 'irrigators.div_id', '=', 'divisions.id')
        ->join('cropsurveys', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->groupBy('divisions.id', 'divisions.divsion_name')
        ->get();
    
    $dropdown_session_year = DB::table('cropsurveys')
        ->select('session_date')
        ->distinct()
        ->orderBy('session_date', 'desc')
        ->get();

    return view('Reports.MoqabilataanReport', compact('dropdown_divisions', 'dropdown_session_year'));
}

public function ReportMoqabilataanData(Request $request)
{
    $division_id = $request->division_id;
    $session_year_base = $request->session_year_base;
    $session_year_compare = $request->session_year_compare;

    // Query for Base Year
    $baseRecords = DB::table('cropsurveys')
        ->leftJoin('canals', 'canals.id', '=', 'cropsurveys.canal_id')
        ->leftJoin('minorcanals', 'minorcanals.id', '=', 'cropsurveys.minor_id')
        ->leftJoin('distributaries', 'distributaries.id', '=', 'cropsurveys.distri_id')
        ->leftJoin('canal_branch', 'canal_branch.id', '=', 'cropsurveys.branch_id')
        ->leftJoin('outlets', 'outlets.id', '=', 'cropsurveys.outlet_id')
        ->leftJoin('crops', 'crops.id', '=', 'cropsurveys.crop_id')
        ->leftJoin('cropprices', 'cropprices.id', '=', 'cropsurveys.finalcrop_id')
        ->leftJoin('divisions', 'divisions.id', '=', 'canals.div_id')
        ->where('cropsurveys.status', 3)
        ->where('cropsurveys.is_billed', 1)
        ->where('canals.div_id', $division_id)
        ->where('cropsurveys.session_date', $session_year_base)
        ->select(
            DB::raw('
                CASE 
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NULL AND cropsurveys.distri_id IS NULL AND cropsurveys.branch_id IS NULL THEN canals.canal_name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NULL AND cropsurveys.branch_id IS NULL THEN minorcanals.minor_name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NOT NULL AND cropsurveys.branch_id IS NULL THEN distributaries.name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NOT NULL AND cropsurveys.branch_id IS NOT NULL THEN canal_branch.branch_name
                    ELSE "Unknown"
                END as channel_name
            '),
            'cropprices.final_crop as crop_name',
            DB::raw('SUM(((cropsurveys.area_kanal * 20) + cropsurveys.area_marla) / 160) as total_acres_base'),
            DB::raw('SUM(((cropsurveys.crop_price * 8) * ((cropsurveys.area_kanal * 20) + cropsurveys.area_marla) / 160)) as total_abyana_base')
        )
        ->groupBy('channel_name', 'cropprices.final_crop')
        ->get()
        ->keyBy(fn($item) => $item->channel_name . '||' . $item->crop_name);

    // Query for Compared Year
    $compareRecords = DB::table('cropsurveys')
        ->leftJoin('canals', 'canals.id', '=', 'cropsurveys.canal_id')
        ->leftJoin('minorcanals', 'minorcanals.id', '=', 'cropsurveys.minor_id')
        ->leftJoin('distributaries', 'distributaries.id', '=', 'cropsurveys.distri_id')
        ->leftJoin('canal_branch', 'canal_branch.id', '=', 'cropsurveys.branch_id')
        ->leftJoin('outlets', 'outlets.id', '=', 'cropsurveys.outlet_id')
        ->leftJoin('crops', 'crops.id', '=', 'cropsurveys.crop_id')
        ->leftJoin('cropprices', 'cropprices.id', '=', 'cropsurveys.finalcrop_id')
        ->leftJoin('divisions', 'divisions.id', '=', 'canals.div_id')
        ->where('cropsurveys.status', 3)
        ->where('cropsurveys.is_billed', 1)
        ->where('canals.div_id', $division_id)
        ->where('cropsurveys.session_date', $session_year_compare)
        ->select(
            DB::raw('
                CASE 
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NULL AND cropsurveys.distri_id IS NULL AND cropsurveys.branch_id IS NULL THEN canals.canal_name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NULL AND cropsurveys.branch_id IS NULL THEN minorcanals.minor_name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NOT NULL AND cropsurveys.branch_id IS NULL THEN distributaries.name
                    WHEN cropsurveys.canal_id IS NOT NULL AND cropsurveys.minor_id IS NOT NULL AND cropsurveys.distri_id IS NOT NULL AND cropsurveys.branch_id IS NOT NULL THEN canal_branch.branch_name
                    ELSE "Unknown"
                END as channel_name
            '),
            'cropprices.final_crop as crop_name',
            DB::raw('SUM(((cropsurveys.area_kanal * 20) + cropsurveys.area_marla) / 160) as total_acres_compare'),
            DB::raw('SUM(((cropsurveys.crop_price * 8) * ((cropsurveys.area_kanal * 20) + cropsurveys.area_marla) / 160)) as total_abyana_compare')
        )
        ->groupBy('channel_name', 'cropprices.final_crop')
        ->get()
        ->keyBy(fn($item) => $item->channel_name . '||' . $item->crop_name);

    // Merge and Compare
    $merged = [];

    $allKeys = $baseRecords->keys()->merge($compareRecords->keys())->unique();

    foreach ($allKeys as $key) {
        $base = $baseRecords[$key] ?? null;
        $compare = $compareRecords[$key] ?? null;

        $merged[] = [
            'channel_name' => $base->channel_name ?? $compare->channel_name,
            'crop_name' => $base->crop_name ?? $compare->crop_name,
            'total_acres_base' => $base->total_acres_base ?? 0,
            'total_acres_compare' => $compare->total_acres_compare ?? 0,
            'total_abyana_base' => $base->total_abyana_base ?? 0,
            'total_abyana_compare' => $compare->total_abyana_compare ?? 0,
        ];
    }

    return response()->json([
        'html' => view('Reports.PartialMoqabilataanReport', ['records' => $merged])->render()
    ]);
}

public function ReportViewNakhshaParthal()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->join('irrigators', 'irrigators.div_id', '=', 'divisions.id')
        ->join('cropsurveys', 'cropsurveys.irrigator_id', '=', 'irrigators.id')
        ->groupBy('divisions.id', 'divisions.divsion_name')
        ->get();

    return view('Reports.NakhshaParthalReport', compact('dropdown_divisions'));
}

public function ReportNakhshaParthalData()
{
    
}

}