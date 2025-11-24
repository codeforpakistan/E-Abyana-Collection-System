@extends('layout')
@section('content')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
<style>
    #detailsModal table th {
        width: 40%;
        background-color: #f2f2f2;
    }
    #detailsModal table td {
        background-color: #fff;
    }
</style>


<div class="app-content">
<div id="simpleModal" class="fixed inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
            <div class="card shadow-sm w-[60vw]">
                <div class="card-header bg-primary flex justify-between text-white">
                    <h4 class="font-weight-bold">Add Outlet</h4>
                    <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('CanalOutlet/add') }}" method="POST">
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
                                <select name="minor_id" id="minor_id" class="form-control">
                                    <option value="">Choose Distributary Canal</option>
                                    @foreach($minors as $minor)
                                        <option value="{{ $minor->id }}">{{ $minor->minor_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    
                        <div class="row" style="margin-top:-10px;">
                            <!-- Distributary Selection -->
                            <div class="form-group col-3">
                                <label class="form-label" for="distrib_id">Select Minor / چھوٹا نہر</label>
                                <select name="distrib_id" id="distrib_id" class="form-control">
                                    <option value="">Choose Minor</option>
                                    @foreach($Distributaries as $Distributarie)
                                        <option value="{{ $Distributarie->id }}">{{ $Distributarie->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label class="form-label" for="branch_id">Select Branch / برانچ</label>
                                <select name="branch_id" id="branch_id" class="form-control">
                                    <option value="">Choose Branch</option>
                                    @foreach($CanalBranch as $CanalBranch)
                                        <option value="{{ $CanalBranch->id }}">{{ $CanalBranch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label class="form-label">Name Outlet</label>
                                <input class="form-control" type="text" value="RD-" name="outlet_name" required>
                            </div>
                            <div class="form-group col-3">
                                <label class="form-label">	Total No CCA</label>
                                <input class="form-control" type="text" name="total_no_cca" required>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top:-10px;">
                            <!-- Name -->
                           <!-- <div class="form-group col-lg-6">
                                <label class="form-label">Beneficiaries</label>
                                <input class="form-control" type="text" name="beneficiaries" required>
                            </div> -->
                            
                            <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of Discharge (Cusec)</label>
                                <input class="form-control" type="text" name="total_no_discharge_cusic" required>
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
                        <h4><strong>Outlet List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example123" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>OutLet Name</th>
                                        <th>Division Name</th>
                                        <th>Canal Name</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                 <tbody>
@foreach($outlets as $outlet)
<tr>
    <td>{{ $outlet->id }}</td>
    <td>{{ $outlet->outlet_name }}</td>
    <td>{{ $outlet->division->divsion_name ?? 'N/A' }}</td>
    <td>{{ $outlet->canal->canal_name ?? 'N/A' }}</td>

    <td>
        <button class="btn btn-sm btn-success" onclick="showDetails({{ json_encode($outlet) }})">
            <i class="fa fa-eye"></i> View
        </button>
    </td>

    <td>
        <a href="{{ url('/outlets/edit/' . $outlet->id) }}" class="btn btn-sm btn-info">
            <i class="fa fa-edit"></i> Edit
        </a>
        <button class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i> Delete
        </button>
    </td>
</tr>
@endforeach
</tbody>
                            </table>
                            
<div id="detailsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-[9999] hidden">
    <div class="bg-white rounded-lg shadow-lg w-[60vw] max-h-[100vh] overflow-y-auto">
 <div class="flex justify-between items-center bg-primary text-white p-1 rounded-t">
            <h6 class="text-lg font-bold">Outlet Details</h6>
            <button onclick="closeDetails()" class="text-white hover:text-gray-300 text-xl">&times;</button>
        </div>
        <div id="detailsContent">
            <!-- Table is dynamically inserted here -->
        </div>
    </div>
</div>

                            
                           <!-- <div class="mt-3">
                               {{-- $outlets->links() --}} 
                            </div> -->
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
function showDetails(data) {
    let html = `
        <table class="table table-bordered w-100">
            <tbody style="font-size:12px;">
                <tr><th>Outlet Name</th><td>${data.outlet_name}</td></tr>
                <tr><th>Division</th><td>${data.division?.divsion_name ?? 'N/A'}</td></tr>
                <tr><th>Canal</th><td>${data.canal?.canal_name ?? 'N/A'}</td></tr>
                <tr><th>Distributary</th><td>${data.minor_name?.name ?? 'N/A'}</td></tr>
                <tr><th>Minor</th><td>${data.minor?.distributsry ?? 'N/A'}</td></tr>
                <tr><th>Branch</th><td>${data.CanalBranch?.branch_name ?? 'N/A'}</td></tr>
                <tr><th>Beneficiaries</th><td>${data.beneficiaries}</td></tr>
                <tr><th>CCA</th><td>${data.total_no_cca}</td></tr>
                <tr><th>Discharge (Cusec)</th><td>${data.total_no_discharge_cusic}</td></tr>
            </tbody>
        </table>
    `;
    document.getElementById('detailsContent').innerHTML = html;
    document.getElementById('detailsModal').classList.remove('hidden');
}


function closeDetails() {
    document.getElementById('detailsModal').classList.add('hidden');
}
</script>


<script>
$(document).ready(function() {
    
        if (!$.fn.DataTable.isDataTable('#example123')) {
        $('#example123').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            pageLength: 100,
            dom: 'lftip'
        });
    }

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

        // Load branches when Minor Canal is selected
    $('#distrib_id').change(function() {
        var distrib_id = $(this).val();
        $('#branch_id').html('<option value="">Loading...</option>');

        if (distrib_id) {
            $.ajax({
                url: '/get-branches/' + distrib_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#branch_id').html('<option value="">Choose Branches</option>');
                    $.each(data, function(key, value) {
                        $('#branch_id').append('<option value="'+ value.id +'">'+ value.branch_name +'</option>');
                    });
                }
            });
        }
    });
});
</script>