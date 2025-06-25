@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
 
<div class="app-content">
  
    <section class="section">
       


<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
    <div class="card shadow-sm w-[60vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Crop & Price</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">
           
 <form class="form-horizontal" action="{{ url('Addprice/add') }}" method="POST">
    @csrf
     <div class="row">
        <div class="form-group col-6">
            <label class="form-label font-weight-bold">Crop Name</label>
            <input class="form-control" type="text" name="final_crop" required>
        </div>
        <div class="form-group col-6">
            <label class="form-label font-weight-bold">Crop Type</label>
            <select class="form-control" name="crop_type" required id="crop_type">
                <option>Choose Crop Type</option>
                 <option value="Cash Crop">Cash Crop</option>
                  <option value="Non-Cash Crop">Non-Cash Crop</option>
            </select>
        </div>
    </div>
    <!-- Submit Button -->
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
    <h4><strong>Crop List</strong></h4>
    <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter">
        <i class="fa fa-plus"></i> </button>
</div> 
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <!--<th><input type="checkbox" id="select-all"></th> -->
                                            <th>ID</th>
                                            <th>Crop Name</th>
                                            <th>Crop Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Cropprice as $cropprice)
                                        <tr>
                                           <!-- <td><input type="checkbox" name="ids[]" value=""></td> -->
                                            <td>{{ $cropprice->id }}</td>
                                            <td>{{ $cropprice->final_crop }}</td>
                                            <td>{{ $cropprice->crop_type }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('cropprice.edit', $cropprice->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                
                        
                                                <!-- Delete Button -->
                                                <button class="btn btn-sm btn-primary" type="submit">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
</div>
    </section>
</div>
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

              
 @endsection



