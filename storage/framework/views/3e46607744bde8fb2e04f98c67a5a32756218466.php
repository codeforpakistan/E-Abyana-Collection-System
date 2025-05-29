
<?php $__env->startSection('content'); ?>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #example th {
        padding: 4px !important;
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
</style>
</head>
<div class="app-content">
    <section class="section">
        <?php if(session('success')): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "<?php echo e(session('success')); ?>",
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "<?php echo e(session('error')); ?>",
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header">
                        <h2><strong>Bill Approval List</strong></h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="button-container">
                                <button id="check-all" class="btn btn-warning btn-sm"><strong>Check All</strong></button>
                                <button id="approve-selected" class="btn btn-success btn-sm" style="display: none;"><i class="side-menu__icon fas fa-check"></i><strong>Approve All</strong></button>
                            </div>
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                <thead class="table-primary text-center align-middle">
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Irrigator Name</th>
                                        <th>Khata #</th>
                                        <th>Village</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $grouped_survey_bill_eligible; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $irrigator_id => $irrigator_surveys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" class="irrigator-checkbox" value="<?php echo e($irrigator_surveys->irrigator_id); ?>">
                                            </td>
                                            <td class="text-center align-middle"><?php echo e($irrigator_surveys->irrigator_id); ?></td>
                                            <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->irrigator_name); ?></strong></td>
                                            <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->irrigator_khata_number); ?></strong></td>
                                            <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->village_name); ?></strong></td>
                                            <td class="text-center align-middle"><strong><?php echo e($irrigator_surveys->total_bill_amount); ?></strong></td>
                                            <td class="text-center align-middle">
                                                <a href="<?php echo e(url('survey_bill/approve/view')); ?>/<?php echo e($irrigator_surveys->irrigator_id); ?>">
                                                    <button class="btn btn-warning btn-sm" type="button" title="Bill">
                                                        <i class="fas fa-eye"></i> View</button>
                                                </a>
                                                <a href="<?php echo e(url('survey_bill/approve')); ?>/<?php echo e($irrigator_surveys->irrigator_id); ?>">
                                                    <button class="btn btn-primary btn-sm" type="button" title="Bill">
                                                        <i class="fas fa-check"></i> Approve</button>
                                                </a>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkAllButton = document.getElementById('check-all');
        const approveSelectedButton = document.getElementById('approve-selected');
        const checkboxes = document.querySelectorAll('.irrigator-checkbox');

        checkAllButton.addEventListener('click', function () {
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
            checkAllButton.textContent = allChecked ? 'Check All' : 'Uncheck All';
            toggleApproveButton();
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleApproveButton);
        });

        function toggleApproveButton() {
            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            approveSelectedButton.style.display = anyChecked ? 'inline-block' : 'none';
        }

        approveSelectedButton.addEventListener('click', function () {
            const selectedIrrigators = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedIrrigators.length === 0) {
                Swal.fire('Error', 'No irrigators selected!', 'error');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to approve selected records!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("<?php echo e(route('survey_bill.approve_multiple')); ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                        },
                        body: JSON.stringify({ irrigator_ids: selectedIrrigators })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    });
                }
            });
        });
    });
</script>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/e_abyana/resources/views/LandRecord/ListIrrigatorsApprovalName.blade.php ENDPATH**/ ?>