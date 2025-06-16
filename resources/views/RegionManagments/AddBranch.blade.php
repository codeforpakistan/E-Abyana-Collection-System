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
                    <h4 class="font-weight-bold">Add Branch</h4>
                    <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('Canalbranch/add') }}" method="POST">
                        @csrf
                        <div class="row" style="margin-top:-30px;">
                            <!-- Division Selection -->
                            <div class="form-group col-4">
                                <label class="form-label" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            
                            <!-- Canal Selection -->
                            <div class="form-group col-4">
                                <label class="form-label" for="canal_id">Select Canal / نہر</label>
                                <select name="canal_id" id="canal_id" class="form-control" required>
                                    <option value="">Choose Canal / نہر</option>
                                    @foreach($canals as $canal)
                                        <option value="{{ $canal->id }}">{{ $canal->canal_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-4">
                                <label class="form-label" for="minor_id">Select Distributary/ تقسیم نہر</label>
                                <select name="minor_id" id="minor_id" class="form-control" required>
                                    <option value="">Choose Minor Canal</option>
                                    @foreach($minors as $minor)
                                        <option value="{{ $minor->id }}">{{ $minor->minor_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    
                        <div class="row" style="margin-top:-10px;">
                            <!-- Distributary Selection -->
                            <div class="form-group col-4">
                                <label class="form-label" for="distrib_id">Select Minor Canal / چھوٹا نہر</label>
                                <select name="distrib_id" id="distrib_id" class="form-control" required>
                                    <option value="">Choose Distributary</option>
                                    @foreach($Distributaries as $Distributarie)
                                        <option value="{{ $Distributarie->id }}">{{ $Distributarie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Branch Name </label>
                                <input class="form-control" type="text" name="branch_name" required>
                            </div>
                            <div class="row" style="margin-top:-10px;">
                                <div class="form-group col-4">
                                    <label class="form-label">No. of Outlets</label>
                                    <input class="form-control" type="text" name="no_outlet" required>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label">No. of Outlets (LS)</label>
                                    <input class="form-control" type="text" name="no_outlet_ls" required>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label">No. of Outlets (RS)</label>
                                    <input class="form-control" type="text" name="no_outlet_rs" required>
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
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header d-flex justify-content-between">
                        <h4><strong>Branch List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> 
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Branch Name</th>
                                        <th>Division</th>
                                        <th>Canal</th>
                                        <th>Minor</th>
                                        <th>Distributary</th>
                                        <th>No. of Outlets</th>
                                        <th>CCA</th>
                                        <th>Discharge (Cusec)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($branches as $branch)
                                        <tr>
                                            <td>{{ $branch->branch_name }}</td>
                                            <td>{{ $branch->division->divsion_name ?? 'N/A' }}</td>
                                            <td>{{ $branch->canal->canal_name ?? 'N/A' }}</td>
                                            <td>{{ $branch->minor->minor_name ?? 'N/A' }}</td>
                                            <td>{{ $branch->distributary->name ?? 'N/A' }}</td>
                                            <td>{{ $branch->no_outlet }} (LS: {{ $branch->no_outlet_ls }}, RS: {{ $branch->no_outlet_rs }})</td>
                                            <td>{{ $branch->total_no_cca }}</td>
                                            <td>{{ $branch->total_no_discharge_cusic }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="" class="btn btn-sm btn-warning">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                            
                                                    <form action="" method="POST"
                                                          onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                            
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
