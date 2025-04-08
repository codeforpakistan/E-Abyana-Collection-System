<?php $__env->startSection('content'); ?>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #example th{
        padding: 4px !important;
    }
</style>
</head>
<div class="app-content">
    <section class="section">
    <div class="row">
      <div class="col-md-12">
      <div class="card export-database">
      <div class="card-header">
      <h3><strong>Survey List</strong></h3>
      <!-- <p>Halqa ID: <?php echo e(session('halqa_id')); ?></p> -->
      </div>
      <div class="card-body">
      <div class="table-responsive">
      <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
    <thead class="table-primary text-center align-middle">
        <tr>
            <th>ID</th>
            <th>Irrigator Name</th>
            <th>Khata #</th>
            <th>Crop Surveys</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $grouped_survey; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $irrigator_id => $irrigator_surveys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center align-middle"><?php echo e($irrigator_surveys->first()->irrigator_id); ?></td>
                <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->first()->irrigator_name); ?></strong></td>
                <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->first()->irrigator_khata_number); ?></strong></td>
                <td>
                    
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Village</th>
                                <th>Farmer</th>
                                <th>Crop</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>Length</th>
                                <th>Width</th>
                                <th>Marla</th>
                                <th>Kanal</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $irrigator_surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $survey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($survey->village_name); ?></td>
                                    <td><?php echo e($survey->cultivators_info); ?></td>
                                    <td><?php echo e($survey->final_crop); ?></td>
                                    <td><?php echo e($survey->crop_price); ?></td>
                                    <td><?php echo e($survey->date); ?></td>
                                    <td><?php echo e($survey->length); ?></td>
                                    <td><?php echo e($survey->width); ?></td>
                                    <td><?php echo e($survey->area_marla); ?></td>
                                    <td><?php echo e($survey->area_kanal); ?></td>
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
      </div>
      </div>
      </div>
      </div>
    </div> 
</section>  
</div>    
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/E-Abyana-Collection-System/resources/views/LandRecord/listforwardedpatwari.blade.php ENDPATH**/ ?>