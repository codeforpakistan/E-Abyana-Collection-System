

<?php $__env->startSection('content'); ?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
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
    
    
<div class="app-content">

    <section class="section">
        <!--page-header closed-->

        <!--row open-->
       

<div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
    <div class="card shadow-sm w-[40vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Divsion</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('AddDivsion/add')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <!-- First Row (Name and CNIC) -->
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Name Divsion / نام ڈویژن</label>
                        <input class="form-control form-control-lg" type="text" name="divsion_name" required>
                    </div>
                    
                 
                </div>
             
               
                
                <!-- Second Row (Skills) -->
              
                
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><strong>Division  List</strong></h4>

                <!-- 🔍 Search Bar -->
                <input type="text" id="search" class="form-control w-25" placeholder="Search Division...">

                <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Division Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="division-data">
                            <?php echo $__env->make('partials.divsion_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-3">
                    <button id="loadMore" class="btn btn-success" data-url="<?php echo e($divsions->nextPageUrl()); ?>">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



              
 <?php $__env->stopSection(); ?>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loadMore').click(function() {
            var button = $(this);
            var nextUrl = button.data('url'); // Get next page URL

            if (nextUrl) {
                $.ajax({
                    url: nextUrl,
                    type: "GET",
                    success: function(response) {
                        if (response.html.trim() !== "") {
                            $('#division-data').append(response.html); // Append new rows
                            button.data('url', response.next_page); // Update next page URL
                        }

                        if (!response.next_page) {
                            button.hide(); // Hide button when no more pages
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error:", error); // Debugging
                    }
                });
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var searchQuery = '';

        // 🔍 Handle Search Input
        $('#search').on('keyup', function() {
            searchQuery = $(this).val(); // Get search query
            fetchData(1); // Fetch data from page 1 with the search query
        });

        // 📄 Handle Load More Button Click
        $('#loadMore').click(function() {
            var button = $(this);
            var nextUrl = button.data('url');

            if (nextUrl) {
                $.ajax({
                    url: nextUrl,
                    type: "GET",
                    data: { search: searchQuery }, // Send search query with pagination
                    success: function(response) {
                        if (response.html.trim() !== "") {
                            $('#division-data').append(response.html);
                            button.data('url', response.next_page);
                        }

                        if (!response.next_page) {
                            button.hide();
                        }
                    }
                });
            }
        });

        // 📥 Function to Fetch Data (Used for Search)
        function fetchData(page) {
            $.ajax({
                url: "<?php echo e(route('AddDivsion')); ?>?page=" + page,
                type: "GET",
                data: { search: searchQuery },
                success: function(response) {
                    $('#division-data').html(response.html); // Replace table data
                    $('#loadMore').data('url', response.next_page).show(); // Update next page URL
                    if (!response.next_page) $('#loadMore').hide(); // Hide button if no more data
                }
            });
        }
    });
</script>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\durshal_cfp\abyana\resources\views/RegionManagments/AddDivsion.blade.php ENDPATH**/ ?>