@extends('layout')
@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .urdu-text {
          font-family: 'Noto Nastaliq Urdu', serif;
          /*direction: rtl; */
        }
    </style>
</head>

<div class="app-content">
    <section class="section">
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    
        
        <!-- Form Card -->
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="font-weight-bold urdu-text">Land Survey/خسرہ گرداوری</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url('LandRecord/add') }}" method="POST">
                        @csrf
                    {{-- @dump($errors) --}}
                        <!-- Farmer Details -->
                        <!--<h5 class="font-weight-bold text-primary mt-3">Land Survey/خسرہ گرداوری</h5> -->
                        <div class="row align-items-center" style="margin-top:-20px;">
                          <!-- Left side: Heading -->
                          <div class="col-md-6">
                            <h5 class="font-weight-bold text-primary urdu-text">Land Survey/خسرہ گرداوری</h5>
                          </div>
                        
                          <!-- Right side: Radio Buttons -->
                          <div class="col-md-6 text-right">
                            <div class="form-check form-check-inline" style="border-bottom:1px solid gray;">
                            <input class="form-check-input" type="radio" name="canalType" id="canal" value="canal" checked>
                              <label class="form-check-label" for="canal">Canal</label>
                            </div>
                            <div class="form-check form-check-inline" style="border-bottom:1px solid gray;">
                              <input class="form-check-input" type="radio" name="canalType" id="minorCanal" value="minor_canal">
                              <label class="form-check-label" for="minorCanal">Distributory</label>
                            </div>
                            <div class="form-check form-check-inline" style="border-bottom:1px solid gray;">
                              <input class="form-check-input" type="radio" name="canalType" id="distributory" value="distributory">
                              <label class="form-check-label" for="distributory">Minor Canal</label>
                              <!-- Branch Checkbox -->&nbsp;&nbsp;
                              <input class="form-check-input" type="checkbox" id="branchCheckbox" name="branch" value="branch">
                              <label class="form-check-label" for="branchCheckbox">Branch</label>
                              <!-- ********************************* -->
                            </div>
                          </div>
                        </div>


                        
                           <!-- <div class="form-group col-lg-3">
                                <label for="div_id" class="form-label font-weight-bold">Select Divsion/ڈویژن</label>
                                <select  id="div_id" class="form-control" required onchange="get_districts(this)">
                                    <option class="form-label" value="">Choose Division/ڈویژن</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="form-label font-weight-bold" for="district_id">Select distric/ضلع</label>
                                <select id="district_id" class="form-control" required onchange="get_tehsils(this)">
                                    <option value="">Choose district</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>                                
                            </div>
                         
                            <div class="form-group col-lg-3">
                                <label class="form-label font-weight-bold" for="tehsil_id">Select Tehsil/تحصیل</label>
                                <select id="tehsil_id" class="form-control" required onchange="get_halqa(this)">
                                    <option value="" >Choose Tehsil</option>
                                    @foreach($tehsils as $tehsil)
                                        <option value="{{$tehsil->tehsil_id }}">{{$tehsil->tehsil_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="form-label font-weight-bold" for="halqa_id" style="">Select Halqa/حلقہ</label>
                                <select id="halqa_id" class="form-control" required>
                                    <option value="">Choose Halqa/حلقہ</option>
                                    @foreach($Halqas as $Halqa)
                                        <option value="{{$Halqa->id }}">{{$Halqa->halqa_name }}</option>
                                    @endforeach
                                </select>
                            </div>  -->
                            <div class="row">
                            <div class="col-4">
                                <label class="form-label font-weight-bold urdu-text" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-group form-control" required readonly>
                                   
        
                                        <option value="{{ $divsions1->id }}">{{ $divsions1->divsion_name }}</option>
                                    
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="form-label font-weight-bold urdu-text">Select Village/گاؤں</label>
                                <select name="village_id" class="form-control" required readonly>
                                        <option value="{{ $villages->village_id }}">{{ $villages->village_name }}</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="form-label font-weight-bold urdu-text">Select Canal/نہر</label>
                                <input type="hidden" id="c_type" name="c_type" value="{{ $canals->c_type }}" />
                                <select name="canal_id" id="canal_id" class="form-control" readonly onchange="get_outlets(this)">
                                        <option value="{{ $canals->id }}">{{ $canals->canal_name }}</option>
                                </select>
                        </div>
                        </div>

                        <div class="row" id="canal_radiobutton_show">
                        <div class="col-12">
                                <label class="form-label font-weight-bold urdu-text">Outlet/موگہ</label>
                                <select name="canal_outlet_id" id="canal_outlet_id" class="form-control">
                                    <option value="">Choose Outlet</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="minor_radiobutton_show">
                        <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Distributory / شقہ</label>
                                <select name="canal_minor_id" id="canal_minor_id" class="form-control">
                                    <option value="">Choose Distributory / شقہ</option>
                                </select>
                            </div>
                        <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Outlet/موگہ</label>
                                <select name="minor_outlet_id" id="minor_outlet_id" class="form-control">
                                    <option value="">Choose Outlet</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="distributory_radiobutton_show">
                        <div class="col-4">
                                <label class="form-label font-weight-bold urdu-text">Distributory / شقہ</label>
                                <select name="distri_minor_id" id="distri_minor_id" class="form-control">
                                    <option value="">Distributory / شقہ</option>
                                </select>
                            </div>
                        <div class="col-4">
                                <label class="form-label font-weight-bold urdu-text">Minor Canal / چھوٹی نہر</label>
                                <select name="distri_id" id="distri_id" class="form-control">
                                    <option value="">Minor Canal / چھوٹی نہر</option>
                                </select>
                            </div>
                        <div class="col-4" id="branch_dropdown_div" style="display: none;">
                          <label class="form-label font-weight-bold urdu-text">Branch / شاخ</label>
                          <select name="branch_id" id="branch_id" class="form-control">
                              <option value="">Choose Branch / شاخ</option>
                          </select>
                         </div>
                        <div class="col-4">
                                <label class="form-label font-weight-bold urdu-text">Outlet/موگہ</label>
                                <select name="distri_outlet_id" id="distri_outlet_id" class="form-control">
                                    <option value="">Choose Outlet</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            @php
                            $currentYear = date('Y');
                            $sessionStart = $currentYear - 1;
                            $sessionEnd = $currentYear;
                            $sessionValue = $sessionStart . '-' . substr($sessionEnd, -2);
                            @endphp
                        <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Session Year / فصلی سال</label>
                                <input type="text" class="form-control" placeholder="Session Year" value="{{ $sessionValue }}" name="session_date">
                            </div>
                            <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Crop Session /فصل&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <select name="crop_id" id="crop_id" class="form-control" required>
                                    <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->id }}">{{ $crop->crop_name }}</option> <!-- Ensure you're using the correct field names -->
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Canal Information -->
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Farmer & Land Registration Form / کاشتکار و زمین کی رجسٹریشن فارم</h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold urdu-text"><span>(1) </span>Khasra Number /نمبر خسرہ&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <input type="text" class="form-control urdu-text" placeholder="Khasra Number /نمبر خسرہ" name="khasra_number" required>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold urdu-text"><span>(2) </span>Irrigator Khata Number / خاتہ نمبر</label>
                                <input type="text" class="form-control" placeholder="Khata Number" name="irrigator_khata_number" readonly value="{{$survey->irrigator_khata_number}}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold urdu-text"><span>(3) </span>Name Irrigator / کاشتکار نام</label>
                                <input type="text" class="form-control" placeholder="Khasra Assessment Number/نمبر خسرہ بندوبست" readonly name="irrigator_name" value="{{$survey->irrigator_name}}">
                            </div>
                            <div class="col-md-4 mb-2" style="display:none;">
                                <label class="form-label font-weight-bold"><span>(4) </span>irrigator_Id</label>
                                <input type="text" class="form-control" placeholder="" name="irrigator_id" value="{{$survey->id}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(4) </span>Tenant Name / نام مالگزار بقید ولدیت  
                                </label>
                                <input type="text" class="form-control" placeholder="Tenant Name/نام مالگزار بقید ولدیت  " name="tenant_name" value="{{$survey->irrigator_name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(5) </span>Entry Date /تاریخ اندراج</label>
                                <input type="date" class="form-control" required placeholder="Entry Date/تاریخ اندراج " name="registration_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(6) </span>Cultivator Name/ نام کاشتکار بقید ولدیت وقومیت وسکونت  
                                </label>
                                <input type="text" class="form-control" placeholder="Cultivator's Information / نام کاشتکار بقید ولدیت وقومیت وسکونت  
                                " name="cultivators_info" value="{{$survey->irrigator_name}}">
                            </div>
                            <div class="col-md-6 mb-6">
                            <label class="form-label font-weight-bold urdu-text"><span>(7) </span> Sowing Date / تاریخ تخمریزی</label>
                            <input type="date" class="form-control" required placeholder="Sowing Date / تاریخ تخمریزی" name="snowing_date">
                        </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Crop Type Registration/انداراج جنس شدکار
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(8) </span>Land Assessment Marla /اراضی تخمینہ  
                                </label>
                                <input type="text" class="form-control" placeholder="Marla/مرلہ  
                                " name="land_assessment_marla" value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(9) </span>Land Assessment Kanal / اراضی تخمینہ  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="0" name="land_assessment_kanal">
                            </div>
   
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-12">
                                <label class="form-label font-weight-bold urdu-text"><span>(10) </span> Previous Crop Name with Grade / نام جنس جو پہلے بوئی گئی بمعہ درجہ&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <select name="previous_crop" id="previous_crop" class="form-control">
                                    <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                    @foreach($cropprice as $crop)
                                        <option value="{{ $crop->final_crop }}">{{ $crop->final_crop }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Final Measurement /پیمائش پختہ
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(11) </span>Date/تاریخ</label>
                                <input type="date" class="form-control"  placeholder="Date/تاریخ" name="date">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(12) </span>Length/طول (Karam/کرم)
 
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Length/طول  
                                " name="length" id="length">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(13) </span>Width/عرض (Karam/کرم)</label>
                                <input type="text" class="form-control" placeholder="Width/عرض" value="0" name="width" id="width">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Area/رقبہ

                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(14) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ" name="area_marla" id="marla" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(15) </span> Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="0" name="area_kanal" id="kanal" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label class="form-label font-weight-bold urdu-text"><span>(16) </span> Crop /فصل&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <select name="finalcrop_id" id="finalcrop_id" class="form-control" required>
                                    <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                    @foreach($cropprice as $crop)
                                        <option value="{{ $crop->id }}" data-type="{{ $crop->crop_type }}" data-name="{{ $crop->final_crop }}">{{ $crop->final_crop }} - {{$crop->crop_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label font-weight-bold urdu-text"><span>(17) </span> Rate / نرخ</label>
                                <input type="number" step="0.1" name="crop_price" id="crop_price" value="0" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Land Details -->
                    
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Land Replanting / اراضی دوبارہ کاشت


                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(18) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                " name="replanting_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(19) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال  " value="0" name="replanting_kanal">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Double Crop Land /اراضی دو فصلی</h5>
                        <div class="form-group row">
                            <div class="col-md-3 mb-3">
                            <label class="form-label font-weight-bold urdu-text"><span>(20) </span>Date / تاریخ تخمریزی</label>
                            <input type="date" class="form-control"  placeholder="Date/تاریخ" name="double_date">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold urdu-text">(21) Double Crop / دو فصلی</label>
                                <select name="double_crop" id="double_crop" class="form-control">
                                    <option class="form-label font-weight-bold" value="">Choose Double Crop / دو فصلی فصل </option>
                                    @foreach($cropprice as $crop)
                                        <option value="{{ $crop->final_crop }}">{{ $crop->final_crop }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(22) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                "name="double_crop_marla">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(23) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" value="0" placeholder="Kanal/کنال  "name="double_crop_kanal">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Irrigated Area / مجرائی رقبہ</h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(24) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                "name="irrigated_area_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(25) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" value="0" placeholder="Kanal/کنال" name="irrigated_area_kanal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(26) </span>Identifiable Area Marla/قابل شناخت رقبہ مرلہ
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                "name="identifable_area_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(27) </span>Identifiable Area Kanal/قابل شناخت رقبہ کنال
                            </label>
                            <input type="text" class="form-control" value="0" placeholder="Kanal/کنال" name="identifable_area_kanal">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 mb-12">
                                <label class="form-label font-weight-bold urdu-text"><span>(28) </span>Land Quality/کیفیت
                                </label>
                                <input type="text" class="form-control" value="N/A" placeholder="Land Quality/کیفیت" name="land_quality">
                                <input type="number" name="is_billed" value="0" style="display:none;">
                                <input type="text"   name="review" value="Survey Added" style="display:none;">
                                <input type="number" name="status" value="0" style="display:none;">
                                <input type="number" name="patwari_user_id" value="{{ session('id') }}" style="display:none;">
                                 <!-- if patwari_user_id column has 12 so its patwari user and 1 then admin user -->
                                <!-- {{-- session('role_id') --}} -->
                            </div>
                        </div>
                        <!-- Submit Button -->
                      
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill mr-1">Submit / <span class="urdu-text">درج کریں</span></button>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canalTypeRadios = document.getElementsByName('canalType');
        const canalDropdown = document.getElementById('canal_id');
        const branchCheckbox = document.getElementById('branchCheckbox');
        const branchDropdownDiv = document.getElementById('branch_dropdown_div');
        // Hide all rows initially
        document.getElementById('canal_radiobutton_show').style.display = 'none';
        document.getElementById('minor_radiobutton_show').style.display = 'none';
        document.getElementById('distributory_radiobutton_show').style.display = 'none';
        // Show canal row by default
        document.getElementById('canal_radiobutton_show').style.display = 'flex';
        // Load canal outlets on page load
        if (canalDropdown && canalDropdown.value) {
            get_outlets(canalDropdown.value);
        }
        // Handle radio button changes
        canalTypeRadios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                // Hide all rows
                document.getElementById('canal_radiobutton_show').style.display = 'none';
                document.getElementById('minor_radiobutton_show').style.display = 'none';
                document.getElementById('distributory_radiobutton_show').style.display = 'none';

                if (this.value === 'canal') {
                    document.getElementById('canal_radiobutton_show').style.display = 'flex';
                    get_outlets(canalDropdown.value);
                } else if (this.value === 'minor_canal') {
                    document.getElementById('minor_radiobutton_show').style.display = 'flex';
                    get_minor_canals(canalDropdown.value);
                } else if (this.value === 'distributory') {
                    document.getElementById('distributory_radiobutton_show').style.display = 'flex';
                    get_minor_canals_for_distributory(canalDropdown.value);
                }
            });
        });
        // Handle checkbox show/hide logic
branchCheckbox.addEventListener('change', function () {
    const isMinorCanalSelected = document.getElementById('distributory').checked;
    if (this.checked && isMinorCanalSelected) {
        branchDropdownDiv.style.display = 'block';
        const distId = document.getElementById('distri_id').value;
        get_branches_from_distributory(distId); // optional: load based on selected distributory
    } else {
        branchDropdownDiv.style.display = 'none';
        $('#branch_id').empty().append('<option value="">Choose Branch / شاخ</option>');
    }
});
        // Load outlets when minor is selected
        $(document).on('change', '#minor_radiobutton_show select[name="canal_minor_id"]', function () {
            const minorId = $(this).val();
            get_outlets_from_minor(minorId);
        });
        // Load distributories and outlets when minor changes in distributory section
        $(document).on('change', '#distributory_radiobutton_show select[name="distri_minor_id"]', function () {
            const minorId = $(this).val();
            get_distributories(minorId);
        });

        // Also listen for changes in distributory dropdown to reload branches if checkbox is checked
        $(document).on('change', '#distributory_radiobutton_show select[name="distri_id"]', function () {
            const distId = $(this).val();
            get_outlets_from_distributory(distId);
            if (branchCheckbox.checked) {
                get_branches_from_distributory(distId);
            }
        });

        $(document).on('change', '#distributory_radiobutton_show select[name="distri_id"]', function () {
            const distId = $(this).val();
           if (!branchCheckbox.checked) { 
            get_outlets_from_distributory(distId);
        }
        });

         $(document).on('change', '#distributory_radiobutton_show select[name="branch_id"]', function () {
            const branch_id = $(this).val();
            if (branchCheckbox.checked) {
            get_outlet_from_branch(branch_id);
            }
        });
    });

    // Canal -> Outlets
    function get_outlets(canal_id) {
        if (canal_id) {
            $.ajax({
                url: '/get-outlets/' + canal_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#canal_radiobutton_show select[name="canal_outlet_id"]').empty().append('<option value="">Choose Outlet / موگہ</option>');
                    $.each(data, function (key, value) {
                        $('#canal_radiobutton_show select[name="canal_outlet_id"]').append('<option value="' + value.id + '">' + value.outlet_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching outlets:', error);
                    alert('Could not fetch outlets.');
                }
            });
        }
    }

    // Canal -> Minor Canals (for minor_canal)
    function get_minor_canals(canal_id) {
        if (canal_id) {
            $.ajax({
                url: '/get-minor-canals/' + canal_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#minor_radiobutton_show select[name="canal_minor_id"]').empty().append('<option value="">Choose Distributory / شقہ</option>');
                    $('#minor_radiobutton_show select[name="minor_outlet_id"]').empty().append('<option value="">Choose Outlet / موگہ</option>');
                    $.each(data, function (key, value) {
                        $('#minor_radiobutton_show select[name="canal_minor_id"]').append('<option value="' + value.id + '">' + value.minor_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching minor canals:', error);
                    alert('Could not fetch minor canals.');
                }
            });
        }
    }

    // Minor Canal -> Outlets
    function get_outlets_from_minor(minor_id) {
        if (minor_id) {
            $.ajax({
                url: '/get-outlets-by-minor/' + minor_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#minor_radiobutton_show select[name="minor_outlet_id"]').empty().append('<option value="">Choose Outlet / موگہ</option>');
                    $.each(data, function (key, value) {
                        $('#minor_radiobutton_show select[name="minor_outlet_id"]').append('<option value="' + value.id + '">' + value.outlet_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching outlets from minor:', error);
                    alert('Could not fetch outlets for minor canal.');
                }
            });
        }
    }

    // Canal -> Minor Canals (for distributory)
    function get_minor_canals_for_distributory(canal_id) {
        if (canal_id) {
            $.ajax({
                url: '/get-minor-canals-for-distri/' + canal_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#distributory_radiobutton_show select[name="distri_minor_id"]').empty().append('<option value="">Choose Distributory / شقہ</option>');
                    $('#distributory_radiobutton_show select[name="distri_id"]').empty().append('<option value="">Choose Minor Canal / چھوٹی نہر</option>');
                    $('#distributory_radiobutton_show select[name="distri_outlet_id"]').empty().append('<option value="">Choose Outlet / موگہ</option>');
                    $.each(data, function (key, value) {
                        $('#distributory_radiobutton_show select[name="distri_minor_id"]').append('<option value="' + value.id + '">' + value.minor_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching minor canals for distributory:', error);
                    alert('Could not fetch minor canals.');
                }
            });
        }
    }

    // Minor Canal -> Distributories
    function get_distributories(minor_id) {
        if (minor_id) {
            $.ajax({
                url: '/get-distributories-by-minor/' + minor_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#distributory_radiobutton_show select[name="distri_id"]').empty().append('<option value="">Choose Minor</option>');
                    $('#distributory_radiobutton_show select[name="distri_outlet_id"]').empty().append('<option value="">Choose Outlet</option>');
                    $.each(data, function (key, value) {
                        $('#distributory_radiobutton_show select[name="distri_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching distributories:', error);
                    alert('Could not fetch distributories.');
                }
            });
        }
    }

    function get_branches_from_distributory(distri_id) {
    if (distri_id) {
        $.ajax({
            url: '/get-branches-by-distributory/' + distri_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#branch_id').empty().append('<option value="">Choose Branch / شاخ</option>');
                $.each(data, function (key, value) {
                    $('#branch_id').append('<option value="' + value.id + '">' + value.branch_name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching branches:', error);
                alert('Could not fetch branches.');
            }
        });
    }

    
}

    // Distributory -> Outlets
    function get_outlets_from_distributory(distri_id) {
        if (distri_id) {
            $.ajax({
                url: '/get-outlets-by-distributory/' + distri_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#distributory_radiobutton_show select[name="distri_outlet_id"]').empty().append('<option value="">Choose Outlet</option>');
                    $.each(data, function (key, value) {
                        $('#distributory_radiobutton_show select[name="distri_outlet_id"]').append('<option value="' + value.id + '">' + value.outlet_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching outlets from distributory:', error);
                    alert('Could not fetch outlets for distributory.');
                }
            });
        }
    }

    function get_outlet_from_branch(branch_id) {
    if (branch_id) {
        $.ajax({
            url: '/get-outlet-by-branch/' + branch_id,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#distri_outlet_id').empty().append('<option value="">Choose Branch / شاخ</option>');
                $.each(data, function (key, value) {
                    $('#distri_outlet_id').append('<option value="' + value.id + '">' + value.outlet_name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching outlet:', error);
                alert('Could not fetch outlet.');
            }
        });
    }

    
}

</script>
    
<script>
    function get_districts(element) {
        var divisionId = element.value; // Get the selected value

        if (divisionId) {
            // Make an AJAX request to fetch districts based on the selected division
            $.ajax({
                url: '/get-districts/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Clear the district dropdown and add a placeholder option
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Choose District</option>');

                    // Populate the district dropdown with the data received
                    $.each(data, function (key, value) {
                        $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching districts:', error);
                }
            });
        } else {
            // Reset the district dropdown if no division is selected
            $('#district_id').empty();
            $('#district_id').append('<option value="">Choose District</option>');
        }
    }
</script>
<script>
    function get_tehsils(element) {
        var districtId = element.value; 
        console.log(districtId);
    
        if (districtId) {
            // Make an AJAX request to fetch tehsils based on the selected district
            $.ajax({
                url: '/get-tehsils/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Clear the Tehsil dropdown and add a placeholder option
                    $('#tehsil_id').empty();
                    $('#tehsil_id').append('<option value="">Choose Tehsil</option>');
    
                    // Populate the Tehsil dropdown with the received data
                    $.each(data, function (key, value) {
                        $('#tehsil_id').append('<option value="' + value.tehsil_id + '">' + value.tehsil_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        } else {
            // Reset the Tehsil dropdown if no district is selected
            $('#tehsil_id').empty();
            $('#tehsil_id').append('<option value="">Choose Tehsil</option>');
        }
    }
    </script>
<script>
    var priceRateData = @json($priceRateData);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const previousCropSelect = document.getElementById('previous_crop');
        const finalCropSelect = document.getElementById('finalcrop_id');
        const priceInput = document.getElementById('crop_price');
        const canalType = document.getElementById('c_type').value;

        // When user selects from "Previous Crop", reflect the same in "Final Crop"
        previousCropSelect.addEventListener('change', function () {
            const selectedPrevCrop = this.value;

            // Loop through final crop options and match by data-name
            for (let i = 0; i < finalCropSelect.options.length; i++) {
                const option = finalCropSelect.options[i];
                const dataName = option.getAttribute('data-name');

                if (dataName === selectedPrevCrop) {
                    finalCropSelect.selectedIndex = i;
                    finalCropSelect.dispatchEvent(new Event('change')); // Trigger rate calculation
                    break;
                }
            }
        });

        // When "Final Crop" changes, calculate and show per kanal rate
        finalCropSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const cropType = selectedOption.getAttribute('data-type');

            if (cropType && priceRateData[cropType] && priceRateData[cropType][canalType]) {
                const perAcreRate = priceRateData[cropType][canalType];
                const perKanalRate = perAcreRate / 8;
                priceInput.value = perKanalRate.toFixed(0);
            } else {
                priceInput.value = 0;
            }
        });

        // Area calculation based on length/width
        function calculateArea() {
            const length = parseFloat(document.getElementById('length').value) || 0;
            const width = parseFloat(document.getElementById('width').value) || 0;
            const total = (length * width) / 20;
            const kanal = Math.floor(total);
            const marla = Math.round((total - kanal) * 20);
            document.getElementById('kanal').value = kanal;
            document.getElementById('marla').value = marla;
        }

        document.getElementById('length').addEventListener('input', calculateArea);
        document.getElementById('width').addEventListener('input', calculateArea);
    });
</script>
