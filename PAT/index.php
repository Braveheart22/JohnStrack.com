<?php
session_start();
include('includes/functions.php');

if(isset($_POST['login'])) {
	// create variables
	// wrap data with validate function
	$formEmail = validateFormData ($_POST['email']);
	$formPass = validateFormData($_POST['password']);
	
	// connect to database
	include ('includes/connection.php');
	
	// create query
	$query = "SELECT name, password FROM users WHERE email = '$formEmail'";
	
	// store the result
	$result = mysqli_query ($conn, $query);
	
	// verify if the result is returned
	if (mysqli_num_rows ($result) > 0) {
		// store basic user data in variables
		while ($row = mysqli_fetch_assoc ($result)) {
			$name = $row['name'];
			$pass = $row['password'];
		}
		
		// verify the password
		if ($formPass == $pass) {
			// correct login details!
			// stoer data in SESSION variables
			$_SESSION['loggedInUser'] = $name;
			
			// redirect user to clients page
			header ("Location: locations.php");
		} else {
			// error message
			$loginError = "<div class='alert alert-danger'>Wrong username / password combination.  Try again.<a class='close' data-dismiss='alert'>&times;</a></div>";
		}
	} else {
		// there are no result in the database
			$loginError = "<div class='alert alert-danger'>No such user.  Try again.<a class='close' data-dismiss='alert'>&times;</a></div>";
	}
}

// close mySQL connection
//mysqli_close ($conn);

include('includes/header.php');
?>

<h1>P.A.T. Tracker</h1>
<p class="lead">Log in to your account.</p>

<?php echo $loginError; ?>
<form class="form-inline" action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" value="<?php echo $formEmail; ?>">
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php
include('includes/footer.php');
?>