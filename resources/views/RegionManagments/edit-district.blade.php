@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="app-content">
    <section class="section">

        {{-- SweetAlert for messages --}}
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

        <!-- Page Header -->
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold">Edit District</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit District</li>
            </ol>
        </div>

        <!-- Centered Form Row -->
        <div class="row justify-content-center" style="margin-top: 80px;">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="font-weight-bold mb-0">Edit District</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('district.update', $district->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Select Division -->
                            <div class="form-group">
                                <label class="form-label font-weight-bold">Select Division / ڈویژن</label>
                                <select name="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{ $divsion->id }}" {{ $divsion->id == $district->div_id ? 'selected' : '' }}>
                                            {{ $divsion->divsion_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- District Name -->
                            <div class="form-group">
                                <label class="form-label font-weight-bold">District Name / ضلع</label>
                                <input class="form-control" type="text" name="name" value="{{ $district->name }}" required>
                            </div>

                            <!-- District Code (optional) -->
                          

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
