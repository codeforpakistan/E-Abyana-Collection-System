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
                            <h4 class="font-weight-bold">Edit Revenue Model</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('rates.update', $PriceRevenue->id) }}" method="POST">
                                @csrf
    <div class="row">
        <div class="form-group col-4">
            <label class="form-label font-weight-bold">Crop Type</label>
            <select class="form-control" name="crop_type" required id="crop_type">
                <option value="{{$PriceRevenue->crop_type}}">{{$PriceRevenue->crop_type}}</option>
                 <option value="Cash Crop">Cash Crop</option>
                  <option value="Non-Cash Crop">Non-Cash Crop</option>
            </select>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">Flow</label>
            <input type="number" step="0.1"class="form-control" name="flow" value="{{$PriceRevenue->flow}}" required>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">LIS</label>
            <input type="number" step="0.1"class="form-control" name="LIS" value="{{$PriceRevenue->LIS}}" required>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">T/Well</label>
            <input type="number" step="0.1"class="form-control" name="t_well" value="{{$PriceRevenue->t_well}}" required>
        </div>
        <div class="form-group col-2">
            <label class="form-label font-weight-bold">Jhallar</label>
            <input type="number" step="0.1"class="form-control" name="jhallar" value="{{$PriceRevenue->jhallar}}" required>
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




























              


 
 







