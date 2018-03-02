<?php
session_start ();

// if the user is not logged in
if (!$_SESSION['loggedInUser']) {
	// send them to the login page
	header ("Location: index.php");
}

// connect to database
include ('includes/connection.php');

// include functions file
include ('includes/functions.php');

if (isset ($_POST['add'])) {
	// set all variables to empty by default
	$id = $description = "";
	
	// check to see if inputs are empty
	// create variables with form data
	// wrap the data with our function
	if (!$_POST['id']) {
		$errorMessage = "<div class='alert alert-warning'>Please enter an id.</div><br>";		
	} else {
		$id = validateFormData ($_POST['id']);
	}

	if (!$_POST['description']) {
		$errorMessage = "<div class='alert alert-warning'>Please enter a description.</div><br>";
	} else {
		$description = validateFormData ($_POST['description']);
	}

    // if required fields have data
    if ($id && $description) {

		// create query
        $query = "INSERT INTO stations (id, description, active) VALUES ('$id', '$description', 'Y')";
		$result = mysqli_query ($conn, $query);
		
		// check if query was successful
		if ($result) {
			//refresh page with query string
			header ("Location: stationMaint.php?alert=success");
		} else {
			// something went wrong
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}
	}
}

// close the connection
mysqli_close ($conn);

include('includes/header.php');
?>

<h1>Add Station</h1>

<?php echo $errorMessage; ?>

<form action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>" method="post" class="row">
    <div class="form-group col-sm-4">
        <label for="client-id">ID *</label>
        <input type="text" class="form-control input-lg" id="client-id" name="id" value="">
    </div>
    <div class="form-group col-sm-8">
        <label for="client-description">Description *</label>
        <input type="text" class="form-control input-lg" id="client-description" name="description" value="">
    </div>
    <div class="col-sm-12">
            <a href="stationMaint.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Station</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>