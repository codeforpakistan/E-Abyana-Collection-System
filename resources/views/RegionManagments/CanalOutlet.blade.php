@extends('layout')

@section('content')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

<div class="app-content">
    <section class="section">
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold"></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Minor</li>
            </ol>
        </div>

        <div id="simpleModal" class="fixed inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
            <div class="card shadow-sm w-[40vw]">
                <div class="card-header bg-primary flex justify-between text-white">
                    <h4 class="font-weight-bold">Add Outlet Canal</h4>
                    <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('CanalOutlet/add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Division Selection -->
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    @foreach($divsions as $divsion)
                                        <option value="{{ $divsion->id }}">{{ $divsion->divsion_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            
                            <!-- Canal Selection -->
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" for="canal_id">Select Canal / نہر</label>
                                <select name="canal_id" id="canal_id" class="form-control" required>
                                    <option value="">Choose Canal / نہر</option>
                                    @foreach($canals as $canal)
                                        <option value="{{ $canal->id }}">{{ $canal->canal_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    
                        <div class="row">
                            <!-- Minor Canal Selection -->
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" for="minor_id">Select Minor Canal / چھوٹا نہر</label>
                                <select name="minor_id" id="minor_id" class="form-control" required>
                                    <option value="">Choose Minor Canal</option>
                                    @foreach($minors as $minor)
                                        <option value="{{ $minor->id }}">{{ $minor->minor_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            
                            <!-- Distributary Selection -->
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" for="distrib_id">Select Distributary/ تقسیم نہر</label>
                                <select name="distrib_id" id="distrib_id" class="form-control" required>
                                    <option value="">Choose Distributary</option>
                                    @foreach($Distributaries as $Distributarie)
                                        <option value="{{ $Distributarie->id }}">{{ $Distributarie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="row">
                            <!-- Name -->
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold">Name Outlet</label>
                                <input class="form-control form-control-lg" type="text" name="outlet_name" required>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold">	Total No CCA</label>
                                <input class="form-control form-control-lg" type="number" name="total_no_cca" required>
                            </div>
                           
                        </div>
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold">Beneficiaries</label>
                                <input class="form-control form-control-lg" type="text" name="beneficiaries" required>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold">Total No. of Discharge (Cusec)</label>
                                <input class="form-control form-control-lg" type="number" name="total_no_discharge_cusic" required>
                            </div>
                           
                        </div>
                    
                      
                    
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-lg-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header d-flex justify-content-between">
                        <h4><strong>Outlet List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Outlet
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name Distributary</th>
                                        <th>Division Name</th>
                                        <th>Outlet Name</th>
                                        <th>Minor Name</th>
                                    
                                        <th>Total No. of CCA</th>
                                        <th>Total No. of Discharge (Cusec)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @if($canal->count())
                                        @foreach($outlets as $canal)
                                        <tr>
                                            <td>{{ $canal->id }}</td>
                                            <td>{{ $canal->	outlet_name }}</td>
                                            <td>
                                                @if($canal->canal)
                                                    {{ $canal->canal->canal_name }}
                                                @else
                                                    <strong style="color:red;">No Canal Found</strong>
                                                @endif
                                            </td>
                                            <td>{{ $canal->minor->minor_name ?? 'N/A' }}</td>

                                          <td>{{ $canal->division->division_name ?? 'N/A' }}</td>
                                          
                                               <td>{{ $canal->total_no_cca }}</td>
                                           <td>{{ $canal->total_no_discharge_cusic }}</td>

                                            <td>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
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
                                {{ $outlets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function openModal() {
    document.getElementById("simpleModal").classList.remove("hidden");
}
function closeModal() {
    document.getElementById("simpleModal").classList.add("hidden");
}
</script>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Load Canals when Division is selected
    $('#div_id').change(function() {
        var division_id = $(this).val();
        $('#canal_id').html('<option value="">Loading...</option>'); // Show loading text

        if (division_id) {
            $.ajax({
                url: '/get-canals/' + division_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#canal_id').html('<option value="">Choose Canal</option>');
                    $.each(data, function(key, value) {
                        $('#canal_id').append('<option value="'+ value.id +'">'+ value.canal_name +'</option>');
                    });
                }
            });
        }
    });

    // Load Minor Canals when Canal is selected
    $('#canal_id').change(function() {
        var canal_id = $(this).val();
        $('#minor_id').html('<option value="">Loading...</option>');

        if (canal_id) {
            $.ajax({
                url: '/get-minors/' + canal_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#minor_id').html('<option value="">Choose Minor Canal</option>');
                    $.each(data, function(key, value) {
                        $('#minor_id').append('<option value="'+ value.id +'">'+ value.minor_name +'</option>');
                    });
                }
            });
        }
    });

    // Load Distributaries when Minor Canal is selected
    $('#minor_id').change(function() {
        var minor_id = $(this).val();
        $('#distrib_id').html('<option value="">Loading...</option>');

        if (minor_id) {
            $.ajax({
                url: '/get-distributaries/' + minor_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#distrib_id').html('<option value="">Choose Distributary</option>');
                    $.each(data, function(key, value) {
                        $('#distrib_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                }
            });
        }
    });
});
</script>
