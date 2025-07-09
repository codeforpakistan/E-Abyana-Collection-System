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
   background-color: rgba(72, 128, 255, 0.5);
  }
  #example123 table th{
   background-color: rgba(72, 128, 255, 0.5);
  }
</style>
</head>
<div class="app-content">
    <section class="section">
    <div class="row">
      <div class="col-md-12">
      <div class="card export-database">
      <div class="card-header">
      <h3><strong>Land Survey List</strong></h3>
      <!-- <p>Halqa ID: {{ session('halqa_id') }}</p> -->
      </div>
      <div class="card-body p-2">
        <div class="button-container">
         <button id="check-all" class="btn btn-warning btn-sm"><strong>Check All</strong></button>
         <button id="forward-selected" class="btn btn-success btn-sm" style="display: none;"><i class="fa fa-arrow-right"></i><strong> Forward All</strong></button>
        </div>
         <div class="table-responsive">
      <table id="example123" class="table table-bordered border-t0 key-buttons w-100">
    <thead class="table-primary text-center align-middle">
        <tr>
            {{-- <th>ID</th> --}}
            <th class="text-center">Irrigator Name</th>
            <th class="text-center">Khata #</th>
            <th class="text-center">Crop Surveys</th>
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
                                <th class="text-center">Village</th>
                                <th class="text-center">Session</th>
                                <th class="text-center">Crop</th>
                                <th class="text-center">Rate</th>
                                <th class="text-center">Date</th>
                               {{-- <th>Length</th>
                                <th>Width</th>
                                <th>Marla</th>
                                <th>Kanal</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irrigator_surveys as $survey)
                            @php
                                $invalid = is_null($survey->date) || $survey->area_kanal <= 0;
                            @endphp

                          <tr @if($invalid) style="background-color: #FFFFE0;" @endif>
                                     <td class="text-center align-middle">
                                         <input type="checkbox"
                                         class="survey-checkbox"
                                         value="{{ $survey->crop_survey_id }}"
                                         @if($invalid) disabled title="Cannot forward: Invalid survey data" @endif>
                                     </td>
                                    <td>{{ $survey->village_name }}</td>
                                    <td>{{ $survey->crop_name }} ({{$survey->session_date}})</td>
                                    <td>{{ $survey->final_crop }}</td>
                                    <td>{{ $survey->crop_price }}</td>
                                    <td>{{ $survey->date }}</td>
                                    {{--<td>
                          
                                        <strong>{{ $survey->water_source_type }}</strong><br>
                                        @if ($survey->canal_name) Canal: {{ $survey->canal_name }}<br> @endif
                                        @if ($survey->minor_name) Minor: {{ $survey->minor_name }}<br> @endif
                                        @if ($survey->distributary_name) Distributary: {{ $survey->distributary_name }} @endif
                                    </td> --}}
                                    <td class="align-middle text-center">
                                        <a href="{{ url('survey/view') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></button>
                                        </a>
                                        
                                        <form action="{{ route('landservey.destroy', $survey->crop_survey_id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                                        </form>
                        
                                        <a href="{{ $invalid ? '#' : url('survey/patwari/forward') . '/' . $survey->crop_survey_id }}">
                                            <button class="btn btn-warning btn-sm 
                                                           @if($invalid) disabled opacity-50 @endif"
                                                    title="{{ $invalid ? 'Disabled' : 'Forward' }}"
                                                    @if($invalid) disabled @endif>
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </a>
                        
                                        <a href="{{ route('edit.survey', $survey->crop_survey_id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Edit
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
                fetch("{{ route('survey_forward.multiple') }}", {
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
 @endsection