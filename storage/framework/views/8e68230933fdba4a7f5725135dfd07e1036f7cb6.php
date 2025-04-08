<?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($divsion->id); ?></td>
    <td><?php echo e($divsion->divsion_name); ?></td>
    <td>
        <form action="<?php echo e(route('AddDivsion.destroy', $divsion->id)); ?>" method="POST"
            onsubmit="return confirm('Are you sure?');" style="display: inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn btn-sm btn-primary badge rounded-pill" type="submit">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/E-Abyana-Collection-System/resources/views/partials/divsion_data.blade.php ENDPATH**/ ?>