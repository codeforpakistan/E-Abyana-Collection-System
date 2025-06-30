@extends('layout')

@section('content')
<head>
    ...
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="app-content">
  
    <section class="section">
        <!--row open-->
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><strong>Jinswaar Report</strong></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label font-weight-bold">Select Division</label>
                        <select name="dropdown_div_id" id="dropdown_div_id" class="form-control">
                            <option value="">Choose Division</option>
                            @foreach($dropdown_divisions as $single_dropdown_divisions)
                                <option value="{{$single_dropdown_divisions->id}}">{{ $single_dropdown_divisions->divsion_name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label font-weight-bold">Select Session</label>
                        <select name="dropdown_session_year" id="dropdown_session_year" class="form-control">
                            <option value="">Choose Session</option>
                            @foreach($dropdown_session_year as $single_dropdown_session_year)
                                <option value="{{$single_dropdown_session_year->session_date}}">{{ $single_dropdown_session_year->session_date }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
        
        
</section> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
$(document).ready(function () {
    $('#dropdown_div_id, #dropdown_session_year').on('change', function () {
        let division_id = $('#dropdown_div_id').val();
        let session_year = $('#dropdown_session_year').val();

        if (division_id && session_year) {
            $.ajax({
                url: "{{ route('ReportJinswaarData') }}",
                type: "POST",
                data: {
                    division_id: division_id,
                    session_year: session_year,
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

</div>  
 @endsection
 