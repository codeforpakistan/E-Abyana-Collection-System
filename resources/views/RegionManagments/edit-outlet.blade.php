@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ isset($outlet) ? 'Edit Outlet' : 'Add Outlet' }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($outlet) ? url('/outlets/update/'.$outlet->id) : url('/outlets/store') }}" method="POST">
                        @csrf
                        @if(isset($outlet))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="div_id">Division</label>
                                <select name="div_id" class="form-control" required>
                                    <option value="">Choose Division</option>
                                    @foreach($divsions as $division)
                                        <option value="{{ $division->id }}" {{ isset($outlet) && $outlet->div_id == $division->id ? 'selected' : '' }}>
                                            {{ $division->divsion_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="canal_id">Canal</label>
                                <select name="canal_id" class="form-control" required>
                                    <option value="">Choose Canal</option>
                                    @foreach($canals as $canal)
                                        <option value="{{ $canal->id }}" {{ isset($outlet) && $outlet->canal_id == $canal->id ? 'selected' : '' }}>
                                            {{ $canal->canal_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label for="minor_id">Minor Canal</label>
                                <select name="minor_id" class="form-control" required>
                                    <option value="">Choose Minor</option>
                                    @foreach($minors as $minor)
                                        <option value="{{ $minor->id }}" {{ isset($outlet) && $outlet->minor_id == $minor->id ? 'selected' : '' }}>
                                            {{ $minor->minor_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="distrib_id">Distributary</label>
                                <select name="distrib_id" class="form-control" required>
                                    <option value="">Choose Distributary</option>
                                    @foreach($Distributaries as $dist)
                                        <option value="{{ $dist->id }}" {{ isset($outlet) && $outlet->distrib_id == $dist->id ? 'selected' : '' }}>
                                            {{ $dist->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label>Name Outlet</label>
                                <input type="text" name="outlet_name" class="form-control" required value="{{ $outlet->outlet_name ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Total No. of CCA</label>
                                <input type="number" name="total_no_cca" class="form-control" required value="{{ $outlet->total_no_cca ?? '' }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label>Beneficiaries</label>
                                <input type="text" name="beneficiaries" class="form-control" required value="{{ $outlet->beneficiaries ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Total No. of Discharge (Cusec)</label>
                                <input type="number" name="total_no_discharge_cusic" class="form-control" required value="{{ $outlet->total_no_discharge_cusic ?? '' }}">
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fa fa-save"></i> {{ isset($outlet) ? 'Update' : 'Add' }} Outlet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
