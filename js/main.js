/**
 * This file is going to handle all ajax requests on the front-end
 *
 * @category   Web App
 * @package    Control System
 * @author     Louis L <louis@ZTelco.com>
 * @copyright  2019 ZTelco
 * @version    Release: 1.0.0
 * @since      file available since Release 1.0.0
 */

$( document ).ready(function() {

	// This ajax call is to set the current options on page load
	$.ajax({
	    url : 'inc/controlajax.php',
	    type : 'POST',
	    data : {
	        'onload' : 'loaded'
	    },
	    dataType:'text',
	    success : function(data) { 
	    	var output = JSON.parse(data);
	    	var optionNumber = $(':radio[name=selection]').length + 1;
	    	// On sucess load all options on page load          
	        $('#'+output.selection).prop('checked',true);
	        $('#eveningNumber').val(output.evening);
	        $('#emergencyNumber').val(output.emergency);
	        console.log(output);
	        // for ( var i in output ) {
	        // 	if ( output[i] === 'evening' || output[i] === 'emergency' || output[i] === 'schedule' || output[i] === '' ) {
	        // 		console.log("return happening " +output[i] );
	        // 	} else {
	        // 		// console.log(output[i]);
			      //   $('#option-table tr:nth-last-child(3)').after( '<tr><th scope="row"><div class="form-check">\
			      //   	<input class="form-check-input" type="radio" id="'+output[i]+'" name="selection" value="'+output[i]+'">\
			      //   	<label class="form-check-label" for="'+output[i]+'">'+output[i]+'</label></div></th>\
			      //   	<td><input name="value'+optionNumber+'" id="value'+optionNumber+'" type="text" class="form-control" value="'+output[i]+'" maxlength="10"></td>\
			      //   	<td class="text-center align-middle"><a href="#"><i class="fas fa-minus"></i></a></td></tr>');
	        // 	}
	        // }
	    },
	    error : function(request,error) {
	    	// Error message for bad ajax call
	        console.log("Request: "+JSON.stringify(request));
	    }
	});

	$( "#add-option" ).click(function( event ) {
		this.preventDefault;
		var maxOptions = 5;
		if ( $(':radio[name=selection]').length > maxOptions ) {

			// When the max option limit is hit error message         
		    $('.alert').text( "Sorry the max limit is " + maxOptions + " options" );
		    $(".alert").fadeIn();
		    setTimeout(function(){
		      $(".alert").fadeOut(); 
		    }, 3000);
			return;
		} else {

			$('#add-option-btn').click(function( event ) {
			this.preventDefault;
			var newOptionNumber = $(':radio[name=selection]').length + 1;
			var newOptionName= $.trim( $( '#new-option-name' ).val() );

			$('#option-table tr:nth-last-child(2)').after( '<tr><th scope="row"><div class="form-check">\
				<input class="form-check-input" type="radio" id="'+newOptionName+'" name="selection" value="'+newOptionName+'" >\
				<label class="form-check-label" for="'+newOptionName+'">'+newOptionName+'</label></div></th>\
				<td>\
				<input name="option'+newOptionNumber+'" id="option'+newOptionNumber+'" type="hidden" value="'+newOptionName+'">\
				<input name="value'+newOptionNumber+'" id="value'+newOptionNumber+'" type="text" class="form-control" placeholder="'+newOptionName+' #" maxlength="10">\
				</td>\
				<td class="text-center align-middle"><a href="#"><i class="fas fa-minus"></i></a></td></tr>');
			$('html, body').animate({ scrollTop:  $('#option-table tr:last').offset().top - 30 } );
			//Clear input after adding the new option
			$( '#new-option-name' ).val('');

			});
		}
	});

	// This for the click event on the form
	$( "#myForm" ).submit(function( event ) {
	  	
	  	// Stop the default page refresh on form submission
	  	event.preventDefault();
		var formData = $( this ).serializeArray();
		var formObj = {};
		// Load all form values into an object
		$(formData).each(function(i, field){
		  formObj[field.name] = field.value;
		});
		console.log(formObj);
		// This ajax call is to load new or update all options in the database
		$.ajax({
		    url : 'inc/controlajax.php',
		    type : 'POST',
		    data : {
		        'selection'   : formObj.selection,
		        'evening'	  : formObj.eveningNumber,
		        'emergency'	  : formObj.emergencyNumber,
		        'option5'	  : formObj.option5,
		        'value5'	  : formObj.value5,
		        'option6'	  : formObj.option6,
		        'value6'	  : formObj.value6,
		        'option7'	  : formObj.option7,
		        'value7'	  : formObj.value7
		    },
		    dataType:'text',
		    success : function(data) {   
		    	// On success load notification on the top           
		        $('.alert').text(data);
		        $(".alert").fadeIn();
		        setTimeout(function(){
		          $(".alert").fadeOut(); 
		        }, 3000);
		    },
		    error : function(request,error) {
	    		// Error message for bad ajax call
		        console.log("Request: "+JSON.stringify(request));
		    }
		});
	});
});