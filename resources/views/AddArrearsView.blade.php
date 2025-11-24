@extends('layout')
@section('content')
    <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    </head>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add Arrear</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="add-arrears-form" action="{{ url('AddArrears/add') }}" method="POST" class="form-horizontal">
                @csrf
            <div class="row">
                <input type="hidden" name="irrigator_id" id="irrigator_id">
                <input type="hidden" name="div_id" id="div_id">
                <div class="form-group col-12">
                        <label class="form-label font-weight-bold">Arrear Amount</label>
                        <input class="form-control" type="number" name="previous_arrears"
                        placeholder=" Enter Arrear Amount" value="0" step="0.01" min="0" 
                        focus="if(this.value=='0'){this.value='';}" onblur="if(this.value==''){this.value='0';}" required>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
          <button type="button" id="submit-btn" class="btn btn-primary" onclick="submit_form()">+ Add Arrear</button>
        </div>
       </form>
      </div>
    </div>
  </div> 
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

            {{-- <p>User ID: {{ session('halqa_id') }}</p> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card export-database">
 <div class="card-header d-flex justify-content-between">
    <h4><strong>Irrigators List (Arrears)</strong></h4>
</div> 
                        <div class="card-body p-1">
                        <div class="row border-bottom p-1">
                            <div class="col-12 mb-2">
                                <label>Select Village</label>
                                <select id="villageFilter" class="form-control">
                                    @foreach ($villages as $village)
                                        <option value="{{ $village->village_id }}">{{ $village->village_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="loader" style="display: none; text-align: center; font-weight: bold;">Loading...</div>
                            <div class="table-responsive mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
 let table = new DataTable('#example123', {
            pageLength: 100
        });

        $('#villageFilter').on('change', function () {
            let village_id = $(this).val();
            $('#loader').show();
            $('#example123').hide();

            $.ajax({
                url: "{{ route('AddArrearsView') }}",
                type: "GET",
                data: { village_id: village_id },
                success: function (data) {
                    if ($.fn.DataTable.isDataTable('#example123')) {
                        $('#example123').DataTable().destroy();
                    }

                    $('.table-responsive').html(data);

                    new DataTable('#example123', {
                        pageLength: 100
                    });

                    $('#loader').hide();
                    $('#example123').show();
                },
                error: function () {
                    $('#loader').hide();
                    alert('Failed to load irrigators.');
                }
            });
        });
        $('#villageFilter').trigger('change');

$(document).on('click', '.open-arrear-modal', function() {
    const irrigatorId = $(this).data('irrigator-id');
    const divId = $(this).data('div-id');

    $('#irrigator_id').val(irrigatorId);
    $('#div_id').val(divId);

    $('#exampleModal').modal('show');
});
    });
</script>
<script>
function submit_form() {
    const form = document.getElementById('add-arrears-form');
    if (!form) return console.error('Form not found!');

    const formData = new FormData(form);
    const actionUrl = form.getAttribute('action');
    const selectedVillageId = $('#villageFilter').val(); // get currently selected village

    fetch(actionUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(async (response) => {
        const data = await response.json();
        if (!response.ok) throw new Error(data.error || 'Something went wrong.');

        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: data.success || 'Arrear added successfully!',
            timer: 1500,
            showConfirmButton: false
        });

        // reset form and close modal
        form.reset();
        document.querySelector('input[name="previous_arrears"]').value = '0';
        $('#exampleModal').modal('hide');

        // 🔁 refresh the irrigators list via AJAX without reloading page
        $('#loader').show();
        $('#example123').hide();

        $.ajax({
            url: "{{ route('AddArrearsView') }}",
            type: "GET",
            data: { village_id: selectedVillageId }, // reload same village
            success: function (data) {
                if ($.fn.DataTable.isDataTable('#example123')) {
                    $('#example123').DataTable().destroy();
                }

                $('.table-responsive').html(data);
                new DataTable('#example123', { pageLength: 100 });
                $('#loader').hide();
                $('#example123').show();
            },
            error: function () {
                $('#loader').hide();
                alert('Failed to refresh irrigators.');
            }
        });

    })
    .catch((error) => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Something went wrong. Please try again.',
        });
    });
}

</script>

<!--<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#exampleModal').on('hidden.bs.modal', function () {
            console.log('Modal hidden event triggered');
            window.location.href = '{{ route("AddIrragtor") }}';
        });
    });
</script> -->
