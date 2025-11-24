@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
    #example123 th{
        padding: 4px !important;
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
      <h3><strong>View & Print Bills</strong></h3>
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
            <th class="text-center text-light">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grouped_survey_bill_eligible as $irrigator_id => $irrigator_surveys)
            <tr>
                <td class="text-center align-middle">{{ $irrigator_surveys->first()->irrigator_id }}</td>
                <td class="text-center align-middle"><strong>{{ $irrigator_surveys->first()->irrigator_name }}</strong></td>
                <td class="text-center align-middle"><strong>{{ $irrigator_surveys->first()->irrigator_khata_number }}</strong></td>
                <td class="text-center align-middle"><a href="{{url('survey_bill/view')}}/{{$irrigator_surveys->first()->irrigator_id}}"><button class="btn btn-primary btn-sm" type="submit" title="Bill">
                <i class="side-menu__icon fas fa-print"></i>Print Bill</button></a>
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