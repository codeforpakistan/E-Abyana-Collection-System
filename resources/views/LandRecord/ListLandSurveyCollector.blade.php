@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #example th{
        padding: 4px !important;
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
      <div class="table-responsive">
      <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead class="table-primary text-center align-middle">
        <tr>
            <th>ID</th>
            <th>Irrigator Name</th>
            <th>Khata #</th>
            <th>Crop Surveys</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grouped_survey as $irrigator_id => $irrigator_surveys)
            <tr>
                <td class="text-center align-middle">{{ $irrigator_surveys->first()->irrigator_id }}</td>
                <td class="text-center align-middle"><strong>{{ $irrigator_surveys->first()->irrigator_name }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $irrigator_surveys->first()->irrigator_khata_number }}</strong></td>
                <td>
                    {{-- Sub-table for crop surveys --}}
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Village</th>
                                <th>Farmer</th>
                                <th>Crop</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>Length</th>
                                <th>Width</th>
                                <th>Marla</th>
                                <th>Kanal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irrigator_surveys as $survey)
                                <tr>
                                    <td>{{ $survey->village_name }}</td>
                                    <td>{{ $survey->cultivators_info }}</td>
                                    <td>{{ $survey->final_crop }}</td>
                                    <td>{{ $survey->crop_price }}</td>
                                    <td>{{ $survey->date }}</td>
                                    <td>{{ $survey->length }}</td>
                                    <td>{{ $survey->width }}</td>
                                    <td>{{ $survey->area_marla }}</td>
                                    <td>{{ $survey->area_kanal }}</td>
                                    <td class="align-middle text-center">
                                        <a href="{{ url('survey/view') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="{{ url('survey/collector/reverse') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-danger btn-sm" title="Reverse Survey"><i class="fa fa-arrow-left"></i></button>
                                        </a>
                                        <a href="{{ url('survey/collector/forward') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-success btn-sm" title="Forward Survey"><i class="fa fa-arrow-right"></i></button>
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
     <!-- <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
        <thead class="table-primary text-center align-middle">
            <tr>
                <th rowspan="3" class="align-middle">ID</th>
                <th rowspan="3" class="align-middle">Name</th>
                <th rowspan="3" class="align-middle">Khata No</th>
                <th colspan="3" class="align-middle">Crop Type Registration</th>
                <th rowspan="3" class="align-middle">Sowing Date</th>
                <th colspan="3" class="align-middle">Final Measurement</th>
                <th colspan="2" class="align-middle">Area</th>
                <th rowspan="3" class="align-middle">Action</th>
            </tr>
            <tr>
                <th colspan="2" class="align-middle">Land Assessment</th>
                <th rowspan="2" class="align-middle">Previous Crop Name</th>
                <th rowspan="2" class="align-middle">Date</th>
                <th rowspan="2" class="align-middle">Length</th>
                <th rowspan="2" class="align-middle">Width</th>
                <th rowspan="2" class="align-middle">Marla</th>
                <th rowspan="2" class="align-middle">Kanal</th>
            </tr>
            <tr>
                <th class="align-middle">Marla</th>
                <th class="align-middle">Kanal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="align-middle">1</td>
                <td class="align-middle">John Doe</td>
                <td class="align-middle">123456</td>
                <td class="align-middle">10</td>
                <td class="align-middle">2</td>
                <td class="align-middle">Wheat</td>
                <td class="align-middle">2024-01-01</td>
                <td class="align-middle">2024-06-01</td>
                <td class="align-middle">20</td>
                <td class="align-middle">10</td>
                <td class="align-middle">3</td>
                <td class="align-middle">1</td>
                <td class="align-middle">Edit/Delete</td>
            </tr>
        </tbody>
    </table> -->

      </div>
      </div>
      </div>
      </div>
    </div> 
</section>  
</div>    
 @endsection