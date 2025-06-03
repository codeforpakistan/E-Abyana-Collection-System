@extends('layout')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #example th {
        padding: 4px !important;
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
                    <h3><strong>View & Print Bills</strong></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('survey_bill.view_multiple') }}">
                            @csrf
                           <div class="button-container">
                                <button id="check-all" type="button" class="btn btn-warning btn-sm">
                                    <strong>Check All</strong>
                                </button>
                                <button id="approve-selected" type="submit" class="btn btn-success btn-sm" style="display: none;">
                                    <strong>Generate</strong>
                                </button>
                            </div>

                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead class="table-primary text-center align-middle">
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Irrigator Name</th>
                                        <th>Khata #</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped_survey_bill_eligible as $irrigator_id => $irrigator_surveys)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" name="irrigator_ids[]" class="irrigator-checkbox" value="{{ $irrigator_surveys->first()->irrigator_id }}">
                                            </td>
                                            <td class="text-center align-middle">{{ $irrigator_surveys->first()->irrigator_id }}</td>
                                            <td class="text-center align-middle">
                                                <strong>{{ $irrigator_surveys->first()->irrigator_name }}</strong>
                                            </td>
                                            <td class="text-center align-middle">
                                                <strong>{{ $irrigator_surveys->first()->irrigator_khata_number }}</strong>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{ url('survey_bill/view', $irrigator_surveys->first()->irrigator_id) }}">
                                                    <button type="button" class="btn btn-primary btn-sm" title="Bill">
                                                        <i class="side-menu__icon fas fa-receipt"></i> Generate Bill
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>  
</div>    

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
    });
</script>
