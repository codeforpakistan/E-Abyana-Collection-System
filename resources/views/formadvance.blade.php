@extends('layout')

@section('content')
<div class="app-content">
					<section class="section">

                        <!--page-header open-->
						<div class="page-header pt-0">
							<h4 class="page-title">Advanced Form Elements</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" class="text-light-color">Forms</a></li>
								<li class="breadcrumb-item active" aria-current="page">Advanced Form Elements</li>
							</ol>
						</div>
						<!--page-header closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-md">
								<div class="card overflow-hidden">
									<div class="card-header">
										<h4>Select2</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group overflow-hidden">
													<label>Minimal</label>
													<select class="form-control select2 w-100" >
														<option selected="selected">Alabama</option>
														<option>Alaska</option>
														<option>California</option>
														<option>Delaware</option>
														<option>Tennessee</option>
														<option>Texas</option>
														<option>Washington</option>
													</select>
												</div>
												<div class="form-group mb-md-0 overflow-hidden">
													<label>Disabled</label>
													<select class="form-control select2 w-100" disabled="disabled" >
														<option selected="selected">Alabama</option>
														<option>Alaska</option>
														<option>California</option>
														<option>Delaware</option>
														<option>Tennessee</option>
														<option>Texas</option>
														<option>Washington</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group overflow-hidden">
													<label>Multiple</label>
													<select class="form-control select2 w-100" multiple="multiple" data-placeholder="Select a State"
														>
														<option>Alabama</option>
														<option>Alaska</option>
														<option>California</option>
														<option>Delaware</option>
														<option>Tennessee</option>
														<option>Texas</option>
														<option>Washington</option>
													</select>
												</div>
												<div class="form-group mb-0 overflow-hidden">
													<label>Disabled</label>
													<select class="form-control select2 w-100" >
														<option selected="selected">Alabama</option>
														<option>Alaska</option>
														<option disabled="disabled">California (disabled)</option>
														<option>Delaware</option>
														<option>Tennessee</option>
														<option>Texas</option>
														<option>Washington</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h4>MutipleSelect Styles</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Basic MutipleSelect</label>
													<select multiple="multiple" class="multi-select">
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
												<div class="form-group">
													<label>Disabled MutipleSelect</label>
													<select multiple="multiple" class="multi-select"  disabled="disabled">
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
												<div class="form-group">
													<label>Single Group Disabled MutipleSelect</label>
													<select multiple="multiple" class="multi-select">
														<optgroup label="Group 1" disabled="disabled">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
														</optgroup>
														<optgroup label="Group 2">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
															<option value="6">Option 6</option>
															<option value="7">Option 7</option>
															<option value="8">Option 8</option>
														</optgroup>
														<optgroup label="Group 3">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
															<option value="6">Option 6</option>
															<option value="7">Option 7</option>
															<option value="8">Option 8</option>
															<option value="9">Option 9</option>
														</optgroup>
													</select>
												</div>
												<div class="form-group">
													<label>Multiple Items With Group-Option</label>
													<select multiple="multiple" class="optmulti-select">
														<optgroup label="Group 1">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</optgroup>
														<optgroup label="Group 2">
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</optgroup>
														<optgroup label="Group 3">
															<option value="11">11</option>
															<option value="12">12</option>
															<option value="13">13</option>
															<option value="14">14</option>
															<option value="15">15</option>
														</optgroup>
													</select>
												</div>
												<div class="form-group">
													<label>Single Row</label>
													<select multiple="multiple" class="single-select">
														<option value="1">First</option>
														<option value="2">Second</option>
														<option value="3">Third</option>
														<option value="4"  selected="selected">Fourth</option>
													</select>
												</div>
												<div class="form-group mb-0">
													<label>Group-Option Filter</label>
													<select multiple="multiple" class="group-filter">
														<optgroup label="Group 1">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
														</optgroup>
														<optgroup label="Group 2">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
															<option value="6">Option 6</option>
															<option value="7">Option 7</option>
															<option value="8">Option 8</option>
														</optgroup>
														<optgroup label="Group 3">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
															<option value="6">Option 6</option>
															<option value="7">Option 7</option>
															<option value="8">Option 8</option>
															<option value="9">Option 9</option>
														</optgroup>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>MutipleSelect</label>
													<select multiple="multiple" class="multi-select">
														<option value="1" selected="selected">January</option>
														<option value="2" disabled="disabled">February</option>
														<option value="3" selected="selected" disabled="disabled">March</option>
														<option value="4"  disabled="disabled">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
												<div class="form-group">
													<label>Group-Option MutipleSelect</label>
													<select multiple="multiple" class="multi-select">
														<optgroup label="Group 1">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
														</optgroup>
														<optgroup label="Group 2">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
															<option value="6">Option 6</option>
															<option value="7">Option 7</option>
															<option value="8">Option 8</option>
														</optgroup>
														<optgroup label="Group 3">
															<option value="1">Option 1</option>
															<option value="2">Option 2</option>
															<option value="3">Option 3</option>
															<option value="4">Option 4</option>
															<option value="5">Option 5</option>
															<option value="6">Option 6</option>
															<option value="7">Option 7</option>
															<option value="8">Option 8</option>
															<option value="9">Option 9</option>
														</optgroup>
													</select>
												</div>
												<div class="form-group">
													<label>Multiple Items</label>
													<select multiple="multiple" class="multiselect" >
														<option value="1">1</option>
														<option value="2" >2</option>
														<option value="3" >3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
														<option value="21">21</option>
														<option value="22">22</option>
														<option value="23">23</option>
														<option value="24">24</option>
														<option value="25">25</option>
														<option value="26">26</option>
														<option value="27">27</option>
														<option value="28">28</option>
														<option value="29">29</option>
														<option value="30">30</option>
													</select>
												</div>
												<div class="form-group">
													<label>Hide SelectAll</label>
													<select multiple="multiple" class="hide-select">
														<option value="1">First</option>
														<option value="2">Second</option>
														<option value="3">Third</option>
														<option value="4">Fourth</option>
													</select>
												</div>
												<div class="form-group">
													<label>Select Filter</label>
													<select multiple="multiple" class="filter-multi">
														<option value="1">1</option>
														<option value="2" >2</option>
														<option value="3" >3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
													</select>
												</div>
												<div class="form-group mb-0">
													<label>Custom Style</label>
													<select multiple="multiple" class="custom-multiselect" >
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Input masks</h4>
									</div>
									<div class="card-body">

										<div class="form-group">
											<label>US phone mask:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-phone"></i>
												</div>
												<input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
											</div>
										</div>
										<div class="form-group">
											<label>Intl US phone mask:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-phone"></i>
												</div>
												<input type="text" class="form-control"
												data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Date picker</h4>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label>Date:</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
										<div class="form-group">
											<label>Month Picker:</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker-months">
											</div>
										</div>
										<div class="form-group">
											<label>Week Picker:</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker-week">
											</div>
										</div>
										<div class="bootstrap-timepicker">
											<div class="form-group">
												<label>Time picker:</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-clock-o"></i>
													</div>
													<input type="text" class="form-control timepicker" id="timepicker">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Date range:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="reservation">
											</div>
										</div>
										<div class="form-group">
											<label>Date and time range:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</div>
												<input type="text" class="form-control pull-right" id="reservationtime">
											</div>
										</div>
										<div class="form-group mb-0">
											<label>Date range button:</label>
											<div class="input-group">
												<button type="button" class="btn btn-primary pull-right" id="daterange-btn">
													<span>
														<i class="fa fa-calendar"></i> Date range picker
													</span>
													<i class="fa fa-caret-down"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Color & Time Picker</h4>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label>Color picker:</label>
											<input type="text" class="form-control my-colorpicker1">
										</div>
										<div class="form-group">
											<label>Color picker with addon:</label>
											<div class="input-group my-colorpicker2">
												<input type="text" class="form-control">
												<div class="input-group-addon">
													<i class="fa fa-sort-desc"></i>
												</div>
											</div>
										</div>
										<div class="bootstrap-timepicker">
											<div class="form-group mb-0">
												<label>Time picker:</label>
												<div class="input-group">
													<input type="text" class="form-control timepicker" id="timepicker2">
													<div class="input-group-addon">
														<i class="fa fa-clock-o"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

						<!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>iCheck - Checkbox &amp; Radio Inputs</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label>
														<input type="checkbox" class="minimal" checked>
													</label>
													<label>
														<input type="checkbox" class="minimal">
													</label>
													<label>
														<input type="checkbox" class="minimal" disabled>
														Minimal checkbox
													</label>
												</div>
												<div class="form-group">
													<label>
														<input type="radio" name="r1" class="minimal" checked>
													</label>
													<label>
														<input type="radio" name="r1" class="minimal">
													</label>
													<label>
														<input type="radio" name="r1" class="minimal" disabled>
														Minimal skin radio
													</label>
												</div>
												<div class="form-group mb-lg-0">
													<label>
														<input type="checkbox" class="minimal-blue" checked>
													</label>
													<label>
														<input type="checkbox" class="minimal-blue">
													</label>
													<label>
														<input type="checkbox" class="minimal-blue" disabled>
														Skin checkbox
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>
														<input type="radio" name="r2" class="minimal-blue" checked>
													</label>
													<label>
														<input type="radio" name="r2" class="minimal-blue">
													</label>
													<label>
														<input type="radio" name="r2" class="minimal-blue" disabled>
														Minimal  skin radio
													</label>
												</div>

												<div class="form-group">
													<label>
														<input type="checkbox" class="flat-blue" checked>
													</label>
													<label>
														<input type="checkbox" class="flat-blue">
													</label>
													<label>
														<input type="checkbox" class="flat-blue" disabled>
														Flat skin checkbox
													</label>
												</div>
												<div class="form-group mb-0">
													<label>
														<input type="radio" name="r3" class="flat-blue" checked>
													</label>
													<label>
														<input type="radio" name="r3" class="flat-blue">
													</label>
													<label>
														<input type="radio" name="r3" class="flat-blue" disabled>
														Flat  skin radio
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Toggle Switches</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-12">
												<div class="form-group custom-switches-stacked">
													<label class="form-label">Toggle switches</label>
													<label class="custom-switch">
														<input type="radio" name="option" value="1" class="custom-switch-input" checked="">
														<span class="custom-switch-indicator"></span>
														<span class="custom-switch-description">Option 1</span>
													</label>
													<label class="custom-switch">
														<input type="radio" name="option" value="2" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
														<span class="custom-switch-description">Option 2</span>
													</label>
													<label class="custom-switch">
														<input type="radio" name="option" value="3" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
														<span class="custom-switch-description">Option 3</span>
													</label>
												</div>
												<div class="form-group mb-0">
													<label class="form-label">Toggle switch single</label><br>
													<label class="custom-switch">
														<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
														<span class="custom-switch-indicator"></span>
														<span class="custom-switch-description">I agree with terms and conditions</span>
													</label>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-12">
												<div class="form-group">
													<label class="form-label">Select Color</label>
													<div class="row gutters-xs">
														<div class="col-auto">
															<label class="colorinput">
																<input name="color" type="checkbox" value="danger" class="colorinput-input" checked="">
																<span class="colorinput-color bg-danger"></span>
															</label>
														</div>
														<div class="col-auto">
															<label class="colorinput">
																<input name="color" type="checkbox" value="primary" class="colorinput-input">
																<span class="colorinput-color bg-primary"></span>
															</label>
														</div>
														<div class="col-auto">
															<label class="colorinput">
																<input name="color" type="checkbox" value="pink" class="colorinput-input">
																<span class="colorinput-color bg-pink"></span>
															</label>
														</div>
														<div class="col-auto">
															<label class="colorinput">
																<input name="color" type="checkbox" value="warning" class="colorinput-input">
																<span class="colorinput-color bg-danger"></span>
															</label>
														</div>
														<div class="col-auto">
															<label class="colorinput">
																<input name="color" type="checkbox" value="orange" class="colorinput-input">
																<span class="colorinput-color bg-orange"></span>
															</label>
														</div>
														<div class="col-auto">
															<label class="colorinput">
																<input name="color" type="checkbox" value="info" class="colorinput-input">
																<span class="colorinput-color bg-info"></span>
															</label>
														</div>
													</div>
												</div>
												<div class="form-group mb-0">
													<label>Sizes</label>
													<div class="row">
														<div class="col-lg-12 selectgroup selectgroup-pills">
															<label class="selectgroup-item">
																<input type="checkbox" name="value" value="S" class="selectgroup-input" checked="">
																<span class="selectgroup-button">S</span>
															</label>
															<label class="selectgroup-item">
																<input type="checkbox" name="value" value="M" class="selectgroup-input">
																<span class="selectgroup-button">M</span>
															</label>
															<label class="selectgroup-item">
																<input type="checkbox" name="value" value="L" class="selectgroup-input">
																<span class="selectgroup-button">L</span>
															</label>
															<label class="selectgroup-item">
																<input type="checkbox" name="value" value="XL" class="selectgroup-input">
																<span class="selectgroup-button">XL</span>
															</label>
															<label class="selectgroup-item">
																<input type="checkbox" name="value" value="XXL" class="selectgroup-input">
																<span class="selectgroup-button">XXL</span>
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Inline Date & TimePicker</h4>
									</div>
									<div class="card-body">
										<div id="datetimepicker2"></div>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

                        <!--row open-->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4>Date & TimePicker Bootstrap4</h4>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label>Basic Date & Time picker</label>
											<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
												<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Year View</label>
											<div class="input-group date" id="datetimepicker3" data-target-input="nearest">
												<input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
												<div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
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
										<h4>Switches</h4>
									</div>
									<div class="card-body">
										 <ul class="list-group">
											<li class="list-group-item">
												Bootstrap Switch Default
												<div class="material-switch pull-right">
													<input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox" />
													<label for="someSwitchOptionDefault" class="label-default"></label>
												</div>
											</li>
											<li class="list-group-item">
												Bootstrap Switch Primary
												<div class="material-switch pull-right">
													<input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"/>
													<label for="someSwitchOptionPrimary" class="label-primary"></label>
												</div>
											</li>
											<li class="list-group-item">
												Bootstrap Switch Success
												<div class="material-switch pull-right">
													<input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"/>
													<label for="someSwitchOptionSuccess" class="label-success"></label>
												</div>
											</li>
											<li class="list-group-item">
												Bootstrap Switch Info
												<div class="material-switch pull-right">
													<input id="someSwitchOptionInfo" name="someSwitchOption001" type="checkbox"/>
													<label for="someSwitchOptionInfo" class="label-info"></label>
												</div>
											</li>
											<li class="list-group-item">
												Bootstrap Switch Warning
												<div class="material-switch pull-right">
													<input id="someSwitchOptionWarning" name="someSwitchOption001" type="checkbox"/>
													<label for="someSwitchOptionWarning" class="label-warning"></label>
												</div>
											</li>
											<li class="list-group-item">
												Bootstrap Switch Danger
												<div class="material-switch pull-right">
													<input id="someSwitchOptionDanger" name="someSwitchOption001" type="checkbox"/>
													<label for="someSwitchOptionDanger" class="label-danger"></label>
												</div>
											</li>
										</ul>
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
										<h4>Accordion-Wizard-Form</h4>
									</div>
									<div class="card-body">
										<form id="form">
											<div class="list-group">
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Name &amp; Email</h5>
													<div data-acc-content>
														<div class="my-3">
															<div class="form-group">
																<label>Name:</label>
																<input type="text" name="name" class="form-control" />
															</div>
															<div class="form-group">
																<label>Email:</label>
																<input type="text" name="email" class="form-control" />
															</div>
														</div>
													</div>
												</div>
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Contact</h5>
													<div data-acc-content>
														<div class="my-3">
															<div class="form-group">
																<label>Telephone:</label>
																<input type="text" name="telephone" class="form-control" />
															</div>
															<div class="form-group">
																<label>Mobile:</label>
																<input type="text" name="mobile" class="form-control" />
															</div>
														</div>
													</div>
												</div>
												<div class="list-group-item py-3" data-acc-step>
													<h5 class="mb-0" data-acc-title>Payment</h5>
													<div data-acc-content>
														<div class="my-3">
															<div class="form-group">
																<label>Credit card:</label>
																<input type="text" name="card" class="form-control">
															</div>
															<div class="form-group form-row">
																<div class="col-sm-4">
																	<label>Expiry:</label>
																	<input type="text" name="expiry" class="form-control">
																</div>
																<div class="col-sm-4">
																	<label>CVV:</label>
																	<input type="text" name="cvv" class="form-control">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--row closed-->

					</section>
				</div>
 @endsection