

<?php $__env->startSection('content'); ?>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add Irrigator</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="add-irrigator-form" action="<?php echo e(url('AddIrragtor/add')); ?>" method="POST" class="form-horizontal">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <?php if(session('halqa_id') <= 0): ?>
                        <div class="form-group col-lg-6">
                            <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                             <!-- .select_search  - class for dropdown searching in div_id-->
                            <select name="div_id" id="div_id" class="form-control" required>
                                <option value="">Choose Division / ڈویژن</option>
                                <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($divsion->id); ?>"><?php echo e($divsion->divsion_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label  class="form-label font-weight-bold" for="canal_id">Select Canal/ضلع</label>
                            <select name="canal_id" id="canal_id" class="form-control" >
                                <option value="">Choose Canal/گاؤں</option>
                                <?php $__currentLoopData = $canals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($canal->id); ?>"><?php echo e($canal->canal_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label font-weight-bold" for="district_id">Select
                                District/ضلع</label>
                            <select name="district_id" id="district_id" class="form-control"
                                onchange="get_tehsils(this)">
                                <option value="">Choose District</option>
                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($district->id); ?>"><?php echo e($district->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="form-label font-weight-bold" for="tehsil_id">Select
                                Tehsil/تحصیل</label>
                            <select name="tehsil_id" id="tehsil_id" class="form-control"
                                onchange="get_halqa(this)">
                                <option value="">Choose Tehsil</option>
                                <?php $__currentLoopData = $tehsils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tehsil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tehsil->tehsil_id); ?>"><?php echo e($tehsil->tehsil_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                        <label class="form-label font-weight-bold" for="halqa_id">Select Halqa/حلقہ</label>
                        <select name="halqa_id" id="halqa_id" class="form-control"
                                onchange="get_village(this)">
                                <option value="">Choose Halqa/حلقہ</option>
                                <?php $__currentLoopData = $Halqas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Halqa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($Halqa->id); ?>"><?php echo e($Halqa->halqa_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label font-weight-bold" for="village_id">Select
                                Village / گاؤں</label>
                            <select name="village_id" id="village_id" class="form-control">
                                <option value="">Choose Village/گاؤں</option>
                                <?php $__currentLoopData = $villages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $village): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($village->village_id); ?>"><?php echo e($village->village_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                    <?php endif; ?>
                    <?php if(session('halqa_id') > 0): ?>
                        <div class="form-group col-lg-6">
                            <label class="form-label font-weight-bold" for="halqa_id">Select Halqa/حلقہ</label>
                            <select name="halqa_id" id="halqa_id" class="form-control" readonly
                                onchange="get_village(this)">
                                <option value="">Choose Halqa/حلقہ</option>
                                <?php $__currentLoopData = $Halqas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Halqa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($Halqa->id); ?>"><?php echo e($Halqa->halqa_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label font-weight-bold" for="village_id">Select
                                Village/گاؤں</label>
                            <select name="village_id" id="village_id" class="form-control" required onchange="get_canals(this)">
                                <option value="">Choose Village/گاؤں</option>
                                <?php $__currentLoopData = $villages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $village): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($village->village_id); ?>"><?php echo e($village->village_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                     
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" for="div_id">Select Division / ڈویژن</label>
                                <select name="div_id" id="div_id" class="form-control" required>
                                    <option value="">Choose Division / ڈویژن</option>
                                    <?php $__currentLoopData = $divsions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divsion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($divsion->id); ?>"><?php echo e($divsion->divsion_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label  class="form-label font-weight-bold" for="canal_id">Select Canal/ضلع</label>
                                <select name="canal_id" id="canal_id" class="form-control " >
                                    <option value="">Choose Canal/گاؤں</option>
                                    <?php $__currentLoopData = $canals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $canal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($canal->id); ?>"><?php echo e($canal->canal_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                
                
                            </div>
                    
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Name Irrigator</label>
                        <input class="form-control" type="text" id="" name="irrigator_name" 
                        placeholder=" Enter Name Irrigator"
                            required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Khata Number</label>
                        <input class="form-control" type="text" id="" name="irrigator_khata_number"
                        placeholder=" Enter Khata Number"
                            required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Irrigator Father Name</label>
                        <input class="form-control" type="text" id="" name="irrigator_f_name"
                        placeholder=" Enter Khata Number"
                            required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label font-weight-bold">Mobile Number</label>
                        <input class="form-control" type="text" id="irrigator_mobile_number"
                        placeholder=" Enter Mobile Number"
                            name="irrigator_mobile_number" required>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Irrigator CNIC</label>
                        <input class="form-control" type="text" id="cnic"
                        placeholder=" Enter CNIC Number"
                            name="cnic" required>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
          <button type="button" id="submit-btn" class="btn btn-primary" onclick="submit_form()">+ Add Irrigator</button>
        </div>
       </form>
      </div>
    </div>
  </div> 
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
 <div class="card-header d-flex justify-content-between">
    <h4><strong>Irrigators List</strong></h4>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </button>

</div> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="<?php echo e(route('tehsil.delete')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <table id="example"
                                                class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <!--<th><input type="checkbox" id="select-all"></th> -->
                                                        <th>#</th>
                                                        <th>Irrigator Name</th>
                                                        <th>CNIC</th>
                                                        <th>Khata No</th>
                                                        
                                                      
                                                        
                                                        
                                                        <!-- <th>Tehsil Name</th>
                                                        <th>District Name</th>
                                                        <th>Divsion</th> -->

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $Irrigators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Irrigator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <!-- <td><input type="checkbox" name="ids[]" value=""></td> -->
                                                            <td><?php echo e($Irrigator->id); ?></td>
                                                            <td><?php echo e($Irrigator->irrigator_name); ?></td>
                                                            <td><?php echo e($Irrigator->cnic); ?></td>
                                                            <td><?php echo e($Irrigator->irrigator_khata_number); ?></td>
                                                            
                                                            
                                                            
                                                            <!--  <td><?php echo e($Irrigator->tehsil_name); ?></td>
                                                        <td><?php echo e($Irrigator->district_name); ?></td>
                                                        
                                                        <td><?php echo e($Irrigator->divsion_name); ?></td> -->

                                                        <td class="align-middle text-center">
                                                            <a href="<?php echo e(route('LandRecord.ListLandSurvey', ['id' => $Irrigator->id, 'abs' => $Irrigator->irrigator_khata_number, 'village_id' => $Irrigator->village_id, 'canal_id' => $Irrigator->canal_id,'div_id' => $Irrigator->div_id])); ?>">
                                                                <button class="btn btn-sm btn-primary" type="button">
                                                                    <span><i class="fa fa-plus"></i></span> Add Survey
                                                                </button>
                                                            </a>
                                                            
                                                                    <form
                                                                        action="<?php echo e(route('irrigators.destroy', $Irrigator->id)); ?>"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Are you sure you want to delete this irrigator?');"
                                                                        style="display: inline;">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('DELETE'); ?>
                                                                        <button class="btn btn-sm btn-primary"
                                                                            type="submit">
                                                                            <i class="fa fa-trash"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                    <a href="<?php echo e(route('edit.irrigator', $Irrigator->id)); ?>" class="btn btn-sm btn-primary">
                                                                        <i class="fa fa-edit"></i> Edit</a> 
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                         







                                            
                                            <div class="mt-3">
                                                <?php echo e($Irrigators->links()); ?>

                                            </div>
                                            </fle>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
    </div>
<?php $__env->stopSection(); ?>
<script>
    function get_districts(element) {
        var divisionId = element.value;

        if (divisionId) {
            $.ajax({
                url: '/get-districts/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#district_id').empty();
                    $('#district_id').append('<option value="">Choose District</option>');
                    $.each(data, function(key, value) {
                        $('#district_id').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching districts:', error);
                }
            });
        } else {
            $('#district_id').empty();
            $('#district_id').append('<option value="">Choose District</option>');
        }
    }

    function get_canals(element) {
        var villageID = element.value;

        if (villageID) {
            $.ajax({
                url: '/get-canals/' + villageID,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#canal_id').empty();
                    $('#canal_id').append('<option value="">Choose Canal</option>');
                    $.each(data, function(key, value) {
                        $('#canal_id').append('<option value="' + value.id + '">' + value.canal_name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching districts:', error);
                }
            });
        } else {
            $('#district_id').empty();
            $('#district_id').append('<option value="">Choose District</option>');
        }
    }
</script>
<script>
    function get_halqa(element) {
        var tehsilId = element.value;
        console.log(tehsilId);

        if (tehsilId) {

            $.ajax({
                url: '/get-halqa/' + tehsilId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#halqa_id').empty();
                    $('#halqa_id').append('<option value="">Choose Tehsil</option>');
                    $.each(data, function(key, value) {
                        $('#halqa_id').append('<option value="' + value.id + '">' + value
                            .halqa_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        } else {

            $('#halqa_id').empty();
            $('#halqa_id').append('<option value="">Choose Tehsil</option>');
        }
    }
</script>
<script>
    function get_village(element) {
        var halqaId = element.value; // Get the selected Halqa ID

        if (halqaId) {
            $.ajax({
                url: '/get-village/' + halqaId, // The route to fetch villages
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear the dropdown and add a placeholder option
                    $('#village_id').empty();
                    $('#village_id').append('<option value="">Choose Village/گاؤں</option>');

                    // Populate dropdown with the fetched data
                    $.each(data, function(key, value) {
                        $('#village_id').append(
                            '<option value="' + value.village_id + '">' + value.village_name +
                            '</option>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching villages:', error);
                    alert('Failed to fetch villages. Please try again later.');
                },
            });
        } else {
            $('#village_id').empty();
            $('#village_id').append('<option value="">Choose Village/گاؤں</option>');
        }
    }
</script>

<script>
    function get_tehsils(element) {
        var districtId = element.value;
        console.log(districtId);

        if (districtId) {
            // Make an AJAX request to fetch tehsils based on the selected district
            $.ajax({
                url: '/get-tehsils/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Clear the Tehsil dropdown and add a placeholder option
                    $('#tehsil_id').empty();
                    $('#tehsil_id').append('<option value="">Choose Tehsil</option>');

                    // Populate the Tehsil dropdown with the received data
                    $.each(data, function(key, value) {
                        $('#tehsil_id').append('<option value="' + value.tehsil_id + '">' + value
                            .tehsil_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tehsils:', error);
                }
            });
        } else {
            // Reset the Tehsil dropdown if no district is selected
            $('#tehsil_id').empty();
            $('#tehsil_id').append('<option value="">Choose Tehsil</option>');
        }
    }
</script>


<script>
    function submit_form() {
        const form = document.getElementById('add-irrigator-form');
        if (!form) {
            console.error('Form not found!');
            return;
        }
        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action');
        fetch(actionUrl, {
            method: 'POST',
            body: new URLSearchParams(formData),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((data) => {
                        throw new Error(data.message || 'An error occurred');
                    });
                }
                return response.json();
            })
            .then((data) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Irrigator Added!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            document.querySelector('[name="irrigator_name"]').value = '';
            document.querySelector('[name="irrigator_khata_number"]').value = '';
            document.querySelector('[name="irrigator_f_name"]').value = '';
            document.querySelector('[name="irrigator_mobile_number"]').value = '';
            })
            .catch((error) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Went Wrong, Try Again.',
                    text: error.message || 'An error occurred',
                    confirmButtonText: 'OK',
                });
            document.querySelector('[name="irrigator_name"]').value = '';
            document.querySelector('[name="irrigator_khata_number"]').value = '';
            document.querySelector('[name="irrigator_f_name"]').value = '';
            document.querySelector('[name="irrigator_mobile_number"]').value = '';
            });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#exampleModal').on('hidden.bs.modal', function () {
            console.log('Modal hidden event triggered');
            window.location.href = '<?php echo e(route("AddIrragtor")); ?>';
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#div_id').change(function() {
            var div_id = $(this).val();

            if (div_id) {
                $.ajax({
                    url: "<?php echo e(route('getCanals')); ?>", // API route to fetch canals
                    type: "GET",
                    data: { div_id: div_id },
                    success: function(data) {
                        $('#canal_id').empty();
                        $('#canal_id').append('<option value="">Choose Canal</option>');
                        $.each(data, function(key, canal) {
                            $('#canal_id').append('<option value="' + canal.id + '">' + canal.canal_name + '</option>');
                        });
                    }
                });
            } else {
                $('#canal_id').empty();
                $('#canal_id').append('<option value="">Choose Canal</option>');
            }
        });
    });
</script>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/AddIrragtor.blade.php ENDPATH**/ ?>