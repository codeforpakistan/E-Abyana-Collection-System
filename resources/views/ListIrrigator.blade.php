@extends('layout')

@section('content')

    
    
<div class="app-content">
  
    <section class="section">
        <!--page-header open-->
        <div class="page-header pt-0">
            <h4 class="page-title font-weight-bold">Irrigator</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-light-color"></a></li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </div>
        <!--page-header closed-->

        <!--row open-->
      
        <div class="row">
            <div class="col-md-12">
                <div class="card export-database">
                    <div class="card-header">
                        <h4>Irrigator/</h4>
                        <div id="irrigators-container">
                            @include('ListIrrigator')
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form action="{{ route('tehsil.delete') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        
                                          <table id="example" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select-all"></th>
                                                    <th>#</th>
                                                    <th>Irrigator Nam/</th>
                                                    <th>Khata Number</th>
                                                    <th>Mobile Number</th>
                                           
                                                    <th>Village Name/حلقہ</th>
                                                    <th>Tehsil Name</th>
                                                    <th>District Name</th>
                                                    <th>Divsion</th>
        
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Irrigators as $Irrigator)
                                                <tr>
                                                    <td><input type="checkbox" name="ids[]" value=""></td>
                                                    <td>{{ $Irrigator->id }}</td>
                                                    <td>{{ $Irrigator->irrigator_name }}</td>
                                                    <td>{{ $Irrigator->irrigator_khata_number }}</td>
                                                    <td>{{ $Irrigator->irrigator_mobile_number }}</td>
                                                    <td>{{ $Irrigator->village_name }}</td>
                                                    <td>{{ $Irrigator->tehsil_name }}</td>
                                                    <td>{{ $Irrigator->district_name }}</td>
                                                    <td>{{ $Irrigator->divsion_name }}</td>
                                                    
                                             
                                                    <td>
                                                        <button class="btn btn-sm btn-primary badge" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                      
                                    </fle>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div
    </section>
</div>       
 @endsection

