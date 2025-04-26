

<?php $__env->startSection('content'); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $__env->stopPush(); ?>
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
<div id="simpleModal" class="fixed inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
            <div class="card shadow-sm w-[60vw]">
                <div class="card-header bg-primary flex justify-between text-white">
                    <h4 class="font-weight-bold">Add Distributary Canal</h4>
                    <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('Distributary/add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row" style="margin-top:-30px;">
                            <!-- Division Selection -->
                            <div class="form-group col-3">
                                <label class="form-label" for="div_id">Division / ڈویژن</label>
                                <!-- select_search -->
                                <select name="div_id" id="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($divsion->id); ?>"><?php echo e($divsion->divsion_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <!-- Canal Selection -->
                            <div class="form-group col-3">
                                <label class="form-label" for="canal_id">Canal / نہر</label>
                                <select name="canal_id" id="canal_id" class="form-control" required>
                                    <option value="">Choose Canal / نہر</option>
                                    <?php $__currentLoopData = $canals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($canal->id); ?>"><?php echo e($canal->canal_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                            <div class="form-group col-3">
                                <label class="form-label" for="minor_id">Minor Canal / چھوٹا نہر</label>
                                <select name="minor_id" id="minor_id" class="form-control" required>
                                    <option value="">Choose Minor Canal</option>
                                    <?php $__currentLoopData = $minors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $minor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($minor->id); ?>"><?php echo e($minor->minor_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div> 
                            <div class="form-group col-3">
                                <label class="form-label">Distributary Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                    
                        <div class="row" style="margin-top:-10px;">
                            <!-- No. of Outlets -->
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets</label>
                                <input class="form-control" type="number" name="no_outlet" required>
                            </div>
                            
                            <!-- No. of Outlets (Left Side) -->
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets (Left Side)</label>
                                <input class="form-control" type="number" name="no_outlet_ls" required>
                            </div>
                            <!-- No. of Outlets (Right Side) -->
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets (Right Side)</label>
                                <input class="form-control" type="number" name="no_outlet_rs" required>
                            </div>
                        </div>
                    
                        <div class="row" style="margin-top:-10px;">
                            <!-- Total No. of CCA -->
                            <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of CCA</label>
                                <input class="form-control" type="number" name="total_no_cca" required>
                            </div>
                              <!-- Total No. of Discharge (Cusec) -->
                              <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of Discharge (Cusec)</label>
                                <input class="form-control" type="number" name="total_no_discharge_cusic" required>
                            </div>
                        </div>
                    
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                        <h4><strong>Distributary List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name Distributary</th>
                                        <th>Division Name</th>
                                        <th>Canal Name</th>
                                        <th>Minor Name</th>
                                        <th>No Of Outlet</th>
                                        <th>No. of Outlets (Left Side)</th>
                                        <th>No. of Outlets (Right Side)</th>
                                        <th>Total No. of CCA</th>
                                        <th>Total No. of Discharge (Cusec)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    <?php if($canal->count()): ?>
                                        <?php $__currentLoopData = $Distributaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($canal->id); ?></td>
                                            <td><?php echo e($canal->name); ?></td>
                                            <td><?php echo e($canal->division->divsion_name ?? 'N/A'); ?></td>
                                            <td>
                                                <?php if($canal->canal): ?>
                                                    <?php echo e($canal->canal->canal_name); ?>

                                                <?php else: ?>
                                                    <strong style="color:red;">No Canal Found</strong>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($canal->minor->minor_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($canal->no_outlet); ?></td>
                                             <td><?php echo e($canal->no_outlet_ls); ?></td>
                                             <td><?php echo e($canal->no_outlet_rs); ?></td>
                                               <td><?php echo e($canal->total_no_cca); ?></td>
                                           <td><?php echo e($canal->total_no_discharge_cusic); ?></td>

                                            <td>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                                <a href="<?php echo e(route('editdist', $canal->id)); ?>" class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No data available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody> 
                            </table>
                          
                            
                           
                            <div class="mt-3">
                                <?php echo e($Distributaries->links()); ?>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function openModal() {
    document.getElementById("simpleModal").classList.remove("hidden");
}
function closeModal() {
    document.getElementById("simpleModal").classList.add("hidden");
}
</script>
<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#div_id').change(function() {
            var div_id = $(this).val();
            console.log("Selected Division ID:", div_id); // Debugging Step

            if (div_id) {
                $.ajax({
                    url: "<?php echo e(route('getdistributary')); ?>",
                    type: "GET",
                    data: { div_id: div_id },
                    dataType: "json",
                    success: function(data) {
                        console.log("Fetched Canals:", data); // Debugging Step
                        $('#canal_id').empty().append('<option value="">Choose Canal</option>');

                        $.each(data, function(index, canal) {
                            $('#canal_id').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching canals:", error);
                    }
                });
            } else {
                $('#canal_id').empty().append('<option value="">Choose Canal</option>');
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#canal_id').change(function() {
            var canal_id = $(this).val();
            console.log("Selected Canal ID:", canal_id); // Debugging Step

            if (canal_id) {
                $.ajax({
                    url: "<?php echo e(route('getMinors')); ?>",
                    type: "GET",
                    data: { canal_id: canal_id },
                    dataType: "json",
                    success: function(data) {
                        console.log("Fetched Minor Canals:", data); // Debugging Step
                        $('#minor_id').empty().append('<option value="">Choose Minor Canal</option>');

                        $.each(data, function(index, minor) {
                            $('#minor_id').append('<option value="' + minor.id + '">' + minor.minor_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching minors:", error);
                    }
                });
            } else {
                $('#minor_id').empty().append('<option value="">Choose Minor Canal</option>');
            }
        });
    });
</script>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/RegionManagments/Distributary.blade.php ENDPATH**/ ?>