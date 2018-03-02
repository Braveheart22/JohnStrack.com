<?php
session_start();

// if the user is not logged in
if (!$_SESSION['loggedInUser']) {
	// send them to the login page
	header ("Location: index.php");
}

// connect to database
include ('includes/connection.php');

// query & result
$dropdownQuery = "SELECT id, description FROM stations WHERE stations.active = 'Y' ORDER BY id ASC";
$dropdownResult = mysqli_query ($conn, $dropdownQuery);

// check for query string
if (isset ($_GET['alert'])) {
	// new client added
	if ($_GET['alert'] == 'success') {
		$alertMessage = "<div class='alert alert-success'>New location added!<a class='close' data-dismiss='alert'>&times;</a></div>";
	// client updated
	} elseif ($_GET['alert'] == 'updatesuccess') {
		$alertMessage = "<div class='alert alert-success'>Location updated!<a class='close' data-dismiss='alert'>&times;</a></div>";
	// client deleted
	} elseif ($_GET['alert'] == 'deleted') {
		$alertMessage = "<div class='alert alert-success'>Location deleted!<a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}

// close the mySQL connection
mysqli_close ($conn);

include('includes/header.php');
?>

<h1>Move Job</h1>

<?php echo $alertMessage; ?>

<table class="table table-striped table-bordered">
    <tr>
        <th>Station ID</th>
        <th>Date Entered</th>
        <th>Job Number</th>
    </tr>
	
	<div class="col-xs-4"></div>
	<div class="col-xs-4">
	<?php
		echo "<select name='stations' class='form-control'>";
		while ($row = mysqli_fetch_assoc($dropdownResult)) {
			echo "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";
		}
		echo "</select>";

	?>
	</div>
	<div class="col-xs-4"></div>

</table>

<?php
include('includes/footer.php');
?>