<script type="text/javascript" src="{{ URL::asset('js/moment.js') }}"></script>
<script type="text/javascript">
		$('#form-control').datepicker({
		    language: 'en',
		    position: "right top" 
		});
		
		//get current date and add to from date input
		var today = moment().format("dddd D MMMM YYYY");

		//when loosing focus of quantity consumed input set date in start date input
		$("input[name='quantity_consumed']").change(function() {
		   	focus++;
	    	$( "input[name='startDate']" ).val(today);
		 });

		//when loosing focus of times_a_day input set date in start date input
		$("input[name='times_a_day']").change(function() {
		   	focus++;
	    	$( "input[name='startDate']" ).val(today);
		 });

		//when loosing focus on no of days input add days to start date and show end date in input
		$("input[name='no_of_days']").change(function() {
		   	focus++;
	    	
	    	var startDate = document.getElementsByName("startDate")[0].value;
	    	if(!startDate)
	    	{
	    		$( "input[name='startDate']" ).val(today);
	    		var startDate = document.getElementsByName("startDate")[0].value;
	    	}

		   	var no_of_days = $("input[name='no_of_days']").val();
		   	if(no_of_days)
		   	{
			   	var endDate    = moment(startDate).add(no_of_days, 'days');
			   	endDate    = moment(endDate).format("dddd D MMMM YYYY");
			   	$("input[name='endDate']").val(endDate);
		   	} 

		 });

		//when loosing focus on start date set end date
		$(".startD").focusout(function() {
		   	focus++;
		   	var startDate = document.getElementsByName("startDate")[0].value;

		   	if(moment(startDate).isBefore(moment()))
		   	{
	    		$( "input[name='startDate']" ).val(today);
		   	}

		   	var startDate = document.getElementsByName("startDate")[0].value;

			var startDate    = moment(startDate).format("dddd D MMMM YYYY");
			$( "input[name='startDate']" ).val(startDate);

		   	var no_of_days = $("input[name='no_of_days']").val();
		   	if(no_of_days)
		   	{
			   	var endDate    = moment(startDate).add(no_of_days, 'days');
			   	endDate    = moment(endDate).format("dddd D MMMM YYYY");
			   	$("input[name='endDate']").val(endDate);
		   	} 

		 });




		$(".endD").focusout(function() {
		   	focus++;
		   	var startDate = document.getElementsByName("startDate")[0].value;
		   	var endDate = document.getElementsByName("endDate")[0].value;

		   	if(moment(endDate).isBefore(startDate))
		   	{
	    		$("input[name='endDate']").val("");

	    		$("input[name='endDate']").css("border", "red solid 1px");
		   	} 

		   	if(moment(endDate).isAfter(startDate))
		   	{

	    		$("input[name='endDate']").css("border", "#cfdadd solid 1px");
		   	} 

		 });

		//Focus on input when prepare modal open
		$('#prepareModal').on('shown.bs.modal', function () {
		    $("input[name='quantityDispensed']").focus();
		});  

		$('#search-dispensation').on('shown.bs.modal', function () {
		    $('.focus-input').focus();
		}); 

		$('.search').on('shown.bs.modal', function () {
		    $('.search').focus();
		});

		$('.focus').on('shown.bs.modal', function () {
		    $('.focus').focus();
		}); 

		/*if(endDate)
		{
			moment('2010-10-20').isBefore('2010-10-21');
		}*/
	</script>
