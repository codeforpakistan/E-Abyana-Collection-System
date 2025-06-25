@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
@php
    $status = session('success') ? 'success' : (session('error') ? 'error' : null);
    $message = session('success') ?? session('error');
@endphp

@if($status && $message)
    @push('scripts')
        <script>
            Swal.fire({
                icon: '{{ $status }}',
                title: '{{ ucfirst($status) }}',
                text: "{{ $message }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endpush
@endif
<div class="app-content">
  
    <section class="section">
       


<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
    <div class="card shadow-sm w-[60vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Rate</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">
           
 <form class="form-horizontal" action="{{ url('Addrates/add') }}" method="POST">
    @csrf
     <div class="row">
        <div class="form-group col-4">
            <label class="form-label font-weight-bold">Crop Type</label>
            <select class="form-control" name="crop_type" required id="crop_type">
                <option>Choose Crop Type</option>
                 <option value="Cash Crop">Cash Crop</option>
                  <option value="Non-Cash Crop">Non-Cash Crop</option>
            </select>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">Flow</label>
            <input type="number" step="0.1"class="form-control" name="flow" required>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">LIS</label>
            <input type="number" step="0.1"class="form-control" name="LIS" required>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">T/Well</label>
            <input type="number" step="0.1"class="form-control" name="t_well" required>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">Jhallar</label>
            <input type="number" step="0.1"class="form-control" name="jhallar" required>
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

<div class="row">
            <div class="col-md-12">
                <div class="card export-database">
 <div class="card-header d-flex justify-content-between">
    <h4><strong>Rate List</strong></h4>
    <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter">
        <i class="fa fa-plus"></i> </button>
</div> 
                    <div class="card-body">
                        <div class="table-responsive">
                                
<table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead>
        <tr>
            <th rowspan="2">S.No</th>
            <th rowspan="2">Crop Type</th>
            <th colspan="4" class="text-center">Water Type</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>Flow</th>
            <th>LIS</th>
            <th>T/Well</th>
            <th>Jhallar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($PriceRevenue as $pricerevenue)
        <tr>
            <td>{{ $pricerevenue->id }}</td>
            <td>{{ $pricerevenue->crop_type }}</td>
            <td>{{ $pricerevenue->flow }}</td>
            <td>{{ $pricerevenue->LIS }}</td>
            <td>{{ $pricerevenue->t_well }}</td>
            <td>{{ $pricerevenue->jhallar }}</td>
            <td><a href="{{ route('rates.edit', $pricerevenue->id) }}" class="btn btn-sm btn-primary">
            <i class="fa fa-edit"></i> Edit</a>
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



