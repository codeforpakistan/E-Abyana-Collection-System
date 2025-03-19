@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .customLegend {
        border: 1px solid #e4e4e4;
        position: relative;
        padding-left:6px;
        padding-right:6px;
    }

    .customLegend legend {
        border: 0;
        background: #fff;
        width: auto;
        color: #6610f2;
        transform: translateY(-50%);
        position: absolute;
        top: 0;
        left: 1em;
        padding: 0 1px;
    }
    </style>
</head>
<div class="app-content">
    <section class="section">
    <div class="row">
    <div class="card w-100">
      <div class="card-header">
        <div class="row">
            <div class="col-10">
            <h4><strong>Survey Details</strong></h4>
            </div>
            <div class="col-2">
            <button style="float:right;" class="btn btn-warning" title="Print" onclick="printCardBody()"><i class="fa fa-print"></i></button>
            </div>
        </div>
      </div>
      <div class="card-body" id="printableCardBody">

<fieldset class="customLegend">
<legend><strong>Land Survey / خسرہ گرداوری</strong></legend>
<br>
<div class="row">
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Halqa</label>
 <input class="form-control" type="text" value="{{$survey->halqa_name}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Village</label>
 <input class="form-control" type="text" value="{{$survey->village_name}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Crop Session</label>
 <input class="form-control" type="text" value="{{$survey->crop_name}}" readonly>
</div>
</div>
<div class="row">
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Session Year</label>
 <input class="form-control" type="text" value="{{$survey->session_date}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Canal</label>
 <input class="form-control" type="text" value="{{$survey->canal_name}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Outlet</label>
 <input class="form-control" type="text" value="{{$survey->outlet_name}}" readonly>
</div>
</div>
</fieldset>
<br><br>
<fieldset class="customLegend">
<legend><strong>Farmer & land Registration Form</strong></legend>
<br>
<div class="row">
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Khasra Assessment Number /نمبر خسرہ</label>
 <input class="form-control" type="text" value="{{$survey->khasra_number}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Irrigator Khata Number</label>
 <input class="form-control" type="text" value="{{$survey->irrigator_khata_number}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Irrigator Name</label>
 <input class="form-control" type="text" value="{{$survey->irrigator_name}}" readonly>
</div>
</div>
<div class="row">
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Tenant Name / نام مالگزار بقید ولدیت</label>
 <input class="form-control" type="text" value="{{$survey->tenant_name}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Cultivator's/ نام کاشتکار بقید ولدیت وقومیت وسکونت</label>
 <input class="form-control" type="text" value="{{$survey->cultivators_info}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Sowing Date / تاریخ تخمریزی</label>
 <input class="form-control" type="text" value="{{$survey->snowing_date}}" readonly>
</div>
</div>
</fieldset>

<br><br>
<fieldset class="customLegend">
<legend><strong>Crop Type Registration /انداراج جنس شدکار</strong></legend>
<br>
<div class="row">
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Land Assessment Marla / اراضی تخمینہ مرلہ</label>
 <input class="form-control" type="text" value="{{$survey->land_assessment_marla}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Land Assessment Kanal / اراضی تخمینہ کنال</label>
 <input class="form-control" type="text" value="{{$survey->land_assessment_kanal}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Previous Crop Name / نام جنس جو پہلے بوئی گئی</label>
 <input class="form-control" type="text" value="{{$survey->previous_crop}}" readonly>
</div>
</div>
</fieldset>

<br><br>
<fieldset class="customLegend">
<legend><strong>Final Measurement /پیمائش پختہ</strong></legend>
<br>
<div class="row">
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Date / تاریخ</label>
 <input class="form-control" type="text" value="{{$survey->date}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Length / طول</label>
 <input class="form-control" type="text" value="{{$survey->length}}" readonly>
</div>
<div class="form-group col-4">
 <label class="form-label font-weight-bold">Width / عرض</label>
 <input class="form-control" type="text" value="{{$survey->width}}" readonly>
</div>
</div>
<h4><strong style="color: #6610f2;">Area/رقبہ</strong></h4>
<div class="row">
<div class="form-group col-3">
 <label class="form-label font-weight-bold">Marla/مرلہ</label>
 <input class="form-control" type="text" value="{{$survey->area_marla}}" readonly>
</div>
<div class="form-group col-3">
 <label class="form-label font-weight-bold">Kanal/کنال</label>
 <input class="form-control" type="text" value="{{$survey->area_kanal}}" readonly>
</div>
<div class="form-group col-3">
 <label class="form-label font-weight-bold">Crop /فصل</label>
 <input class="form-control" type="text" value="{{$survey->final_crop}}" readonly>
</div>
<div class="form-group col-3">
 <label class="form-label font-weight-bold">Rate</label>
 <input class="form-control" type="text" value="{{$survey->crop_price}}" readonly>
</div>
</div>
</fieldset>

<!--<br><br>
<fieldset class="customLegend">
<legend><strong>Land Replanting / اراضی دوبارہ کاشت</strong></legend>
<br>
<div class="row">
<div class="form-group col-6">
 <label class="form-label font-weight-bold">Marla/مرلہ</label>
 <input class="form-control" type="text" value="{{$survey->crop_price}}" readonly>
</div>
<div class="form-group col-6">
 <label class="form-label font-weight-bold">Kanal/کنال</label>
 <input class="form-control" type="text" value="{{$survey->crop_price}}" readonly>
</div>
</div>
</fieldset>  -->

<br><br>
<fieldset class="customLegend">
<legend><strong>Double Crop Land / اراضی دو فصلی</strong></legend>
<br>
<div class="row">
<div class="form-group col-6">
 <label class="form-label font-weight-bold">Marla/مرلہ</label>
 <input class="form-control" type="text" value="{{$survey->double_crop_marla}}" readonly>
</div>
<div class="form-group col-6">
 <label class="form-label font-weight-bold">Kanal/کنال</label>
 <input class="form-control" type="text" value="{{$survey->double_crop_kanal}}" readonly>
</div>
</div>
</fieldset>

<br><br>
<fieldset class="customLegend">
<legend><strong>Irrigated Area / مجرائی رقبہ</strong></legend>
<br>
<div class="row">
<div class="form-group col-2">
 <label class="form-label font-weight-bold">Marla/مرلہ</label>
 <input class="form-control" type="text" value="{{$survey->irrigated_area_marla}}" readonly>
</div>
<div class="form-group col-2">
 <label class="form-label font-weight-bold">Kanal/کنال</label>
 <input class="form-control" type="text" value="{{$survey->irrigated_area_kanal}}" readonly>
</div>
<div class="form-group col-3">
 <label class="form-label font-weight-bold">Identifabl Area Marla</label>
 <input class="form-control" type="text" value="{{$survey->identifable_area_marla}}" readonly>
</div>
<div class="form-group col-3">
 <label class="form-label font-weight-bold">Identifabl Area Kanal</label>
 <input class="form-control" type="text" value="{{$survey->identifable_area_kanal}}" readonly>
</div>
<div class="form-group col-2">
 <label class="form-label font-weight-bold">Land Quality/کیفیت</label>
 <input class="form-control" type="text" value="{{$survey->land_quality}}" readonly>
</div>
</div>
</fieldset>

      </div>
      </div>
    </div> 
</section>  
</div>    
 @endsection
 <script>
    function printCardBody() {
    var printContents = document.getElementById('printableCardBody').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    document.head.removeChild(printStyle);
    location.reload();
        }
 </script>



  <!--  Section 1: Land Survey 
   <fieldset class="customLegend">
    <legend>Land Survey / خسرہ گرداوری</legend>
    <div class="data-row">
        <span class="data-label">Halqa:</span>
        <span class="data-value"> </span>
    </div>
    <div class="data-row">
        <span class="data-label">Village:</span>
        <span class="data-value"></span>
    </div>
    <div class="data-row">
        <span class="data-label">Crop Session:</span>
        <span class="data-value"></span>
    </div>
    <div class="data-row">
        <span class="data-label">Session Year:</span>
        <span class="data-value"></span>
    </div>
    <div class="data-row">
        <span class="data-label">Canal:</span>
        <span class="data-value"></span>
    </div>
    <div class="data-row">
        <span class="data-label">Outlet:</span>
        <span class="data-value"></span>
    </div>
</fieldset> -->