@extends('layout')

@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
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
    <div class="app-content">
            <section class="section">
                <!--row open-->
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="font-weight-bold">Edit Irrigator</h4> <!-- Updated to reflect Employer data -->
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('update.irrigator', $irrigator->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Village Selection -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="village_id">Select Village/گاؤں&nbsp;<span style="color:red;"><strong>*</strong></span></label>
                                        <select name="village_id" id="village_id" class="form-control" required>
                                            @foreach ($villages as $village)
                                                <option value="{{ $village->village_id }}" {{ (old('village_id', $irrigator->village_id) == $village->village_id) ? 'selected' : '' }}>
                                                    {{ $village->village_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Name of Irrigator -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="irrigator_name">Name Irrigator&nbsp;<span style="color:red;"><strong>*</strong></span></label>
                                        <input class="form-control" type="text" id="irrigator_name" name="irrigator_name"
                                            value="{{ old('irrigator_name', $irrigator->irrigator_name) }}" required>
                                    </div>
                                    <!-- Khata Number -->
                                    <div class="form-group col-lg-12">
                                        <label class="form-label font-weight-bold" for="irrigator_khata_number">Khata Number&nbsp;<span style="color:red;"><strong>*</strong></span></label>
                                        <input class="form-control" type="text" id="irrigator_khata_number" name="irrigator_khata_number"
                                            value="{{ old('irrigator_khata_number', $irrigator->irrigator_khata_number) }}" required>
                                    </div>

                                    <div class="form-group col-12">
                                         <label class="form-label font-weight-bold">Irrigator Father Name&nbsp;<span style="color:red;"><strong>*</strong></span></label>
                                         <input class="form-control" type="text" id="" name="irrigator_f_name" value="{{ old('irrigator_f_name', $irrigator->irrigator_f_name) }}" required>
                                     </div>
                            
                                    <div class="form-group col-12">
                                        <label class="form-label font-weight-bold">Mobile Number</label>
                                        <input class="form-control" type="text" id="irrigator_mobile_number" value="{{ old('irrigator_mobile_number', $irrigator->irrigator_mobile_number) }}" maxlength="13" name="irrigator_mobile_number">
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="form-label font-weight-bold">Irrigator CNIC</label>
                                        <input class="form-control" type="text" id="cnic" value="{{ old('cnic', $irrigator->cnic) }}" name="cnic" maxlength="15">
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit" title="Update"><i class="fa fa-save"></i>&nbsp;Update Irrigator</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </section> 
<script>
const mobileInput = document.getElementById('irrigator_mobile_number');
if (!mobileInput.value) {
    mobileInput.value = '+92';
}
mobileInput.addEventListener('keydown', function (e) {
    if (mobileInput.selectionStart < 3 && (e.key === 'Backspace' || e.key === 'Delete')) {
        e.preventDefault();
    }
});
mobileInput.addEventListener('input', function (e) {
    let value = e.target.value;
    if (!value.startsWith('+92')) {
        value = '+92' + value.replace(/\D/g, '');
    }
    value = '+92' + value.substring(3).replace(/\D/g, '');
    value = value.replace(/^(\+920)/, '+92');
    if (value.length > 13) {
        value = value.substring(0, 13);
    }

    e.target.value = value;
});
</script>
<script>
document.getElementById('cnic').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.substring(0, 13);
    if (value.length > 5 && value.length <= 12)
        value = value.replace(/(\d{5})(\d{0,7})/, '$1-$2');
    else if (value.length > 12)
        value = value.replace(/(\d{5})(\d{7})(\d{0,1})/, '$1-$2-$3');
    e.target.value = value;
});
</script>
@endsection



