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
                    <h4 class="page-title font-weight-bold">Edit User</h4>
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
                            <h4 class="font-weight-bold">Edit User</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('update.user', $user->id) }}" method="POST">

                                @csrf
                                @method('PUT')
                                
                                <div class="form-group row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Password" name="password">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number" value="{{ $user->phone_number }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label font-weight-bold">Select Role</label>
                                        <select name="role_id" id="role_id" class="form-control" required onchange="toggleDropdowns()">
                                            <option value="">Choose Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                            
                                <div class="row">
                                    <div id="div_district" class="form-group col-lg-4">
                                        <label class="form-label font-weight-bold" for="district_id">Select District</label>
                                        <select name="district_id" id="district_id" class="form-control" onchange="get_tehsils(this)">
                                            <option value="">Choose District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" {{ $user->district_id == $district->id ? 'selected' : '' }}>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div id="div_tehsil" class="form-group col-lg-4">
                                        <label class="form-label font-weight-bold" for="tehsil_id">Select Tehsil</label>
                                        <select name="tehsil_id" id="tehsil_id" class="form-control" onchange="get_halqa(this)">
                                            <option value="">Choose Tehsil</option>
                                            @foreach($tehsils as $tehsil)
                                                <option value="{{ $tehsil->tehsil_id }}" {{ $user->tehsil_id == $tehsil->tehsil_id ? 'selected' : '' }}>
                                                    {{ $tehsil->tehsil_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div id="div_halqa" class="form-group col-lg-4">
                                        <label class="form-label font-weight-bold" for="halqa_id">Select Halqa</label>
                                        <select name="halqa_id" id="halqa_id" class="form-control" required>
                                            <option value="">Choose Halqa</option>
                                            @foreach($Halqas as $halqa)
                                                <option value="{{ $halqa->id }}" {{ $user->halqa_id == $halqa->id ? 'selected' : '' }}>
                                                    {{ $halqa->halqa_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div id="div_division" class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Select Division</label>
                                        <select name="div_id" id="div_id" class="form-control">
                                            <option value="">Choose Division</option>
                                            @foreach($divsions as $divsion)
                                                <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                            @endforeach
                                        </select>
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


<script>
   function getRoleIdFromUrl() {
    const params = new URLSearchParams(window.location.search);
    return params.get("role_id");
}

$(document).ready(function () {
    let roleId = getRoleIdFromUrl(); 

    if (roleId) {
        $("#role_id").val(roleId).change();
        toggleDropdowns(roleId);
    }

    $("#role_id").change(function () {
        toggleDropdowns($(this).val());
    });
});

function toggleDropdowns(roleId) {
    var selectedRoleName = $("#role_id option[value='" + roleId + "']").text().trim().toLowerCase();

    console.log("Selected Role:", selectedRoleName);

    $("#div_division, #div_district, #div_tehsil, #div_halqa").hide();

    if (selectedRoleName === "patwari") {
        $("#div_district, #div_tehsil, #div_halqa").show();
    } else if (selectedRoleName === "zilladar" || selectedRoleName === "collector") { 
        $("#div_district").show();
    } else if (selectedRoleName === "xen") {
        $("#div_division").show();
    }
}

</script>



