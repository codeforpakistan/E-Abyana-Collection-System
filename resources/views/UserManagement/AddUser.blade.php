@extends('layout')
@section('content')
<head>
    ...
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectra@1.0.12/dist/selectra.min.css">

<style>
/* Force Selectra to use Bootstrap full-width form-control style */
#halqa_zilladar .selectra-container {
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    flex: 1 1 auto !important;
    box-sizing: border-box !important;
    font-size: 1rem;
}

/* Selection box (the visible input) */
#halqa_zilladar .selectra-selection {
    width: 100% !important;
    display: block !important;
    border: 1px solid #ced4da !important;
    border-radius: .25rem !important;
    padding: .375rem .75rem !important;
    min-height: calc(1.5em + .75rem + 2px) !important;
    line-height: 1.5 !important;
    background-color: #fff !important;
    font-size: 1rem !important;
}

/* Selected tags */
#halqa_zilladar .selectra-tags {
    width: 100% !important;
    display: flex;
    flex-wrap: wrap;
    gap: .25rem;
}
#halqa_zilladar .selectra-tag {
    background-color: #007bff !important;
    color: #fff !important;
    border-radius: .2rem !important;
    padding: 0 .4rem !important;
    font-size: .875rem !important;
}

/* Dropdown search box */
.selectra-dropdown .selectra-search {
    width: 100% !important;
    border: 1px solid #ced4da !important;
    border-radius: .25rem !important;
    padding: .375rem .75rem !important;
    box-sizing: border-box !important;
}

/* Dropdown panel width aligned with input */
.selectra-dropdown {
    width: 100% !important;
    box-sizing: border-box !important;
}
</style>



</head>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add Irrigator</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                    <form class="form-horizontal" action="{{ url('AddUser/add') }}" method="POST">
                @csrf
                
                <!-- First Row (Name and Email) -->
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                    </div>
                </div>
            
                <!-- Second Row (Password, Phone Number, Role) -->
                <div class="form-group row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Select Role</label>
                        <select name="role_id" id="role_id" class="form-control" required onchange="toggleDropdowns()">
                            <option value="">Choose Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <!-- Third Row (Division and District) -->
                <div class="form-group row">
                    <div id="div_division" class="col-lg-6">
                        <label class="form-label font-weight-bold">Select Division / ڈویژن</label>
                        <select name="div_id" id="div_id" class="form-control" onchange="get_districts(this)">
                            <option value="">Choose Division</option>
                            @foreach($divsions as $division)
                                <option value="{{ $division->id }}">{{ $division->divsion_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div id="div_district" class="col-lg-6">
                        <label class="form-label font-weight-bold">Select District / ضلع</label>
                        <select name="district_id" id="district_id" class="form-control" onchange="get_tehsils(this)">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div id="div_tehsil" class="col-lg-6">
                        <label class="form-label font-weight-bold">Select Tehsil / تحصیل</label>
                        <select name="tehsil_id" id="tehsil_id" class="form-control" onchange="get_halqa(this)">
                        </select>
                    </div>
                    
                    <div id="div_halqa" class="col-lg-6">
                        <label class="form-label font-weight-bold">Select Halqa / حلقہ</label>
                        <select name="halqa_id" id="halqa_id" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                <div id="halqa_zilladar" class="col-12">
                        <label class="form-label font-weight-bold">Select Halqa / حلقہ</label>
                       <select id="halqa_multiple" 
                       class="form-control halqa_multiple" 
                       name="halqa_multiple[]" 
                       multiple="multiple">
                           <option value="">Choose Halqa's</option>
                           @foreach($Halqas as $Halqa)
                               <option value="{{ $Halqa->id }}">{{ $Halqa->halqa_name }}</option>
                           @endforeach
                       </select>
                </div>
                </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
       </form>
      </div>
    </div>
  </div>

<!--*********************************************************************** -->
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

        <!--row open-->      
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
 <div class="card-header d-flex justify-content-between">
    <h4><strong>System Users List</strong></h4>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
    </button>
</div>
                    <div class="card-body">
                        <div class="table-responsive">
                                
                                <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                             <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th>Contact</th>
                                           <!-- <th>User Password</th> -->
                                            <th>Role</th>
                                            <th class="text-center">Action</th>
                                            
                                        </tr>
                                    </thead>
                                         
                                <ul>
                                    @foreach($usersWithRoles as $usersWithRole)
                                    <tr>
                                        <td>{{ $usersWithRole->id }}</td>
                                          <td>{{ $usersWithRole->user_name }}</td>

                                            <td>{{ $usersWithRole->email }}</td>
                                             <td>{{ $usersWithRole->phone_number }}</td>
                                                 <td>{{ $usersWithRole->role_name ?? 'No role assigned' }}</td>
                                              <td>
                                                <form
                                                action="{{ route('AddUser.destroy', $usersWithRole->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                            <a href="{{ route('edit.user', $usersWithRole->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Edit</a> 
                                              </td>
                                                  
                                    </tr>
                                @endforeach
                        
                                              </ul>
                                        

                                </tbody>
                                </table>
                                <div class="row align-items-center mt-3">
                                 <div class="col-md-6 text-left">
                                     <p class="mb-0 text-muted">
                                         Showing {{ $usersWithRoles->firstItem() }} to {{ $usersWithRoles->lastItem() }} of {{ $usersWithRoles->total() }} results
                                     </p>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="d-flex justify-content-end">
                                     {{ $usersWithRoles->links('pagination::bootstrap-4') }}
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </section>

    @if(Session::has('success'))
        <script>
            swal({
                title: "Success!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                button: "OK",
            });
            
        </script>
    @endif

<script>
function get_districts(element) {
    var divisionId = element.value;
    var districtSelect = document.getElementById('district_id');

    // Reset district dropdown
    districtSelect.innerHTML = '<option value="">Choose District</option>';

    if (divisionId) {
        fetch('/get-districts/' + divisionId)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(function(district) {
                        var option = document.createElement('option');
                        option.value = district.id;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });
                } else {
                    districtSelect.innerHTML = '<option value="">No Districts Found</option>';
                }
            })
            .catch(error => {
                console.error('Error fetching districts:', error);
                districtSelect.innerHTML = '<option value="">Error loading districts</option>';
            });
    } else {
        districtSelect.innerHTML = '<option value="">No Data Available</option>';
    }
}
function get_tehsils(element) {
    var districtId = element.value; 
    console.log(districtId);

    if (districtId) {
        $.ajax({
            url: '/get-tehsils/' + districtId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#tehsil_id').empty();
                $('#tehsil_id').append('<option value="">Choose Tehsil</option>');
                $.each(data, function (key, value) {
                    $('#tehsil_id').append('<option value="' + value.tehsil_id + '">' + value.tehsil_name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching tehsils:', error);
            }
        });
    } else {
        $('#tehsil_id').empty();
        $('#tehsil_id').append('<option value="">No Data Available</option>');
    }
}
function get_halqa(element) {
    const tehsilId = element.value;

    const halqaSelect = document.getElementById("halqa_id");
    const halqaMultiple = document.getElementById("halqa_multiple");

    // Clear both selects
    halqaSelect.innerHTML = "";
    halqaMultiple.innerHTML = "";

    if (tehsilId) {
        fetch(`/halqa_for_users/${tehsilId}`)
            .then(response => response.json())
            .then(data => {
                // Add default options
                halqaSelect.innerHTML = '<option value="">Choose Halqa</option>';
                halqaMultiple.innerHTML = '<option value="">Choose Halqa\'s</option>';

                // Append new options
                data.forEach(halqa => {
                    const opt1 = document.createElement("option");
                    opt1.value = halqa.id;
                    opt1.textContent = halqa.halqa_name;
                    halqaSelect.appendChild(opt1);

                    const opt2 = document.createElement("option");
                    opt2.value = halqa.id;
                    opt2.textContent = halqa.halqa_name;
                    halqaMultiple.appendChild(opt2);
                });
            })
            .catch(error => {
                console.error("Error fetching halqas:", error);
                halqaSelect.innerHTML = '<option value="">Error loading data</option>';
                halqaMultiple.innerHTML = '<option value="">Error loading data</option>';
            });
    } else {
        halqaSelect.innerHTML = '<option value="">No Data Available</option>';
        halqaMultiple.innerHTML = '<option value="">No Data Available</option>';
    }
}
    </script>
</div>             
 @endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    function toggleDropdowns() {
        var role = $("#role_id option:selected").text().toLowerCase();
        $("#div_division, #div_district, #div_tehsil, #div_halqa,#halqa_zilladar").hide();
        if (role === "patwari") {
            $("#div_division,#div_district, #div_tehsil, #div_halqa").show();
        } else if (role === "zilladar") {
            $("#div_division,#div_district,#div_tehsil,#halqa_zilladar").show();
        }else if(role === "deputy collector"){
            $("#div_division,#div_district").show();
        } else if (role === "xen") {
            $("#div_division").show();
        }
    }

$(document).ready(function () {
    toggleDropdowns();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/selectra@1.0.12/dist/selectra.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const halqaSelect = new Selectra('#halqa_multiple', {
        search: true,
        langInputPlaceholder: 'Search Halqas...',
        langEmptyValuePlaceholder: "Choose Halqa's"
    });
    halqaSelect.init();

    // Ensure full width when modal opens
    $('#exampleModal').on('shown.bs.modal', function () {
        $('#halqa_zilladar .selectra-container, #halqa_zilladar .selectra-selection').css({
            "width": "100%",
            "max-width": "100%"
        });
        $('.selectra-dropdown').css({
            "width": "100%"
        });
    });
});
</script>

