<?php

namespace App\Http\Controllers\RegionAdministration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halqa;
class ControllerPatwari extends Controller
{
    public function AddPatwari(){
        $halqas = Halqa::all(); 
        return view('RegionManagments.AddPatwari')->with('halqas',$halqas);
   
}
}
