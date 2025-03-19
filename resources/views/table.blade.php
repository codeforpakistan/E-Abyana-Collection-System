@extends('layout')

@section('content')
<div class="app-content">
					<section class="section">

					    <!--page-header open-->
						<div class="page-header pt-0">
							<h4 class="page-title">Basic Tables</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Table</a></li>
								<li class="breadcrumb-item active" aria-current="page">Basic Tables</li>
							</ol>
						</div>
						<!--page-header closed-->

						<div class="section-body">

                            <!--row open-->
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<h4>Basic Table</h4>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-bordered mb-0 text-nowrap">
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Position</th>
														<th>Date of joining</th>
														<th>Date of Re leaving</th>
														<th>projects</th>
														<th>Experience</th>
													</tr>
													<tr>
														<td>1</td>
														<td>Joshua Welch</td>
														<td>Web Designer</td>
														<td>19-6-2014</td>
														<td>19-6-2018</td>
														<td>14</td>
														<td>4 yrs</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Alan	Randall</td>
														<td>Accountant</td>
														<td>21-5-2015</td>
														<td>21-5-2018</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Jack	Greene</td>
														<td>App Developer</td>
														<td>21-3-2010</td>
														<td>21-3-2018</td>
														<td>24</td>
														<td>8 yrs</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Sean Lawrence</td>
														<td>Jr.Developer</td>
														<td>25-8-2015</td>
														<td>25-8-2015</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Oliver Welch</td>
														<td>HR</td>
														<td>15-10-2012</td>
														<td>15-10-2018</td>
														<td>20</td>
														<td>6 yrs</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<h4>Full Width Table</h4>
										</div>
										<div class="card-body p-0">
											<div class="table-responsive">
												<table class="table table-striped mb-0 text-nowrap">
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Position</th>
														<th>Date of joining</th>
														<th>Date of Re leaving</th>
														<th>projects</th>
														<th>Experience</th>
													</tr>
													<tr>
														<td>1</td>
														<td>Joshua Welch</td>
														<td>Web Designer</td>
														<td>19-6-2014</td>
														<td>19-6-2018</td>
														<td>14</td>
														<td>4 yrs</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Alan	Randall</td>
														<td>Accountant</td>
														<td>21-5-2015</td>
														<td>21-5-2018</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Jack	Greene</td>
														<td>App Developer</td>
														<td>21-3-2010</td>
														<td>21-3-2018</td>
														<td>24</td>
														<td>8 yrs</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Sean Lawrence</td>
														<td>Jr.Developer</td>
														<td>25-8-2015</td>
														<td>25-8-2015</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Oliver Welch</td>
														<td>HR</td>
														<td>15-10-2012</td>
														<td>15-10-2018</td>
														<td>20</td>
														<td>6 yrs</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--row closed-->

                            <!--row open-->
							<div class="row">
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<h4>Hover Table</h4>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-bordered table-hover mb-0 text-nowrap">
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Position</th>
														<th>Date of joining</th>
														<th>Date of Re leaving</th>
														<th>projects</th>
														<th>Experience</th>
													</tr>
													<tr>
														<td>1</td>
														<td>Joshua Welch</td>
														<td>Web Designer</td>
														<td>19-6-2014</td>
														<td>19-6-2018</td>
														<td>14</td>
														<td>4 yrs</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Alan	Randall</td>
														<td>Accountant</td>
														<td>21-5-2015</td>
														<td>21-5-2018</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Jack	Greene</td>
														<td>App Developer</td>
														<td>21-3-2010</td>
														<td>21-3-2018</td>
														<td>24</td>
														<td>8 yrs</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Sean Lawrence</td>
														<td>Jr.Developer</td>
														<td>25-8-2015</td>
														<td>25-8-2015</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Oliver Welch</td>
														<td>HR</td>
														<td>15-10-2012</td>
														<td>15-10-2018</td>
														<td>20</td>
														<td>6 yrs</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="card">
										<div class="card-header">
											<h4>Headercolor Table</h4>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-bordered mb-0 text-nowrap">
													<tr class="bg-primary">
														<th>#</th>
														<th>Name</th>
														<th>Position</th>
														<th>Date of joining</th>
														<th>Date of Re leaving</th>
														<th>projects</th>
														<th>Experience</th>
													</tr>
													<tr>
														<td>1</td>
														<td>Joshua Welch</td>
														<td>Web Designer</td>
														<td>19-6-2014</td>
														<td>19-6-2018</td>
														<td>14</td>
														<td>4 yrs</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Alan	Randall</td>
														<td>Accountant</td>
														<td>21-5-2015</td>
														<td>21-5-2018</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Jack	Greene</td>
														<td>App Developer</td>
														<td>21-3-2010</td>
														<td>21-3-2018</td>
														<td>24</td>
														<td>8 yrs</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Sean Lawrence</td>
														<td>Jr.Developer</td>
														<td>25-8-2015</td>
														<td>25-8-2015</td>
														<td>10</td>
														<td>3 yrs</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Oliver Welch</td>
														<td>HR</td>
														<td>15-10-2012</td>
														<td>15-10-2018</td>
														<td>20</td>
														<td>6 yrs</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--row closed-->

                            <!--row open-->
							<div class="row">
								<div class="col-12">
									<div class="card Advance-table">
										<div class="card-header">
											<div class="float-right">
												<form>
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Search">
														<div class="input-group-btn">
															<button class="btn btn-primary"><i class="ion ion-search"></i></button>
														</div>
													</div>
												</form>
											</div>
											<h4>Advanced Table</h4>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-striped table-bordered mb-0 text-nowrap">
													<tr>
														<th>#</th>
														<th>Project</th>
														<th>Progress</th>
														<th>Team</th>
														<th>Deadline</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
													<tr>
														<td>
															<div class="custom-checkbox custom-control">
																<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
																<label for="checkbox-1" class="custom-control-label"></label>
															</div>
														</td>
														<td>Konr Admin Template</td>
														<td class="align-middle">
															<div class="progress h-6" data-toggle="tooltip" title="90%">
																<div class="progress-bar bg-success w-90" ></div>
															</div>
														</td>
														<td>
															<img alt="image" src="../../assets/img/avatar/avatar-5.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Wildan Ahdian">
														</td>
														<td>10-11-2018</td>
														<td><div class="badge badge-success">Testing</div></td>
														<td><a href="#" class="btn btn-action btn-primary">More</a></td>
													</tr>
													<tr>
														<td>
															<div class="custom-checkbox custom-control">
																<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
																<label for="checkbox-2" class="custom-control-label"></label>
															</div>
														</td>
														<td>Gogg beauty Template</td>
														<td class="align-middle">
															<div class="progress h-6"  data-toggle="tooltip" title="40%">
																<div class="progress-bar bg-primary w-40" ></div>
															</div>
														</td>
														<td>
															<img alt="image" src="../../assets/img/avatar/avatar-3.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Nur Alpiana">
															<img alt="image" src="../../assets/img/avatar/avatar-3.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Hariono Yusup">
															<img alt="image" src="../../assets/img/avatar/avatar-4.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Bagus Dwi Cahya">
														</td>
														<td>29-11-2018</td>
														<td><div class="badge badge-info">Coding</div></td>
														<td><a href="#" class="btn btn-action btn-primary">More</a></td>
													</tr>
													<tr>
														<td>
															<div class="custom-checkbox custom-control">
																<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3">
																<label for="checkbox-3" class="custom-control-label"></label>
															</div>
														</td>
														<td>Hytr Hosting Template</td>
														<td class="align-middle">
															<div class="progress h-6"  data-toggle="tooltip" title="60%">
																<div class="progress-bar bg-danger w-60" ></div>
															</div>
														</td>
														<td>
															<img alt="image" src="../../assets/img/avatar/avatar-3.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Rizal Fakhri">
															<img alt="image" src="../../assets/img/avatar/avatar-2.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Hasan Basri">
														</td>
														<td>31-10-2018</td>
														<td><div class="badge badge-warning">Process</div></td>
														<td><a href="#" class="btn btn-action btn-primary">More</a></td>
													</tr>
													<tr>
														<td>
															<div class="custom-checkbox custom-control">
																<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
																<label for="checkbox-4" class="custom-control-label"></label>
															</div>
														</td>
														<td>Ureo Education Template</td>
														<td class="align-middle">
															<div class="progress h-6" data-toggle="tooltip" title="50%">
																<div class="progress-bar bg-secondary w-50" ></div>
															</div>
														</td>
														<td>
															<img alt="image" src="../../assets/img/avatar/avatar-2.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Rizal Fakhri">
															<img alt="image" src="../../assets/img/avatar/avatar-5.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Isnap Kiswandi">
															<img alt="image" src="../../assets/img/avatar/avatar-4.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Yudi Nawawi">
															<img alt="image" src="../../assets/img/avatar/avatar-3.jpeg" class="rounded-circle" width="35" data-toggle="title" title="Khaerul Anwar">
														</td>
														<td>15-10-2018</td>
														<td><div class="badge badge-danger">Completed</div></td>
														<td><a href="#" class="btn btn-action btn-primary">More</a></td>
													</tr>
												</table>
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