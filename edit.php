<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

if (isset($_POST['update'])) {
	$id = $_POST['id'];

	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];

	// checking empty fields
	if (empty($name) || empty($qty) || empty($price)) {

		if (empty($name)) {
			echo "<div class='alert alert-danger'>Name field is empty.</div>";
		}

		if (empty($qty)) {
			echo "<div class='alert alert-danger'>Quantity field is empty.</div>";
		}

		if (empty($price)) {
			echo "<div class='alert alert-danger'>Price field is empty.</div>";
		}
	} else {
		// updating the table
		$result = mysqli_query($mysqli, "UPDATE products SET name='$name', qty='$qty', price='$price' WHERE id=$id");

		// redirecting to the display page (view.php)
		header("Location: view.php");
	}
}
?>
<?php
// getting id from URL
$id = $_GET['id'];

// selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");

while ($res = mysqli_fetch_array($result)) {
	$name = $res['name'];
	$qty = $res['qty'];
	$price = $res['price'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Edit Data</title>
	<!-- Include Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<a href="index.php" class="h4">Home</a>
				<div class="float-right">
					<a href="view.php" class="btn btn-success">View Tenants</a>
					<a href="logout.php" class="btn btn-danger">Logout</a>
				</div>
				<br /><br />

				<form name="form1" method="post" action="edit.php">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
					</div>
					<div class="form-group">
						<label for="qty">Quantity</label>
						<input type="text" class="form-control" name="qty" value="<?php echo $qty; ?>" required>
					</div>
					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" class="form-control" name="price" value="<?php echo $price; ?>" required>
					</div>
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<div class="text-center">
						<input type="submit" class="btn btn-primary" name="update" value="Update">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Include Bootstrap JS and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>