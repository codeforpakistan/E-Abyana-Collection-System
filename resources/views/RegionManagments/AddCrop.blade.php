@extends('layout')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<div class="app-content">
  
    <section class="section">
        <!--page-header open-->
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold">Crop(فصل)</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color"></a></li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </div>
        <!--page-header closed-->

     

 <div id="simpleModal" class="fixed  inset-0 bg-gray-400 bg-opacity-50 flex z-50 items-center justify-center hidden">
  
    <div class="card shadow-sm w-[40vw]">
        <div class="card-header bg-primary flex justify-between text-white">
            <h4 class="font-weight-bold">Add Crop</h4> <!-- Updated to reflect Employer data -->

            <button onclick="closeModal()" type="button"
                class="bg-white text-black h-[30px] w-[30px] rounded-[50px]" data-target="#exampleModalCenter">
                <i class="fa fa-close"></i></button>
        </div>
        <div class="card-body">

            <form class="form-horizontal" action="{{ url('AddCrop/add') }}" method="POST">
                @csrf
                
                <!-- First Row (Crop Name) -->
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label class="form-label font-weight-bold">Crop(فصل)</label>
                        <input class="form-control form-control-lg" type="text" name="crop_name" required>
                    </div>
                </div>
               
                <!-- Second Row (Crop Year) -->
              
            
                <!-- Village Dropdown -->
              
            
                <!-- Outlet Dropdown -->
            
            
                <!-- Submit Button -->
                <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-primary">Add Crop</button>
                </div>
            </form>
        </div>
    </div>
</div> 



        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                   <div class="card-header d-flex justify-content-between">
    <h4><strong>Irrigators List</strong></h4>
    <button onclick="openModal()" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter">
        <i class="fa fa-plus"></i> </button>
</div> 
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Crop76 Name(فصل)</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                       
                                    </tr>
                                   
                                   
                                 
                                    
                                    <tr>
                                        <td>4</td>
                                        <td>Marketing Designer</td>
                                        <td>San Francisco</td>
                                      
                                    </tr>
                                  
                                    
                                   
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div
    </section>
</div>
      
 @endsection





















              


 
 