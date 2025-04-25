

<?php $__env->startSection('content'); ?>


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

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->


<div class="app-content">
<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
    <div class="card shadow-sm w-[40vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Halqa</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(url('AddHalqa/add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
            
                <div class="row">
                    <!-- District Dropdown with Select2 -->
                    <div class="form-group col-4">
                        <label class="form-label font-weight-bold" for="district_id">Select District/ضلع</label>
                        <select name="district_id" id="district_id" class="form-control select2" required onchange="get_tehsils(this)">
                            <option value="">Choose District</option>
                            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($district->id); ?>"><?php echo e($district->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>                                
                    </div>
            
                    <!-- Tehsil Dropdown -->
                    <div class="form-group col-8">
                        <label class="form-label font-weight-bold" for="tehsil_id">Select Tehsil/تحصیل</label>
                        <select name="tehsil_id" id="tehsil_id" class="form-control" required>
                            <option value="">Choose Tehsil</option>
                        </select>
                    </div>
            
                    <!-- Halqa Name Input -->
                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Halqa Name/حلقہ</label>
                        <input class="form-control form-control-lg" type="text" name="halqa_name" required>
                    </div>
                </div>
            
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
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                     <div class="card-header d-flex justify-content-between">
    <h4><strong>Halqa List</strong></h4>
    <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter">
        <i class="fa fa-plus"></i> </button>
</div> 
                    <div class="card-body">
                        <div class="table-responsive">
                            <form id="districtDeleteForm" action="<?php echo e(route('district.delete')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                
                                <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>ID</th>
                                            <th>Halqa Name/حلقہ</th>
                                            <th>Tehsil Name</th>
                                            <th>District Name</th>
                                            <th>Division</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $halqas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $halqa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" value="<?php echo e($halqa->id); ?>"></td>
                                            <td><?php echo e($halqa->id); ?></td>
                                            <td><?php echo e($halqa->halqa_name); ?></td>
                                            <td><?php echo e($halqa->tehsil_name); ?></td>
                                            <td><?php echo e($halqa->district_name); ?></td>
                                            <td><?php echo e($halqa->divsion_name); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" type="submit">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    
                                </table>
                                <?php echo e($halqas->links()); ?>


                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>

    <?php if(Session::has('success')): ?>
        <script>
            swal({
                title: "Success!",
                text: "<?php echo e(Session::get('success')); ?>",
                icon: "success",
                button: "OK",
            });
            
        </script>
    <?php endif; ?>

    <script>
    function get_tehsils(element) {
        var districtId = element.value; // Get the selected district ID
        console.log(districtId);

        if (districtId) {
            // Make an AJAX request to fetch tehsils based on the selected district
            $.ajax({
                url: '/get-tehsils/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Clear the Tehsil dropdown and add a placeholder option
                    $('#tehsil_id').empty();
                    $('#tehsil_id').append('<option value="">Choose Tehsil</option>');

                    // Populate the Tehsil dropdown with the received data
                    $.each(data, function (key, value) {
                        $('#tehsil_id').append('<option value="' + value.tehsil_id + '">' + value.tehsil_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        } else {
            // Reset the Tehsil dropdown if no district is selected
            $('#tehsil_id').empty();
            $('#tehsil_id').append('<option value="">Choose Tehsil</option>');
        }
    }
    /**************************************************************/
        function confirmDelete(districtId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This district cannot be deleted because it is associated with other records, such as tehsils. Please remove any linked records before attempting to delete this district.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteDistrict(districtId);
                }
            });
        }
    
        function deleteDistrict(districtId) {
            fetch(`<?php echo e(route('district.delete')); ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    ids: { [districtId]: districtId }
                })
            }).then(response => {
                if (!response.ok) {
                    throw response;
                }
                return response.json();
            }).then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The district has been deleted.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            }).catch(error => {
                error.json().then(errorData => {
                    if (errorData.errorCode === 1451) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Deletion Error',
                            text: errorData.error,
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        }
    </script>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</div>         
 <?php $__env->stopSection(); ?>
 <script>
  
</script>

 <!-- CSS -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
 
 <!-- Initialize Select2 -->
 <script>
     $(document).ready(function() {
         $('.select2').select2({
             placeholder: "Choose District",
             allowClear: true
         });
     });
 </script>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eabyanairrigdc/public_html/resources/views/RegionManagments/AddHalqa.blade.php ENDPATH**/ ?>