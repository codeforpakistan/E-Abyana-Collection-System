

<?php $__env->startSection('content'); ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .customLegend {
        border: 1px solid #e4e4e4;
        position: relative;
        padding-left:6px;
        padding-right:6px;
    }
    .customLegend legend {
        border: 0;
        background: #fff;
        width: auto;
        color: #6610f2;
        transform: translateY(-50%);
        position: absolute;
        top: 0;
        left: 1em;
        padding: 0 1px;
    }
    </style>
</head>
<div class="app-content">
    <section class="section">
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    <h4><strong>Edit Survey Details</strong></h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <fieldset class="customLegend">
                            <legend><strong>Land Survey / خسرہ گرداوری</strong></legend>
                            <div class="row">
                             
                                <div class="form-group col-lg-4">
                                    <label class="form-label font-weight-bold" for="village_id">Select Village/گاؤں</label>
                                    <select name="village_id" id="village_id" class="form-control" required>
                                        <option value="">Choose Village/گاؤں</option>
                                        <?php $__currentLoopData = $villages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $village): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($village->village_id); ?>" <?php echo e(old('village_id', $survey->village_id) == $village->village_id ? 'selected' : ''); ?>>
                                                <?php echo e($village->village_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="form-label">Crop/فصل</label>
                                    <select name="crop_id" id="crop_id" class="form-control" required>
                                        <option class="form-label font-weight-bold" value="">Choose</option>
                                        <?php $__currentLoopData = $crops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($crop->crop_id); ?>" <?php echo e(old('crop_id', $survey->crop_id) == $village->id ? 'selected' : ''); ?>>
                                                <?php echo e($crop->crop_name); ?></option> <!-- Ensure you're using the correct field names -->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="customLegend">
                            <legend><strong>Farmer & Land Registration Form</strong></legend>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Khasra Assessment Number</label>
                                    <input class="form-control" type="text" name="khasra_number" value="<?php echo e($survey->khasra_number); ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Irrigator Name</label>
                                    <input class="form-control" type="text" name="irrigator_name" value="<?php echo e($survey->irrigator_name); ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Tenant Name</label>
                                    <input class="form-control" type="text" name="tenant_name" value="<?php echo e($survey->tenant_name); ?>">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="customLegend">
                            <legend><strong>Crop Type Registration</strong></legend>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Land Assessment Marla</label>
                                    <input class="form-control" type="text" name="land_assessment_marla" value="<?php echo e($survey->land_assessment_marla); ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Land Assessment Kanal</label>
                                    <input class="form-control" type="text" name="land_assessment_kanal" value="<?php echo e($survey->land_assessment_kanal); ?>">
                                </div>
                                <div class="col-md-12 mb-12">
                                    <label class="form-label font-weight-bold"><Previous Crop Name with Grade / نام جنس جو پہلے بوئی گئی بمعہ درجہ</label>
                                    <select name="previous_crop" id="previous_crop" class="form-control">
                                        <option class="form-label font-weight-bold" value="">Choose Crop/فصل</option>
                                        <?php $__currentLoopData = $cropprice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($crop->final_crop); ?>" <?php echo e(old('crop_id', $survey->crop_id) == $village->id ? 'selected' : ''); ?>>
                                                <?php echo e($crop->final_crop); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            

                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="customLegend">
                            <legend><strong>Final Measurement</strong></legend>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Date</label>
                                    <input class="form-control" type="text" name="date" value="<?php echo e($survey->date); ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Length</label>
                                    <input class="form-control" type="text" name="length" value="<?php echo e($survey->length); ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label font-weight-bold">Width</label>
                                    <input class="form-control" type="text" name="width" value="<?php echo e($survey->width); ?>">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Update Survey</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/LandRecord/edit-servey.blade.php ENDPATH**/ ?>