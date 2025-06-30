@extends('layout')

@section('content')
<head>
    ...
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
    .customLegend legend strong {
        font-size:20px;
    }
    </style>
</head>

<div class="app-content">
  
    <section class="section">
        <!--row open-->
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><strong>Moqabilataan Report</strong></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                        <fieldset class="customLegend">
                        <legend><strong>Division / ڈویژن</strong></legend>
                        <br>
                        <div class="row mb-2">
                        <div class="col-12">
                         <label class="form-label font-weight-bold">Select Division</label>
                        <select name="dropdown_div_id" id="dropdown_div_id" class="form-control">
                            <option value="">Choose Division</option>
                            @foreach($dropdown_divisions as $single_dropdown_divisions)
                                <option value="{{$single_dropdown_divisions->id}}">{{ $single_dropdown_divisions->divsion_name }}</option>
                            @endforeach
                        </select>
                        </div>
                        </div>
                        </fieldset>
                        </div>
                        <div class="col-8">
                           <fieldset class="customLegend">
                        <legend><strong>Season Comparison / سیزن موازنہ</strong></legend>
                        <br>
                        <div class="row mb-2">
                        <div class="col-6">
                        <label class="form-label font-weight-bold">Select Base Season</label>
                        <select name="dropdown_session_year_base" id="dropdown_session_year_base" class="form-control">
                            <option value="">Choose Base Season</option>
                            @foreach($dropdown_session_year as $single_dropdown_session_year)
                                <option value="{{$single_dropdown_session_year->session_date}}">{{ $single_dropdown_session_year->session_date }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-6">
                        <label class="form-label font-weight-bold">Select Compared Season</label>
                        <select name="dropdown_session_year_compare" id="dropdown_session_year_compare" class="form-control">
                            <option value="">Choose Compared Season</option>
                            @foreach($dropdown_session_year as $single_dropdown_session_year)
                                <option value="{{$single_dropdown_session_year->session_date}}">{{ $single_dropdown_session_year->session_date }}</option>
                            @endforeach
                        </select>
                        </div>
                        </div>
                        </fieldset> 
                        </div>
                    </div>
                     
                    <div class="row">
                       
                        <div class="col-4">
                           
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
        
        
</section> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
$(document).ready(function () {
    $('#dropdown_div_id, #dropdown_session_year_base, #dropdown_session_year_compare').on('change', function () {
        let division_id = $('#dropdown_div_id').val();
        let session_year_base = $('#dropdown_session_year_base').val();
        let session_year_compare = $('#dropdown_session_year_compare').val();

        if (session_year_base && session_year_compare && session_year_base === session_year_compare) {
            Swal.fire("Warning", "Base and Compared seasons should not be the same!", "warning");
        } 
        else if (division_id && session_year_base && session_year_compare) {
            $.ajax({
                url: "{{ route('ReportMoqabilataanData') }}",
                type: "POST",
                data: {
                    division_id: division_id,
                    session_year_base: session_year_base,
                    session_year_compare: session_year_compare,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('.table-responsive').html(response.html);
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            });
        }
    });
});
</script>


</div>  
 @endsection
 