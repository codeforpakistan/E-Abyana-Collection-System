<?php if(count($grouped)): ?>
<table class="table table-bordered">
    <thead class="table-primary">
        <tr>
            <th>S.#</th>
            <th>Division Name</th>
            <th>Assessment of Kharif <?php echo e(request('session_year')); ?> (Acres)</th>
            <th>Assessment of Rabi <?php echo e(request('session_year')); ?> (Acres)</th>
            <th>Total Assessment <?php echo e(request('session_year')); ?> (Acres)</th>
            <th>Abyana Demand of Kharif <?php echo e(request('session_year')); ?> (Rs)</th>
            <th>Abyana Demand of Rabi <?php echo e(request('session_year')); ?> (Rs)</th>
            <th>Total Abyana <?php echo e(request('session_year')); ?> (Rs)</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division_id => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $division_name = $rows->first()->divsion_name;
                $kharif_area = $rows->firstWhere('crop_id', 2)?->total_acres ?? 0;
                $rabi_area   = $rows->firstWhere('crop_id', 1)?->total_acres ?? 0;
                $total_area  = $kharif_area + $rabi_area;

                $kharif_amount = $rows->firstWhere('crop_id', 2)?->total_abyana ?? 0;
                $rabi_amount   = $rows->firstWhere('crop_id', 1)?->total_abyana ?? 0;
                $total_amount  = $kharif_amount + $rabi_amount;
            ?>
            <tr>
                <td><?php echo e($i++); ?></td>
                <td><?php echo e($division_name); ?></td>
                <td><?php echo e(number_format($kharif_area, 2)); ?></td>
                <td><?php echo e(number_format($rabi_area, 2)); ?></td>
                <td><strong><?php echo e(number_format($total_area, 2)); ?></strong></td>
                <td><?php echo e(number_format($kharif_amount, 2)); ?></td>
                <td><?php echo e(number_format($rabi_amount, 2)); ?></td>
                <td><strong><?php echo e(number_format($total_amount, 2)); ?></strong></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php else: ?>
<p class="text-danger">No data available for selected filters.</p>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/Reports/PartialDemandReport.blade.php ENDPATH**/ ?>