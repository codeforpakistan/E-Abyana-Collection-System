@extends('layout')

@section('content')

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
    <div class="card shadow-sm w-[60vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Tehsil</h4>
            <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ url('AddTahsil/add') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label font-weight-bold" for="div_id">Select Division/ڈویژن</label>
                        <select name="div_id" id="div_id" class="form-control" required onchange="get_districts(this)">
                            <option value="">Choose Division/ڈویژن</option>
                            @foreach($divsions as $divsion)
                                <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label class="form-label font-weight-bold" for="district_id">Select District/ضلع</label>
                        <select name="district_id" id="district_id" class="form-control" required>
                            <option value="">Choose District/ضلع</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Name Tehsil / نام تحصیل</label>
                        <input class="form-control form-control-lg" type="text" name="tehsil_name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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
                        <h4><strong>Tehsil List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('tehsil.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <table id="example" class="table table-bordered key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>ID</th>
                                            <th>Name Division / نام ڈویژن</th>
                                            <th>District Name / نام ضلع</th>
                                            <th>Tehsil Name / نام تحصیل</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tehsils as $tehsil)
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" value="{{ $tehsil->tehsil_id }}"></td>
                                                <td>{{ $tehsil->tehsil_id }}</td>
                                                <td>{{ $tehsil->district->division->divsion_name }}</td>
                                                <td>{{ $tehsil->district->name }}</td>
                                                <td>{{ $tehsil->tehsil_name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" type="submit">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $tehsils->links() }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function get_districts(element) {
            var divisionId = element.value;

            if (divisionId) {
                $.ajax({
                    url: '/get-districts/' + divisionId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#district_id').empty().append('<option value="">Choose District</option>');
                        $.each(data, function (key, value) {
                            $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching districts:', error);
                    }
                });
            } else {
                $('#district_id').empty().append('<option value="">Choose District</option>');
            }
        }
    </script>
