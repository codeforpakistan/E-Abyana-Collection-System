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
                <!--row open-->
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="font-weight-bold">Edit Distributary</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form action="{{ route('updateMinorCanal', $minorCanal->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                        <select name="div_id" id="div_id" class="form-control" required>
                                            <option value="">Choose Division / ڈویژن</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" {{ $minorCanal->div_id == $division->id ? 'selected' : '' }}>
                                                    {{ $division->divsion_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                            
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold" for="canal_id">Select Canal / نہر</label>
                                        <select name="canal_id" id="canal_id" class="form-control" required>
                                            <option value="">Choose Canal / نہر</option>
                                            @foreach($canals as $canal)
                                                <option value="{{ $canal->id }}" {{ $minorCanal->canal_id == $canal->id ? 'selected' : '' }}>
                                                    {{ $canal->canal_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label class="form-label font-weight-bold">Name of Distributary</label>
                                        <input class="form-control" type="text" name="minor_name" value="{{ $minorCanal->minor_name }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Total No. of CCA</label>
                                        <input class="form-control" type="number" name="total_no_cca" value="{{ $minorCanal->total_no_cca }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Total No. of Discharge (Cusec)</label>
                                        <input class="form-control" type="number" name="total_no_discharge_cusic" value="{{ $minorCanal->total_no_discharge_cusic }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              
                
            </section>
@endsection