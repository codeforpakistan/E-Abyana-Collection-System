@extends('layout')

@section('content')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
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
<div id="simpleModal" class="fixed inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
            <div class="card shadow-sm w-[60vw]">
                <div class="card-header bg-primary flex justify-between text-white">
                    <h4 class="font-weight-bold">Add Distributory</h4>
                    <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('AddMinor-Canal/add') }}" method="POST">
                        @csrf
                        <div class="row" style="margin-top:-30px;">
                            <div class="form-group col-4">
                                <label class="form-label" for="div_id">Select Division / ڈویژن</label>
                                <!-- select_search -->
                                <select name="div_id" id="div_id" class="form-group form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label  class="form-label" for="canal_id">Select Canal/ضلع</label>
                                <select name="canal_id" id="canal_id" class="form-control" >
                                    <option value="">Choose Canal/گاؤں</option>
                                    @foreach($canals as $canal)
                                        <option value="{{ $canal->id }}">{{ $canal->canal_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Name of Distributory</label>
                                <input class="form-control" type="text" name="minor_name" required>
                            </div>
                        </div>
                        <div class="row" style="margin-top:-10px;">
                            
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets</label>
                                <input class="form-control" type="number" name="no_outlet" required>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets (Left Side)</label>
                                <input class="form-control" type="number" name="no_outlet_ls" required>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets (Right Side)</label>
                                <input class="form-control" type="number" name="no_outlet_rs" required>
                            </div>
                        </div>
                           
                        <div class="row" style="margin-top:-10px;">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of CCA</label>
                                <input class="form-control" type="text" name="total_no_cca" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of Discharge (Cusec)</label>
                                <input class="form-control" type="text" name="total_no_discharge_cusic" required>
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
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header d-flex justify-content-between">
                        <h4><strong>Distributory List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> 
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Distributory</th>
                                        <th>Division Name</th>
                                        <th>Canal Name</th>
                                        <th>No Of Outlet</th>
                                        <th>No. of Outlets (Left Side)</th>
                                        <th>No. of Outlets (Right Side)</th>
                                        <th>Total No. of CCA</th>
                                        <th>Total No. of Discharge (Cusec)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($canal->count())
                                        @foreach($minorCanals as $canal)
                                        <tr>
                                            <td>{{ $canal->id }}</td>
                                            <td>{{ $canal->minor_name }}</td>
                                            <td>{{ $canal->division->divsion_name ?? 'N/A' }}</td>
                                            <td>
                                                @if($canal->canal)
                                                    {{ $canal->canal->canal_name }}
                                                @else
                                                    <strong style="color:red;">No Canal Found</strong>
                                                @endif
                                            </td>
                                    
                                          
                                            <td>{{ $canal->no_outlet }}</td>
                                             <td>{{ $canal->no_outlet_ls }}</td>
                                             <td>{{ $canal->no_outlet_rs }}</td>
                                               <td>{{ $canal->total_no_cca }}</td>
                                           <td>{{ $canal->total_no_discharge_cusic }}</td>

                                            <td>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                                <a href="{{ route('editminor', $canal->id) }}" class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                
                                            </td>
                                        </tr>
                                        @endforeach 
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No data available</td>
                                        </tr>
                                    @endif
                                </tbody> 
                            </table>
                            <div class="mt-3">
                                {{ $minorCanals->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

<script>
    function openModal() {
        document.getElementById("simpleModal").classList.remove("hidden");
        document.getElementById("simpleModal").classList.add("flex"); // Ensure modal is visible
    }
    
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('#div_id').change(function() {
            var div_id = $(this).val();

            if (div_id) {
                $.ajax({
                    url: "{{ route('getCanals') }}", // API route to fetch canals
                    type: "GET",
                    data: { div_id: div_id },
                    success: function(data) {
                        $('#canal_id').empty();
                        $('#canal_id').append('<option value="">Choose Canal</option>');
                        $.each(data, function(key, canal) {
                            $('#canal_id').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                        });
                    }
                });
            } else {
                $('#canal_id').empty();
                $('#canal_id').append('<option value="">Choose Canal</option>');
            }
        });
    });
</script>
