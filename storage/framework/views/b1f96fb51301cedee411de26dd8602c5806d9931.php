

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "<?php echo e(session('success')); ?>",
                confirmButtonText: 'OK'
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php if(session('error')): ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "<?php echo e(session('error')); ?>",
                confirmButtonText: 'OK'
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="app-content">
<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
    <div class="card shadow-sm w-[60vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Tehsil</h4>
            <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(url('AddTahsil/add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-6">
                        <label class="form-label font-weight-bold" for="div_id">Select Division/ڈویژن</label>
                        <select name="div_id" id="div_id" class="form-control" required onchange="get_districts(this)">
                            <option value="">Choose Division/ڈویژن</option>
                            <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($divsion->id); ?>"><?php echo e($divsion->divsion_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label class="form-label font-weight-bold" for="district_id">Select District/ضلع</label>
                        <select name="district_id" id="district_id" class="form-control" required>
                            <option value="">Choose District/ضلع</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Name Tehsil / نام تحصیل</label>
                        <input class="form-control form-control-lg" type="text" name="tehsil_name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header d-flex justify-content-between">
                        <h4><strong>Tehsil List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="<?php echo e(route('tehsil.delete')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <table id="example" class="table table-bordered key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>ID</th>
                                            <th>Name Division / نام ڈویژن</th>
                                            <th>District Name / نام ضلع</th>
                                            <th>Tehsil Name / نام تحصیل</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $tehsils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tehsil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" value="<?php echo e($tehsil->tehsil_id); ?>"></td>
                                                <td><?php echo e($tehsil->tehsil_id); ?></td>
                                                <td><?php echo e($tehsil->district->division->divsion_name); ?></td>
                                                <td><?php echo e($tehsil->district->name); ?></td>
                                                <td><?php echo e($tehsil->tehsil_name); ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" type="submit">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <?php echo e($tehsils->links()); ?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function get_districts(element) {
            var divisionId = element.value;

            if (divisionId) {
                $.ajax({
                    url: '/get-districts/' + divisionId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#district_id').empty().append('<option value="">Choose District</option>');
                        $.each(data, function (key, value) {
                            $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching districts:', error);
                    }
                });
            } else {
                $('#district_id').empty().append('<option value="">Choose District</option>');
            }
        }
    </script>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eabyanairrigdc/public_html/resources/views/RegionManagments/AddTahsil.blade.php ENDPATH**/ ?>