<?php
session_start();

if (!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

include("connection.php");

$tender_id = $_GET['id'];

$result = mysqli_query($mysqli, "DELETE FROM user_applied_tender WHERE tender_id = $tender_id");

if ($result) {
	header("Location: view.php");
} else {
	echo "Error deleting records from user_applied_tender table.";
}
