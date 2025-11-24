@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
  /* Main table settings */
  #example123 {
    width: 100% !important;
    table-layout: auto;
    word-wrap: break-word;
    font-size: 13px !important;
  }

  /* Main table cells */
  #example123 td,
  #example123 th {
    padding: 2px !important;
    margin: 2px !important;
    white-space: normal !important;
    font-size: 13px !important;
  }
  /* Nested table and its cells */
  #example123 table,
  #example123 table td,
  #example123 table th {
    font-size: 12px !important;
    padding: 2px !important;
    margin: 2px !important;
    white-space: normal !important;
  }

  /* Fix width for "Action" column in nested table */
  #example123 table th:last-child,
  #example123 table td:last-child {
    width: 200px !important;
    max-width: 200px !important;
    white-space: nowrap !important;
  }
  #example123 th{
   background-color: #5cd17b;
  }
  #example123 table th{
   background-color: #5cd17b;
  }
</style>
</head>
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
    <div class="row">
      <div class="col-md-12">
      <div class="card export-database">
      <div class="card-header">
      <h3><strong>Survey List</strong></h3>
      <!-- <p>Halqa ID: {{ session('halqa_id') }}</p> -->
      </div>
      <div class="card-body">
        <div class="button-container">
         <button id="check-all" class="btn btn-primary btn-sm"><strong>Check All</strong></button>
         <button id="forward-selected" class="btn btn-primary btn-sm" style="display: none;"><i class="fa fa-arrow-right"></i><strong> Forward All</strong></button>
        </div>
      <div class="table-responsive">
      <table id="example123" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead class="table-primary text-center align-middle">
        <tr>
            {{-- <th>ID</th> --}}
            <th class="text-center text-light">Irrigator Name</th>
            <th class="text-center text-light">Khata #</th>
            <th class="text-center text-light">Crop Surveys</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grouped_survey as $irrigator_id => $irrigator_surveys)
            <tr>
                {{-- <td class="text-center align-middle">{{ $irrigator_surveys->first()->irrigator_id }}</td> --}}
                <td class="text-center align-middle"><strong>{{ $irrigator_surveys->first()->irrigator_name }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $irrigator_surveys->first()->irrigator_khata_number }}</strong></td>
                <td>
                    {{-- Sub-table for crop surveys --}}
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center text-light">Village</th>
                           {{-- <th>Farmer</th> --}}
                                <th class="text-center text-light">Crop</th>
                                <th class="text-center text-light">Rate</th>
                                <th class="text-center text-light">Date</th>
                                {{-- <th>Length</th> --}}
                                {{-- <th>Width</th> --}}
                                <th class="text-center text-light">Marla</th>
                                <th class="text-center text-light">Kanal</th> 
                                <th class="text-center text-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irrigator_surveys as $survey)
                                <tr>
                                    <td class="text-center align-middle">
                                         <input type="checkbox"
                                         class="survey-checkbox"
                                         value="{{ $survey->crop_survey_id }}">
                                     </td>
                                    <td>{{ $survey->village_name }}</td>
                                    {{-- <td>{{ $survey->cultivators_info }}</td> --}}
                                    <td>{{ $survey->final_crop }}</td>
                                    <td>{{ $survey->crop_price }}</td>
                                    <td>{{ $survey->date }}</td>
                                    {{-- <td>{{ $survey->length }}</td>
                                    <td>{{ $survey->width }}</td> --}}
                                    <td>{{ $survey->area_marla }}</td>
                                    <td>{{ $survey->area_kanal }}</td>
                                    <td class="align-middle text-center">
                                        <a href="{{ url('survey/view') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye"></i>&nbsp;</button>
                                        </a>
                                        <a href="{{ url('survey/reverse/') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-primary btn-sm" title="Reverse Survey"><i class="fa fa-arrow-left"></i>&nbsp;</button>
                                        </a>
                                        <a href="{{ url('survey/forward') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-primary btn-sm" title="Forward Survey"><i class="fa fa-arrow-right"></i>&nbsp;</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
      </div>
      </div>
      </div>
      </div>
    </div> 
</section>  
</div>
<script>
$(document).ready(function () {
    $('#example123').DataTable({
        pageLength: 100,
        lengthMenu: [ [100, 250, 500, -1], [100, 250, 500, "All"] ],
        ordering: false
    });
});
</script>   
 @endsection
 <script>
document.addEventListener('DOMContentLoaded', function () {
    const checkAllButton = document.getElementById('check-all');
    const approveSelectedButton = document.getElementById('forward-selected');
    
    function getAllCheckboxes() {
        return Array.from(document.querySelectorAll('.survey-checkbox'));
    }

    function getEnabledCheckboxes() {
        return getAllCheckboxes().filter(checkbox => !checkbox.disabled);
    }

    checkAllButton.addEventListener('click', function () {
        const enabledCheckboxes = getEnabledCheckboxes();
        const allChecked = enabledCheckboxes.every(checkbox => checkbox.checked);

        enabledCheckboxes.forEach(checkbox => checkbox.checked = !allChecked);

        checkAllButton.textContent = allChecked ? 'Check All' : 'Uncheck All';
        toggleApproveButton();
    });

    getAllCheckboxes().forEach(checkbox => {
        checkbox.addEventListener('change', toggleApproveButton);
    });

    function toggleApproveButton() {
        const anyChecked = getEnabledCheckboxes().some(checkbox => checkbox.checked);
        approveSelectedButton.style.display = anyChecked ? 'inline-block' : 'none';
    }

    approveSelectedButton.addEventListener('click', function () {
        const selectedIrrigators = getEnabledCheckboxes()
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        if (selectedIrrigators.length === 0) {
            Swal.fire('Error', 'No Survey selected!', 'error');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to forward the selected surveys!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Forward',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('survey_forward_zilladar.multiple') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ irrigator_ids: selectedIrrigators })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Success', data.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                });
            }
        });
    });
});

</script>