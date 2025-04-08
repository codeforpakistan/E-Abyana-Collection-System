@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <h4 class="font-weight-bold">Land Survey/خسرہ گرداوری</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url('LandRecord/add') }}" method="POST">
                        @csrf
{{-- @dump($errors) --}}
                        <!-- Farmer Details -->
                        <h5 class="font-weight-bold text-primary mt-3">Land Survey/خسرہ گرداوری</h5>
                        <div class="row">
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
                            <div class="form-group col-lg-3">
                                <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-group form-control" required readon>
                                   
                          
                                        <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label font-weight-bold">Select Village/گاؤں</label>
                                <select name="village_id" class="form-control" required readonly>
                                        <option value="{{ $villages->village_id }}">{{ $villages->village_name }}</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="form-label font-weight-bold">Select canal/نہر</label>
                                <select name="canal_id" id="canal_id" class="form-control" readonly onchange="get_outlets(this)">
                                        <option value="{{ $canals->id }}">{{ $canals->canal_name }}</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="form-label font-weight-bold">Outlet/موگیہ</label>
                                <select name="outlet_id" id="outlet_id" class="form-control" required>
                                    <option value="">Choose Outlet</option>
                                </select>
                            </div>
                            
                       
                            <div class="col-md-2 mb-2">
                                <label class="form-label font-weight-bold">Session Year</label>
                                <input type="text" class="form-control" placeholder="Session Year" value="2025"name="session_date">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label font-weight-bold">Crop Session /فصل</label>
                                <select name="crop_id" id="crop_id" class="form-control" required>
                                    <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->id }}">{{ $crop->crop_name }}</option> <!-- Ensure you're using the correct field names -->
                                    @endforeach
                                </select>
                            </div>
                         
                       
                     
                        </div>
                        
                        <!-- Canal Information -->
                        <h5 class="font-weight-bold text-primary mt-3">Farmer & Land Registration Form</h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold"><span>(1) </span>Khasra Number /نمبر خسرہ </label>
                                <input type="text" class="form-control" placeholder="Khasra Number /نمبر خسرہ" name="khasra_number">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold"><span>(2) </span>Irrigator Khata Number</label>
                                <input type="text" class="form-control" placeholder="Khata Number" name="irrigator_khata_number" readonly value="{{$survey->irrigator_khata_number}}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold"><span>(3) </span>Name Irrigator</label>
                                <input type="text" class="form-control" placeholder="Khasra Assessment Number/نمبر خسرہ بندوبست" readonly name="irrigator_name" value="{{$survey->irrigator_name}}">
                            </div>
                            <div class="col-md-4 mb-2" style="display:none;">
                                <label class="form-label font-weight-bold"><span>(4) </span>irrigator_Id</label>
                                <input type="text" class="form-control" placeholder="" name="irrigator_id" value="{{$survey->id}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(4) </span>Tenant Name / نام مالگزار بقید ولدیت  
                                </label>
                                <input type="text" class="form-control" placeholder="Tenant Name/نام مالگزار بقید ولدیت  " name="tenant_name" value="{{$survey->irrigator_name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(5) </span>Entry Date/تاریخ اندراج</label>
                                <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Entry Date/تاریخ اندراج " name="registration_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(6) </span>Cultivator Name/ نام کاشتکار بقید ولدیت وقومیت وسکونت  
                                </label>
                                <input type="text" class="form-control" placeholder="Cultivator's Information / نام کاشتکار بقید ولدیت وقومیت وسکونت  
                                " name="cultivators_info" value="{{$survey->irrigator_name}}">
                            </div>
                            <div class="col-md-6 mb-6">
                            <label class="form-label font-weight-bold"><span>(7) </span> Sowing Date / تاریخ تخمریزی</label>
                            <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Sowing Date / تاریخ تخمریزی" name="snowing_date">
                        </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3">Crop Type Registration/انداراج جنس شدکار
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(8) </span>Land Assessment Marla /اراضی تخمینہ  
                                </label>
                                <input type="text" class="form-control" placeholder="Marla/مرلہ  
                                " name="land_assessment_marla" value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(9) </span>Land Assessment Kanal / اراضی تخمینہ  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="0" name="land_assessment_kanal">
                            </div>
   
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-12">
                                <label class="form-label font-weight-bold"><span>(10) </span> Previous Crop Name with Grade / نام جنس جو پہلے بوئی گئی بمعہ درجہ</label>
                                <select name="previous_crop" id="previous_crop" class="form-control">
                                    <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                    @foreach($cropprice as $crop)
                                        <option value="{{ $crop->final_crop }}">{{ $crop->final_crop }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3">Final Measurement/پیمائش پختہ
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold"><span>(11) </span>Date/تاریخ  
                                </label>
                                <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="Date/تاریخ" name="date">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold"><span>(12) </span>Length/طول (Marla)
 
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Length/طول  
                                " name="length" id="length">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold"><span>(13) </span>Width/عرض (Marla)</label>
                                <input type="text" class="form-control" placeholder="Width/عرض" value="0" name="width" id="width">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3">Area/رقبہ

                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(14) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ" name="area_marla" id="marla" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(15) </span> Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="0" name="area_kanal" id="kanal" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label class="form-label font-weight-bold"><span>(16) </span> Crop/فصل</label>
                                <select name="finalcrop_id" id="finalcrop_id" class="form-control" >
                                    <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                    @foreach($cropprice as $crop)
                                        <option value="{{ $crop->id }}" data-price="{{ $crop->crop_price }}" data-name="{{ $crop->final_crop }}">{{ $crop->final_crop }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label font-weight-bold"><span>(17) </span> Rate</label>
                                <input type="number" step="0.1" name="crop_price" id="crop_price" value="0" class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Land Details -->
                    
                        <h5 class="font-weight-bold text-primary mt-3">Land Replanting/اراضی دوبارہ کاشت


                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(18) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                " name="replanting_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(19) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال  " value="0" name="replanting_kanal">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3">Double Crop Land/اراضی دو فصلی



                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(20) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                "name="double_crop_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(21) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" value="0" placeholder="Kanal/کنال  "name="double_crop_kanal">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3">Irrigated Area / مجرائی رقبہ




                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(22) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                "name="irrigated_area_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(23) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" value="0" placeholder="Kanal/کنال" name="irrigated_area_kanal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(24) </span>Identifiable Area Marla/قابل شناخت رقبہ مرلہ
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ    

                                "name="identifable_area_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold"><span>(25) </span>Identifiable Area Kanal/قابل شناخت رقبہ کنال
                            </label>
                            <input type="text" class="form-control" value="0" placeholder="Kanal/کنال" name="identifable_area_kanal">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 mb-12">
                                <label class="form-label font-weight-bold"><span>(26) </span>Land Quality/کیفیت
                                </label>
                                <input type="text" class="form-control" value="N/A" placeholder="Land Quality/کیفیت" name="land_quality">
                                <input type="number" name="is_billed" value="0" style="display:none;">
                                <input type="text"   name="review" value="Survey Added" style="display:none;">
                                <input type="number" name="status" value="0" style="display:none;">
                                
                            </div>
                        </div>
                        <!-- Submit Button -->
                      
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill mr-1">Submit</button>

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
        const canalDropdown = document.getElementById('canal_id');
    
        // Run only if the canal dropdown has a value
        if (canalDropdown.value) {
            get_outlets(canalDropdown.value);
        }
    
        // Update outlets when the user selects a different canal
        canalDropdown.addEventListener('change', function () {
            get_outlets(this.value);
        });
    });
    
    function get_outlets(canal_id) {
        if (canal_id) {
            $.ajax({
                url: '/get-outlets/' + canal_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log("Fetched outlets:", data); // Debugging
                    $('#outlet_id').empty().append('<option value="">Choose Outlet</option>');
    
                    $.each(data, function (key, value) {
                        $('#outlet_id').append('<option value="' + value.id + '">' + value.outlet_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching outlets:', error);
                    alert('Could not fetch outlets. Check console for details.');
                }
            });
        } else {
            $('#outlet_id').empty().append('<option value="">Choose Outlet</option>');
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
    document.addEventListener('DOMContentLoaded', function() {
        const previousCropSelect = document.getElementById('previous_crop');
        const finalCropSelect = document.getElementById('finalcrop_id');
        const priceInput = document.getElementById('crop_price');

        function synchronizeDropdowns() {
            const selectedCropName = previousCropSelect.value;
            for (let i = 0; i < finalCropSelect.options.length; i++) {
                const option = finalCropSelect.options[i];
                if (option.getAttribute('data-name') === selectedCropName) {
                    finalCropSelect.selectedIndex = i;
                    const price = option.getAttribute('data-price');
                    priceInput.value = price ? price : 0;
                    return;
                }
            }
            finalCropSelect.selectedIndex = 0;
            priceInput.value = 0;
        }
        previousCropSelect.addEventListener('change', synchronizeDropdowns);
        finalCropSelect.addEventListener('change', function () {
            const selectedOption = finalCropSelect.options[finalCropSelect.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            priceInput.value = price ? price : 0;
        });

        function calculateArea() {
        const length = parseFloat(document.getElementById('length').value) || 0;
        const width = parseFloat(document.getElementById('width').value) || 0;
        const total = (length + width) / 20;
        const kanal = Math.floor(total);
        const marla = Math.round((total - kanal) * 20);
        document.getElementById('kanal').value = kanal;
        document.getElementById('marla').value = marla;
    }
    document.getElementById('length').addEventListener('input', calculateArea);
    document.getElementById('width').addEventListener('input', calculateArea);
    });
</script>