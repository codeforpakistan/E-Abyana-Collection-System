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
                                <th>Village</th>
                           {{-- <th>Farmer</th> --}}
                                <th>Crop</th>
                                <th>Rate</th>
                                <th>Date</th>
                                {{-- <th>Length</th> --}}
                                {{-- <th>Width</th> --}}
                                <th>Marla</th>
                                <th>Kanal</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($irrigator_surveys as $survey)
                                <tr>
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
                                            <button class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="{{ url('survey/reverse/') }}/{{$survey->crop_survey_id}}">
                                            <button class="btn btn-danger btn-sm" title="Reverse Survey"><i class="fa fa-arrow-left"></i></button>
                                        </a>
                                        <a href="{{ url('survey/forward') }}/{{$survey->crop_survey_id}}">
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
      </div>
      </div>
      </div>
      </div>
    </div> 
</section>  
</div>    
 @endsection