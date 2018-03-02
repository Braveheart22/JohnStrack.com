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
$query = "SELECT * FROM stations ORDER BY id";
$result = mysqli_query ($conn, $query);

// check for query string
if (isset ($_GET['alert'])) {
	// new client added
	if ($_GET['alert'] == 'success') {
		$alertMessage = "<div class='alert alert-success'>New station added!<a class='close' data-dismiss='alert'>&times;</a></div>";
	// client updated
	} elseif ($_GET['alert'] == 'updatesuccess') {
		$alertMessage = "<div class='alert alert-success'>Station updated!<a class='close' data-dismiss='alert'>&times;</a></div>";
	// client deleted
	} elseif ($_GET['alert'] == 'deleted') {
		$alertMessage = "<div class='alert alert-success'>Station deleted!<a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}

// close the mySQL connection
mysqli_close ($conn);

include('includes/header.php');
?>

<h1>Station Maintenance</h1>

<?php echo $alertMessage; ?>
<table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Active</th>
        <th>Modify</th>
    </tr>
	
	<?php
		if (mysqli_num_rows ($result) > 0) {
			// we have data!
			// output the data
			while ($row = mysqli_fetch_assoc ($result)) {
				echo "<tr>";
				echo "<td>" . $row['id'] . "</td>";
				echo "<td>" . $row['description'] . "</td>";
				echo "<td>" . $row['active'] . "</td>";
				echo "<td><a href='editStation.php?id=" . $row['id'] . "' type='button' class='btn btn-default btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span></a></td>";
				echo "</tr>";
			}
		} else {
			echo "<div class = 'alert alert-warning'>You have no locations!</div>";
		}
		
		// if ($conn) {
			// mysqli_close ($conn);
		// }
	?>

    <tr>
        <td colspan="7"><div class="text-center"><a href="addStation.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Station</a></div></td>
    </tr>
</table>

<?php
include('includes/footer.php');
?>