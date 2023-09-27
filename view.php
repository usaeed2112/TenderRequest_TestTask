<?php
session_start();

if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

// Including the database connection file
include_once("connection.php");

// Fetching data from tenders and user_applied_tender tables with INNER JOIN
$result = mysqli_query($mysqli, "SELECT tenders.*, departments.name AS department_name, GROUP_CONCAT(login.email) AS user_emails 
                                    FROM tenders 
                                    INNER JOIN departments ON tenders.department_id = departments.id 
                                    INNER JOIN user_applied_tender ON tenders.id = user_applied_tender.tender_id
                                    INNER JOIN login ON user_applied_tender.user_id = login.id
                                    GROUP BY tenders.id");

?>

<html>

<head>
	<title>Homepage</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>

<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<a href="index.php" class="h4">Home</a>
				<div class="float-right">
					<a href="add_tenant.php" class="btn btn-success">Add New Data</a>
					<a href="logout.php" class="btn btn-danger">Logout</a>
				</div>
				<br /><br />

				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th>Tender Code</th>
							<th>Department</th>
							<th>Users</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($res = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $res['tender_numbe'] . "</td>";
							echo "<td>" . $res['department_name'] . "</td>";
							echo "<td><ul>";
							$userEmails = explode(',', $res['user_emails']);
							foreach ($userEmails as $email) {
								echo "<li>$email</li>";
							}
							echo "</ul></td>";
							echo "<td>
                                    <a href=\"delete.php?id=" . $res['id'] . "\" class='btn btn-danger btn-sm' onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                  </td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>