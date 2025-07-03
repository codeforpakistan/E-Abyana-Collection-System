@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #example th{
        padding: 4px !important;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
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
      <div class="card-body">
      <div class="table-responsive">
        <div class="button-container">
         <button id="check-all" class="btn btn-warning btn-sm"><strong>Check All</strong></button>
         <button id="forward-selected" class="btn btn-success btn-sm" style="display: none;"><i class="fa fa-arrow-right"></i><strong> Forward All</strong></button>
        </div>
      <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead class="table-primary text-center align-middle">
        <tr>
            {{-- <th>ID</th> --}}
            <th>Irrigator Name</th>
            <th>Khata #</th>
            <th>Crop Surveys</th>
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
                                <th></th>
                                <th>Village</th>
                                <th>Session</th>
                                <th>Crop</th>
                                <th>Rate</th>
                                <th>Date</th>
                               {{-- <th>Length</th>
                                <th>Width</th>
                                <th>Marla</th>
                                <th>Kanal</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irrigator_surveys as $survey)
                            @php
                                $invalid = is_null($survey->date) || $survey->area_kanal <= 0;
                            @endphp

                          <tr @if($invalid) style="background-color: #FFFFE0;" @endif>
                                     <td class="text-center align-middle">
                                         <input type="checkbox" class="survey-checkbox" value="{{ $survey->crop_survey_id }}">
                                     </td>
                                    <td>{{ $survey->village_name }}</td>
                                    <td>{{ $survey->crop_name }}</td>
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
    document.addEventListener('DOMContentLoaded', function () {
        const checkAllButton = document.getElementById('check-all');
        const approveSelectedButton = document.getElementById('forward-selected');
        const checkboxes = document.querySelectorAll('.survey-checkbox');

        checkAllButton.addEventListener('click', function () {
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
            checkAllButton.textContent = allChecked ? 'Check All' : 'Uncheck All';
            toggleApproveButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleApproveButton);
        });

        function toggleApproveButton() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            approveSelectedButton.style.display = anyChecked ? 'inline-block' : 'none';
        }

        approveSelectedButton.addEventListener('click', function () {
            const selectedIrrigators = Array.from(checkboxes)
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