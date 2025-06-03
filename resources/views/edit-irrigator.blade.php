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
                    <h4 class="page-title font-weight-bold">Edit Irrigator</h4>
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
                            <h4 class="font-weight-bold">Edit Irrigator</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('update.irrigator', $irrigator->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- This ensures the form submits as a PUT request -->
                                
                                <div class="row">
                                    <!-- Village Selection -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="village_id">Select Village/گاؤں</label>
                                        <select name="village_id" id="village_id" class="form-control" required>
                                            <option value="">Choose Village/گاؤں</option>
                                            @foreach ($villages as $village)
                                                <option value="{{ $village->village_id }}" {{ old('village_id', $irrigator->village_id) == $village->village_id ? 'selected' : '' }}>
                                                    {{ $village->village_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Name of Irrigator -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="irrigator_name">Name Irrigator</label>
                                        <input class="form-control form-control-lg" type="text" id="irrigator_name" name="irrigator_name"
                                            value="{{ old('irrigator_name', $irrigator->irrigator_name) }}" required>
                                    </div>
                            
                                    <!-- Khata Number -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="irrigator_khata_number">Khata Number</label>
                                        <input class="form-control form-control-lg" type="text" id="irrigator_khata_number" name="irrigator_khata_number"
                                            value="{{ old('irrigator_khata_number', $irrigator->irrigator_khata_number) }}" required>
                                    </div>
                            
                                    <!-- Mobile Number -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="irrigator_mobile_number">Mobile Number</label>
                                        <input class="form-control form-control-lg" type="text" id="irrigator_mobile_number" name="irrigator_mobile_number"
                                            value="{{ old('irrigator_mobile_number', $irrigator->irrigator_mobile_number) }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <!-- Submit Button -->
                                    <div class="col-lg-12">
                                        <button class="btn btn-sm btn-primary rounded-pill" type="submit">
                                            <span><i class="fa fa-save"></i></span> Update Irrigator
                                        </button>
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



