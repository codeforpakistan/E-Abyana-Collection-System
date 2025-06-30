@extends('layout')

@section('content')
<div class="app-content py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 700px;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Halqa</h4>
        </div>

        <div class="card-body">
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <!-- District -->
                    <div class="col-md-6">
                        <label for="district_id" class="form-label font-weight-bold">Select District / ضلع</label>
                        <select name="district_id" id="district_id" class="form-control" onchange="get_tehsils(this)" required>
                            <option value="">Choose District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ $district->id == $halqa->district_id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tehsil -->
                    <div class="col-md-6">
                        <label for="tehsil_id" class="form-label font-weight-bold">Select Tehsil / تحصیل</label>
                        <select name="tehsil_id" id="tehsil_id" class="form-control" required>
                            <option value="">Choose Tehsil</option>
                            @foreach($tehsils as $tehsil)
                                <option value="{{ $tehsil->tehsil_id }}" {{ $tehsil->tehsil_id == $halqa->tehsil_id ? 'selected' : '' }}>
                                    {{ $tehsil->tehsil_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Halqa Name -->
                <div class="mb-3">
                    <label for="halqa_name" class="form-label font-weight-bold">Halqa Name / حلقہ</label>
                    <input type="text" name="halqa_name" id="halqa_name" class="form-control" value="{{ $halqa->halqa_name }}" required>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Update Halqa
                    </button>
                    <a href="" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


<script>
function get_tehsils(element) {
    var districtId = element.value;
    $.ajax({
        url: '/get-tehsils/' + districtId,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var tehsilSelect = $('#tehsil_id');
            tehsilSelect.empty().append('<option value="">Choose Tehsil</option>');
            $.each(data, function (key, value) {
                tehsilSelect.append('<option value="' + value.tehsil_id + '">' + value.tehsil_name + '</option>');
            });
        }
    });
}

</script>

