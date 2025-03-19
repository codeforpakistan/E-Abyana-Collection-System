$(function() {

	//Initialize Select2 Elements
	$('.select2').select2()

	//Datemask dd/mm/yyyy
	$('#datemask').inputmask('dd/mm/yyyy', {
		'placeholder': 'dd/mm/yyyy'
	})

	//Datemask2 mm/dd/yyyy
	$('#datemask2').inputmask('mm/dd/yyyy', {
		'placeholder': 'mm/dd/yyyy'
	})

	//Money Euro
	$('[data-mask]').inputmask()

	//Date range picker
	$('#reservation').daterangepicker()

	//Date range picker with time picker
	$('#reservationtime').daterangepicker({
		timePicker: true,
		timePickerIncrement: 30,
		format: 'MM/DD/YYYY h:mm A'
	})

	//Date range as a button
	$('#daterange-btn').daterangepicker({
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().subtract(29, 'days'),
		endDate: moment()
	}, function(start, end) {
		$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
	})

	//Date picker
	$('#datepicker').datepicker({
		autoclose: true
	})

	//Month picker
	$('#datepicker-months').datepicker({
		format: "mm-yyyy",
		viewMode: "months",
		minViewMode: "months"
	})

	//Week picker
	var updating = false;
	$('#datepicker-week').datepicker({
		weekStart: 1,
		format: "dd-mm-yyyy",
		calendarWeeks: true
	}).on('changeDate', function (e){
		if (updating)
			return;
		updating = true;
		var value = e.date;
		var startOfWeek = moment(value).day(1);
		var endOfWeek =  moment(value).day(7);
		$(this).datepicker('clearDate');
		$(this).datepicker('setDates', [
			moment(value).day(1).toDate(),
			moment(value).day(2).toDate(),
			moment(value).day(3).toDate(),
			moment(value).day(4).toDate(),
			moment(value).day(5).toDate(),
			moment(value).day(6).toDate(),
			moment(value).day(7).toDate()
		]);
		updating = false;
	});


	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	})

	//blue color scheme for iCheck
	$('input[type="checkbox"].minimal-blue, input[type="radio"].minimal-blue').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	})

	//Flat blue color scheme for iCheck
	$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat-blue'
	})

	//Colorpicker
	$('.my-colorpicker1').colorpicker()

	//color picker with addon
	$('.my-colorpicker2').colorpicker()

	//Timepicker
	$('#timepicker').timepicker({
		showInputs: false
	})//Timepicker
	$('#timepicker2').timepicker({
		showInputs: false
	})
})