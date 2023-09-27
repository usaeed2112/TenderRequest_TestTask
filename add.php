<?php
session_start();

if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

// Including the database connection file
include_once("connection.php");

if (isset($_POST['Submit'])) {
	$departmentId = $_POST['department'];
	$t_number = $_POST['t_number'];
	$t_date = $_POST['t_date'];
	$file = $_FILES['file']['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];

	if (empty($t_number) || empty($t_date) || empty($file) || empty($email) || empty($username)) {
		echo "<div class='alert alert-danger' role='alert'>";
		echo "Field Empty.";
		echo "</div>";
	} else {
		$check_query = mysqli_query($mysqli, "SELECT id FROM tenders WHERE tender_numbe = '$t_number'");
		if (mysqli_num_rows($check_query) > 0) {
			$tender_row = mysqli_fetch_assoc($check_query);
			$tender_id = $tender_row['id'];
			$check_login_query = mysqli_query($mysqli, "SELECT id FROM login WHERE email = '$email'");
			if (mysqli_num_rows($check_login_query) > 0) {
				$login_row = mysqli_fetch_assoc($check_login_query);
				$user_id = $login_row['id'];
			} else {
				$result_login = mysqli_query($mysqli, "INSERT INTO login (email, username) VALUES ('$email', '$username')");
				if ($result_login) {
					$user_id = mysqli_insert_id($mysqli);
				} else {
					echo "<div class='alert alert-danger' role='alert'>";
					echo "Error creating a new user record.";
					echo "</div>";
				}
			}
			$result_user_applied_tender = mysqli_query($mysqli, "INSERT INTO user_applied_tender (user_id, tender_id) VALUES ('$user_id', '$tender_id')");

			if ($result_user_applied_tender) {
				echo "<div class='alert alert-success' role='alert'>";
				echo "Data added successfully.";
				echo "</div>";
			} else {
				echo "<div class='alert alert-danger' role='alert'>";
				echo "Error adding data to the user_applied_tender table.";
				echo "</div>";
			}
		} else {
			echo "<div class='alert alert-danger' role='alert'>";
			echo "Error adding data to the tenders table.";
			echo "</div>";
		}

		echo "<div class='text-center'>";
		echo "<a href='view.php' class='btn btn-primary'>View Result</a>";
		echo "</div>";
	}
}
