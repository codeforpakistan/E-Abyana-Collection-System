
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
            
            <th>Irrigator Name</th>
            <th>Khata #</th>
            <th>Crop Surveys</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $grouped_survey; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $irrigator_id => $irrigator_surveys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                
                <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->first()->irrigator_name); ?></strong></td>
                <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->first()->irrigator_khata_number); ?></strong></td>
                <td>
                    
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Village</th>
                                
                                <th>Date</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $irrigator_surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $survey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($survey->village_name); ?></td>
                                    <td><?php echo e($survey->crop_name); ?></td>
                                    <td><?php echo e($survey->final_crop); ?></td>
                                    <td><?php echo e($survey->crop_price); ?></td>
                                    <td><?php echo e($survey->date); ?></td>
                                    
                                    <td class="align-middle text-center">
                                        <a href="<?php echo e(url('survey/view')); ?>/<?php echo e($survey->crop_survey_id); ?>">
                                            <button class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></button>
                                        </a>
                                        
                                        <?php if(session('role_id') == 1): ?>
                                            <form action="<?php echo e(route('landservey.destroy', $survey->crop_survey_id)); ?>"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
                                                  style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                                            </form>
                                        <?php endif; ?>
                        
                                        <a href="<?php echo e(url('survey/patwari/forward')); ?>/<?php echo e($survey->crop_survey_id); ?>">
                                            <button class="btn btn-warning btn-sm" title="Forward"><i class="fa fa-arrow-right"></i></button>
                                        </a>
                        
                                        <a href="<?php echo e(route('edit.survey', $survey->crop_survey_id)); ?>" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eabyanairrigdc/public_html/resources/views/LandRecord/ListLandSurvey.blade.php ENDPATH**/ ?>