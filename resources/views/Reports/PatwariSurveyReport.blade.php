@extends('layout')

@section('content')
<head>
</head>

<div class="app-content">
  
    <section class="section">
        <!--row open-->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><strong>Patwari's Survey Report</strong></h5>
                </div>
                <div class="card-body">
                 <div class="d-flex align-items-center justify-content-between" style="margin-top:-20px;">
    <!-- Left side (two dropdowns side by side) -->
    <div class="d-flex gap-3">
        <div>
            <label class="form-label font-weight-bold">Select Division</label>
            <select name="dropdown_div_id" id="dropdown_div_id" class="form-control">
                <option value="">Choose Division</option>
                @foreach($dropdown_divisions as $single_dropdown_divisions)
                    <option value="{{$single_dropdown_divisions->id}}">
                        {{ $single_dropdown_divisions->divsion_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label font-weight-bold">Select Season</label>
            <select name="dropdown_season_id" id="dropdown_season_id" class="form-control">
                <option value="">Choose Season</option>
                @foreach($dropdown_seasons as $single_dropdown_season)
                    <option value="{{$single_dropdown_season->id}}">
                        {{ $single_dropdown_season->crop_name }}
                    </option>
                @endforeach
            </select>
        </div>
         <div>
            <label class="form-label font-weight-bold">Crop Session</label>
            <select name="dropdown_session_year" id="dropdown_session_year" class="form-control">
                <option value="">Choose Crop Session</option>
                @foreach($dropdown_session_year as $single_dropdown_session_year)
                    <option value="{{$single_dropdown_session_year->session_date}}">
                        {{ $single_dropdown_session_year->session_date }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Right side (button) -->
    <div>
        <button class="btn btn-sm btn-primary print-btn">Print</button>
    </div>
</div>

                </div>

            </div>
        </div>

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body print-area">
                        <div class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
</section> 
</div>
<script>
$(document).ready(function () {
    function fetchData() {
        let division_id   = $('#dropdown_div_id').val();
        let crop_id       = $('#dropdown_season_id').val();
        let session_date  = $('#dropdown_session_year').val();

        if (division_id && crop_id && session_date) {
            $.ajax({
                url: "{{ route('ReportViewPatwariSurveyData') }}",
                type: "POST",
                data: {
                    div_id: division_id,
                    crop_id: crop_id,
                    session_date: session_date,
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
    }

    $('#dropdown_div_id, #dropdown_season_id, #dropdown_session_year').on('change', fetchData);
});
</script>

<script>
document.querySelector(".print-btn").addEventListener("click", function () {
    var printContents = document.querySelector(".print-area").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
});
</script>
 @endsection
 