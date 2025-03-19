@extends('layout')

@section('content')

@php
    $today = date('d-m-Y');
    $date = new DateTime();
    $date->modify('+3 month');
    $nextMonthDate = $date->format('d-m-Y');
@endphp

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .a4 {
            width: 210mm;
            min-height: 297mm;
            padding: 20px;
            margin: auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        #save {
    page-break-inside: avoid;
}
.page-break {
    page-break-before: always;
}

        @media print {
            .a4 {
                box-shadow: none;
                width: 100%;
                height: auto;
            }
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
                            <h4><strong>Survey Bills</strong></h4>
                        </div>
                        <div class="col-2">
                            <button style="float:right;" class="btn btn-warning" title="Print" onclick="window.print()">
                                <i class="fa fa-print"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @foreach($surveys as $survey)
                        <div class="a4 mb-4" id="printableCardBody">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-sm-6 d-flex align-items-center">
                                    <img src="{{ asset('assets/img/avatar/logo.png') }}" alt="E-Abyana Logo" class="mr-3" style="width: 80px;">
                                    <div>
                                        <strong>
                                            <h5 class="mb-0">E-Abyana</h5>
                                            <h6 class="mb-0">Irrigation Department KPK</h6>
                                            <h6 class="mb-0">محکمہ آبپاشی خیبر پختونخوا</h6>
                                        </strong>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 text-right">
                                    <div class="form-inline" style="float:right;">
                                        <div class="bill_date mr-2 text-center" style="height:62px; width:100px; background: #97e4ae; border:1px solid gray;">
                                            <p style="margin:0px;">بل کی تاریخ</p>
                                            <p style="margin:0px;">Bill Date</p>
                                            <p style="margin:0px;">{{ $today }}</p>
                                        </div>
                                        <div class="bill_due_date mr-4 text-center" style="height:62px; width:100px; background: #f78484; border:1px solid gray;">
                                            <p style="margin:0px;">آخری تاریخ</p>
                                            <p style="margin:0px;">Due Date</p>
                                            <p style="margin:0px;">{{ $nextMonthDate }}</p>
                                        </div>
                                        <img src="{{ asset('assets/img/avatar/KP-Logo.png') }}" alt="Bill Logo" style="width: 80px;">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row" style="margin-left:2px; margin-right:2px;">
                                <div class="col-md-8 col-sm-8" style="border:1px solid gray;">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <span><strong>Consumer ID</strong></span>
                                            <p>1000000000{{ $survey->irrigator_id }}</p>
                                            <span><strong>Name</strong></span>
                                            <p>{{ $survey->irrigator_name }}</p>
                                            <span><strong>Father Name</strong></span>
                                            <p>{{ $survey->irrigator_f_name }}</p>
                                            <span><strong>Khata No</strong></span>
                                            <p>{{ $survey->irrigator_khata_number }}</p>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <span><strong>Canal</strong></span>
                                            <p>{{ $survey->canal_name }}</p>
                                            <span><strong>Outlet</strong></span>
                                            <p>{{ $survey->outlet_name }}</p>
                                            <span><strong>Division</strong></span>
                                            <p>{{ $survey->divsion_name }}</p>
                                            <span><strong>District</strong></span>
                                            <p>{{ $survey->name }}</p>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <span><strong>Tehsil</strong></span>
                                            <p>{{ $survey->tehsil_name }}</p>
                                            <span><strong>Halqa</strong></span>
                                            <p>{{ $survey->halqa_name }}</p>
                                            <span><strong>Village</strong></span>
                                            <p>{{ $survey->village_name }}</p>
                                            <span><strong>Crop Season</strong></span>
                                            <p>{{ $survey->crop_name }}-2024</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4" style="border:1px solid gray;">
                                    <span><strong>Bill Payment History</strong></span>
                                    <span><strong>Season</strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Bill</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Payment</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Arrears</strong></span>
                                </div>
                            </div>

                            <hr>

                            <div class="row" style="margin-left:2px; margin-right:2px;">
                                <table class="table table-bordered text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:200px;">Authorized Use</th>
                                            <th class="text-center" style="width:50px;">Rate (Rs)</th>
                                            <th class="text-center" style="width:80px;">Area</th>
                                            <th class="text-center" style="width:100px;">Total (Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $total_amount =0;
                                      $total_marla=0;
                                      $total_kanal=0;
                                      
                                      ?>
                                      @foreach($surveys as $survey)
                                      @php
                                      $convert_marla = $survey->area_marla/20;
                                     $amount = ($convert_marla + $survey->area_kanal) * $survey->crop_price;
                                     $total_amount+=$amount;
                                     $total_marla+=$survey->area_marla;
                                     $total_kanal+=$survey->area_kanal;
                                      @endphp
                                      <tr>
                                          <td>Irrigable Area <span style="float:right;">قابل آبپاشی رقبہ</span></td>
                                          <td class="text-center">{{$survey->crop_price}}</td>
                                          <td class="text-center">{{$survey->area_marla}} Marla - {{$survey->area_kanal}} Kanal</td>
                                          <td class="text-center">{{ number_format($amount, 2) }}</td>
                                        </tr>
                                      @endforeach
                                        <tr>
                                          <th colspan="2" class="text-center">Total / کل</th>
                                          <th class="text-center">{{$total_marla}} Marlas - {{$total_kanal}} Kanals</th>
                                          <th class="text-center">{{number_format($total_amount, 2)}}</th>
                                        </tr>
                                      </tbody>
                                </table>
                                <table class="table table-bordered text-nowrap w-100">
                                  <tr>
                                    <td style="width:430px;">Current Abyana</td>
                                    <td class="text-center" style="width:50px;"><strong>{{number_format($total_amount, 2)}}</strong></td>
                                  </tr>
                                  <tr>
                                    <td style="width:430px;">Arrears</td>
                                    <td class="text-center" style="width:50px;"><strong>0</strong></td>
                                  </tr>
                                  <tr>
                                    <td style="width:430px;">Total Payable Amount</td>
                                    <td class="text-center" style="width:50px;"><strong>{{number_format($total_amount, 2)}}</strong></td>
                                  </tr>
                                </table>
                                <table class="table table-bordered text-nowrap w-100">
                                  <tr>
                                    <td style="width:360px;">Payable Amount (Within Due Date)</td>
                                    <td class="text-center" style="width:80px;"><strong>{{number_format($total_amount, 2)}}</strong></td>
                                  </tr>
                                  <tr>
                                    <td style="width:360px;">Payable Amount (After Due Date)</td>
                                    <td class="text-center" style="width:80px;"><strong>{{number_format($total_amount+440, 2)}}</strong></td>
                                  </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                              <div class="col-md-5 col-sm-5 d-flex align-items-center">
                                       <img src="{{asset('assets/img/avatar/logo.jpg')}}" alt="E-Abyana Logo" class="mr-3" style="width: 80px;"> <!-- Logo -->
                                       <div>
                                           <h5 class="mb-0">E-Abyana</h5>
                                           <h6 class="mb-0">Irrigation Department KPK</h6> 
                                           <h6 class="mb-0">محکمہ آبپاشی خیبر پختونخوا</h6> 
                                       </div>
                                   </div>
                      
                                   <div class="col-md-7 col-sm-7 text-right">
                                       <div class="form-inline" style="float:right;">
                                           <div class="bill_date mr-1 text-center" style="height:50px; width:80px; border:1px solid gray;">
                                            <p style="margin:0px;"><strong>Bill Date</strong></p>
                                            <p style="margin:0px;">{{$today}}</p>
                                           </div>
                                           <div class="bill_due_date mr-1 text-center" style="height:50px; width:80px; border:1px solid gray;">
                                            <p style="margin:0px;"><strong>Due Date</strong></p>
                                            <p style="margin:0px;">{{$today}}</p>
                                           </div>
                                           <div class="abyana mr-1 text-center" style="height:50px; width:80px; border:1px solid gray;">
                                            <p style="margin:0px;"><strong>Abyana</strong></p>
                                            <p style="margin:0px;">{{number_format($total_amount+440, 2)}}</p>
                                           </div>
                                           <div class="arrears mr-1 text-center" style="height:50px; width:80px; border:1px solid gray;">
                                            <p style="margin:0px;"><strong>Arrear</strong></p>
                                            <p style="margin:0px;">0</p>
                                           </div>
                                           <div class="total mr-1 text-center" style="height:50px; width:80px; border:1px solid gray;">
                                            <p style="margin:0px;"><strong>Total</strong></p>
                                            <p style="margin:0px;">{{number_format($total_amount+440, 2)}}</p>
                                           </div>
                                       </div>
                                   </div>
                              </div>
                              <div class="row" style="margin-left:2px; margin-right:2px;">
                                <table class="table table-bordered text-nowrap w-100">
                                  <tr>
                                    <th>Consumer ID</th>
                                    <th>Name</th>
                                    <th>F Name</th>
                                    <th>Khata No</th>
                                    <th>Canal</th>
                                    <th>Outlet</th>
                                    <th>Crop Season</th>
                                  </tr>
                                  <tr>
                                    <td>1000000000{{$relatedData->irrigator_id}}</td>
                                    <td>{{$relatedData->irrigator_name}}</td>
                                    <td>Sher Ali Khan</td>
                                    <td>{{$relatedData->irrigator_khata_number}}</td>
                                    <td>{{$relatedData->canal_name}}</td>
                                    <td>{{$relatedData->outlet_name}}</td>
                                    <td>{{$relatedData->crop_name}}-2024</td>
                                  </tr>
                                </table>
                                <hr>
                                <table class="table table-bordered text-nowrap w-100">
                                <tr>
                                    <th colspan="3" class="text-center">Bill Amount Details</th>
                                  </tr>
                                  <tr>
                                  <td style="width:360px;">Payable Amount (Within Due Date)</td>
                                  <td style="width:80px;" class="text-center"><strong>{{number_format($total_amount, 2)}}</strong></td>
                                </tr>
                                <tr>
                                  <td style="width:360px;">Payable Amount (After Due Date)</td>
                                  <td style="width:80px;" class="text-center"><strong>{{number_format($total_amount+440, 2)}}</strong></td>
                                </tr>
                                </table>
                                </div>
                        </div>
                        <div class="page-break"></div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</div>

@endsection
