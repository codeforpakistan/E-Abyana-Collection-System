@extends('layout')

@section('content')
<div class="app-content">
					<section class="section">

					    <!--page-header open-->
						<div class="page-header pt-0">
							<h4 class="page-title" style="color:#4880FF;">Dashboard</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="" style="color:#4880FF;">Home / Dashboard</a></li>
							</ol>
						</div>
						<!--page-header closed-->

                        <!--row open-->
                        <div class="row row-deck">
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Planning</h5>
										<input type="text" class="knob mb-0" value="80" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#4880FF"><br>
										<span class="text-muted mt-3"><i class="fa fa-check-circle text-success mr-2"></i>80% Completed</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Design</h5>
										<input type="text" class="knob mb-0" value="74" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#ffb209"><br>
									    <span class="text-muted mt-3"><i class="fa fa-check-circle text-success mr-2"></i>74% Completed</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Development</h5>
										<input type="text" class="knob mb-0" value="53" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#22e840"><br>
									    <span class="text-muted mt-3"><i class="fa fa-check-circle text-success mr-2"></i>53% On Going</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
								<div class="card text-center ">
									<div class="card-body  mb-0">
									    <h5 class="mb-3">Testing</h5>
										<div class="widget-3 mb-1">
											<i class="icon icon-clock text-orange"></i><br>
										</div>
									    <span class="text-muted mt-5">Waiting</span>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row row-deck">
						    <div class="col-xl-4 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h4>Total Risks</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col mt-1 text-danger font-weight-bold">
												Over all current budget
											</div>
											<div class="col col-auto">
												<h5 class="text-danger mb-0 "><span class="badge badge-danger">9.2%</span></h5>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col mt-1 text-warning font-weight-bold">
												High Risk Over Due tasks
											</div>
											<div class="col col-auto">
												<h5 class="text-warning mb-0"><span class="badge badge-warning">2</span></h5>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col mt-1 text-primary font-weight-bold">
												low Risk Scanning Risks
											</div>
											<div class="col col-auto ">
												<h5 class="text-white mb-0"><span class="badge badge-primary">5</span></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h4>Project Details</h4>
									</div>
									<div class="card-body">
										<div class="">
											<div class="row ">
												<div class="col">
													<h5 class="mb-0">Project:</h5>
												</div>
												<div class="col col-auto mt-1">
													 adipiscing elit
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<h6 class="mb-0">Start Date :</h6>
												</div>
												<div class="col col-auto text-lighter">
													12-12-2018
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<h6 class="mb-0">End Date :</h6>
												</div>
												<div class="col col-auto text-lighter">
													03-05-2019
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<h6 class="mb-0">Team Lead :</h6>
												</div>
												<div class="col col-auto text-lighter">
													John Wisely
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-12">
								<div class="card ">
									<div class="card-body">
										<div class="text-center widget-2">
											<h5 class="mb-3">Project Launch Date</h5>
											<i class="fa fa-flag-o text-success"  title=""></i>
											<h2 class="mt-3 mb-2">105 Days</h2>
											<p>Monday, Feb 11th 2019</p>
											<div class="progress progress-md mt-2 mb-0">
												<div class="progress-bar bg-primary w-70">70%</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
						    <div class="col-xl-4">
								<div class="card">
									<div class="card-content">
										<div class="card-body">
											<div class="media mt-0 d-flex server">
												<div class=" ml-0  mt-0 media-body text-left">
													<h3 class="mb-2">Server1 </h3>
													<h4 class=" mb-0 text-muted"><span class="text-primary"><i class="fe fe-arrow-up-circle "></i></span> Last 52 days Ago <span class="badge badge-primary mt-1 mb-1">Online</span></h4>
												</div>
												<div class="align-self-center">
													<i class="fe fe-hard-drive icon text-primary float-right"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-content">
										<div class="card-body">
											<div class="media mt-0 d-flex server">
												<div class=" ml-0  mt-0 media-body text-left">
													<h3 class="mb-2">Server2 </h3>
													<h4 class=" mb-0 text-muted"><span class="text-secondary"><i class="fe fe-arrow-up-circle "></i></span> Last 43 days Ago <span class="badge badge-secondary mt-1 mb-1">Online</span></h4>
												</div>
												<div class="align-self-center">
													<i class="fe fe-hard-drive icon text-secondary float-right"></i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-content">
										<div class="card-body">
											<div class="media mt-0 d-flex server">
												<div class= "ml-0  mt-0 media-body text-left">
													<h3 class="">Server3</h3>
													<h4 class=" mb-0 text-muted"><span class="text-danger"><i class="fe fe-arrow-down-circle "></i></span> Last 10 days Ago <span class="badge badge-danger mt-1 mb-1">Offline</span></h4>
												</div>
												<div class="align-self-center">
													<i class="fe fe-hard-drive icon text-danger float-right"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-8 col-md-12 col-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Space Details</h4>
									</div>
									<div class="card-body">
										<canvas id="lineChart" class="chartjs-render-monitor chart-dropshadow h-335"></canvas>
									</div>
							    </div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row row-deck">
							<div class="col-lg-12 col-xl-6 col-md-12 col-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4>Avg Time For Project Task</h4>
									</div>
									<div class="card-body">
									    <div class="dash2 mb-3">
											<div class="">
												<canvas id="barChart" class="chartjs-render-monitor chart-dropshadow h-300"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xl-6">
								<div class="card ">
								    <div class="card-header">
										<h4>Current Budget</h4>
									</div>
									<div class="card-body">
									  <canvas id="team-chart" class="chartjs-render-monitor chart-dropshadow h-300"></canvas>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row ">
							<div class="col-12">
								<div class="card">
									<div class="card-header ">
										<h4>Upcoming Deadlines</h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-hover card-table table-vcenter table-bordered text-nowrap">
												<thead>
												  <tr>
													<th scope="col">ID</th>
													<th scope="col">Employee</th>
													<th scope="col">Project Name</th>
													<th scope="col">Issues</th>
													<th scope="col">Deadline</th>
													<th scope="col">Team Members</th>
													<th scope="col">WorkLoad </th>
												  </tr>
												</thead>
												<tbody>
												  <tr>
													<th scope="row">1</th>
													<td>Juliette</td>
													<td>At vero eos et accusamus et iusto odio </td>
													<td>CMS Issue</td>
													<td>02/01/2019</td>
													<td>5 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-success w-70"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">2</th>
													<td>Brock Lee</td>
													<td>voluptatum deleniti atque corrupti quos</td>
													<td>DNS Issue</td>
													<td>13/01/2019</td>
													<td>4 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-primary w-30"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">3</th>
													<td>Harry</td>
													<td>dignissimos ducimus qui blanditiis praesentium</td>
													<td>Hardware Failure</td>
													<td>18/01/2019</td>
													<td>5 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-warning w-40"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">4</th>
													<td>Robin</td>
													<td>deleniti atque corrupti quos dolores </td>
													<td>Host Provider</td>
													<td>21/01/2019</td>
													<td>10 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-secondary w-30"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">5</th>
													<td>Anne Fibbiyon</td>
													<td>et quas molestias excepturi sint occaecati</td>
													<td>Hardware Failure</td>
													<td>28/01/2019</td>
													<td>3 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-orange w-60"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">6</th>
													<td>Anthony</td>
													<td>At vero eos et accusamus et iusto odio </td>
													<td>CMS Issue</td>
													<td>05/02/2019</td>
													<td>6 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-success w-40"></div>
														</div>
													</td>
												  </tr>
												  <tr>
													<th scope="row">7</th>
													<td>Jennifer</td>
													<td>At vero eos et accusamus et iusto odio </td>
													<td>DNS Issue</td>
													<td>12/02/2019</td>
													<td>4 Members</td>
													<td>
														<div class="progress progress-md mt-1 h-6">
															<div class="progress-bar  progress-bar-animated bg-primary w-60"></div>
														</div>
													</td>
												  </tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

					</section>
				</div>
 @endsection