<?php $__env->startSection('content'); ?>
<head>
    ...
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <!--row open-->
      
      
 <div id="simpleModal" 
 class="fixed inset-0 top-[12%] bg-gray-400 bg-opacity-50 flex z-[9999] items-center justify-center hidden">
  
    <div class="card shadow-sm w-[60vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add User</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(url('AddUser/add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <!-- First Row (Name and CNIC) -->
                <div class="form-group row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name  
                        </label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email  
                        </label>
                        <input type="text" class="form-control" placeholder="Enter Email" name="email">
                    </div>
                 
                </div>
    
                <div class="form-group row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Password  
                        </label>
                        <input type="text" class="form-control" placeholder="Enter Password" name="password">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone Number  
                        </label>
                        <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label  for="role_id" class="form-label font-weight-bold">Select  Role</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option class="form-label font-weight-bold">Choose  Role</option>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                 
                 
                </div>
               
                <div class="row">
              <!--  <div class="form-group col-lg-3">
                        <label for="div_id" class="form-label font-weight-bold">Select Divsion/ڈویژن</label>
                        <select name="div_id" id="div_id" class="form-control" onchange="get_districts(this)">
                            <option class="form-label font-weight-bold value=">Choose Division/ڈویژن</option>
                            <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($divsion->id); ?>"><?php echo e($divsion->divsion_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div> -->
                    <div class="form-group col-lg-4">
                        <label class="form-label font-weight-bold" for="district_id">Select District/ضلع</label>
                        <select name="district_id" id="district_id" class="form-control" onchange="get_tehsils(this)">
                            <option value="">Choose district</option>
                            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($district->id); ?>"><?php echo e($district->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>                                
                    </div>
                 
                    <div class="form-group col-lg-4">
                        <label class="form-label font-weight-bold" for="tehsil_id">Select Tehsil/تحصیل</label>
                        <select name="tehsil_id" id="tehsil_id" class="form-control" onchange="get_halqa(this)">
                            <option value="">Choose Tehsil</option>
                            <?php $__currentLoopData = $tehsils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tehsil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tehsil->tehsil_id); ?>"><?php echo e($tehsil->tehsil_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-4">
                    <label class="form-label font-weight-bold" for="halqa_id" style="">Select Halqa/حلقہ</label>
                        <select name="halqa_id" id="halqa_id" class="form-control">
                            <option value="">Choose Halqa/حلقہ</option>
                        </select>
                    </div>
                </div>
            
               <!--  <div class="form-group row">
                <div class="col-md-3 mb-3">
                        <label class="form-label font-weight-bold" for="halqa_id" style="">Select Halqa/حلقہ</label>
                        <select name="halqa_id" id="halqa_id" class="form-control form-control-lg" required style="font-size: 1.1rem; padding: 0.5rem 1rem; line-height: 1.5;">
                            <option value="" style="font-weight: bold;">Choose Halqa/حلقہ</option>
                            <?php $__currentLoopData = $Halqas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Halqa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($Halqa->id); ?>"><?php echo e($Halqa->halqa_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    </div>
                Second Row (Skills) -->
              
                
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
    <h4><strong>System Users List</strong></h4>
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
                                             <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Phone Number</th>
                                           <!-- <th>User Password</th> -->
                                            <th>Role Name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                         
                                <ul>
                                    <?php $__currentLoopData = $usersWithRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usersWithRole): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($usersWithRole->id); ?></td>
                                          <td><?php echo e($usersWithRole->user_name); ?></td>

                                            <td><?php echo e($usersWithRole->email); ?></td>
                                             <td><?php echo e($usersWithRole->phone_number); ?></td>
                                                 <td><?php echo e($usersWithRole->role_name ?? 'No role assigned'); ?></td>
                                              <td>
                                                <form
                                                action="<?php echo e(route('AddUser.destroy', $usersWithRole->id)); ?>"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
                                                style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            

                                                        <button class="btn btn-sm btn-primary badge rounded-pill" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                            </form>
                                            <a href="<?php echo e(route('edit.user', $usersWithRole->id)); ?>" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Edit</a> 
                                              </td>
                                                  
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                                              </ul>
                                        

                                </tbody>
                                </table>
                                
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
//******************************************************************************* */
function get_districts(element) {
        var divisionId = element.value; // Get the selected value

        if (divisionId) {
            // Make an AJAX request to fetch districts based on the selected division
            $.ajax({
                url: '/get-districts/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Clear the district dropdown and add a placeholder option
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Choose District</option>');

                    // Populate the district dropdown with the data received
                    $.each(data, function (key, value) {
                        $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching districts:', error);
                }
            });
        } else {
            // Reset the district dropdown if no division is selected
            $('#district_id').empty();
            $('#district_id').append('<option value="">Choose District</option>');
        }
    }
function get_tehsils(element) {
    var districtId = element.value; 
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
function get_halqa(element) {
        var tehsilId = element.value; 
        console.log(tehsilId);

        if (tehsilId) {
          
            $.ajax({
                url: '/halqa_for_users/' + tehsilId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
    
                    $('#halqa_id').empty();
                    $('#halqa_id').append('<option value="">Choose Halqa</option>');

                  
                    $.each(data, function (key, value) {
                        $('#halqa_id').append('<option value="' + value.id + '">' + value.halqa_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        } else {
           
            $('#halqa_id').empty();
            $('#halqa_id').append('<option value="">Choose Halqa</option>');
        }
    }
    </script>

    
    <script> <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</script>
</div>             
 <?php $__env->stopSection(); ?>
 
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/UserManagement/AddUser.blade.php ENDPATH**/ ?>