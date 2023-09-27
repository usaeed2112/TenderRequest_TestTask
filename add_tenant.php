<?php
include_once("connection.php");
$departments = array();
$query = "SELECT * FROM departments";

$result = mysqli_query($mysqli, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Data</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <a href="index.php" class="h4">Home</a>
                <div class="float-right">
                    <a href="view.php" class="btn btn-success">View Tenders</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
                <br /><br />

                <form action="add.php" method="post" name="form1" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" name="department">
                            <?php
                            foreach ($departments as $department) {
                                echo "<option value=\"" . $department['id'] . "\">" . $department['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number">Tender Number</label>
                        <input type="text" class="form-control" name="t_number" required>
                    </div>
                    <div class="form-group">
                        <label for="t_date">Date</label>
                        <input type="date" class="form-control" name="t_date" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" name="file" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" name="Submit" value="Add">
                    </div>
                    <br>
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