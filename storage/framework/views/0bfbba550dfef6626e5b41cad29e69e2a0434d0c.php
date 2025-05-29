

<?php $__env->startSection('content'); ?>

    
    
<div class="app-content">
  
    <section class="section">
        <!--page-header open-->
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold">Irrigator</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color"></a></li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </div>
        <!--page-header closed-->

        <!--row open-->
      
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header">
                        <h4>Irrigator/</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action="<?php echo e(route('tehsil.delete')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        
                                          <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select-all"></th>
                                                    <th>#</th>
                                                    <th>Irrigator Nam/</th>
                                                    <th>Khata Number</th>
                                                    <th>Mobile Number</th>
                                           
                                                    <th>Village Name/حلقہ</th>
                                                    <th>Tehsil Name</th>
                                                    <th>District Name</th>
                                                    <th>Divsion</th>
        
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $Irrigators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Irrigator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><input type="checkbox" name="ids[]" value=""></td>
                                                    <td><?php echo e($Irrigator->id); ?></td>
                                                    <td><?php echo e($Irrigator->irrigator_name); ?></td>
                                                    <td><?php echo e($Irrigator->irrigator_khata_number); ?></td>
                                                    <td><?php echo e($Irrigator->irrigator_mobile_number); ?></td>
                                                    <td><?php echo e($Irrigator->village_name); ?></td>
                                                    <td><?php echo e($Irrigator->tehsil_name); ?></td>
                                                    <td><?php echo e($Irrigator->district_name); ?></td>
                                                    <td><?php echo e($Irrigator->divsion_name); ?></td>
                                                    
                                             
                                                    <td>
                                                        <button class="btn btn-sm btn-primary badge" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                      
                                    </fle>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div
    </section>
</div>       
 <?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/e_abyana/resources/views/ListIrrigator.blade.php ENDPATH**/ ?>