@extends('layout')

@section('content')
<head>
</head>

<div class="app-content">
  
    <section class="section">
        <!--row open-->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><strong>Irrigator's No NIC Report</strong></h5>
                </div>

<div class="card-body">
    <div class="row align-items-end" style="margin-top: -10px;">
    <!-- Division dropdown -->
    <div class="col-md-4 mb-3">
        <label class="form-label font-weight-bold">Select Division</label>
        <select name="dropdown_div_id" id="dropdown_div_id" class="form-control">
            <option value="">Choose Division</option>
            @foreach($dropdown_divisions as $single_dropdown_divisions)
                <option value="{{ $single_dropdown_divisions->id }}">
                    {{ $single_dropdown_divisions->divsion_name }}
                </option>
            @endforeach
        </select>
    </div>
        <!-- Print button -->
        <div class="col-md-4 mb-3 text-md-end text-end">
            <button class="btn btn-sm btn-primary mt-4 mt-md-0 print-btn">Print</button>
        </div>
    </div>
</div>

            </div>
        </div>

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body print-area">
                        <div class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
</section> 
</div>
<script>
$(document).ready(function () {
    $('#dropdown_div_id').on('change', function () {
        let division_id = $('#dropdown_div_id').val();

        if (division_id) {
            $.ajax({
                url: "{{ route('get-irrigator-no-nic') }}",
                type: "POST",
                data: {
                    division_id: division_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('.table-responsive').html(response.html);
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            });
        }
    });
});
</script>
<script>
document.querySelector(".print-btn").addEventListener("click", function () {
    var printContents = document.querySelector(".print-area").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
});
</script>
 @endsection
 