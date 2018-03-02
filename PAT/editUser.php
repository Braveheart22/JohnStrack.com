<?php
session_start ();

// if the user is not logged in
if (!$_SESSION['loggedInUser']) {
	// send them to the login page
	header ("Location: index.php");
}

// get ID sent by GET collection
$userID = $_GET['id'];

// connect to database
include ('includes/connection.php');

// include functions file
include ('includes/functions.php');

// query the database with the client id
$query = "SELECT * FROM users WHERE id='$userID'";
$result = mysqli_query ($conn, $query);

// if result is returned
if (mysqli_num_rows ($result) > 0) {
	// we have data!
	// set some variables
	while ($row = mysqli_fetch_assoc ($result)) {
		$name		= $row['name'];
		$email		= $row['email'];
		$password	= $row['password'];
	}
} else {
	$alertMessage = "<div class='alert alert-warning'>Nothing to see here.  <a href='userMaint.php'>Head back</a></div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables
    $name		= validateFormData( $_POST["name"] );
    $email		= validateFormData( $_POST["email"] );
    $password	= validateFormData( $_POST["password"] );
    
    // new database query & result
    $query = "UPDATE users
            SET name='$name',
            email='$email',
            password='$password'
            WHERE id='$userID'";
    
    $result = mysqli_query( $conn, $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: userMaint.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($conn); 
    }
}

// if delete button was submitted
if( isset($_POST['delete']) ) {
    
    $alertMessage = "<div class='alert alert-danger'>
                        <p>Are you sure you want to delete this client? No take backs!</p><br>
                        <form action='". htmlspecialchars( $_SERVER["PHP_SELF"] ) ."?id=$userID' method='post'>
                            <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!'>
                            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Oops, no thanks!</a>
                        </form>
                    </div>";
    
}

// if confirm delete button was submitted
if( isset($_POST['confirm-delete']) ) {
    
    // new database query & result
    $query = "DELETE FROM users WHERE id='$userID'";
    $result = mysqli_query( $conn, $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: userMaint.php?alert=deleted");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
}

mysqli_close ($conn);

include('includes/header.php');
?>

<h1>Edit User</h1>

<?php echo $alertMessage; ?>

<form action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>?id=<?php echo $userID; ?>" method="post" class="row">
    <div class="form-group col-sm-3">
        <label for="client-name">Name</label>
        <input type="text" class="form-control input-lg" id="client-name" name="name" value="<?php echo $name; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email</label>
        <input type="text" class="form-control input-lg" id="client-email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="form-group col-sm-3">
        <label for="client-phone">Pssword</label>
        <input type="text" class="form-control input-lg" id="client-password" name="password" value="<?php echo $password; ?>">
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="delete">Delete</button>
        <div class="pull-right">
            <a href="userMaint.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success" name="update">Update</button>
        </div>
    </div>
</form>

<?php
include('includes/footer.php');
?>