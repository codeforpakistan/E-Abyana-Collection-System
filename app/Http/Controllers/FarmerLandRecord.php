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
use App\Models\PreviousArrear;
use Carbon\Carbon;

use DB;

class FarmerLandRecord extends Controller
{
    public function dashboard()
    {
        $sys_user_role_id = session('role_id');

        if($sys_user_role_id==1 || $sys_user_role_id==16 || $sys_user_role_id==17){
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
        }elseif ($sys_user_role_id == 12) {
                $sys_user_id = session('id');
    $halqa_id = session('halqa_id');

    $villageIds = DB::table('villages')
        ->where('halqa_id', $halqa_id)
        ->pluck('village_id');

    $totalIrrigators = DB::table('irrigators')
        ->whereIn('village_id', $villageIds)
        ->count();

    $totalCropSurveyAmount = DB::table('cropsurveys')
        ->where('is_billed', 1)
        ->where('patwari_user_id', $sys_user_id)
        ->whereNotNull('area_marla')
        ->whereNotNull('area_kanal')
        ->where('area_marla', '!=', '')
        ->where('area_kanal', '!=', '')
        ->selectRaw('SUM(((area_marla / 20) + area_kanal) * crop_price) as total')
        ->value('total');

    $totalCropSurveyAmount = $totalCropSurveyAmount > 0 ? $totalCropSurveyAmount : 0;

    return view('dashboard', compact('totalIrrigators', 'totalCropSurveyAmount'));
        }elseif($sys_user_role_id == 15){

    $sys_user_id = session('id');
    $halqaIds = DB::table('zilladar_halqas')
        ->where('user_id', $sys_user_id)
        ->pluck('halqa_id');
    $villageIds = DB::table('villages')
        ->whereIn('halqa_id', $halqaIds)
        ->pluck('village_id');
    $totalIrrigators = DB::table('irrigators')
        ->whereIn('village_id', $villageIds)
        ->count();
    $totalCropSurveyAmount = DB::table('cropsurveys')
        ->where('is_billed', 1)
        ->whereIn('village_id', $villageIds)
        ->whereNotNull('area_marla')
        ->whereNotNull('area_kanal')
        ->where('area_marla', '!=', '')
        ->where('area_kanal', '!=', '')
        ->selectRaw('SUM(((area_marla / 20) + area_kanal) * crop_price) as total')
        ->value('total');

    $totalCropSurveyAmount = $totalCropSurveyAmount > 0 ? $totalCropSurveyAmount : 0;

    return view('dashboard', compact('totalIrrigators', 'totalCropSurveyAmount'));
}
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

    $survey->registration_date = $survey->registration_date 
    ? Carbon::parse($survey->registration_date)->format('d/m/Y') 
    : null;

    $survey->snowing_date = $survey->snowing_date 
    ? Carbon::parse($survey->snowing_date)->format('d/m/Y') 
    : null;
    $survey->date = $survey->date 
    ? Carbon::parse($survey->date)->format('d/m/Y') 
    : null;
    
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
            'patwari_user_id' => 'required|numeric|max:255',
        ]);
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

        $validatedData['registration_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['registration_date'])->format('Y-m-d');
        $validatedData['snowing_date']      = Carbon::createFromFormat('d/m/Y', $validatedData['snowing_date'])->format('Y-m-d');
        $validatedData['date'] = !empty($validatedData['date'])
        ? Carbon::createFromFormat('d/m/Y', $validatedData['date'])->format('Y-m-d')
        : null;

       
        $crop_survey->update($validatedData);
        return redirect()->route('edit.survey', ['id' => $crop_survey_id])
                         ->with('success', 'Details Updated successfully!');
    } catch (\Exception $e) {
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
        'registration_date' => 'required|string',
        'cultivators_info' => 'required|string|max:255',
        'snowing_date' => 'required|string',
        'land_assessment_marla' => 'required|string|max:255',
        'land_assessment_kanal' => 'required|string|max:255',
        'previous_crop' => 'required|string|max:255',
        'date' => 'nullable|string',
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
        'minor_id' => 'nullable|numeric',
        'distri_id' => 'nullable|numeric',
        'branch_id' => 'nullable|numeric',
        'crop_id' => 'required|exists:crops,id',
        'outlet_id' => 'required|numeric',
        'finalcrop_id' => 'nullable|exists:cropprices,id',
        'crop_price' => 'nullable|string|max:255',
        'is_billed' => 'required|numeric|max:255',
        'review' => 'required|string|max:255',
        'status' => 'required|numeric|max:255',
        'patwari_user_id' => 'required|numeric|max:255',
    ]);

    $validatedData['registration_date'] = Carbon::createFromFormat('d/m/Y', $validatedData['registration_date'])->format('Y-m-d');
    $validatedData['snowing_date']      = Carbon::createFromFormat('d/m/Y', $validatedData['snowing_date'])->format('Y-m-d');
    $validatedData['date'] = !empty($validatedData['date'])
    ? Carbon::createFromFormat('d/m/Y', $validatedData['date'])->format('Y-m-d')
    : null;
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
    $role_id = session('role_id'); 
    $user_id = session('id'); 
    
    $validatedData = $request->validate([
         'review' => 'nullable|string|max:255',
    ]);

    $cropsurvey = LandRecord::findOrFail($crop_survey_id);
    $cropsurvey->review = $validatedData['review'];
    $cropsurvey->status = 1;

    // Only update patwari_user_id if role_id is 12
    if ($role_id == 12) {
        $cropsurvey->patwari_user_id = $user_id;
    }

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
    $div_id = session('div_id');

    $villages = $halqa_id > 0 ? village::where('halqa_id', $halqa_id)->get() : village::all();

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
            'cropsurveys.session_date',
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

    return view('LandRecord.ListLandSurvey', compact('grouped_survey','villages'));
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
        ->groupBy(
            'cropsurveys.irrigator_id',
            'irrigators.irrigator_name',
            'irrigators.irrigator_khata_number',
            'villages.village_name',
            'cropsurveys.status'
        )
        ->paginate(200); // ✅ pagination
    
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
    $halqa_id   = session('halqa_id');
    $district_id = session('district_id');
    $user_id    = session('id'); 
    $role_id    = session('role_id'); 

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

    // **1️⃣ Admin (halqa_id = 0) → show all records**
    if ($role_id === 1) {
        // no filter
    }
    // **2️⃣ Zilladar → filter records by halqas assigned to this user**
    else {
        $halqaIds = DB::table('zilladar_halqas')
            ->where('user_id', $user_id)
            ->pluck('halqa_id')
            ->toArray();

        if (!empty($halqaIds)) {
          $query_survey->whereIn('halqa.id', $halqaIds);
        } else {
            // If no halqas assigned, return empty
            $query_survey->whereRaw('1 = 0');
        }
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
        ->leftjoin('previous_arrears', 'irrigators.id', '=', 'previous_arrears.irrigator_id')
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
            'previous_arrears.previous_arrears',
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
        ->leftjoin('previous_arrears', 'irrigators.id', '=', 'previous_arrears.irrigator_id')
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
            'previous_arrears.previous_arrears',
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

public function surveyForwardMultiple(Request $request) {
    $role_id = session('role_id'); 
    $user_id = session('id'); 
    $irrigatorIds = $request->input('irrigator_ids');

    if (empty($irrigatorIds)) {
        return response()->json(['success' => false, 'message' => 'No Surveys selected!']);
    }

    try {
        // Base update data
        $updateData = [
            'status' => 1,
            'review' => 'Forwarded by Patwari'
        ];

        // Conditionally add patwari_user_id if user_id is 12
        if ($role_id == 12) {
            $updateData['patwari_user_id'] = $user_id;
        }

        LandRecord::whereIn('crop_survey_id', $irrigatorIds)
            ->update($updateData);

        return response()->json(['success' => true, 'message' => 'Forwarding successful for the selected records!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Database update failed!']);
    }
}

public function surveyForwardZilladarMultiple(Request $request) {
    $role_id = session('role_id'); 
    $user_id = session('id'); 
    $irrigatorIds = $request->input('irrigator_ids');

    if (empty($irrigatorIds)) {
        return response()->json(['success' => false, 'message' => 'No Surveys selected!']);
    }

    try {
        // Base update data
        $updateData = [
            'status' => 2,
            'review' => 'Forwarded by Zilladar'
        ];

        LandRecord::whereIn('crop_survey_id', $irrigatorIds)
            ->update($updateData);

        return response()->json(['success' => true, 'message' => 'Forwarding successful for the selected records!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Database update failed!']);
    }
}

public function surveyForwardCollectorMultiple(Request $request) {
    $role_id = session('role_id'); 
    $user_id = session('id'); 
    $irrigatorIds = $request->input('irrigator_ids');

    if (empty($irrigatorIds)) {
        return response()->json(['success' => false, 'message' => 'No Surveys selected!']);
    }

    try {
        // Base update data
        $updateData = [
            'status' => 3,
            'review' => 'Forwarded by Deputy Collector'
        ];

        LandRecord::whereIn('crop_survey_id', $irrigatorIds)
            ->update($updateData);

        return response()->json(['success' => true, 'message' => 'Forwarding successful for the selected records!']);
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

    $selected_session_date = request()->session_date;

    // Get last five distinct session_date values
    $last_five_session_dates = DB::table('cropsurveys')
        ->select('session_date')
        ->distinct()
        ->orderBy('session_date', 'desc')
        ->limit(5)
        ->pluck('session_date');

    // Default session date = most recent
    if (!$selected_session_date) {
        $selected_session_date = $last_five_session_dates->first();
    }

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

    if ($halqa_id > 0) {
        $query_survey->where('villages.halqa_id', '=', $halqa_id);
    }

    // NEW: Session date filter
    $query_survey->where('cropsurveys.session_date', '=', $selected_session_date);

    $query_survey->whereIn('cropsurveys.status', [1, 2, 3]);

    $survey_get = $query_survey->get();

    $grouped_survey = $survey_get->groupBy('irrigator_id');

    return view('LandRecord.listforwardedpatwari', compact(
        'grouped_survey',
        'last_five_session_dates',
        'selected_session_date'
    ));
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

    return view('LandRecord.listforwardedzilladar', compact('grouped_survey'));
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

public function ReportViewIrrigatorsHalqaWise()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->get();

    return view('Reports.IrrigatorsListHalqaWiseReport', compact('dropdown_divisions'));
}

public function ReportViewIrrigatorsHalqaWiseData(Request $request)
{
    $division_id = $request->division_id;

    $division = DB::table('divisions')
        ->where('id', $division_id)
        ->value('divsion_name');

$data = DB::table('users as u')
    ->join('halqa as h', 'u.halqa_id', '=', 'h.id')
    ->join('tehsils as t', 'h.tehsil_id', '=', 't.tehsil_id')
    ->join('districts as d', 't.district_id', '=', 'd.id')
    ->join('divisions as divs', 'd.div_id', '=', 'divs.id')
    ->leftJoin('villages as v', 'v.halqa_id', '=', 'h.id')
    ->leftJoin('irrigators as i', 'i.village_id', '=', 'v.village_id')
    ->where('divs.id', $division_id)
    ->where('u.role_id', 12)
    ->select(
        'u.id as user_id',
        'u.name as user_name',
        'h.halqa_name',
        'v.village_name',
        DB::raw('COUNT(i.id) as irrigators_count')
    )
    ->groupBy('u.id', 'u.name', 'h.id', 'h.halqa_name', 'v.village_id', 'v.village_name')
    ->orderBy('u.name')
    ->orderBy('h.halqa_name')
    ->orderBy('v.village_name')
    ->get();

        
    $grouped = $data->groupBy('user_name')->map(function ($user) {
        return $user->groupBy('halqa_name');
    });

    return response()->json([
        'html' => view('Reports.PartialIrrigatorsListHalqaWiseReport', compact('grouped', 'division'))->render()
    ]);
}

public function ReportViewPatwariSurvey()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->get();
    $dropdown_seasons = DB::table('crops')
        ->select('crops.id', 'crops.crop_name')
        ->get();
    $dropdown_session_year = DB::table('cropsurveys')
        ->select('session_date')
        ->distinct()
        ->orderBy('session_date', 'desc')
        ->get();

    return view('Reports.PatwariSurveyReport', compact('dropdown_divisions','dropdown_seasons','dropdown_session_year'));
}

public function ReportViewPatwariSurveyData(Request $request)
{
    $div_id       = $request->div_id;
    $crop_id      = $request->crop_id;
    $session_date = $request->session_date;

    // Get division name
    $division = DB::table('divisions')
        ->where('id', $div_id)
        ->value('divsion_name');

    // Fetch survey counts grouped by User -> Halqa -> Village
    $data = DB::table('users as u')
        ->join('halqa as h', 'u.halqa_id', '=', 'h.id')
        ->join('tehsils as t', 'h.tehsil_id', '=', 't.tehsil_id')
        ->join('districts as d', 't.district_id', '=', 'd.id')
        ->join('divisions as divs', 'd.div_id', '=', 'divs.id')
        ->leftJoin('villages as v', 'v.halqa_id', '=', 'h.id')
        ->leftJoin('cropsurveys as cs', 'cs.village_id', '=', 'v.village_id')
        ->where('divs.id', $div_id)
        ->where('u.role_id', 12) // Patwari role
        ->when($crop_id, function ($q) use ($crop_id) {
            $q->where('cs.crop_id', $crop_id);
        })
        ->when($session_date, function ($q) use ($session_date) {
            $q->where('cs.session_date', $session_date);
        })
        ->select(
            'u.id as user_id',
            'u.name as user_name',
            'h.halqa_name',
            'v.village_name',
            DB::raw('COUNT(cs.crop_survey_id) as surveys_count')
        )
        ->groupBy('u.id', 'u.name', 'h.id', 'h.halqa_name', 'v.village_id', 'v.village_name')
        ->orderBy('u.name')
        ->orderBy('h.halqa_name')
        ->orderBy('v.village_name')
        ->get();

    $grouped = $data->groupBy('user_name')->map(function ($user) {
        return $user->groupBy('halqa_name');
    });

    return response()->json([
        'html' => view('Reports.PartialPatwariSurveyReport', compact('grouped', 'division'))->render()
    ]);
}

public function ReportViewNoNic()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->get();

    return view('Reports.NoNicReport', compact('dropdown_divisions'));
}

public function get_irrigator_no_nic(Request $request)
{
    $division_id = $request->division_id;

$division = DB::table('divisions')
    ->where('id', $division_id)
    ->value('divsion_name');

$data = DB::table('users as u')
    ->join('halqa as h', 'u.halqa_id', '=', 'h.id')
    ->join('tehsils as t', 'h.tehsil_id', '=', 't.tehsil_id')
    ->join('districts as d', 't.district_id', '=', 'd.id')
    ->join('divisions as divs', 'd.div_id', '=', 'divs.id')
    ->leftJoin('villages as v', 'v.halqa_id', '=', 'h.id')
    ->leftJoin('irrigators as i', 'i.village_id', '=', 'v.village_id')
    ->where('divs.id', $division_id)
    ->where('u.role_id', 12)
    ->where(function($query) {
        $query->whereNull('i.cnic')
              ->orWhere('i.cnic', 'NOT REGEXP', '^[0-9]{5}-[0-9]{7}-[0-9]{1}$');
    })
    ->select(
        'u.id as user_id',
        'u.name as user_name',
        'h.halqa_name',
        'v.village_name',
        DB::raw('COUNT(i.id) as irrigators_count')
    )
    ->groupBy('u.id', 'u.name', 'h.id', 'h.halqa_name', 'v.village_id', 'v.village_name')
    ->orderBy('u.name')
    ->orderBy('h.halqa_name')
    ->orderBy('v.village_name')
    ->get();

$grouped = $data->groupBy('user_name')->map(function ($user) {
    return $user->groupBy('halqa_name');
});

    return response()->json([
        'html' => view('Reports.PartialIrrigatorsListNoNicReport', compact('grouped', 'division'))->render()
    ]);
}

public function ReportViewPendingArrears()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->get();

    return view('Reports.PendingArrearsReport', compact('dropdown_divisions'));
}

public function get_irrigator_pending_arrears(Request $request)
{
    $division_id = $request->division_id;

    $division = DB::table('divisions')
        ->where('id', $division_id)
        ->value('divsion_name');

    $data = DB::table('users as u')
        ->join('halqa as h', 'u.halqa_id', '=', 'h.id')
        ->join('tehsils as t', 'h.tehsil_id', '=', 't.tehsil_id')
        ->join('districts as d', 't.district_id', '=', 'd.id')
        ->join('divisions as divs', 'd.div_id', '=', 'divs.id')
        ->leftJoin('villages as v', 'v.halqa_id', '=', 'h.id')
        ->leftJoin('irrigators as i', 'i.village_id', '=', 'v.village_id')
        ->leftJoin('previous_arrears as pa', 'pa.irrigator_id', '=', 'i.id')
        ->where('divs.id', $division_id)
        ->where('u.role_id', 12)
        ->select(
            'u.id as user_id',
            'u.name as user_name',
            'h.halqa_name',
            'v.village_name',
            // count irrigators who have entered arrears
            DB::raw('SUM(CASE WHEN pa.irrigator_id IS NOT NULL THEN 1 ELSE 0 END) as arrears_entered'),
            // count irrigators who have no arrears entered
            DB::raw('SUM(CASE WHEN pa.irrigator_id IS NULL THEN 1 ELSE 0 END) as arrears_pending'),
            DB::raw('COUNT(i.id) as total_irrigators')
        )
        ->groupBy('u.id', 'u.name', 'h.id', 'h.halqa_name', 'v.village_id', 'v.village_name')
        ->orderBy('u.name')
        ->orderBy('h.halqa_name')
        ->orderBy('v.village_name')
        ->get();

    $grouped = $data->groupBy('user_name')->map(function ($user) {
        return $user->groupBy('halqa_name');
    });

    return response()->json([
        'html' => view('Reports.PartialIrrigatorsListPendingArrearsReport', compact('grouped', 'division'))->render()
    ]);
}

public function ReportViewCcaArea()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->get();

    return view('Reports.AreaCCAReport', compact('dropdown_divisions'));
}
public function getCanalsByDivisionInReport(Request $request)
{
    $divisionId = $request->division_id;

    $canals = DB::table('canals')
        ->where('div_id', $divisionId)
        ->select('id', 'canal_name')
        ->get();
    return response()->json($canals);
}
public function getOutletByCanalInReport(Request $request)
{
    $canalId = $request->canalId;

    $outlets = DB::table('outlets')
        ->where('canal_id', $canalId)
        ->select('id', 'outlet_name')
        ->get();
    return response()->json($outlets);
}

public function get_cca_data_only_division(Request $request)
{
    $division_id = $request->division_id;

    $division = DB::table('divisions')
        ->where('id', $division_id)
        ->value('divsion_name');

    $total_cca_sum = DB::table('outlets')
        ->where('div_id', $division_id)
        ->sum('total_no_cca');
    $total_cca_sum = number_format($total_cca_sum, 2, '.', '');

    $outlet_ids = DB::table('outlets')
        ->where('div_id', $division_id)
        ->pluck('id');

    // acres = (area_kanal / 8) + (area_marla / 160)

    $assessment_cca_sum = DB::table('cropsurveys')
        ->whereIn('outlet_id', $outlet_ids)
        ->selectRaw('SUM((area_kanal / 8) + (area_marla / 160)) as total_assessment')
        ->value('total_assessment');

    $assessment_cca_sum = number_format($assessment_cca_sum, 2, '.', '');

    /** 🔹 UPDATED CODE — Canal Wise Data WITH CANAL NAME **/
    $canal_data = DB::table('outlets as o')
        ->join('canals as c', 'o.canal_id', '=', 'c.id')
        ->where('o.div_id', $division_id)
        ->whereNotNull('o.canal_id')
        ->select(
            'o.canal_id',
            'c.canal_name',
            DB::raw('SUM(o.total_no_cca) as total_area_cca')
        )
        ->groupBy('o.canal_id', 'c.canal_name')
        ->get();

    $canal_wise_data = [];

    foreach ($canal_data as $canal) {
        $outlet_ids_by_canal = DB::table('outlets')
            ->where('canal_id', $canal->canal_id)
            ->pluck('id');

        $assessment_by_canal = DB::table('cropsurveys')
            ->whereIn('outlet_id', $outlet_ids_by_canal)
            ->selectRaw('SUM((area_kanal / 8) + (area_marla / 160)) as total_assessment')
            ->value('total_assessment');

        $canal_wise_data[] = [
            'canal_id'       => $canal->canal_id,
            'canal_name'     => $canal->canal_name, // added canal name
            'total_area_cca' => number_format($canal->total_area_cca, 2, '.', ''),
            'assessment_cca' => number_format($assessment_by_canal ?? 0, 2, '.', ''),
        ];
    }
    /** 🔹 END UPDATED CODE **/

    return response()->json([
        'html' => view(
            'Reports.PartialAreaCCAReport',
            compact('division', 'total_cca_sum', 'assessment_cca_sum', 'canal_wise_data')
        )->render()
    ]);
}


/* **************************************************************************** */
public function get_cca_data_canal(Request $request)
{
    $division_id = $request->division_id;
    $canal_id = $request->canal_id;

    $division = DB::table('divisions')
        ->where('id', $division_id)
        ->value('divsion_name');

    $canal = DB::table('canals')
        ->where('id', $canal_id)
        ->value('canal_name');

    $total_cca_sum = DB::table('outlets')
        ->where('canal_id', $canal_id)
        ->sum('total_no_cca');
    $total_cca_sum = number_format($total_cca_sum, 2, '.', '');

    $outlet_ids = DB::table('outlets')
        ->where('canal_id', $canal_id)
        ->pluck('id');

    $assessment_cca_sum = DB::table('cropsurveys')
        ->whereIn('outlet_id', $outlet_ids)
        ->selectRaw('SUM((area_kanal / 8) + (area_marla / 160)) as total_assessment')
        ->value('total_assessment');

    $assessment_cca_sum = number_format($assessment_cca_sum, 2, '.', '');

    // ------------------ NEW CODE (DO NOT CHANGE YOUR EXISTING CODE ABOVE) ------------------

$outlets = DB::table('outlets')
    ->where('canal_id', $canal_id)
    ->get()
    ->groupBy(function($item) {
        if ($item->minor_id && !$item->distrib_id && !$item->branch_id) {
            return 'minor_'.$item->minor_id;
        } elseif ($item->minor_id && $item->distrib_id && !$item->branch_id) {
            return 'distrib_'.$item->distrib_id;
        } elseif ($item->minor_id && $item->distrib_id && $item->branch_id) {
            return 'branch_'.$item->branch_id;
        } else {
            return 'others';
        }
    });

$minorNames   = DB::table('minorcanals')->pluck('minor_name','id');
$distribNames = DB::table('distributaries')->pluck('name','id');
$branchNames  = DB::table('canal_branch')->pluck('branch_name','id');
// ----------------------------------------------------------------------------------------

$assessmentPerOutlet = DB::table('cropsurveys')
    ->selectRaw('outlet_id, SUM((area_kanal / 8) + (area_marla / 160)) as total_assessment')
    ->whereIn('outlet_id', $outlet_ids)
    ->groupBy('outlet_id')
    ->pluck('total_assessment', 'outlet_id');


return response()->json([
    'html' => view(
        'Reports.PartialAreaCanalCCAReport',
        compact(
            'division',
            'canal',
            'total_cca_sum',
            'assessment_cca_sum',
            'outlets',
            'minorNames',
            'distribNames',
            'branchNames',
            'assessmentPerOutlet'
        )
    )->render()
]);
}
/* *************************************************************************** */
public function get_cca_data_outlet(Request $request)
{
    $division_id = $request->division_id;
    $canal_id = $request->canal_id;
    $outlet_id = $request->outlet_id;

    $division = DB::table('divisions')
        ->where('id', $division_id)
        ->value('divsion_name');

    $canal = DB::table('canals')
        ->where('id', $canal_id)
        ->value('canal_name');

    $outlet = DB::table('outlets')
        ->where('id', $outlet_id)
        ->value('outlet_name');

    $total_cca_sum = DB::table('outlets')
        ->where('id', $outlet_id)
        ->sum('total_no_cca');
    $total_cca_sum = number_format($total_cca_sum, 2, '.', '');

    $outlet_ids = DB::table('outlets')
        ->where('id', $outlet_id)
        ->pluck('id');

    $assessment_cca_sum = DB::table('cropsurveys')
        ->whereIn('outlet_id', $outlet_ids)
        ->selectRaw('SUM((area_kanal / 8) + (area_marla / 160)) as total_assessment')
        ->value('total_assessment');

    $assessment_cca_sum = number_format($assessment_cca_sum, 2, '.', '');

    return response()->json([
        'html' => view(
            'Reports.PartialAreaOutletCCAReport',
            compact('division','canal','outlet', 'total_cca_sum', 'assessment_cca_sum')
        )->render()
    ]);
}

public function ReportViewPatwariCca()
{
    $dropdown_divisions = DB::table('divisions')
        ->select('divisions.id', 'divisions.divsion_name')
        ->get();

    $dropdown_seasons = DB::table('crops')
        ->select('crops.id', 'crops.crop_name')
        ->get();

    $dropdown_session_year = DB::table('cropsurveys')
        ->select('session_date')
        ->distinct()
        ->orderBy('session_date', 'desc')
        ->get();

    return view('Reports.PatwariCCAReport', compact('dropdown_divisions', 'dropdown_seasons', 'dropdown_session_year'));
}

public function get_patwari_halqa_cca(Request $request)
{
    $div_id       = $request->div_id;
    $crop_id      = $request->crop_id;
    $session_date = $request->session_date;
    
    $division = DB::table('divisions')
        ->where('id', $div_id)
        ->value('divsion_name');

    $total_cca_sum = DB::table('outlets')
        ->where('div_id', $div_id)
        ->sum('total_no_cca');
    $total_cca_sum = number_format($total_cca_sum, 2, '.', '');

    $assessment_cca_sum = DB::table('users as u')
        ->join('halqa as h', 'u.halqa_id', '=', 'h.id')
        ->join('tehsils as t', 'h.tehsil_id', '=', 't.tehsil_id')
        ->join('districts as d', 't.district_id', '=', 'd.id')
        ->join('divisions as divs', 'd.div_id', '=', 'divs.id')
        ->leftJoin('villages as v', 'v.halqa_id', '=', 'h.id')
        ->leftJoin('cropsurveys as cs', 'cs.village_id', '=', 'v.village_id')
        ->where('divs.id', $div_id)
        ->where('u.role_id', 12) // Patwari role
        ->when($crop_id, function ($q) use ($crop_id) {
            $q->where('cs.crop_id', $crop_id);
        })
        ->when($session_date, function ($q) use ($session_date) {
            $q->where('cs.session_date', $session_date);
        })
        ->select(
            'u.id as user_id',
            'u.name as user_name',
            DB::raw('SUM((cs.area_kanal / 8) + (cs.area_marla / 160)) as assessment_cca')
        )
        ->groupBy('u.id', 'u.name')
        ->get();

    /** 🔹 NEW CODE START — calculate Halqa Total CCA for each Patwari **/
    $halqa_cca_data = [];

    foreach ($assessment_cca_sum as $item) {
        $outlet_ids = DB::table('cropsurveys')
            ->where('patwari_user_id', $item->user_id)
            ->distinct()
            ->pluck('outlet_id')
            ->toArray();

        if (!empty($outlet_ids)) {
            $halqa_total_cca = DB::table('outlets')
                ->whereIn('id', $outlet_ids)
                ->sum('total_no_cca');
        } else {
            $halqa_total_cca = 0;
        }

        $halqa_cca_data[$item->user_id] = number_format($halqa_total_cca, 2, '.', '');
    }
    /** 🔹 NEW CODE END **/

    return response()->json([
        'html' => view(
            'Reports.PartialPatwariHalqaWiseCCAReport',
            compact('division', 'total_cca_sum', 'assessment_cca_sum', 'halqa_cca_data')
        )->render()
    ]);
}


}