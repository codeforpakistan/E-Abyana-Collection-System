@extends('layout')

@section('content')
<div class="app-content">
    <div class="card shadow-sm w-[60vw]">
        <div class="card-header bg-primary text-white">
            <h4>Edit Tehsil</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('tehsil.update', $tehsil->tehsil_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Division -->
                    <div class="form-group col-6">
                        <label for="div_id">Select Division / ڈویژن</label>
                        <select name="div_id" id="div_id" class="form-control" onchange="get_districts(this)" required>
                            <option value="">Choose Division</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div->id }}" {{ $div->id == $tehsil->district->div_id ? 'selected' : '' }}>
                                    {{ $div->divsion_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- District -->
                    <div id="get_districts" class="form-group col-lg-6">                        <label for="district_id">Select District / ضلع</label>
                        <select name="district_id" id="district_id" class="form-control" required>
               

                            <option value="">Choose District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ $district->id == $tehsil->district_id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tehsil Name -->
                    <div class="form-group col-lg-12">
                        <label>Tehsil Name / نام تحصیل</label>
                        <input type="text" name="tehsil_name" class="form-control" value="{{ $tehsil->tehsil_name }}" required>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Tehsil</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


<script>
function get_districts(element) {
    var divisionId = element.value;
    var selectedDistrictId = $('#selected_district_id').val(); // only applies during edit

    if (divisionId) {
        $.ajax({
            url: '/get-districts/' + divisionId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var districtSelect = $('#district_id');
                districtSelect.empty(); // 💡 clears old options
                districtSelect.append('<option value="">Choose District</option>');

                $.each(data, function (index, district) {
                    let isSelected = district.id == selectedDistrictId ? 'selected' : '';
                    districtSelect.append('<option value="' + district.id + '" ' + isSelected + '>' + district.name + '</option>');
                });

                // clear pre-selected district after first load
                $('#selected_district_id').val('');
            },
            error: function (xhr) {
                console.error('Error fetching districts:', xhr);
            }
        });
    } else {
        $('#district_id').empty().append('<option value="">Choose District</option>');
    }
}

</script>

