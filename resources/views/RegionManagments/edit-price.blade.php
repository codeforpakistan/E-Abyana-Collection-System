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
                <!--page-header open-->
                <div class="page-header pt-0">
                    <h4 class="page-title font-weight-bold">Edit price</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-light-color"></a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </div>
                <!--page-header closed-->
        
                <!--row open-->
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="margin-top: 80px;">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="font-weight-bold">Edit price</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('cropprice.update', $cropprice->id) }}" method="POST">
                                @csrf
                                
                                <!-- Crop Price -->
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold">Crop Price</label>
                                        <input class="form-control form-control-lg" type="text" name="crop_price" value="{{ $cropprice->crop_price }}" required>
                                    </div>
                                </div>
                            
                                <!-- Final Crop -->
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold">Final Crop</label>
                                        <input class="form-control form-control-lg" type="text" name="final_crop" value="{{ $cropprice->final_crop }}" required>
                                    </div>
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success btn-lg">Update</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
              
                
            </section>





 
@endsection




























              


 
 







