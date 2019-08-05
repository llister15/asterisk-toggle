<?php

session_start();

/**
 * This file is main message page
 *
 * @category   Web App
 * @package    Forwarding toggle
 * @author     Louis L <louis@ZTelco.com>
 * @copyright  2019 ZTelco
 * @version    Release: 1.0.0
 * @since      file available since Release 1.0.0
 */

$config = parse_ini_file( 'inc/config.ini' );
?>

<!DOCTYPE html>
<html>
<head>
	<title>BackDrops | Control System</title>
	<meta charset="UTF-8">
	<meta name="description" content="ZTelco Control System">
	<meta name="keywords" content="Control System,HTML,APPLICATION">
	<meta name="author" content="Louis">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link crossorigin="anonymous" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" rel="stylesheet">
	<link rel="shortcut icon" href="img/zfavicon.png" type="image/png">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="content-wrap">
		<header class="container-fuild">
			<div class="row no-gutters">
				<div class="col">
					<nav class="navbar navbar-expand-md navbar-dark navbar-color">
						<a href="#" class="navbar-brand"><img src="img/ztelco-logo.png"></a>
						<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="navbarCollapse">
							<div class="navbar-nav">
							</div>
							<div class="navbar-nav ml-auto">
								<a href="#" class="nav-item nav-link"><?php echo $config['company']; ?></a>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<main class="container">
			<div class="row justify-content-md-center">
				<div class="col-xm-12 col-md-8">
					<div class="alert alert-success hide" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="card">
					  <div class="card-body">
						<h5 class="card-title text-center">Main Number Flow</h5>
						<p class="card-text text-center">Control System Options <br />
								This system does not support spaces <br />
								All number numbers must be in a 10 digit format <br />
								[ ########## ] <br />
						</p>
						<form id="myForm">
							<table id="option-table" class="table table-striped table-hover">
							  <thead>
								<tr class="text-center">
								  <th scope="col">Setting</th>
								  <th scope="col">Value</th>
								  <th scope="col"></th>
								</tr>
							  </thead>
							  <tbody>
								  <tr>
									<th scope="row" colspan="1">
										<div class="form-check">
										  <input class="form-check-input" type="radio" id="schedule" name="selection" value="schedule">
										  <label class="form-check-label" for="schedule">
											Schedule
										  </label>
										</div>
									</th>
									<td class="text-center align-middle">
										<button type="button" class="btn btn-outline-info btn-sm" id="edit" data-toggle="modal" data-target="#scheduleModal">Edit</button>
									</td>
									<td class="text-center align-middle">
									</td>
								  </tr>
								<tr>
								  <th scope="row" colspan="2">
									  <div class="form-check">
										<input class="form-check-input" type="radio" id="day" name="selection" value="day" checked>
										<label class="form-check-label" for="day">
										  Day
										</label>
									  </div>
								  </th>
									  <td class="text-center align-middle">
									  </td>
								</tr>
								<tr>
								  <th scope="row">
									  <div class="form-check">
										<input class="form-check-input" type="radio" id="evening" name="selection" value="evening">
										<label class="form-check-label" for="evening">
										  Evening
										</label>
									  </div>
								  </th>
								  <td>
									  <input name="eveningNumber" id="eveningNumber" type="text" class="form-control" placeholder="Evening #" maxlength="10">
								  </td>
								  <td class="text-center align-middle">
								  </td>
								</tr>
								<tr>
								  <th scope="row">
									  <div class="form-check">
										<input class="form-check-input" type="radio" id="emergency" name="selection" value="emergency">
										<label class="form-check-label" for="emergency">
										  Emergency
										</label>
									  </div>
								  </th>
								  <td>
									  <input name="emergencyNumber" id="emergencyNumber" type="text" class="form-control" placeholder="Emergency #" maxlength="10">
								  </td>
								  <td class="text-center align-middle">
								  </td>
								</tr>
							  </tbody>
							  <tfoot>  
								<tr>
									<td colspan="3">
										<input type="submit" name="submit" id="submit" class="btn btn-md btn-outline-secondary">
									  </td>
								  </tr>
							  </tfoot>
							</table>
						</form>
						<div class="row">
							<div class="col text-center align-middle">
								<a href="#" id="add-option"  data-toggle="modal" data-target="#newOptionModal"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					  </div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="scheduleModalLabel">Main Number Flow (edit)</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			...
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-outline-danger">Save changes</button>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Modal for new option -->
	<div class="modal fade" id="newOptionModal" tabindex="-1" role="dialog" aria-labelledby="newOptionModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="newOptionModalLabel">New Option</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<input class="form-control" id="new-option-name" type="text" placeholder="Option Name">
		  </div>
		  <div class="modal-footer">
			<button id="add-option-btn" type="button" class="btn btn-outline-danger" class="close" data-dismiss="modal" aria-label="Close">Add Option</button>
		  </div>
		</div>
	  </div>
	</div>

	<footer class="container-fuild footer">
		<div class="row no-gutters">
			<div class="col text-center">
				<span>&copy; ZTelco <?php echo date( 'Y' ); ?> | All rights reserved.
			</div>
		</div>
	</footer>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js" type="text/javascript"></script>
</body>
</html>
