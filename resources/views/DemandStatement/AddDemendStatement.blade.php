



 @extends('layout')

 @section('content')
 <head>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
 </head>
 
     
     
 <div class="app-content">

     <section class="section">
         <!--page-header open-->
         <div class="page-header pt-0">
             <h4 class="page-title font-weight-bold">Demand Statement( )</h4>
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="#" class="text-light-color"></a></li>
                 <li class="breadcrumb-item active" aria-current="page"></li>
             </ol>
         </div>
         <!--page-header closed-->
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="margin-top: 80px;">
             <div class="card shadow-sm">
                 <div class="card-header bg-primary text-white">
                     <h4 class="font-weight-bold">Demand Statement( )</h4> <!-- Updated to reflect Employer data -->
                 </div>
                 <div class="card-body">
                     <form class="form-horizontal" action="{{ url('employer/add') }}" method="POST">
                         @csrf
                         
                      
                         <div class="row">
                             
                             
                            
                            
                            
                           
                           
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Canal/آراضی آبپاشی نہر </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Canal/آراضی آبپاشی نہر</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Divsion/ڈویژن</label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Divsion/راجباہ</label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/راجباہ</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Divsion/حلقہ</label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/حلقہ</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                             <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                 <label class="form-label font-weight-bold">Village/موضع</label>
                                 <select class="form-control select2" name="project" required>
                                     <option value="">Select a Village/موضع</option>
                                     <option value="KPITB-Intership<">Shabqadar</option>
                                         <option value=" PSEB-Internship">Peshawar</option>
                                         <option value="Navttc-Batch-1">Charsdda</option>
                                         <option value="Free-Course">Mardan</option>
                                         <option value="Paid-Course">Swabi</option>
                                         <option value="Free-internship">Tangi</option>
                                  
                                     
                                     <!-- More options omitted for brevity -->
                                 </select>
                             </div>
                             <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                 <label class="form-label font-weight-bold">Tahsil/تحصیل</label>
                                 <select class="form-control select2" name="project" required>
                                     <option value="">Select a Tahsil/تحصیل</option>
                                     <option value="KPITB-Intership<">Shabqadar</option>
                                         <option value=" PSEB-Internship">Peshawar</option>
                                         <option value="Navttc-Batch-1">Charsdda</option>
                                         <option value="Free-Course">Mardan</option>
                                         <option value="Paid-Course">Swabi</option>
                                         <option value="Free-internship">Tangi</option>
                                  
                                     
                                     <!-- More options omitted for brevity -->
                                 </select>
                             </div>
                             <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                 <label class="form-label font-weight-bold">District/ضلع</label>
                                 <select class="form-control select2" name="project" required>
                                     <option value="">Select a District/ضلع</option>
                                     <option value="KPITB-Intership<">Shabqadar</option>
                                         <option value=" PSEB-Internship">Peshawar</option>
                                         <option value="Navttc-Batch-1">Charsdda</option>
                                         <option value="Free-Course">Mardan</option>
                                         <option value="Paid-Course">Swabi</option>
                                         <option value="Free-internship">Tangi</option>
                                  
                                     
                                     <!-- More options omitted for brevity -->
                                 </select>
                             </div>
                           
                          
                             <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                 <label class="form-label font-weight-bold">Crop/فصل</label>
                                 <select class="form-control select2" name="project" required>
                                     <option value="">Select a Divsion/فصل</option>
                                     <option value="KPITB-Intership<">Shabqadar</option>
                                         <option value=" PSEB-Internship">Peshawar</option>
                                         <option value="Navttc-Batch-1">Charsdda</option>
                                         <option value="Free-Course">Mardan</option>
                                         <option value="Paid-Course">Swabi</option>
                                         <option value="Free-internship">Tangi</option>
                                  
                                     
                                     <!-- More options omitted for brevity -->
                                 </select>
                             </div>
                         
                          
                       
                         
                         <!-- Submit Button -->
                      
 
                     </form>
                     
                 </div>
             </div>
         </div>
         <!--row open-->
     
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12" style="margin-top: 80px;">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="font-weight-bold">Demand Statement/</h4> 
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url('AddVillage/add') }}" method="POST">
                        @csrf
                        
                    
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Land Settlement Plot Number/نمبر شمار کھاتہ</label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-4">
                                <label class="form-label font-weight-bold" style="font-size: 1.1rem;">Canal Khasra Number"/نمبر خسرہ نہری</label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                        
                               
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Land Settlement Plot Number/نمبر خسرہ بندوبستی</label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/نام مالک بقید ولدیت قومیت</label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            

                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/نام مالگزار بقید ولدیت
                                </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/نام کاشتکار بقید ولدیت و سکونت
                                </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/رقبہ: توڑ
                                </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/توڑ</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/رقبہ: جھلار
                                </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/جھلار</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/ نام جنس

                                </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/رقبہ درجہ وار
                                </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/شرح </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/رقم آبیانہ درجہ وار
                                </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/کل رز آبیانہ

                                </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/زر معانی


                                </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/باقی واجب الوصول

                                </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label class="form-label font-weight-bold">Name/پٹواری

                                </label>
                                <select class="form-control select2" name="project" required>
                                    <option value="">Select a Divsion/ڈویژن</option>
                                    <option value="KPITB-Intership<">Shabqadar</option>
                                        <option value=" PSEB-Internship">Peshawar</option>
                                        <option value="Navttc-Batch-1">Charsdda</option>
                                        <option value="Free-Course">Mardan</option>
                                        <option value="Paid-Course">Swabi</option>
                                        <option value="Free-internship">Tangi</option>
                                 
                                    
                                    <!-- More options omitted for brevity -->
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label font-weight-bold" style="">Name Village/کیفیت

                                </label>
                                <input class="form-control form-control-lg" type="text" name="village_name" required style="font-size: 1rem;">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </section>
 </div>
 
 
               
  @endsection
  