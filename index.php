<?php session_start(); ?>
<html>

<head>
	<title>Homepage</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

	<div class="container mt-5">
		<?php
		if (isset($_SESSION['valid'])) {
			include("connection.php");
			$result = mysqli_query($mysqli, "SELECT * FROM login");
		?>

			<div class="alert alert-success">
				<div class="d-flex justify-content-between">
					<div class="h4">
						Welcome <?php echo $_SESSION['name'] ?>!
					</div>
					<div>
						<a class="btn btn-primary float-right" href='logout.php'>Logout</a>
					</div>
				</div>
			</div>
			<div class="mt-4">
				<a class="btn btn-info" href='view.php'>View and Add Tenders</a>
			</div>

		<?php
		} else {
		?>

			<div class="alert alert-warning">
				You must be logged in to view this page.
			</div>
			<div class="mt-4">
				<a class="btn btn-primary" href='login.php'>Login</a> <a class="btn btn-secondary" href='register.php'>Register</a>
			</div>

		<?php
		}
		?>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>

</html>