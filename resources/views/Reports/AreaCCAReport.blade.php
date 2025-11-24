@extends('layout')

@section('content')
<head>
</head>

<div class="app-content">
  
    <section class="section">
        <!--row open-->
        <div class="col-12">
            <div class="card">
                <div class="bg-primary text-white p-2">
                    <div class="row">
                        <div class="col-10 p-2">
                            <h5><strong>&nbsp;&nbsp;&nbsp;Area CCA Report</strong></h5>
                        </div>
                        <div class="col-2 text-end">
                            <button class="btn btn-sm btn-warning print-btn">Print</button>
                        </div>
                    </div>
                </div>
<div class="card-body">
 <div class="row" style="margin-top:-20px;">
        <div class="col-12 d-flex align-items-center">
            <div class="form-check me-4">
                <input class="form-check-input" type="radio" name="filterType" id="divisionRadio" value="division">
                <label class="form-check-label" for="divisionRadio">Division Wise CCA</label>
            </div>
            <div class="form-check me-4">
               <input class="form-check-input" type="radio" name="filterType" id="canalRadio" value="canal">
                <label class="form-check-label" for="canalRadio">Canal Wise CCA</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="filterType" id="outletRadio" value="outlet">
                <label class="form-check-label" for="outletRadio">Outlet Wise CCA</label>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="row" id="divisionWiseCcaSetting">
    <div class="col-md-4">
        <label class="form-label font-weight-bold">Select Division</label>
        <select name="dropdown_div_id" id="dropdown_div_id" class="form-control">
            <option value="">Choose Division</option>
            @foreach($dropdown_divisions as $single_dropdown_divisions)
                <option value="{{ $single_dropdown_divisions->id }}">
                    {{ $single_dropdown_divisions->divsion_name }}
                </option>
            @endforeach
        </select>
    </div> 
    </div>

    <div class="row" id="canalWiseCcaSetting">
    <div class="col-md-4">
        <label class="form-label font-weight-bold">Select Division</label>
        <select name="dropdown_div_id_canal" id="dropdown_div_id_canal" class="form-control">
            <option value="">Choose Division</option>
            @foreach($dropdown_divisions as $single_dropdown_divisions)
                <option value="{{ $single_dropdown_divisions->id }}">
                    {{ $single_dropdown_divisions->divsion_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label font-weight-bold">Select Canal</label>
        <select name="dropdown_canal_id" id="dropdown_canal_id" class="form-control">
            <option value="">Choose Canal</option>
        </select>
    </div>
    </div>

    <div class="row" id="outletWiseCcaSetting">
           <div class="col-md-4">
        <label class="form-label font-weight-bold">Select Division</label>
        <select name="dropdown_div_id_outlet" id="dropdown_div_id_outlet" class="form-control">
            <option value="">Choose Division</option>
            @foreach($dropdown_divisions as $single_dropdown_divisions)
                <option value="{{ $single_dropdown_divisions->id }}">
                    {{ $single_dropdown_divisions->divsion_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label font-weight-bold">Select Canal</label>
        <select name="dropdown_canal_id_outlet" id="dropdown_canal_id_outlet" class="form-control">
            <option value="">Choose Canal</option>
        </select>
    </div> 
        <div class="col-md-4">
        <label class="form-label font-weight-bold">Select Outlet</label>
        <select name="dropdown_outlet_id" id="dropdown_outlet_id" class="form-control">
            <option value="">Choose Outlet</option>
        </select>
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

    $('#divisionRadio').prop('checked', true);
    $('#divisionWiseCcaSetting').show();
    $('#canalWiseCcaSetting').hide();
    $('#outletWiseCcaSetting').hide();

    $('input[name="filterType"]').change(function() {
        var selectedValue = $(this).val();

        if (selectedValue === 'division') {
            $('#divisionWiseCcaSetting').show();
            $('#canalWiseCcaSetting').hide();
            $('#outletWiseCcaSetting').hide();
        } 
        else if (selectedValue === 'canal') {
            $('#divisionWiseCcaSetting').hide();
            $('#canalWiseCcaSetting').show();
            $('#outletWiseCcaSetting').hide();
        } 
        else if (selectedValue === 'outlet') {
            $('#divisionWiseCcaSetting').hide();
            $('#canalWiseCcaSetting').hide();
            $('#outletWiseCcaSetting').show();
        }
    });    
/* ****************************************************************************** */
 $('#dropdown_div_id_canal').on('change', function() {
        var divisionId = $(this).val();
        $('#dropdown_canal_id').html('<option value="">Loading...</option>');

        if (divisionId) {
            $.ajax({
                url: "{{ route('getCanalsByDivisionInReport') }}",
                type: "GET",
                data: { division_id: divisionId },
                success: function(data) {
                    $('#dropdown_canal_id').empty();
                    $('#dropdown_canal_id').append('<option value="">Choose Canal</option>');
                    $.each(data, function(key, canal) {
                        $('#dropdown_canal_id').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                    });
                },
                error: function() {
                    $('#dropdown_canal_id').html('<option value="">Error loading canals</option>');
                }
            });
        } else {
            $('#dropdown_canal_id').html('<option value="">Choose Canal</option>');
        }
    });

/*----------------------------------------------------------------------------- */
 $('#dropdown_div_id_outlet').on('change', function() {
        var divisionId = $(this).val();
        $('#dropdown_canal_id_outlet').html('<option value="">Loading...</option>');

        if (divisionId) {
            $.ajax({
                url: "{{ route('getCanalsByDivisionInReport') }}",
                type: "GET",
                data: { division_id: divisionId },
                success: function(data) {
                    $('#dropdown_canal_id_outlet').empty();
                    $('#dropdown_canal_id_outlet').append('<option value="">Choose Canal</option>');
                    $.each(data, function(key, canal) {
                        $('#dropdown_canal_id_outlet').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                    });
                },
                error: function() {
                    $('#dropdown_canal_id_outlet').html('<option value="">Error loading canals</option>');
                }
            });
        } else {
            $('#dropdown_canal_id_outlet').html('<option value="">Choose Canal</option>');
        }
    });

/* ------------------------------------------------------------------------------------------ */
 $('#dropdown_canal_id_outlet').on('change', function() {
        var canalId = $(this).val();
        $('#dropdown_outlet_id').html('<option value="">Loading...</option>');

        if (canalId) {
            $.ajax({
                url: "{{ route('getOutletByCanalInReport') }}",
                type: "GET",
                data: { canalId: canalId },
                success: function(data) {
                    $('#dropdown_outlet_id').empty();
                    $('#dropdown_outlet_id').append('<option value="">Choose Outlet</option>');
                    $.each(data, function(key, canal) {
                        $('#dropdown_outlet_id').append('<option value="' + canal.id + '">' + canal.outlet_name + '</option>');
                    });
                },
                error: function() {
                    $('#dropdown_outlet_id').html('<option value="">Error loading outlets</option>');
                }
            });
        } else {
            $('#dropdown_outlet_id').html('<option value="">Choose Outlet</option>');
        }
    });
 
/* ******************************** Get Data For Reports ******************************* */
     /* *************** Division ****************************** */
    $('#dropdown_div_id').on('change', function () {
        let division_id = $('#dropdown_div_id').val();

        if (division_id) {
            $.ajax({
                url: "{{ route('get-cca-data-only-division') }}",
                type: "POST",
                data: {
                    division_id: division_id,
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

    function fetchDataCanal() {
        let division_id   = $('#dropdown_div_id_canal').val();
        let canal_id       = $('#dropdown_canal_id').val();

        if (division_id && canal_id) {
            $.ajax({
                url: "{{ route('get-cca-data-canal') }}",
                type: "POST",
                data: {
                    division_id: division_id,
                    canal_id: canal_id,
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

    $('#dropdown_div_id_canal, #dropdown_canal_id').on('change', fetchDataCanal);
/* ********************************************************************************* */
    function fetchDataOutlet() {
        let division_id   = $('#dropdown_div_id_outlet').val();
        let canal_id       = $('#dropdown_canal_id_outlet').val();
        let outlet_id       = $('#dropdown_outlet_id').val();

        if (division_id && canal_id && outlet_id) {
            $.ajax({
                url: "{{ route('get-cca-data-outlet') }}",
                type: "POST",
                data: {
                    division_id: division_id,
                    canal_id: canal_id,
                    outlet_id: outlet_id,
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

    $('#dropdown_div_id_outlet, #dropdown_canal_id_outlet, #dropdown_outlet_id').on('change', fetchDataOutlet);
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
 