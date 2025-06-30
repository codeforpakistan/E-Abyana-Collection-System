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
    @php
    use Carbon\Carbon;

    $createdDate = Carbon::parse($survey->created_at);
    $diffInDays = $createdDate->diffInDays(Carbon::now());
    $readonly = $diffInDays > 15 ? 'readonly' : '';
    @endphp
    <!-- {{ \Carbon\Carbon::parse($survey->created_at)->format('m/d/Y') }} -->
    
        
        <!-- Form Card -->
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="font-weight-bold urdu-text">Edit&nbsp;&nbsp;Land&nbsp;&nbsp;Survey/ خسرہ گرداوری کی ترمیم</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('update.survey', $survey->crop_survey_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="row">
                            <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Village/گاؤں</label>
                                <select name="village_id" class="form-control" required readonly>
                                        <option value="">{{$survey->village_name}}</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Canal/نہر</label>
                                <input type="hidden" id="c_type" name="c_type" value="{{$survey->canal_type}}" />
                                <select name="canal_id" id="canal_id" class="form-control" readonly>
                                <option value="{{$survey->canal_id}}">{{$survey->canal_name}}</option>
                                </select>
                            </div>
                            </div>

            
            @if ($waterSourceType === 'Canal')
            <div class="row">
                <div class="form-group col-12">
                 <label class="form-label font-weight-bold">Outlet</label>
                 <input class="form-control" type="text" value="{{$survey->outlet_name}}" readonly>
                </div>
            </div>
    @elseif ($waterSourceType === 'Canal + Minor Canal')
        <div class="row">
        <div class="form-group col-6">
            <label class="form-label font-weight-bold">Distributory</label>
            <input class="form-control" type="text" value="{{ $survey->minor_name }}" readonly>
        </div>
        <div class="form-group col-6">
        <label class="form-label font-weight-bold">Outlet</label>
        <input class="form-control" type="text" value="{{$survey->outlet_name}}" readonly>
       </div>
       </div>
    @elseif ($waterSourceType === 'Distributary')
       <div class="row">
        <div class="form-group col-4">
            <label class="form-label font-weight-bold">Distributory</label>
            <input class="form-control" type="text" value="{{ $survey->minor_name }}" readonly>
        </div>
        <div class="form-group col-4">
            <label class="form-label font-weight-bold">Minor</label>
            <input class="form-control" type="text" value="{{ $survey->distributary_name }}" readonly>
        </div>
        <div class="form-group col-4">
         <label class="form-label font-weight-bold">Outlet</label>
         <input class="form-control" type="text" value="{{$survey->outlet_name}}" readonly>
        </div>
        </div>
    @elseif ($waterSourceType === 'Branch')
     <div class="row">
        <div class="form-group col-3">
            <label class="form-label font-weight-bold">Distributory</label>
            <input class="form-control" type="text" value="{{ $survey->minor_name }}" readonly>
        </div>
        <div class="form-group col-3">
            <label class="form-label font-weight-bold">Minor</label>
            <input class="form-control" type="text" value="{{ $survey->distributary_name }}" readonly>
        </div>
        <div class="form-group col-3">
            <label class="form-label font-weight-bold">Branch</label>
            <input class="form-control" type="text" value="{{ $survey->branch_name }}" readonly>
        </div>
        <div class="form-group col-3">
         <label class="form-label font-weight-bold">Outlet</label>
         <input class="form-control" type="text" value="{{$survey->outlet_name}}" readonly>
        </div>
        </div>
    @endif

                        <div class="row">
                        <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Session Year / فصلی سال</label>
                                <input type="text" class="form-control" placeholder="Session Year" value="{{$survey->session_date}}" name="session_date" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label font-weight-bold urdu-text">Crop Session /فصل&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <select name="crop_id" id="crop_id" class="form-control" required>
                                    <option class="form-label" value="{{$survey->session_crop_id}}">{{$survey->session_crop_name}}</option>
                                    @foreach($session_crops as $single_session_crops)
                                    <option class="form-label" value="{{$single_session_crops->id}}">{{$single_session_crops->crop_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Farmer & Land Registration Form / کاشتکار و زمین کی رجسٹریشن فارم</h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label font-weight-bold urdu-text"><span>(1) </span>Khasra Number /نمبر خسرہ&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <input type="text" class="form-control urdu-text" placeholder="Khasra Number /نمبر خسرہ" name="khasra_number" value="{{$survey->khasra_number ?? 0}}" required>
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
                                <input type="text" class="form-control" placeholder="" name="irrigator_id" value="{{$survey->irrigator_id}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(4) </span>Tenant Name / نام مالگزار بقید ولدیت  
                                </label>
                                <input type="text" class="form-control" placeholder="Tenant Name/نام مالگزار بقید ولدیت  " name="tenant_name" value="{{$survey->tenant_name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(5) </span>Entry Date /تاریخ اندراج</label>
                                <input type="date" class="form-control" value="{{$survey->registration_date}}" placeholder="Entry Date/تاریخ اندراج " name="registration_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(6) </span>Cultivator Name/ نام کاشتکار بقید ولدیت وقومیت وسکونت  
                                </label>
                                <input type="text" class="form-control" placeholder="Cultivator's Information / نام کاشتکار بقید ولدیت وقومیت وسکونت  
                                " name="cultivators_info" value="{{$survey->cultivators_info}}">
                            </div>
                            <div class="col-md-6 mb-6">
                            <label class="form-label font-weight-bold urdu-text"><span>(7) </span> Sowing Date / تاریخ تخمریزی</label>
                            <input type="date" class="form-control" value="{{$survey->snowing_date}}" placeholder="Sowing Date / تاریخ تخمریزی" name="snowing_date">
                        </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Crop Type Registration/انداراج جنس شدکار
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(8) </span>Land Assessment Marla /اراضی تخمینہ  
                                </label>
                                <input type="text" class="form-control" placeholder="Marla/مرلہ  
                                " name="land_assessment_marla" value="{{ $survey->land_assessment_kanal ?? 0 }}" {{ $readonly }}>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(9) </span>Land Assessment Kanal / اراضی تخمینہ  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="{{$survey->land_assessment_kanal ?? 0}}" name="land_assessment_kanal" {{ $readonly }}>
                            </div>
   
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-12">
                                <label class="form-label font-weight-bold urdu-text"><span>(10) </span> Previous Crop Name with Grade / نام جنس جو پہلے بوئی گئی بمعہ درجہ&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <select name="previous_crop" id="previous_crop" class="form-control">
                                    <option class="form-label" value="{{$survey->previous_crop}}">{{$survey->previous_crop}}</option>
                                    @foreach($crop_details as $single_crop_details)
                                    <option class="form-label" value="{{$single_crop_details->final_crop}}">{{$single_crop_details->final_crop}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Final Measurement /پیمائش پختہ
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(11) </span>Date/تاریخ</label>
                                <input type="date" class="form-control"  value="{{$survey->date}}" placeholder="Date/تاریخ" name="date">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(12) </span>Length/طول (Karam/کرم)</label>
                                <input type="text" class="form-control" value="{{$survey->length ?? 0}}" placeholder="Length/طول" name="length" id="length">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(13) </span>Width/عرض (Karam/کرم)</label>
                                <input type="text" class="form-control" placeholder="Width/عرض" value="{{$survey->width ?? 0}}" name="width" id="width">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Area/رقبہ
                        </h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(14) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="{{$survey->area_marla ?? 0}}" placeholder="Marla/مرلہ" name="area_marla" id="marla" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(15) </span> Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="{{$survey->area_kanal ?? 0}}" name="area_kanal" id="kanal" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 form-group">
                                <label class="form-label font-weight-bold urdu-text"><span>(16) </span> Crop /فصل&nbsp;&nbsp;<span style="color:red;">*</span></label>
                                <select name="finalcrop_id" id="finalcrop_id" class="form-control" required>
                                    <option class="form-label" value="{{$survey->final_crop_id}}" data-type="{{ $survey->crop_type }}" data-name="{{ $survey->final_crop }}">{{$survey->final_crop}}</option>
                                    @foreach($crop_details as $single_crop_details)
                                    <option class="form-label" value="{{ $single_crop_details->id }}" data-type="{{ $single_crop_details->crop_type }}" data-name="{{ $single_crop_details->final_crop }}">{{ $single_crop_details->final_crop }} - {{$single_crop_details->crop_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label font-weight-bold urdu-text"><span>(17) </span> Rate / نرخ</label>
                                <input type="number" step="0.1" name="crop_price" id="crop_price" value="{{$survey->crop_price ?? 0}}" class="form-control" readonly>
                            </div>
                        </div>
                      <!--  <h5 class="font-weight-bold text-primary mt-3 urdu-text">Land Replanting / اراضی دوبارہ کاشت</h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(18) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="0" placeholder="Marla/مرلہ" name="replanting_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(19) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" placeholder="Kanal/کنال" value="0" name="replanting_kanal">
                            </div>
                        </div> -->
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Double Crop Land /اراضی دو فصلی</h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(20) </span>Marla/مرلہ</label>
                                <input type="text" class="form-control" value="{{$survey->double_crop_marla ?? 0}}" placeholder="Marla/مرلہ" name="double_crop_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(21) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" value="{{$survey->double_crop_kanal ?? 0}}" placeholder="Kanal/کنال" name="double_crop_kanal">
                            </div>
                        </div>
                        <h5 class="font-weight-bold text-primary mt-3 urdu-text">Irrigated Area / مجرائی رقبہ</h5>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(22) </span>Marla/مرلہ    
                                </label>
                                <input type="text" class="form-control" value="{{$survey->irrigated_area_marla ?? 0}}" placeholder="Marla/مرلہ" name="irrigated_area_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(23) </span>Kanal/کنال  
                            </label>
                            <input type="text" class="form-control" value="{{$survey->irrigated_area_kanal ?? 0}}" placeholder="Kanal/کنال" name="irrigated_area_kanal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(24) </span>Identifiable Area Marla/قابل شناخت رقبہ مرلہ
                                </label>
                                <input type="text" class="form-control" value="{{$survey->identifable_area_marla ?? 0}}" placeholder="Marla/مرلہ" name="identifable_area_marla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold urdu-text"><span>(25) </span>Identifiable Area Kanal/قابل شناخت رقبہ کنال
                            </label>
                            <input type="text" class="form-control" value="{{$survey->identifable_area_kanal ?? 0}}" placeholder="Kanal/کنال" name="identifable_area_kanal">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 mb-12">
                                <label class="form-label font-weight-bold urdu-text"><span>(26) </span>Land Quality/کیفیت
                                </label>
                                <input type="text" class="form-control" value="{{$survey->land_quality ?? N/A}}" placeholder="Land Quality/کیفیت" name="land_quality">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary rounded-pill mr-1">Update / <span class="urdu-text">ترمیم کریں</span></button>

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
