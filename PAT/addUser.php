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
	$name = $email = $password = "";
	
	// check to see if inputs are empty
	// create variables with form data
	// wrap the data with our function
	if (!$_POST['name']) {
		$nameError = "Please enter a name.<br>";		
	} else {
		$name = validateFormData ($_POST['name']);
	}

	if (!$_POST['email']) {
		$nameError = "Please enter an email.<br>";		
	} else {
		$email = validateFormData ($_POST['email']);
	}
	
	if (!$_POST['password']) {
		$nameError = "Please enter a password.<br>";		
	} else {
	$password = validateFormData ($_POST['password']);
	}

    // if required fields have data
    if ($name && $email && password) {

		// create query
        $query = "INSERT INTO users (id, name, email, password) VALUES (NULL, '$name', '$email', '$password')";
		$result = mysqli_query ($conn, $query);
		
		// check if query was successful
		if ($result) {
			//refresh page with query string
			header ("Location: userMaint.php?alert=success");
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

<h1>Add User</h1>

<form action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>" method="post" class="row">
    <div class="form-group col-sm-3">
        <label for="client-name">Name *</label>
        <input type="text" class="form-control input-lg" id="client-name" name="name" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email *</label>
        <input type="text" class="form-control input-lg" id="client-email" name="email" value="">
    </div>
    <div class="form-group col-sm-3">
        <label for="client-phone">Password *</label>
        <input type="text" class="form-control input-lg" id="client-password" name="password" value="">
    </div>
    <div class="col-sm-12">
            <a href="userMaint.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add User</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>