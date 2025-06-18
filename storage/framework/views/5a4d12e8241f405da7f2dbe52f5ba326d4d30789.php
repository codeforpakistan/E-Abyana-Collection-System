<?php $__env->startSection('content'); ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="app-content">
    <section class="section">

        
        <?php if(session('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "<?php echo e(session('success')); ?>",
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "<?php echo e(session('error')); ?>",
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold">Edit District</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit District</li>
            </ol>
        </div>

        <!-- Centered Form Row -->
        <div class="row justify-content-center" style="margin-top: 80px;">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="font-weight-bold mb-0">Edit District</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                        
                            <div class="row">
                                <!-- Division Selection -->
                                <div class="form-group col-6">
                                    <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                    <select name="div_id" id="div_id" class="form-control" required onchange="get_districts(this)">
                                        <option value="">Choose Division / ڈویژن</option>
                                        <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($divsion->id); ?>" <?php echo e($divsion->id == $tehsil->div_id ? 'selected' : ''); ?>>
                                                <?php echo e($divsion->divsion_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                        
                                <!-- District Selection -->
                                <div class="form-group col-6">
                                    <label class="form-label font-weight-bold" for="district_id">Select District / ضلع</label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="">Choose District / ضلع</option>
                                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($district->id); ?>" <?php echo e($district->id == $tehsil->district_id ? 'selected' : ''); ?>>
                                                <?php echo e($district->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                        
                                <!-- Tehsil Name -->
                                <div class="form-group col-lg-12">
                                    <label class="form-label font-weight-bold">Tehsil Name / نام تحصیل</label>
                                    <input class="form-control form-control-lg" type="text" name="tehsil_name" value="<?php echo e($tehsil->tehsil_name); ?>" required>
                                </div>
                            </div>
                        
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-success btn-lg">Update</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/e_abyana/resources/views/RegionManagments/edit-tehsil.blade.php ENDPATH**/ ?>