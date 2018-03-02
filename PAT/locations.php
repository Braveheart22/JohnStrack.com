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
$query = "SELECT * FROM jobs, stations WHERE stations.id = jobs.station_id AND station_id < 1200 ORDER BY station_id, date_entered";
$result = mysqli_query ($conn, $query);

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

<h1>Current Locations</h1>

<?php echo $alertMessage; ?>
<table class="table table-striped table-bordered">
    <tr>
        <th>Station ID</th>
        <th>Date Entered</th>
        <th>Job Number</th>
    </tr>
	
	<?php
		if (mysqli_num_rows ($result) > 0) {
			// we have data!
			// output the data
			while ($row = mysqli_fetch_assoc ($result)) {
				echo "<tr>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>" . $row['date_entered'] . "</td>";
				echo "<td>" . $row['job_no'] . "</td>";
				echo "</tr>";
			}
		} else {
			echo "<div class = 'alert alert-warning'>There is no data to display!</div>";
		}
	?>

</table>

<?php
include('includes/footer.php');
?>