<?php

/**
 * This file is going to handle all ajax requests on the backend
 *
 * @category   Web App
 * @package    Control System
 * @author     Louis L <louis@ZTelco.com>
 * @copyright  2019 ZTelco
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0.0
 * @since      file available since Release 1.0.0
 */

include 'dbconnect.php';

if ( isset( $_POST[ 'selection' ] ) ) {
	
	$selection 	= ( empty( $_POST[ 'selection' ] ) ) ? 	'' : $_POST[ 'selection' ];
	$evening 	= ( empty( $_POST[ 'evening' ] ) )	? 	'' : $_POST[ 'evening' ];
	$emergency 	= ( empty( $_POST[ 'emergency' ] ) ) ?	'' : $_POST[ 'emergency' ];
	$option3 	= ( empty( $_POST[ 'option3' ] ) )	? 	'' : $_POST[ 'option3' ];
	$option4 	= ( empty( $_POST[ 'option4' ] ) )	? 	'' : $_POST[ 'option4' ];
	$option5 	= ( empty( $_POST[ 'option5' ] ) )	? 	'' : $_POST[ 'option5' ];
	$option6 	= ( empty( $_POST[ 'option6' ] ) )	? 	'' : $_POST[ 'option6' ];
	$option7 	= ( empty( $_POST[ 'option7' ] ) )	? 	'' : $_POST[ 'option7' ];
	$option8 	= ( empty( $_POST[ 'option8' ] ) )	? 	'' : $_POST[ 'option8' ];

	// Check if there are any records in the database
	$checkquery = $db->query( "SELECT * FROM control WHERE id=1" );

	/**
	 * If there are no records run code to add new record
	 * else update the current record
	 * @author Louis Lister <llister@ztelco.com>
	 * @since  1.0.0
	 */
	if ( $checkquery->num_rows > 0 ) {
		
		$sql = "UPDATE control SET 
				selection='$selection',
				evening='$evening',
				emergency='$emergency',
				option3='$option3',
				option4='$option4', 
				option5='$option5', 
				option6='$option6', 
				option7='$option7', 
				option8='$option8' 
					WHERE id='1'";
		
		if ($db->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $db->error;
		}

	} else {
		
		$sql = "INSERT INTO control ( id, selection, evening, emergency, option3, option4, option5, option6, option7, option8 )
			VALUES ( '1', '$selection', '$evening', '$emergency', '$option3', '$option4', '$option5', '$option6', '$option7', '$option8' )"; 

		if ($db->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $db->error;
		}
	}
}

if ( isset ( $_POST[ 'onload' ] ) ) {

	$sql = $db->query("SELECT * FROM asterisk.control") or die($db->error);
	$data = $sql->fetch_assoc();

	if ( empty( $data ) ) {
		echo "No data in database";
	} else {
		echo json_encode( $data );
	}
}