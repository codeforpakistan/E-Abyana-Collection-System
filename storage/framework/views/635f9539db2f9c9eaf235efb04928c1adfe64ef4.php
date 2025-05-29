

<?php $__env->startSection('content'); ?>
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
                        <h3 class="text-success">20,000</h3>
                    </div>
                </div>
            </div>
			<div class="col-md-6 col-xl-3 mb-4">
				<div class="card shadow border-0 rounded">
					<div class="card-body text-center">
						<i class="fa fa-coins fa-2x text-warning mb-2"></i> 
						<h5>Total Payments</h5>
						<h3 class="text-warning">PKR 200,000</h3>

					</div>
				</div>
			</div>
			

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-check-circle fa-2x text-success mb-2"></i>
                        <h5>Payments Collected</h5>
                        <h3 class="text-success">100,000</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-clock fa-2x text-danger mb-2"></i>
                        <h5>Payments Pending</h5>
                        <h3 class="text-danger">100,000</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-tint fa-2x text-info mb-2"></i>
                        <h5>Total Outlets</h5>
                        <h3 class="text-info">30,000</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-water fa-2x text-primary mb-2"></i>
                        <h5>Total Canals</h5>
                        <h3 class="text-primary">100</h3>
                    </div>
                </div>
            </div>
			<div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-water fa-2x text-primary mb-2"></i>
                        <h5>Total Minors Canals</h5>
                        <h3 class="text-primary">200</h3>
                    </div>
                </div>
            </div>
			<div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0 rounded">
                    <div class="card-body text-center">
                        <i class="fa fa-water fa-2x text-primary mb-2"></i>
                        <h5>Total Distributaries Canals</h5>
                        <h3 class="text-primary">200</h3>
                    </div>
                </div>
            </div>
          
        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/e_abyana/resources/views/dashboard.blade.php ENDPATH**/ ?>