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
	
	$selection 	= (  empty( $_POST[ 'selection' ] ) ) ? '' : $_POST[ 'selection' ];
	$evening 	= (  empty( $_POST[ 'evening' ] ) )	? '' : $_POST[ 'evening' ];
	$emergency 	= (  empty( $_POST[ 'emergency' ] ) ) ? '' : $_POST[ 'emergency' ];
	$option5 	= (  empty( $_POST[ 'option5' ] ) )	? '' : $_POST[ 'option5' ];
	$value5 	= (  empty( $_POST[ 'value5' ] ) )	? '' : $_POST[ 'value5' ];
	$option6 	= (  empty( $_POST[ 'option6' ] ) )	? '' : $_POST[ 'option6' ];
	$value6 	= (  empty( $_POST[ 'value6' ] ) )	? '' : $_POST[ 'value6' ];
	$option7 	= (  empty( $_POST[ 'option7' ] ) ) ? '' : $_POST[ 'option7' ];
	$value7 	= (  empty( $_POST[ 'value7' ] ) ) 	? '' : $_POST[ 'value7' ];
	

	$sql = "UPDATE control SET selection=$selection,evening=$evening WHERE 0";

	// $db->query( $sql ) or die( $db->error );
	
	echo json_encode($_POST);
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