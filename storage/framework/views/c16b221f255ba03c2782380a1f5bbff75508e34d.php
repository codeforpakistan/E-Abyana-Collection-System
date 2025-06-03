

<?php $__env->startSection('content'); ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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
                    <h4 class="font-weight-bold">Add New Canal</h4>
                    <button onclick="closeModal()" type="button" class="bg-white text-black h-[30px] w-[30px] rounded-[50px]">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('AddCanal/add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                    
                        <div class="row" style="margin-top:-30px;">
                            <div class="form-group col-4">
                                <label class="form-label" for="village_id">Select Village</label>
                                <select name="village_id" id="village_id" class="form-control" required>
                                    <option value="">Choose Village</option>
                                    <?php $__currentLoopData = $villages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $village): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($village->village_id); ?>"><?php echo e($village->village_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                    
                            <div class="form-group col-4">
                                <label class="form-label" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($divsion->id); ?>"><?php echo e($divsion->divsion_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Name of Canal</label>
                                <input class="form-control" type="text" name="canal_name" required>
                            </div>
                        </div>
                    
                        <div class="row" style="margin-top:-10px;">
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets</label>
                                <input class="form-control" type="text" name="no_outlet" required>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets (LS)</label>
                                <input class="form-control" type="text" name="no_outlet_ls" required>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">No. of Outlets (RS)</label>
                                <input class="form-control" type="text" name="no_outlet_rs" required>
                            </div>
                        </div>
                    
                        <div class="row" style="margin-top:-10px;">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of CCA</label>
                                <input class="form-control" type="text" name="total_no_cca" required>
                            </div>
                    
                            <div class="form-group col-lg-6">
                                <label class="form-label">Total No. of Discharge (Cusec)</label>
                                <input class="form-control" type="text" name="total_no_discharge_cusic" required>
                            </div>
                        </div>
                    
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
                        <h4><strong>Canal List</strong></h4>
                        <button onclick="openModal()" type="button" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add Canal
                        </button>
                    </div> 
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Canal</th>
                                        <th>Division Name</th>
                                        <th>No Of Outlet</th>
                                        <th>No. of Outlets (LS)</th>
                                        <th>No. of Outlets (RS)</th>
                                        <th>Total No. of CCA</th>
                                        <th>Total No. of Discharge (Cusec)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                        <?php $__currentLoopData = $canals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($canal->id); ?></td>
                                            <td><?php echo e($canal->canal_name); ?></td>
                                           
                                    
                                          <td><?php echo e($canal->division->divsion_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($canal->no_outlet); ?></td>
                                             <td><?php echo e($canal->no_outlet_ls); ?></td>
                                             <td><?php echo e($canal->no_outlet_rs); ?></td>
                                               <td><?php echo e($canal->total_no_cca); ?></td>
                                           <td><?php echo e($canal->total_no_discharge_cusic); ?></td>
                                           
                                            <td>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                
                                       
                                
                                </tbody> 
                            </table>
                            <div class="mt-3">
                                <?php echo e($canals->links()); ?>

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
    let modal = document.getElementById("simpleModal");
    modal.style.display = "flex"; // Show the modal
}

function closeModal() {
    let modal = document.getElementById("simpleModal");
    modal.style.display = "none"; // Hide the modal
}

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/e_abyana/resources/views/RegionManagments/AddCanal.blade.php ENDPATH**/ ?>