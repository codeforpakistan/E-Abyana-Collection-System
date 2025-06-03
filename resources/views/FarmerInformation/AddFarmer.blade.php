@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="app-content">
    <section class="section">
        <!-- Page Header -->
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold">Irrigation System - Farmer & Land Details</h4>
        </div>
        
        <!-- Form Card -->
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="margin-top: 80px;">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="font-weight-bold">Land Survey/خسرہ گرداوری</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url('AddFarmer/add') }}" method="POST">
                        @csrf

                        <!-- Farmer Details -->
                        <h5 class="font-weight-bold text-primary mt-3">Farmer Information</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="form-label">Select Village/ضلع</label>
                                <select name="village_id" class="form-control" required>
                                    <option value="">Select Village</option>
                                    @foreach($villages as $village)
                                        <option value="{{ $village->village_id }}">{{ $village->village_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label">plat_boundary_number/ نمبر شمار</label>
                                <input type="text" class="form-control" name="plat_boundary_number" placeholder="Enter plat_boundary_number">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label">Select Division/تحصیل</label>
                                <select name="division_id" class="form-control" required>
                                    <option value="">Choose Division</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{$divsion->division_id}}">{{$divsion->divsion_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label">Select District/ضلع</label>
                                <select name="district_id" id="district_id" class="form-control" required>
                                    <option class="form-label font-weight-bold >Choose District/ضلع</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="form-label">Select Canal/نہر</label>
                                <select name="id" id="id" class="form-control" required>
                                    <option value="" class="form-label font-weight-bold">Choose Canal/نہر</option>
                                    @foreach($canals as $canal)
                                        <option value="{{ $canal->id }}">{{ $canal->canal_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group">
                                <label class="form-label">Crop/فصل</label>
                                <select name="crop_id" id="crop_id" class="form-control" required>
                                    <option class="form-label font-weight-bold" value="">Choose District/ضلع</option>
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->crop_id }}">{{ $crop->crop_name }}</option> <!-- Ensure you're using the correct field names -->
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-md-2 form-group">
                                <label class="form-label">Select Tehsil/تحصیل</label>
                                <select name="crop_id" id="crop_id" class="form-control" required>
                                    <option value="">Choose Crop/فصل</option>
                                    @foreach($crops as $crop)
                                        <option value="{{ $crop->crop_id }}">{{ $crop->crop_year }}</option> <!-- Ensure you're using the correct field name -->
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="form-label">Outlet/موگیہ</label>
                                <select name="crop_id" id="crop_id" class="form-control" required>
                                    <option value="">Choose Crop/فصل</option>
                                    @foreach($Outlets as $Outlet)
                                        <option value="{{ $Outlet->id }}">{{ $Outlet->outlet_name}}</option> <!-- Ensure you're using the correct field name -->
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Water Outlet/توڑ جھلار</label>
                                <input type="text" class="form-control" placeholder="Serial Number / نمبر شمار" name="serial_number">
                            </div>
                        </div>
                        
                        <!-- Canal Information -->
                        <h5 class="font-weight-bold text-primary mt-3">Farmer & land Registration Form</h5>
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><span>(1)</span> Serial Number / نمبر شمار</label>
                                <input type="text" class="form-control" placeholder="Serial Number / نمبر شمار" name="serial_number">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><span>(2)</span> Entry Date/تاریخ اندراج</label>
                                <input type="date" class="form-control" placeholder="Entry Date/تاریخ اندراج" name="registration_date">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><span>(3)</span>Assessment_number/نمبر کھاتہ(کھتونی)  </label>
                                <input type="text" class="form-control" placeholder="Account Number/نمبر کھاتہ(کھتونی)  " name="assessment_number">
                            </div>
                        </div>

                        <!-- Land Details -->
                    
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><span>(4)</span>Khasra Assessment Number/نمبر خسرہ بندوبست</label>
                                <input type="text" class="form-control" placeholder="Khasra Assessment Number/نمبر خسرہ بندوبست" name="khasra_number">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><span>(5)</span>Patwari Name/پٹواری </label>
                                <input type="text" class="form-control" placeholder="Patwari Name/پٹواری" name="patwari_name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><span>(6)</span>Owner Name/نام مالک بقید ولدیت و قومیت </label>
                                <input type="text" class="form-control" placeholder="Owner Name/نام مالک بقید ولدیت و قومیت " name="owner_name">
                            </div>
                        </div>
                     
                     <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><span>(7)</span>Tenant Name / نام مالگزار بقید ولدیت  
                            </label>
                            <input type="text" class="form-control" placeholder="Tenant Name/نام مالگزار بقید ولدیت  " name="tenant_name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><span>(8)</span>Cultivator's/ نام کاشتکار بقید ولدیت وقومیت وسکونت  
                            </label>
                            <input type="text" class="form-control" placeholder="Cultivator's Information / نام کاشتکار بقید ولدیت وقومیت وسکونت  
                            " name="cultivators_info">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label"><span>(9)</span> Previous Crop Type / نام جنس جو پہلے بوئی گئی بمعہ درجہ</label>
                                <input type="text" class="form-control" placeholder="Previous Crop Type / نام جنس جو پہلے بوئی گئی بمعہ درجہ" name="previous_crop">
                            </div>
                        </div>
                    </div>
                    <h5 class="font-weight-bold text-primary mt-3">Farmer & land Registration Form</h5>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><span>(10)</span>Land Assessment/اراضی تخمینہ  
                            </label>
                            <input type="text" class="form-control" placeholder="Marla/مرلہ  
                            " name="marla">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><span>(11)</span>Land Assessment / اراضی تخمینہ  
                        </label>
                        <input type="text" class="form-control" placeholder="Kanal/کنال  " name="kanal">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label"><span>(12)</span> Sowing Date / تاریخ تخمریزی</label>
                                <input type="date" class="form-control" placeholder="Sowing Date / تاریخ تخمریزی" name="snowing_date">
                            </div>
                        </div>
                    </div>
                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
