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
                            <h4 class="font-weight-bold">Edit Canal</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('updateCanal', $canal->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                            
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                        <select name="div_id" id="div_id" class="form-control" required>
                                            <option value="">Choose Division / ڈویژن</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" {{ $division->id == $canal->div_id ? 'selected' : '' }}>
                                                    {{ $division->divsion_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="form-label font-weight-bold">Name of Canal</label>
                                        <input class="form-control" type="text" name="canal_name" value="{{ $canal->canal_name }}" required>
                                    </div>
<div class="form-group col-4">
    <label class="form-label" for="c_type">Canal Water Type</label>
    <select name="c_type" id="c_type" class="form-control">
        <option value="">Choose Water Type</option>

        <option value="flow" {{ $canal->c_type == 'flow' ? 'selected' : '' }}>Flow</option>
        <option value="LIS" {{ $canal->c_type == 'LIS' ? 'selected' : '' }}>LIS</option>
        <option value="t_well" {{ $canal->c_type == 't_well' ? 'selected' : '' }}>T/Well</option>
        <option value="jhallar" {{ $canal->c_type == 'jhallar' ? 'selected' : '' }}>Jhallar</option>
    </select>
</div>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Total No. of CCA</label>
                                        <input class="form-control" type="text" name="total_no_cca" value="{{ $canal->total_no_cca }}" required>
                                    </div>
                            
                                    <div class="form-group col-lg-6">
                                        <label class="form-label font-weight-bold">Total No. of Discharge (Cusec)</label>
                                        <input class="form-control" type="text" name="total_no_discharge_cusic" value="{{ $canal->total_no_discharge_cusic }}" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
@endsection






















