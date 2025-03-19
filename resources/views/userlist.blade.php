@extends('layout')

@section('content')
<div class="app-content">
					<section class="section">

					    <!--page-header open-->
						<div class="page-header pt-0">
							<h4 class="page-title">Users</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">UI Elements</a></li>
								<li class="breadcrumb-item active" aria-current="page">Users</li>
							</ol>
						</div>
						<!--page-header closed-->

						<div class="section-body">

                            <!--row open-->
							<div class="row">
								<div class="col-lg-12">
									<div class="e-panel card">
										<div class="card-header">
											<h4>Users</h4>
										</div>
										<div class="card-body">
											<div class="e-table">
												<div class="table-responsive table-lg">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th  class="text-center">

																</th>
																<th class="text-center">Photo</th>
																<th >Name</th>
																<th>Date</th>
																<th></th>
																<th class="text-center">Actions</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-1" type="checkbox"> <label class="custom-control-label" for="item-1"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-3.jpeg"></td>
																<td class="text-nowrap align-middle">Adam Cotter</td>
																<td class="text-nowrap align-middle"><span>09 Dec 2017</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-2" type="checkbox"> <label class="custom-control-label" for="item-2"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-2.jpeg"></td>
																<td class="text-nowrap align-middle">Pauline Noble</td>
																<td class="text-nowrap align-middle"><span>26 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-3" type="checkbox"> <label class="custom-control-label" for="item-3"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-3.jpeg"></td>
																<td class="text-nowrap align-middle">Sherilyn Metzel</td>
																<td class="text-nowrap align-middle"><span>27 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-4" type="checkbox"> <label class="custom-control-label" for="item-4"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-4.jpeg"></td>
																<td class="text-nowrap align-middle">Terrie Boaler</td>
																<td class="text-nowrap align-middle"><span>20 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-5" type="checkbox"> <label class="custom-control-label" for="item-5"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-5.jpeg"></td>
																<td class="text-nowrap align-middle">Rutter Pude</td>
																<td class="text-nowrap align-middle"><span>13 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-6" type="checkbox"> <label class="custom-control-label" for="item-6"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-4.jpeg"></td>
																<td class="text-nowrap align-middle">Clifford Benjamin</td>
																<td class="text-nowrap align-middle"><span>25 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-7" type="checkbox"> <label class="custom-control-label" for="item-7"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-3.jpeg"></td>
																<td class="text-nowrap align-middle">Thedric Romans</td>
																<td class="text-nowrap align-middle"><span>12 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-8" type="checkbox"> <label class="custom-control-label" for="item-8"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-2.jpeg"></td>
																<td class="text-nowrap align-middle">Haily Carthew</td>
																<td class="text-nowrap align-middle"><span>27 Jan 2018</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-9" type="checkbox"> <label class="custom-control-label" for="item-9"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-2.jpeg"></td>
																<td class="text-nowrap align-middle">Dorothea Joicey</td>
																<td class="text-nowrap align-middle"><span>12 Dec 2017</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-10" type="checkbox"> <label class="custom-control-label" for="item-10"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-3.jpeg"></td>
																<td class="text-nowrap align-middle">Mikaela Pinel</td>
																<td class="text-nowrap align-middle"><span>10 Dec 2017</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-11" type="checkbox"> <label class="custom-control-label" for="item-11"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-4.jpeg"></td>
																<td class="text-nowrap align-middle">Donnell Farries</td>
																<td class="text-nowrap align-middle"><span>03 Dec 2017</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<tr>
																<td class="align-middle text-center">
																	<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
																		<input class="custom-control-input" id="item-12" type="checkbox"> <label class="custom-control-label" for="item-12"></label>
																	</div>
																</td>
																<td class="align-middle text-center"><img alt="image" class="avatar avatar-md rounded-circle" src="../../assets/img/avatar/avatar-5.jpeg"></td>
																<td class="text-nowrap align-middle">Letizia Puncher</td>
																<td class="text-nowrap align-middle"><span>09 Dec 2017</span></td>
																<td class="text-center align-middle">
																	<label class="custom-switch">
																		<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
																		<span class="custom-switch-indicator"></span>
																	</label>
																</td>
																<td class="text-center align-middle">
																	<div class="btn-group align-top">
																		<button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Edit</button> <button class="btn btn-sm btn-primary badge" type="button"><i class="fa fa-trash"></i></button>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="d-flex justify-content-center">
													<ul class="pagination mt-3 mb-0">
														<li class="disabled page-item">
															<a class="page-link" href="#">‹</a>
														</li>
														<li class="active page-item">
															<a class="page-link" href="#">1</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">2</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">3</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">4</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">5</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">›</a>
														</li>
														<li class="page-item">
															<a class="page-link" href="#">»</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--row closed-->

						</div>
					</section>
				</div>
 @endsection

 <div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Serial Number/نمبر شمار</label>
			<input class="form-control form-control-lg" type="text" name="district" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Entry Date/تاریخ اندراج</label>
			<input class="form-control form-control-lg" type="text" name="area" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Account Number (Khatoni)/ کھاتہ(کھتونی)</label>
			<input class="form-control form-control-lg" type="text" name="canal_number" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Section (سیکشن)</label>
			<input class="form-control form-control-lg" type="text" name="section" required>
		</div>
	</div>
</div>

<!-- Second Row -->
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Account Number (Khatoni)/ کھاتہ(کھتونی)</label>
			<input class="form-control form-control-lg" type="text" name="owner_name" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Khasra Number (Land Record)/  نمبر خسرہ بندوبست</label>
			<input class="form-control form-control-lg" type="text" name="length" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Patwari (Land Revenue Officer)/(پٹواری )</label>
			<input class="form-control form-control-lg" type="text" name="width" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Date of Construction (تاریخ تعمیر)</label>
			<input class="form-control form-control-lg" type="date" name="construction_date" required>
		</div>
	</div>
</div>

<!-- Third Row -->
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Patwari (Land Revenue Officer)/(پٹواری )</label>
			<input class="form-control form-control-lg" type="text" name="condition" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Owner's Name with Nationality/  نام مالک بقید قومیت</label>
			<input class="form-control form-control-lg" type="text" name="usage" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label font-weight-bold">Supervisor (نگرانی کرنے والا)</label>
			<input class="form-control form-control-lg" type="text" name="supervisor" required>
		</div>
	</div>
	
</div>

<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
	<div class="card shadow-sm border-0">
		<div class="card-header bg-primary text-white">
			<h4>Elements/خسرہ</h4>
		</div>
		<div class="card-body p-4">
			<div class="form-group row">
				<div class="col-md-4">
					<label class="form-label">پیمائش: تاریخ</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
				<div class="col-md-4">
					<label class="form-label">طول</label>
					<input type="text" class="form-control">
				</div>
				<div class="col-md-4">
					<label class="form-label">عرض</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label class="form-label">رقبہ:مرلہ</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
				<div class="col-md-6">
					<label class="form-label">کنال</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<label class="form-label">نام جنس جو پہلے بوئی گئی بمعہ درجہ</label>
				<div class="col-md-12">
					<input class="form-control" type="text" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label class="form-label">اراضی دوبارہ کاشت:مرلہ</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
				<div class="col-md-6">
					<label class="form-label">اراضی دوبارہ کاشت:کنال</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label class="form-label">اراضی دو فصلی:مرلہ</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
				<div class="col-md-6">
					<label class="form-label">اراضی دو فصلی:کنال</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label class="form-label">مجرائی رقبہ:مرلہ</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
				<div class="col-md-6">
					<label class="form-label">مجرائی رقبہ:کنال</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label class="form-label">رقبہ قابل تشخیص:مرلہ</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
				<div class="col-md-6">
					<label class="form-label">رقبہ قابل تشخیص:کنال</label>
					<input type="text" class="form-control" placeholder="Typing...">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="form-label">کیفیت</label>
					<input class="form-control" type="text" placeholder="Typing...">
				</div>
			</div>
			
		</div>
	</div>
</div>