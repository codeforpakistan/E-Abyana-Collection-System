@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
</head>
@if(session('success'))
    @push('scripts')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endpush
@endif

@if(session('error'))
    @push('scripts')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endpush
@endif
    
    
<div class="app-content">
<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
  <div class="card shadow-sm w-[40vw]">
      <div class="card-header bg-primary flex justify-between text-white">
          <h4 class="font-weight-bold">Add Village</h4> <!-- Updated to reflect Employer data -->

          <button onclick="closeModal()" type="button"
              class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
              <i class="fa fa-close"></i></button>
      </div>
      <div class="card-body">
          <form class="form-horizontal" action="{{ url('AddVillage/add') }}" method="POST">
              @csrf
              <div class="row">
              <div class="form-group col-6">
                  <label class="form-label font-weight-bold" for="tehsil_id">Select Tehsil/تحصیل</label>
                  <select name="tehsil_id" id="tehsil_id" class="form-control" required>
                      <option value="" style="font-weight: bold;">Choose Tehsil</option>
                      @foreach($tehsils as $tehsil)
                          <option value="{{$tehsil->tehsil_id }}">{{$tehsil->tehsil_name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group col-6">
                  <label class="form-label font-weight-bold" for="halqa_id" style="">Select Halqa/حلقہ</label>
                  <select name="halqa_id" id="halqa_id" class="form-control" required>
                      <option value="" style="font-weight: bold;">Choose Halqa/حلقہ</option>
                      @foreach($Halqas as $Halqa)
                          <option value="{{$Halqa->id }}">{{$Halqa->halqa_name }}</option>
                      @endforeach
                  </select>
              </div>
              </div>
              
              
             
              <div class="row">
                  <div class="form-group col-lg-12">
                      <label class="form-label font-weight-bold">Village Name</label>
                      <input class="form-control" type="text" name="village_name" required>
                  </div>
                  
               
              </div>
              
              <div class="row">
                  <div class="col-lg-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
          </form>
    
      </div>
  </div>
</div>  
    <section class="section">



        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
 <div class="card-header d-flex justify-content-between">
    <h4><strong>Village List</strong></h4>
    <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter">
        <i class="fa fa-plus"></i> </button>
</div> 
                    <div class="card-body">
                        <div class="table-responsive">

                                
                                  <table id="example123" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            
                                            <th>#</th>
                                            <th>Village Name</th>
                                            <th>Tehsil Name</th>
                                            <th>District Name</th>
                                            <th>Division</th>
                                         

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($villages as $village)
                                        <tr>
                                           
                                            <td>{{ $village->village_id }}</td>
                                            <td>{{ $village->village_name }}</td>
                                            <td>{{ $village->tehsil_name }}</td>
                                            <td>{{ $village->district_name }}</td>
                                            <td>{{ $village->divsion_name }}</td>
                                            
                                     
                                            <td>
                                               <!-- <button class="btn btn-sm btn-primary" type="submit">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button> -->
                                                <a href="{{ route('village.edit', $village->village_id) }}">
                                                <button class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $villages->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function() {
 let table = new DataTable('#example123', {
            pageLength: 100
        }); 
  });
</script>            
 @endsection
 