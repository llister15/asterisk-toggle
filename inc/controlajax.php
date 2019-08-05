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

require 'dbconnect.php';

if ( isset( $_POST['onload'] ) ) {

	$sql  = $db->query( 'SELECT * FROM asterisk.control' ) or die( $db->error );
	$data = $sql->fetch_assoc();

	if ( empty( $data ) ) {
		echo 'No data in database';
	} else {
		echo json_encode( $data );
	}
}

if ( isset( $_POST['removeitem'] ) ) {
	$option = $_POST['removeitem'];
	$sql    = $db->query( 'SELECT options FROM asterisk.control' ) or die( $db->error );
	$data   = $sql->fetch_assoc();

	echo implode( ' ', $data );
	// $data = json_encode( $data );
	// $obj  = json_decode( $data );

}

if ( isset( $_POST['selection'] ) ) {

	$selection = ( empty( $_POST['selection'] ) ) ? '' : $_POST['selection'];
	$evening   = ( empty( $_POST['evening'] ) ) ? '' : $_POST['evening'];
	$emergency = ( empty( $_POST['emergency'] ) ) ? '' : $_POST['emergency'];
	$options   = ( empty( $_POST['options'] ) ) ? '' : $_POST['options'];

	// Check if there are any records in the database
	$checkquery = $db->query( 'SELECT * FROM control WHERE id=1' );

	/**
	 * If there are no records run code to add new record
	 * else update the current record
	 *
	 * @author Louis Lister <llister@ztelco.com>
	 * @since  1.0.0
	 */
	if ( $checkquery->num_rows > 0 ) {

		$sql = "UPDATE control SET 
				selection='$selection',
				evening='$evening',
				emergency='$emergency',
				options='$options'
					WHERE id='1'";

		if ( $db->query( $sql ) === true ) {
			echo 'New record created successfully';
		} else {
			echo 'Error: ' . $sql . '<br>' . $db->error;
		}
	} else {

		$sql = "INSERT INTO control ( id, selection, evening, emergency, options )
			VALUES ( '1', '$selection', '$evening', '$emergency', '$options')";

		if ( $db->query( $sql ) === true ) {
			echo 'New record created successfully';
		} else {
			echo 'Error: ' . $sql . '<br>' . $db->error;
		}
	}
}
