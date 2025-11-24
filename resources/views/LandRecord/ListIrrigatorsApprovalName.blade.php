@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
    #example123 th{
        padding: 4px !important;
        background-color: #5cd17b;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
</style>
</head>
<div class="app-content">
    <section class="section">
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header">
                        <h2><strong>Bill Approval List</strong></h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="button-container">
                                <button id="check-all" class="btn btn-primary btn-sm"><strong>Check All</strong></button>
                                <button id="approve-selected" class="btn btn-primary btn-sm" style="display: none;"><i class="side-menu__icon fas fa-check"></i><strong>Approve All</strong></button>
                            </div>
                            <table id="example123" style="font-size:14px;" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead class="table-primary text-center align-middle">
                                    <tr>
                                        <th class="text-center text-light"></th>
                                        <th class="text-center text-light">ID</th>
                                        <th class="text-center text-light">Irrigator Name</th>
                                        <th class="text-center text-light">Khata #</th>
                                        <th class="text-center text-light">Village</th>
                                        <th class="text-center text-light">Amount</th>
                                        <th class="text-center text-light">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped_survey_bill_eligible as $irrigator_id => $irrigator_surveys)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="irrigator-checkbox" value="{{ $irrigator_surveys->irrigator_id }}">
                                            </td>
                                            <td class="text-center align-middle">{{ $irrigator_surveys->irrigator_id }}</td>
                                            <td class="text-center align-middle"><strong>{{ $irrigator_surveys->irrigator_name }}</strong></td>
                                            <td class="text-center align-middle"><strong>{{ $irrigator_surveys->irrigator_khata_number }}</strong></td>
                                            <td class="text-center align-middle"><strong>{{ $irrigator_surveys->village_name }}</strong></td>
                                            <td class="text-center align-middle"><strong>{{ $irrigator_surveys->total_bill_amount }}</strong></td>
                                            <td class="text-center align-middle">
                                                <a href="{{ url('survey_bill/approve/view') }}/{{ $irrigator_surveys->irrigator_id }}">
                                                    <button class="btn btn-primary btn-sm" type="button" title="Bill">
                                                        <i class="fas fa-eye"></i> View</button>
                                                </a>
                                                <a href="{{ url('survey_bill/approve') }}/{{ $irrigator_surveys->irrigator_id }}">
                                                    <button class="btn btn-primary btn-sm" type="button" title="Bill">
                                                        <i class="fas fa-check"></i> Approve</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                {{-- Laravel paginator summary (correct numbers) --}}
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div>
                            @if ($grouped_survey_bill_eligible->total())
                                Showing {{ $grouped_survey_bill_eligible->firstItem() }} to {{ $grouped_survey_bill_eligible->lastItem() }} of {{ $grouped_survey_bill_eligible->total() }} entries
                            @else
                                Showing 0 entries
                            @endif
                        </div>
                    
                        <div>
                            {{ $grouped_survey_bill_eligible->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>    
<script>
$(document).ready(function () {
$('#example123').DataTable({
    paging: false,   // keep DataTables paging off (server-side paging is used)
    info: false,     // IMPORTANT: disable DataTables info text (the wrong "Showing 1 to 200 of 200")
    ordering: false
});
});
</script> 
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkAllButton = document.getElementById('check-all');
        const approveSelectedButton = document.getElementById('approve-selected');
        const checkboxes = document.querySelectorAll('.irrigator-checkbox');

        checkAllButton.addEventListener('click', function () {
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
            checkAllButton.textContent = allChecked ? 'Check All' : 'Uncheck All';
            toggleApproveButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleApproveButton);
        });

        function toggleApproveButton() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            approveSelectedButton.style.display = anyChecked ? 'inline-block' : 'none';
        }

        approveSelectedButton.addEventListener('click', function () {
            const selectedIrrigators = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedIrrigators.length === 0) {
                Swal.fire('Error', 'No irrigators selected!', 'error');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to approve selected records!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('survey_bill.approve_multiple') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ irrigator_ids: selectedIrrigators })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    });
                }
            });
        });
    });
</script>
