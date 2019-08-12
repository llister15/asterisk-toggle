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

$(document).ready(function() {

    // Load the amount of options
    newaddedOptionNumber = $(':radio[name=selection]').length - 1;
    // This ajax call is to set the current options on page load
    $.ajax({
        url: 'inc/controlajax.php',
        type: 'POST',
        data: {
            'onload': 'loaded'
        },
        dataType: 'text',
        success: function(data) {
            if ("No data in database" !== data) {
                var addedOptionNumber = $(':radio[name=selection]').length - 2;
                var output = JSON.parse(data);
                // On sucess load all options on page load          
                $('#' + output.selection).prop('checked', true);
                $('#eveningNumber').val(output.evening);
                $('#emergencyNumber').val(output.emergency);
                var options = JSON.parse( output.options );
                for ( let option in options ) {
                    $('#option-table tbody tr:last-child').after('<tr><th scope="row"><div class="form-check">\
    					<input class="form-check-input" type="radio" id="' + option + '-radio" name="selection" value="' + option + '" >\
    					<label class="form-check-label" for="' + option + '">' + option + '</label></div></th>\
    					<td>\
    					<input name="' + option + '" id="' + option + '" type="text" class="form-control" placeholder="' + option + ' #" value="' + options[option] + '" maxlength="10">\
    					</td>\
    					<td class="text-center align-middle"><a href="#"><i class="fas fa-minus" forid="' + option + '"></i></a></td></tr>');
                }

                $('input:radio').each(function() {
                    if ($(this).attr('value') === output.selection) {
                        $(this).attr('checked', 'checked');
                    }
                });

                $("td>a>.fa-minus").click(function(event) {
                    var inputid = $(this).attr('forid');
                    var inputelement = $('#' + $(this).attr('forid'));
                    $.ajax({
                        url: 'inc/controlajax.php',
                        type: 'POST',
                        data: {
                            'removeitem': inputid,
                        },
                        dataType: 'text',
                        success: function(data) {
                            console.log(data);
                            // On success load notification on the top           
                            // $('html, body').animate({
                            //     scrollTop: $('body').offset().top + 30
                            // });
                            // $('.alert').text(data);
                            // $(".alert").fadeIn();
                            // setTimeout(function() {
                            //     $(".alert").fadeOut();
                            // }, 3000);
                            // inputelement.val('').parent().closest('tr').fadeOut();
                        },
                        error: function(request, error) {
                            // Error message for bad ajax call
                            console.log("Request: " + JSON.stringify(request));
                        }
                    });
                });
            }
        },
        error: function(request, error) {
            // Error message for bad ajax call
            console.log("Request: " + JSON.stringify(request));
        }

    });

    $("#add-option").click(function(event) {
        event.preventDefault();
        var maxOptions = 8;
        if (newaddedOptionNumber > maxOptions) {
            $("#add-option").prop("disabled", true);
            // When the max option limit is hit error message         
            $('.alert').text("Sorry the max limit is " + maxOptions + " options");
            $(".alert").fadeIn();
            setTimeout(function() {
                $(".alert").fadeOut();
            }, 3000);
            $('html, body').animate({
                scrollTop: $('body').offset().top + 30
            });
            return;
        } else {
            $("#add-option").removeProp("disabled");
        }
        setTimeout(function() {
            $('#new-option-name').focus();
            $(document).on('keypress', function(e) {
                if (e.which == 13) {
                    $('#add-option-btn').click();
                    $(document).off('keypress');
                }
            });
        }, 500);

    });

    $('#add-option-btn').click(function(event) {
        event.preventDefault();
        var newOptionName = $.trim($('#new-option-name').val());

        $('#option-table tbody tr:last-child').after('<tr><th scope="row"><div class="form-check">\
			<input class="form-check-input" type="radio" id="' + newOptionName + '-radio" name="selection" value="' + newOptionName + '" >\
			<label class="form-check-label" for="' + newOptionName + '">' + newOptionName + '</label></div></th>\
			<td>\
			<input name="' + newOptionName + '" id="' + newOptionName + '" type="text" class="form-control" placeholder="' + newOptionName + ' #" maxlength="10">\
			</td>\
			<td class="text-center align-middle"><a href="#"><i class="fas fa-minus" forid="' + newOptionName + '"></i></a></td></tr>');

        $('html, body').animate({
            scrollTop: $('#option-table tr:last').offset().top - 30
        });
        //Clear input after adding the new option
        $('#new-option-name').val('');
        newaddedOptionNumber = newaddedOptionNumber + 1;
        setTimeout(function() {
            $('#' + newOptionName).focus();
        }, 800);

    });

    // This for the click event on the form
    $("#myForm").submit(function(event) {

        // Stop the default page refresh on form submission
        event.preventDefault();
        var formData = $(this).serializeArray();
        var formObj = {};
        formObj.options = {};
        // Load all form values into an object
        $(formData).each(function(i, field) {
            if ('selection' !== field.name && 'eveningNumber' !== field.name && 'emergencyNumber' !== field.name) {

                formObj.options[field.name] = field.value;

            } else {

                formObj[field.name] = field.value;
            }
        });
        // This ajax call is to load new or update all options in the database
        $.ajax({
            url: 'inc/controlajax.php',
            type: 'POST',
            data: {
                'selection': formObj.selection,
                'evening': formObj.eveningNumber,
                'emergency': formObj.emergencyNumber,
                'options': JSON.stringify(formObj.options),
            },
            dataType: 'text',
            success: function(data) {
                // On success load notification on the top           
                $('html, body').animate({
                    scrollTop: $('body').offset().top + 20
                });
                $('.alert').text(data);
                $(".alert").fadeIn();
                setTimeout(function() {
                    $(".alert").fadeOut();
                }, 3000);
            },
            error: function(request, error) {
                // Error message for bad ajax call
                console.log("Request: " + JSON.stringify(request));
            }
        });
    });
});