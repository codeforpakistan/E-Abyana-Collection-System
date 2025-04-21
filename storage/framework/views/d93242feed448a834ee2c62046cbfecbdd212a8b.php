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
  
    <section class="section">
       


<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
    <div class="card shadow-sm w-[40vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Crop Price</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">
           
 <form class="form-horizontal" action="<?php echo e(url('Addprice/add')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    
    <!-- First Row (Name and CNIC) -->
    <div class="row">
        <div class="form-group col-lg-12">
            <label class="form-label font-weight-bold">Crop Price</label>
            <input class="form-control form-control-lg" type="text" name="crop_price" required>
        </div>
        
     
    </div>
    <div class="row">
        <div class="form-group col-lg-12">
            <label class="form-label font-weight-bold">Crop Name</label>
            <input class="form-control form-control-lg" type="text" name="final_crop" required>
        </div>
        
     
    </div>
   
    
    <!-- Second Row (Skills) -->
  
    
    <!-- Submit Button -->
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
    </div>

</form>
      
        </div>
    </div>
</div> 





        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
 <div class="card-header d-flex justify-content-between">
    <h4><strong>Crop Price List</strong></h4>
    <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter">
        <i class="fa fa-plus"></i> </button>
</div> 
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                
                                <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>ID</th>
                                            <th>Crop Price</th>
                                            <th>Final Crop</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $Cropprice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cropprice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" value=""></td>
                                            <td><?php echo e($cropprice->id); ?></td>
                                            <td><?php echo e($cropprice->crop_price); ?></td>
                                            <td><?php echo e($cropprice->final_crop); ?></td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="<?php echo e(route('cropprice.edit', $cropprice->id)); ?>" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                
                        
                                                <!-- Delete Button -->
                                                <button class="btn btn-sm btn-primary" type="submit">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
</div>
    </section>
</div>


              
 <?php $__env->stopSection(); ?>




<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/E-Abyana-Collection-System/resources/views/RegionManagments/Addprice.blade.php ENDPATH**/ ?>