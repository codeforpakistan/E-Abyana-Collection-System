@extends('layout')

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    </head>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add Irrigator</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="add-irrigator-form" action="{{ url('AddIrragtor/add') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="row">
                    @if (session('halqa_id') <= 0)
                        <div class="form-group col-lg-6">
                            <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                             <!-- .select_search  - class for dropdown searching in div_id-->
                            <select name="div_id" id="div_id" class="form-control" required>
                                <option value="">Choose Division / ڈویژن</option>
                                @foreach($divsions as $divsion)
                                    <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label  class="form-label font-weight-bold" for="canal_id">Select Canal / نہر</label>
                            <select name="canal_id" id="canal_id" class="form-control" >
                                <option value="">Choose Canal / نہر</option>
                                @foreach($canals as $canal)
                                    <option value="{{ $canal->id }}">{{ $canal->canal_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label font-weight-bold" for="district_id">Select
                                District / ضلع</label>
                            <select name="district_id" id="district_id" class="form-control"
                                onchange="get_tehsils(this)">
                                <option value="">Choose District / ضلع</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label font-weight-bold" for="tehsil_id">Select
                                Tehsil / تحصیل</label>
                            <select name="tehsil_id" id="tehsil_id" class="form-control"
                                onchange="get_halqa(this)">
                                <option value="">Choose Tehsil / تحصیل</option>
                                @foreach ($tehsils as $tehsil)
                                    <option value="{{ $tehsil->tehsil_id }}">{{ $tehsil->tehsil_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                        <label class="form-label font-weight-bold" for="halqa_id">Select Halqa / حلقہ</label>
                        <select name="halqa_id" id="halqa_id" class="form-control"
                                onchange="get_village(this)">
                                <option value="">Choose Halqa / حلقہ</option>
                                @foreach ($Halqas as $Halqa)
                                    <option value="{{ $Halqa->id }}">{{ $Halqa->halqa_name }}</option>
                                @endforeach
                        </select>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label font-weight-bold" for="village_id">Select
                                Village / گاؤں</label>
                            <select name="village_id" id="village_id" class="form-control">
                                <option value="">Choose Village / گاؤں</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->village_id }}">{{ $village->village_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group col-6">
                            <label class="form-label font-weight-bold" for="canal_id">Select Canal / نہر</label>
                            <select name="canal_id" id="canal_id" class="form-control" required>
                            <option value="">Choose Canal / نہر</option>
                            </select>
                        </div> --}}
                    @endif
                    @if (session('halqa_id') > 0)
                        <div class="form-group col-lg-6">
                            <label class="form-label font-weight-bold" for="halqa_id">Select Halqa /حلقہ</label>
                            <select name="halqa_id" id="halqa_id" class="form-control" readonly
                                onchange="get_village(this)">
                                <option value="">Choose Halqa /حلقہ</option>
                                @foreach ($Halqas as $Halqa)
                                    <option value="{{ $Halqa->id }}">{{ $Halqa->halqa_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label font-weight-bold" for="village_id">Select
                                Village / گاؤں</label>
                            <select name="village_id" id="village_id" class="form-control" required onchange="get_canals(this)">
                                <option value="">Choose Village / گاؤں</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->village_id }}">{{ $village->village_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                     
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label  class="form-label font-weight-bold" for="canal_id">Select Canal / نہر</label>
                                <select name="canal_id" id="canal_id" class="form-control " >
                                    <option value="">Choose Canal / نہر</option>
                                    @foreach($canals as $canal)
                                        <option value="{{ $canal->id }}">{{ $canal->canal_name }}</option>
                                    @endforeach
                                </select>
                                
                
                            </div>
                    
                    @endif
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Name Irrigator</label>
                        <input class="form-control" type="text" id="" name="irrigator_name" 
                        placeholder=" Enter Name Irrigator"
                            required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Khata Number</label>
                        <input class="form-control" type="number" id="" name="irrigator_khata_number"
                        placeholder=" Enter Khata Number"
                            required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Irrigator Father Name</label>
                        <input class="form-control" type="text" id="" name="irrigator_f_name"
                        placeholder=" Enter Khata Number"
                            required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Mobile Number</label>
                        <input class="form-control" type="text" id="irrigator_mobile_number"
                        placeholder=" Enter Mobile Number"
                            name="irrigator_mobile_number">
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Irrigator CNIC</label>
                        <input class="form-control" type="text" id="cnic"
                        placeholder=" Enter CNIC Number"
                            name="cnic">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
          <button type="button" id="submit-btn" class="btn btn-primary" onclick="submit_form()">+ Add Irrigator</button>
        </div>
       </form>
      </div>
    </div>
  </div> 
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

            {{-- <p>User ID: {{ session('halqa_id') }}</p> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card export-database">
 <div class="card-header d-flex justify-content-between">
    <h4><strong>Irrigators List</strong></h4>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </button>

</div> 
                        <div class="card-body p-1">
                        <div class="row border-bottom p-1">
                            <div class="col-12 mb-2">
                                <label>Select Village</label>
                                <select id="villageFilter" class="form-control">
                                    @foreach ($villages as $village)
                                        <option value="{{ $village->village_id }}">{{ $village->village_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="loader" style="display: none; text-align: center; font-weight: bold;">Loading...</div>
                            <div class="table-responsive mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
    </div>
@endsection
<script>
    function get_districts(element) {
        var divisionId = element.value;

        if (divisionId) {
            $.ajax({
                url: '/get-districts/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Choose District</option>');
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
            $('#district_id').empty();
            $('#district_id').append('<option value="">Choose District</option>');
        }
    }

    function get_canals(element) {
        var villageID = element.value;

        if (villageID) {
            $.ajax({
                url: '/get-canals/' + villageID,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#canal_id').empty();
                    $('#canal_id').append('<option value="">Choose Canal</option>');
                    $.each(data, function(key, value) {
                        $('#canal_id').append('<option value="' + value.id + '">' + value.canal_name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching districts:', error);
                }
            });
        } else {
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
    function submit_form() {
        const form = document.getElementById('add-irrigator-form');
        if (!form) {
            console.error('Form not found!');
            return;
        }

        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action');

        fetch(actionUrl, {
            method: 'POST',
            body: new URLSearchParams(formData),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })
        .then(async (response) => {
            const data = await response.json();

            if (!response.ok) {
                // Check for duplicate khata (422 error)
                if (response.status === 422 && data.error) {
                    throw new Error(data.error);  // Laravel sends 'error' for duplicate
                }

                // Other validation errors (like missing required fields)
                if (response.status === 422 && data.errors) {
                    // Combine all validation messages
                    const messages = Object.values(data.errors).flat().join('\n');
                    throw new Error(messages);
                }

                // General error
                throw new Error(data.error || 'Something went wrong. Please try again.');
            }

            // Success
            Swal.fire({
                icon: 'success',
                title: 'Irrigator Added!',
                text: data.success || 'Record saved successfully.',
                timer: 2000,
                showConfirmButton: false,
            });

            // Clear form fields
            ['irrigator_name', 'irrigator_khata_number', 'irrigator_f_name', 'irrigator_mobile_number'].forEach(name => {
                const input = document.querySelector(`[name="${name}"]`);
                if (input) input.value = '';
            });
        })
        .catch((error) => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Something went wrong.',
                confirmButtonText: 'OK',
            });
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#exampleModal').on('hidden.bs.modal', function () {
            console.log('Modal hidden event triggered');
            window.location.href = '{{ route("AddIrragtor") }}';
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
 let table = new DataTable('#example123', {
            pageLength: 100
        });

        $('#villageFilter').on('change', function () {
            let village_id = $(this).val();

            // Show loader and hide table
            $('#loader').show();
            $('#example123').hide();

            $.ajax({
                url: "{{ route('AddIrragtor') }}",
                type: "GET",
                data: { village_id: village_id },
                success: function (data) {
                    if ($.fn.DataTable.isDataTable('#example123')) {
                        $('#example123').DataTable().destroy();
                    }

                    $('.table-responsive').html(data);

                    new DataTable('#example123', {
                        pageLength: 100
                    });

                    // Hide loader and show new table
                    $('#loader').hide();
                    $('#example123').show();
                },
                error: function () {
                    $('#loader').hide();
                    alert('Failed to load irrigators.');
                }
            });
        });

        // Trigger change on page load
        $('#villageFilter').trigger('change');

        $('#div_id').change(function() {
            var div_id = $(this).val();

            if (div_id) {
                $.ajax({
                    url: "{{ route('getCanals') }}", // API route to fetch canals
                    type: "GET",
                    data: { div_id: div_id },
                    success: function(data) {
                        $('#canal_id').empty();
                        $('#canal_id').append('<option value="">Choose Canal</option>');
                        $.each(data, function(key, canal) {
                            $('#canal_id').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                        });
                    }
                });
            } else {
                $('#canal_id').empty();
                $('#canal_id').append('<option value="">Choose Canal</option>');
            }
        });
    });
</script>
