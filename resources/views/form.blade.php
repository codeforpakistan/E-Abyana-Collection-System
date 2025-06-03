@extends('layout')

@section('content')
<div class="app-content">
					<section class="section">

                        <!--page-header open-->
						<div class="page-header pt-0">
							<h4 class="page-title">Form Elements</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Forms</a></li>
								<li class="breadcrumb-item active" aria-current="page">Form Elements</li>
							</ol>
						</div>
						<!--page-header closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>General Elements</h4>
									</div>
									<div class="card-body">
										<form class="form-horizontal">
											<div class="form-group row">
												<label class="col-md-3 form-label">Text</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="Typing.....">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label" for="example-email">Email</label>
												<div class="col-md-9">
													<input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Password</label>
												<div class="col-md-9">
													<input type="password" class="form-control" value="password">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Placeholder</label>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="text">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Readonly</label>
												<div class="col-md-9">
													<input type="text" class="form-control" readonly="" value="Readonly value">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Disabled</label>
												<div class="col-md-9">
													<input type="text" class="form-control" disabled="" value="Disabled value">
												</div>
											</div>
											<div class="form-group row mb-0">
												<label class="col-md-3 form-label">Number</label>
												<div class="col-md-9">
													<input class="form-control" type="number" name="number">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>General Elements</h4>
									</div>
									<div class="card-body">
										<form class="form-horizontal">
											<div class="form-group row">
												<label class="col-md-3 form-label">Name</label>
												<div class="col-md-9">
													<input class="form-control" type="text" name="name">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Text area</label>
												<div class="col-md-9">
													<textarea class="form-control" rows="3">Hiiiii.....</textarea>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">URL</label>
												<div class="col-md-9">
													<input class="form-control" type="url" name="url">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Search</label>
												<div class="col-md-9">
													<input class="form-control" type="search" name="search">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-md-3 form-label">Tel</label>
												<div class="col-md-9">
													<input class="form-control" type="tel" name="tel">
												</div>
											</div>
											<div class="form-group row mb-0">
												<label class="col-md-3 form-label">Input Select</label>
												<div class="col-md-9">
													<select class="form-control select2">
														<option>Apple</option>
														<option>Orange</option>
														<option>Mango</option>
														<option>Grapes</option>
														<option>Banana</option>
													</select>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Vertical Form</h4>
									</div>
									<div class="card-body">
										<form >
											<div class="">
												<div class="form-group">
													<label for="exampleInputEmail1">Email address</label>
													<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
												</div>
												<div class="checkbox">
													<div class="custom-checkbox custom-control">
														<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
														<label for="checkbox-1" class="custom-control-label">Check me Out</label>
													</div>
												</div>
											</div>
											<button type="submit" class="btn btn-primary mt-1 mb-0">Submit</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Horizontal Form</h4>
									</div>
									<div class="card-body">
										<form class="form-horizontal" >
											<div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label">User Name</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="inputName" placeholder="Name">
												</div>
											</div>
											<div class="form-group row">
												<label for="inputEmail3" class="col-md-3 col-form-label">Email</label>
												<div class="col-md-9">
													<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
												</div>
											</div>
											<div class="form-group row">
												<label for="inputPassword3" class="col-md-3 col-form-label">Password</label>
												<div class="col-md-9">
													<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
												</div>
											</div>
											<div class="form-group mb-0 row justify-content-end">
												<div class="col-md-9">
													<div class="checkbox">
														<div class="custom-checkbox custom-control">
															<input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
															<label for="checkbox-2" class="custom-control-label">Check me Out</label>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group mb-0 mt-2 row justify-content-end">
												<div class="col-md-9">
													<button type="submit" class="btn btn-info">Sign in</button>
													<button type="submit" class="btn btn-primary">Cancel</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-12 ">
								<div class="card">
									<div class="card-header">
										<h4>Different Height</h4>
									</div>
									<div class="card-body">
										<input class="form-control input-lg" type="text" placeholder=".input-lg">
										<br>
										<input class="form-control" type="text" placeholder="Default input">
										<br>
										<input class="form-control input-sm" type="text" placeholder=".input-sm">
									</div>
								</div>
							</div>
						</div>
						<!--row close-->

                        <!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Different Width</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-3 m-t-5 m-b-5">
												<input type="text" class="form-control" placeholder=".col-xs-3">
											</div>
											<div class="col-md-4 m-t-5 m-b-5">
												<input type="text" class="form-control" placeholder=".col-xs-4">
											</div>
											<div class="col-md-5 m-t-5 m-b-5">
												<input type="text" class="form-control" placeholder=".col-xs-5">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row close-->

                        <!--row open-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4>Form Input Grid</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-12" class="form-control">
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-6" class="form-control">
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-6" class="form-control">
											</div>
											<div class="col-md-4 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-4" class="form-control">
											</div>
											<div class="col-md-4 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-4" class="form-control">
											</div>
											<div class="col-md-4 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-4" class="form-control">
											</div>
											<div class="col-md-3 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-3" class="form-control">
											</div>
											<div class="col-md-3 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-3" class="form-control">
											</div>
											<div class="col-md-3 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-3" class="form-control">
											</div>
											<div class="col-md-3 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-3" class="form-control">
											</div>
											<div class="col-md-2 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-2" class="form-control">
											</div>
											<div class="col-md-2 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-2" class="form-control">
											</div>
											<div class="col-md-2 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-2" class="form-control">
											</div>
											<div class="col-md-2 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-2" class="form-control">
											</div>
											<div class="col-md-2 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-2" class="form-control">
											</div>
											<div class="col-md-2 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder=".col-md-2" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
											<div class="col-md-1 col-sm-12 col-xs-12 form-group">
												<input type="text" placeholder="col-1" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row close-->

					</section>
				</div>
 @endsection