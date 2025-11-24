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

            <section class="section">
                <!--row open-->
                <div class="row">
                    <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="font-weight-bold">Edit Division</h4> <!-- Updated to reflect Employer data -->
                        </div>
<div class="card-body">
    <form class="form-horizontal" action="{{ route('update_division', $division->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <label class="form-label font-weight-bold">Division Name</label>
                <input class="form-control" type="text" name="divsion_name"
                       value="{{ $division->divsion_name }}" required>
            </div>

            <div class="col-2 d-flex align-items-end">
                <button class="btn btn-success btn-block" type="submit">
                    <i class="fa fa-save"></i> Update
                </button>
            </div>
        </div>

    </form>
</div>

                    </div>
                </div>
                </div>
            </section>
@endsection






















