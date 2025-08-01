@extends('layout')

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>



    <div class="app-content">

        <section class="section">

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "{{ session('error') }}",
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            <!--page-header open-->
          

                




            <section class="section">
                <!--page-header open-->
                <div class="page-header pt-0">
                    <h4 class="page-title font-weight-bold">Edit Canal</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-light-color"></a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </div>
                <!--page-header closed-->
        
                <!--row open-->
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="margin-top: 80px;">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="font-weight-bold">Edit Distributary</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form action="{{ route('updateMinorCanal', $minorCanal->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            
                            

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                        <select name="div_id" id="div_id" class="form-control" required>
                                            <option value="">Choose Division / ڈویژن</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" {{ $minorCanal->div_id == $division->id ? 'selected' : '' }}>
                                                    {{ $division->divsion_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                            
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold" for="canal_id">Select Canal / نہر</label>
                                        <select name="canal_id" id="canal_id" class="form-control" required>
                                            <option value="">Choose Canal / نہر</option>
                                            @foreach($canals as $canal)
                                                <option value="{{ $canal->id }}" {{ $minorCanal->canal_id == $canal->id ? 'selected' : '' }}>
                                                    {{ $canal->canal_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Name of Minor</label>
                                        <input class="form-control form-control-lg" type="text" name="minor_name" value="{{ $minorCanal->minor_name }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">No. of Outlets</label>
                                        <input class="form-control form-control-lg" type="number" name="no_outlet" value="{{ $minorCanal->no_outlet }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">No. of Outlets (Left Side)</label>
                                        <input class="form-control form-control-lg" type="number" name="no_outlet_ls" value="{{ $minorCanal->no_outlet_ls }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">No. of Outlets (Right Side)</label>
                                        <input class="form-control form-control-lg" type="number" name="no_outlet_rs" value="{{ $minorCanal->no_outlet_rs }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Total No. of CCA</label>
                                        <input class="form-control form-control-lg" type="number" name="total_no_cca" value="{{ $minorCanal->total_no_cca }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Total No. of Discharge (Cusec)</label>
                                        <input class="form-control form-control-lg" type="number" name="total_no_discharge_cusic" value="{{ $minorCanal->total_no_discharge_cusic }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </div>
                            </form>
                            
                            
                            
                        </div>
                    </div>
                </div>
              
                
            </section>





 
@endsection
<script>
    function get_districts(element) {
        var divisionId = element.value; // Get the selected value

        if (divisionId) {
            // Make an AJAX request to fetch districts based on the selected division
            $.ajax({
                url: '/get-districts/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear the district dropdown and add a placeholder option
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Choose District</option>');

                    // Populate the district dropdown with the data received
                    $.each(data, function(key, value) {
                        $('#district_id').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
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
    function get_halqa(element) {
        var tehsilId = element.value;
        console.log(tehsilId);

        if (tehsilId) {

            $.ajax({
                url: '/get-halqa/' + tehsilId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#halqa_id').empty();
                    $('#halqa_id').append('<option value="">Choose Tehsil</option>');


                    $.each(data, function(key, value) {
                        $('#halqa_id').append('<option value="' + value.id + '">' + value
                            .halqa_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        } else {

            $('#halqa_id').empty();
            $('#halqa_id').append('<option value="">Choose Tehsil</option>');
        }
    }
</script>
<script>
    function get_village(element) {
        var halqaId = element.value; // Get the selected Halqa ID

        if (halqaId) {
            $.ajax({
                url: '/get-village/' + halqaId, // The route to fetch villages
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear the dropdown and add a placeholder option
                    $('#village_id').empty();
                    $('#village_id').append('<option value="">Choose Village/گاؤں</option>');

                    // Populate dropdown with the fetched data
                    $.each(data, function(key, value) {
                        $('#village_id').append(
                            '<option value="' + value.village_id + '">' + value.village_name +
                            '</option>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching villages:', error);
                    alert('Failed to fetch villages. Please try again later.');
                },
            });
        } else {
            $('#village_id').empty();
            $('#village_id').append('<option value="">Choose Village/گاؤں</option>');
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
                success: function(data) {
                    // Clear the Tehsil dropdown and add a placeholder option
                    $('#tehsil_id').empty();
                    $('#tehsil_id').append('<option value="">Choose Tehsil</option>');

                    // Populate the Tehsil dropdown with the received data
                    $.each(data, function(key, value) {
                        $('#tehsil_id').append('<option value="' + value.tehsil_id + '">' + value
                            .tehsil_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
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





















