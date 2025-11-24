@extends('layout')

@section('content')

<div class="app-content py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 700px;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Village</h4>
        </div>

        <div class="card-body">
<form action="{{ route('village.update', $village->village_id) }}" method="POST">
    @csrf
    @method('PUT')

                <div class="row mb-3">

                    <div class="col-6">
                        <label for="halqa_id" class="form-label font-weight-bold">Select Halqa</label>
                        <select name="halqa_id" id="halqa_id" class="form-control" required>
                            <option value="">Choose Halqa</option>
                            @foreach($halqas as $halqa)
                                <option value="{{ $halqa->id }}" {{ $halqa->id == $village->halqa_id ? 'selected' : '' }}>
                                    {{ $halqa->halqa_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                <div class="col-6">
                    <label for="halqa_name" class="form-label font-weight-bold">Village Name</label>
                    <input type="text" name="village_name" id="village_name" class="form-control" value="{{ $village->village_name }}" required>
                </div>
                </div>
                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Update Village
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


