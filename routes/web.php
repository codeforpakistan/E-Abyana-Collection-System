<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegionAdministration\DistrictController;
use App\Http\Controllers\RegionAdministration\CropController;
use App\Http\Controllers\RegionAdministration\VollageController;
use App\Http\Controllers\RegionAdministration\TahsilController;
use App\Http\Controllers\RegionAdministration\CanalController;
use App\Http\Controllers\RegionAdministration\DivsionController;
use App\Http\Controllers\RegionAdministration\CanalOutLet;
use App\Http\Controllers\FarmerInfo\FarmerController;
use App\Http\Controllers\Login;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AssignRController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionAdministration\HalqaController;
use App\Http\Controllers\RegionAdministration\PriceController;
use App\Http\Controllers\RegionAdministration\ControllerPatwari;
use App\Http\Controllers\IrrigatorController;
use App\Http\Controllers\FarmerLandRecord;
use App\Http\Controllers\LogoutController;

// Public routes (Login & Logout)
Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/signin', [Login::class, 'make_login'])->name('signin');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Grouping protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [FarmerLandRecord::class, 'dashboard']);
    Route::get('/dashboard', [FarmerLandRecord::class, 'dashboard'])->name('dashboard');

    Route::get('/table', function () {
        return view('table');
    });

    Route::get('/datatables', function () {
        return view('datatables');
    });

    Route::get('/users', function () {
        return view('userlist');
    });

    Route::get('/register', function () {
        return view('register');
    });

    Route::get('/form', function () {
        return view('form');
    });

    Route::get('/formadvance', function () {
        return view('formadvance');
    });

    Route::get('/profile', function () {
        return view('profile');
    });

    // Your existing protected routes
    Route::get('AddDistrict', [DistrictController::class, 'AddDistrict'])->name('AddDistrict');
    Route::post('AddDistrict/add', [DistrictController::class, 'StoreDistrict'])->name('AddDistrict.add');
    Route::delete('deletedistrict', [DistrictController::class, 'delete'])->name('district.delete');
    Route::get('district/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
    Route::put('district/update/{id}', [DistrictController::class, 'update'])->name('district.update');

    Route::delete('districts/delete', [DistrictController::class, 'deleteMultiple'])->name('districts.delete');
    Route::delete('tehsil/delete', [TahsilController::class, 'deletetehsil'])->name('tehsil.delete');
    Route::get('tehsil/edit/{id}', [TahsilController::class, 'edittehsil'])->name('tehsil.edit');
    Route::get('/get-districts/{division_id}', [DistrictController::class, 'getByDivision']);

Route::put('tehsil/update/{id}', [TahsilController::class, 'updatetehsil'])->name('tehsil.update');

    Route::post('CanalOutlet/add', [CanalOutLet::class, 'storeOutlet'])->name('CanalOutlet/add');
    Route::get('AddVillage', [VollageController::class, 'AddVillage'])->name('AddVillage');
    Route::post('AddVillage/add', [VollageController::class, 'StoreVillage'])->name('AddVillage/add');

    Route::get('AddCrop', [CropController::class, 'AddCrop'])->name('AddCrop');
    Route::post('AddCrop/add', [CropController::class, 'storeCrop'])->name('AddCrop/add');
    Route::post('Addprice/add', [PriceController::class, 'Storeprice'])->name('Addprice/add');
    Route::post('Addrates/add', [PriceController::class, 'Storerates'])->name('Addrates/add');
    Route::get('AddTahsil', [TahsilController::class, 'AddTahsil'])->name('AddTahsil');
    Route::post('AddTahsil/add', [TahsilController::class, 'StoreTehsil'])->name('AddTahsil/add');
    
    Route::get('/minor-canals/edit/{id}', [CanalController::class, 'editminor'])->name('editminor');
    Route::put('/updateMinorCanal/{id}', [CanalController::class, 'updateminor'])->name('updateMinorCanal');
    Route::put('/Distributary/update/{id}', [CanalController::class, 'updatedistributary'])->name('updatedist');
    
    Route::get('/minor-dis/edit/{id}', [CanalController::class, 'editdistributary'])->name('editdist');
    Route::get('/updatedist/update/{id}', [CanalController::class, 'updatedistributary'])->name('updatedist');
    Route::get('AddCanal', [CanalController::class, 'AddCanal'])->name('AddCanal');
    Route::get('AddMinor-Canal', [CanalController::class, 'Addminor'])->name('AddMinor-Canal');
    Route::get('Distributary', [CanalController::class, 'AddDistributary'])->name('Distributary');
    Route::post('AddMinor-Canal/add', [CanalController::class, 'storeMinor'])->name('AddMinor-Canal/add');
    Route::post('Distributary/add', [CanalController::class, 'storeDistributaries'])->name('Distributary/add');
    Route::post('AddCanal/add', [CanalController::class, 'storecanal'])->name('AddCanal/add');
    Route::get('CanalOutlet', [CanalOutLet::class, 'AddOutlet'])->name('CanalOutlet');
    Route::get('AddDivsion', [DivsionController::class, 'AddDivsion'])->name('AddDivsion');
    Route::post('AddDivsion/add', [DivsionController::class, 'StoreDivsion'])->name('AddDivsion/add');

    Route::get('/outlets/edit/{id}', [CanalOutLet::class, 'edit'])->name('outlet.edit');
    Route::put('/outlets/update/{id}', [CanalOutLet::class, 'update'])->name('outlet.update');


    Route::get('/get-canals/{division_id}', [CanalOutLet::class, 'getCanals']);
    Route::get('/get-minors/{canal_id}', [CanalOutLet::class, 'getMinors']);
    Route::get('/get-distributaries/{minor_id}', [CanalOutLet::class, 'getDistributaries']);

    Route::get('/get-branches/{minor_id}', [CanalOutLet::class, 'getBranches']);


    Route::get('AddFarmer', [FarmerController::class, 'AddFarmer'])->name('AddFarmer');
    Route::post('AddFarmer/add', [FarmerController::class, 'storeFarmer'])->name('AddFarmer.add');

    Route::get('AddRoles', [RulesController::class, 'Add'])->name('AddRoles');
    Route::post('AddRoles/add', [RulesController::class, 'storeRoles'])->name('AddRoles.add');
    Route::get('Addprice', [PriceController::class, 'Addprice'])->name('Addprice');
    Route::get('Addrates', [PriceController::class, 'Addrates'])->name('Addrates');
    Route::get('AddPermission', [PermissionController::class, 'AddPermission']);
    Route::post('AddPermission/add', [PermissionController::class, 'storepermission'])->name('AddPermission.add');

    Route::get('AssignRoles_Permission', [AssignRController::class, 'AddAssignRoles']);
    Route::post('AssignRoles_Permission/add', [AssignRController::class, 'storeAssignRoles'])->name('AssignRoles_Permission.add');

    Route::get('AddUser', [UserController::class, 'AddUser']);
    Route::post('AddUser/add', [UserController::class, 'storeUser'])->name('AddUser.add');

    Route::get('AddHalqa', [HalqaController::class, 'Addhalqa'])->name('AddHalqa');
    Route::post('AddHalqa/add', [HalqaController::class, 'storeHalqa'])->name('AddHalqa.add');
    Route::get('/halqa/{id}/edit', [HalqaController::class, 'edithalqa'])->name('halqa.edit');

    Route::get('AddPatwari', [ControllerPatwari::class, 'AddPatwari']);

  Route::get('/getCanals', [CanalController::class, 'getCanals'])->name('getCanals');
  Route::get('/getMinors', [CanalController::class, 'getMinors'])->name('getMinors');
Route::get('/getdistributary', [CanalController::class, 'distributary'])->name('getdistributary');
Route::get('/fetch-canals', [CanalController::class, 'fetchCanals'])->name('fetchCanals');
Route::get('/fetch-minor-canals', [CanalController::class, 'fetchMinorCanals'])->name('fetchMinorCanals');
Route::get('/fetch-distributary-canals', [CanalController::class, 'fetchDistributaryCanals'])->name('fetchDistributaryCanals');

Route::get('/canals/{id}/edit', [CanalController::class, 'edit'])->name('editCanal');
Route::put('/canals/{id}/update', [CanalController::class, 'update'])->name('updateCanal');

    Route::get('AddIrragtor', [IrrigatorController::class, 'AddIrrigator'])->name('AddIrragtor');
    Route::post('/AddIrragtor/add', [IrrigatorController::class, 'StoreIrrgator'])->name('AddIrragtor.add');
    Route::get('ListIrrigator', [IrrigatorController::class, 'ListIrrigator']);

    
    Route::get('ListIrrigator', [IrrigatorController::class, 'ListIrrigator']);
    Route::get('ListBills', [FarmerLandRecord::class, 'ListBills'])->name('');

    Route::get('/get-outlets/{canal_id}', [FarmerLandRecord::class, 'get_outlet']);
    //Route::get('/get-districts/{divisionId}', [FarmerLandRecord::class, 'FarmerDistricts']);
    Route::get('/get-tehsils/{districtId}', [FarmerLandRecord::class, 'FarmerTehsils']);
    Route::get('ListIrrigator', [IrrigatorController::class, 'ListIrrigator']);
    
    Route::get('LandRecord/LandRecord/{id}/{abs}/{village_id}/{canal_id}{div_id}', [FarmerLandRecord::class, 'LandRecord'])->name('LandRecord.ListLandSurvey');

    Route::post('LandRecord/add', [FarmerLandRecord::class, 'storeFarmer'])->name('LandRecord.add');
    
    Route::get('ListLandSurvey', [FarmerLandRecord::class, 'LandSurvey'])->name('ListLandSurvey');
    Route::get('ListBills', [FarmerLandRecord::class, 'ListBills']);
    Route::get('ListLandSurveyZilladar', [FarmerLandRecord::class, 'LandSurveyZilladar'])->name('ListLandSurveyZilladar');
    Route::get('ListLandSurveyCollector', [FarmerLandRecord::class, 'LandSurveyCollector'])->name('ListLandSurveyCollector');
    Route::get('survey/view/{id}', [FarmerLandRecord::class, 'surveyView']);
    Route::get('survey/forward/{id}', [FarmerLandRecord::class, 'surveyViewForward']);
    Route::get('survey/reverse/{id}', [FarmerLandRecord::class, 'surveyViewReverse']);
    Route::get('survey/collector/forward/{id}', [FarmerLandRecord::class, 'surveyViewForwardCollector']);
    Route::get('survey/collector/reverse/{id}', [FarmerLandRecord::class, 'surveyViewReverseCollector']);
    Route::get('survey/patwari/forward/{id}', [FarmerLandRecord::class, 'surveyViewForwardPatwari']);
    Route::post('surveyReview/forward/{crop_survey_id}', [FarmerLandRecord::class, 'surveyReviewForward']);
    Route::post('surveyReview/reverse/{crop_survey_id}', [FarmerLandRecord::class, 'surveyReviewReverse']);
    Route::post('surveyReview/forward/collector/{crop_survey_id}', [FarmerLandRecord::class, 'surveyReviewForwardCollector']);
    Route::post('surveyReview/reverse/collector/{crop_survey_id}', [FarmerLandRecord::class, 'surveyReviewReverseCollector']);
    Route::post('surveyReview/forward/patwari/{crop_survey_id}', [FarmerLandRecord::class, 'surveyReviewForwardPatwari']);
    Route::get('survey_bill/view/{id}', [FarmerLandRecord::class, 'surveyBillView']);
    Route::get('survey_bill/approve/view/{id}', [FarmerLandRecord::class, 'surveyBillApprovalView']);
    Route::get('survey_bill/approve/{irrigator_id}', [FarmerLandRecord::class, 'surveyApproved']);
    Route::post('survey_bill/approve_multiple', [FarmerLandRecord::class, 'surveyApproveMultiple'])->name('survey_bill.approve_multiple');
    Route::post('survey_bill/view_multiple', [FarmerLandRecord::class, 'surveyBillMultiple'])->name('survey_bill.view_multiple');
    Route::get('ListIrrigatorsForApprovals', [FarmerLandRecord::class, 'IrrigatorsForApproval'])->name('ListIrrigatorsForApprovals');
    Route::get('edit-servey/{id}',[FarmerLandRecord::class,'EditSurvey'])->name('edit.survey');
    Route::put('/update-servey/{crop_survey_id}', [FarmerLandRecord::class, 'UpdateSurvey'])->name('update.survey');
    Route::get('ListIrrigatorsForBills', [FarmerLandRecord::class, 'IrrigatorsForBills']);
    Route::delete('/landservey/{id}', [FarmerLandRecord::class, 'destroy'])->name('landservey.destroy');
    Route::delete('/AddUser/{id}', [UserController::class, 'destroy'])->name('AddUser.destroy');
    Route::put('/user/{id}', [UserController::class, 'updateUser'])->name('update.user');

    Route::get('Edituser/{id}',[UserController::class,'editUser'])->name('edit.user');
    Route::delete('/AddDivsion/{id}', [DivsionController::class, 'destroy'])->name('AddDivsion.destroy');
    Route::delete('/irrigators/{id}', [IrrigatorController::class, 'destroy'])->name('irrigators.destroy');
    Route::get('AddBranch', [CanalController::class, 'AddBranch'])->name('AddBranch');

    Route::get('/irrigators', [IrrigatorController::class, 'AddIrrigator'])->name('irrigators.search');

    Route::get('/get-districts/{divisionId}', [IrrigatorController::class, 'Districts']);
    Route::get('/get-canals/{villageID}', [IrrigatorController::class, 'Canals']);
    Route::get('/get-tehsils/{districtId}', [IrrigatorController::class, 'Tehsils']);
    Route::get('/get-halqa/{tehsilId}', [IrrigatorController::class, 'Halqa']);
    Route::get('/halqa_for_users/{tehsilId}', [UserController::class, 'Halqa']);
    //Route::get('/get-districts/{divisionId}', [FarmerLandRecord::class, 'FarmerDistricts']);
    Route::get('/get-tehsils/{districtId}', [FarmerLandRecord::class, 'FarmerTehsils']);
    Route::get('/get-village/{halqaId}', [IrrigatorController::class, 'Village']);
    Route::get('/get-tehsils/{districtId}', [HalqaController::class, 'getTehsils']);
    Route::get('/get-outlets/{canal_id}', [FarmerLandRecord::class, 'get_outlet']);

    Route::get('/get-minor-canals/{canal_id}', [FarmerLandRecord::class, 'get_minor_canal1']);
    Route::get('/get-outlets-by-minor/{minor_id}', [FarmerLandRecord::class, 'get_outlet_by_minor']);

    Route::get('/get-minor-canals-for-distri/{canal_id}', [FarmerLandRecord::class, 'get_minor_canals_for_distri']);
    Route::get('/get-distributories-by-minor/{minor_id}', [FarmerLandRecord::class, 'get_distributories_by_minor']);
    Route::get('/get-outlets-by-distributory/{distri_id}', [FarmerLandRecord::class, 'get_outlets_by_distributory']);
    Route::get('/get-branches-by-distributory/{distri_id}', [FarmerLandRecord::class, 'get_branches_by_distributory']);
    Route::get('/get-outlet-by-branch/{branch_id}', [FarmerLandRecord::class, 'get_outlet_by_branch']);
    

    Route::get('edit-irrigator/{id}',[IrrigatorController::class,'editIrrigator'])->name('edit.irrigator');
    Route::put('/irrigators/{id}', [IrrigatorController::class, 'update'])->name('update.irrigator');
    Route::get('Addprice/edit/{id}', [PriceController::class, 'edit'])->name('cropprice.edit');
    Route::get('rates/edit/{id}', [PriceController::class, 'rates_edit'])->name('rates.edit');
    Route::post('rates/update/{id}', [PriceController::class, 'rates_update'])->name('rates.update');
    Route::post('Addprice/update/{id}', [PriceController::class, 'update'])->name('cropprice.update');


Route::get('listforwardedpatwari', [FarmerLandRecord::class, 'forwardedpatwari'])->name('listforwardedpatwari');
Route::get('listforwardedzilladar', [FarmerLandRecord::class, 'forwardedzilladar'])->name('listforwardedzilladar');
Route::get('listforwardedcollertor', [FarmerLandRecord::class, 'forwardedcollector'])->name('listforwardedcollertor');
Route::get('/irrigators/search', [IrrigatorController::class, 'Search'])->name('irrigator.search');
Route::post('Canalbranch/add', [CanalController::class, 'store'])->name('Canalbranch/add');
Route::get('Canalbranch', [CanalController::class, 'Addbranch'])->name('Canalbranch/Addbranch');


//************************ REPORTS ************************************************/
Route::get('ReportViewNaksha5', [FarmerLandRecord::class, 'ReportViewNaksha5'])->name('ReportViewNaksha5');
Route::post('ReportNaksha5Data', [FarmerLandRecord::class, 'ReportNaksha5Data'])->name('ReportNaksha5Data');

Route::get('ReportViewJinswaar', [FarmerLandRecord::class, 'ReportViewJinswaar'])->name('ReportViewJinswaar');
Route::post('ReportJinswaarData', [FarmerLandRecord::class, 'ReportJinswaarData'])->name('ReportJinswaarData');

Route::get('ReportViewMoqabilataan', [FarmerLandRecord::class, 'ReportViewMoqabilataan'])->name('ReportViewMoqabilataan');
Route::post('ReportMoqabilataanData', [FarmerLandRecord::class, 'ReportMoqabilataanData'])->name('ReportMoqabilataanData');

Route::get('ReportViewNakhshaParthal', [FarmerLandRecord::class, 'ReportViewNakhshaParthal'])->name('ReportViewNakhshaParthal');
Route::post('ReportNakhshaParthalData', [FarmerLandRecord::class, 'ReportNakhshaParthalData'])->name('ReportNakhshaParthalData');

});
