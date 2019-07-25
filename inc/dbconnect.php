<?php

/**
 * This file is going to handle all database connections
 *
 * @category   Web App
 * @package    Control System
 * @author     Louis L <louis@ZTelco.com>
 * @copyright  2019 ZTelco
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0.0
 * @since      file available since Release 1.0.0
 */

$config = parse_ini_file( 'config.ini' );

$db = new mysqli( $config[ 'host' ], $config[ 'user' ], $config[ 'pass' ], $config[ 'dbname' ] ) or die( $db->error );

// Check connection
if ( $db->connect_error ) {
    die( "Connection failed: " . $db->connect_error );
} 