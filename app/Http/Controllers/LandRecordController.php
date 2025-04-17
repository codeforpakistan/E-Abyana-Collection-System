<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\village;
use App\Models\Irrigator;
class LandRecordController extends Controller
{
    public function AddLandRecord(){
        $villages = village::all();  
        $Irrigators = Irrigator::all();  
        return view('LandRecord',compact('Irrigators','villages'));
   
}

}
