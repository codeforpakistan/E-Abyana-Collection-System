@extends('layout')

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>



    <div class="app-content">

        <section class="section">

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "{{ session('error') }}",
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            <!--page-header open-->
          

                




            <section class="section">
                <!--page-header closed-->
        
                <!--row open-->
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="font-weight-bold">Edit Crop</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('cropprice.update', $cropprice->id) }}" method="POST">
                                @csrf
                            
                                <!-- Final Crop -->
                                <div class="row">
                                <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold">Crop</label>
                                        <input class="form-control" type="text" name="final_crop" value="{{ $cropprice->final_crop }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label font-weight-bold">Crop Type</label>
                                    <select class="form-control" name="crop_type" required id="crop_type">
                                        <option value="{{ $cropprice->crop_type }}">{{ $cropprice->crop_type }}</option>
                                         <option value="Cash Crop">Cash Crop</option>
                                          <option value="Non-Cash Crop">Non-Cash Crop</option>
                                    </select>
                                </div>
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
              
                
            </section>





 
@endsection




























              


 
 







