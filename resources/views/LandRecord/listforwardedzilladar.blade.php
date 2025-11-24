@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>

  /* Main table settings */
  #example123 {
    width: 100% !important;
    table-layout: auto;
    word-wrap: break-word;
    font-size: 14px !important;
  }

  /* Main table cells */
  #example123 td,
  #example123 th {
    padding: 2px !important;
    margin: 2px !important;
    white-space: normal !important;
    font-size: 14px !important;
  }
  /* Nested table and its cells */
  #example123 table,
  #example123 table td,
  #example123 table th {
    font-size: 13px !important;
    padding: 2px !important;
    margin: 2px !important;
    white-space: normal !important;
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
    <div class="row">
      <div class="col-md-12">
      <div class="card export-database">
      <div class="card-header">
      <h3><strong>Survey List</strong></h3>
      <!-- <p>Halqa ID: {{ session('halqa_id') }}</p> -->
      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table id="example123" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead class="table-primary text-center align-middle">
        <tr>
            <th class="text-center text-light">ID</th>
            <th class="text-center text-light">Irrigator Name</th>
            <th class="text-center text-light">Khata #</th>
            <th class="text-center text-light">Crop Surveys</th>
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
                                <th class="text-center text-light">Village</th>
                                <th class="text-center text-light">Cultivator</th>
                                <th class="text-center text-light">Crop</th>
                                <th class="text-center text-light">Rate</th>
                                <th class="text-center text-light">Date</th>
                               <!-- <th>Length</th>
                                <th>Width</th> -->
                                <th class="text-center text-light">Marla</th>
                                <th class="text-center text-light">Kanal</th>
                               
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
                                  <!--  <td>{{ $survey->length }}</td>
                                    <td>{{ $survey->width }}</td> -->
                                    <td>{{ $survey->area_marla }}</td>
                                    <td>{{ $survey->area_kanal }}</td>
                                  
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