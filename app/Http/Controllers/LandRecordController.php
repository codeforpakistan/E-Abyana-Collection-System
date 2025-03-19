<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;
use App\Models\Irrigator;
class LandRecordController extends Controller
{
    public function AddLandRecord(){
        $villages = Village::all();  
        $Irrigators = Irrigator::all();  
        return view('LandRecord',compact('Irrigators','villages'));
   
}

}
