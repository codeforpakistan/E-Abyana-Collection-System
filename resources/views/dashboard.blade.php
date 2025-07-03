@extends('layout')

@section('content')
<div class="app-content">
    <section class="section">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

        <!-- Page Header -->
        <div class="page-header pt-0 mb-4">
            <h4 class="page-title text-primary">Dashboard</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" class="text-primary">Home / Dashboard</a>
                </li>
            </ol>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-users fa-2x text-success mb-2"></i>
                        <h5>Total Irrigators</h5>
                        <h3 class="text-success mt-2"><strong>{{ $totalIrrigators > 0 ? $totalIrrigators : 0 }}</strong></h3>
                    </div>
                </div>
            </div>
			<div class="col-md-6 col-xl-3 mb-4">
				<div class="card shadow border-0 rounded">
					<div class="card-body text-center">
						<i class="fa fa-coins fa-2x text-warning mb-2"></i>
						<h5>Billing Amount</h5>
						<h3 class="text-warning mt-2"><strong>RS: {{number_format($totalCropSurveyAmount, 1)}}</strong></h3>

					</div>
				</div>
			</div>
			

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-check-circle fa-2x text-success mb-2"></i>
                        <h5>Amount Collected</h5>
                        <h3 class="text-success mt-2"><strong>RS: 0</strong></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-clock fa-2x text-danger mb-2"></i>
                        <h5>Amount Pending</h5>
                        <h3 class="text-danger mt-2"><strong>RS: {{number_format($totalCropSurveyAmount, 1)}}</strong></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-tint fa-2x text-info mb-2"></i>
                        <h5>Total Outlets</h5>
                        <h3 class="text-info mt-2"><strong>{{ $totalOutlets > 0 ? $totalOutlets : 0 }}</strong></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-water fa-2x text-primary mb-2"></i>
                        <h5>Total Canals</h5>
                        <h3 class="text-primary mt-2"><strong>{{ $totalCanals > 0 ? $totalCanals : 0 }}</strong></h3>
                    </div>
                </div>
            </div>
			<div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-water fa-2x text-primary mb-2"></i>
                        <h5>Total Distributaries</h5>
                        <h3 class="text-primary mt-2"><strong>{{ $totalDistry > 0 ? $totalDistry : 0 }}</strong></h3>
                    </div>
                </div>
            </div>
			<div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-water fa-2x text-primary mb-2"></i>
                        <h5>Total Minors / Branches</h5>
                        <h3 class="text-primary mt-2"><strong>{{ $totalMinor > 0 ? $totalMinor : 0 }}</strong></h3>
                    </div>
                </div>
            </div>
          
        </div>

    </section>
</div>
@endsection
