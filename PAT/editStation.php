<?php
session_start ();

// if the user is not logged in
if (!$_SESSION['loggedInUser']) {
	// send them to the login page
	header ("Location: index.php");
}

// function to check if a checkbox is checked
function IsChecked($chkname,$value) {
	if(!empty($_POST[$chkname]))
	{
		foreach($_POST[$chkname] as $chkval)
		{
			if($chkval == $value)
			{
				return true;
			}
		}
	}
	return false;
}

// get ID sent by GET collection
$stationID = $_GET['id'];

// connect to database
include ('includes/connection.php');

// include functions file
include ('includes/functions.php');

// query the database with the client id
$query = "SELECT * FROM stations WHERE id='$stationID'";
$result = mysqli_query ($conn, $query);

// if result is returned
if (mysqli_num_rows ($result) > 0) {
	// we have data!
	// set some variables
	while ($row = mysqli_fetch_assoc ($result)) {
		$description	= $row['description'];
		$active			= $row['active'];
	}
} else {
	$alertMessage = "<div class='alert alert-warning'>Nothing to see here.  <a href='stationMaint.php'>Head back</a></div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables
    $description	= validateFormData( $_POST["description"] );
    $active			= validateFormData( $_POST["active"] );
	
	if ($active == '') {
		$active = 'N';
	}

    // new database query & result
    $query = "UPDATE stations
            SET description='$description',
            active='$active'
            WHERE id='$stationID'";
    $result = mysqli_query( $conn, $query );
    if( $result ) {
        // redirect to client page with query string
        header("Location: stationMaint.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($conn); 
    }
}

// if delete button was submitted
if( isset($_POST['delete']) ) {
    
    $alertMessage = "<div class='alert alert-danger'>
                        <p>Are you sure you want to delete this client? Data cannot be retrieved!</p><br>
                        <form action='". htmlspecialchars( $_SERVER["PHP_SELF"] ) ."?id=$stationID' method='post'>
                            <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!'>
                            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Oops, no thanks!</a>
                        </form>
                    </div>";
    
}

// if confirm delete button was submitted
if( isset($_POST['confirm-delete']) ) {
    
    // new database query & result
    $query = "DELETE FROM stations WHERE id='$stationID'";
    $result = mysqli_query( $conn, $query );
    
    if( $result ) {
        
        // redirect to client page with query string
        header("Location: stationMaint.php?alert=deleted");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
}

mysqli_close ($conn);

include('includes/header.php');
?>

<h1>Edit Station</h1>

<?php echo $alertMessage; ?>

<form action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>?id=<?php echo $stationID; ?>" method="post" class="row">
    <div class="form-group col-sm-5">
        <label for="client-name">ID</label>
        <input type="text" class="form-control input-lg" id="station-Id" name="stationID" value="<?php echo $stationID; ?>" disabled>
    </div>
    <div class="form-group col-sm-5">
        <label for="client-email">Description</label>
        <input type="text" class="form-control input-lg" id="station-description" name="description" value="<?php echo $description; ?>">
    </div>
	<div class="form-group col-sm-2">
        <label for="client-phone">Active</label>
		<input type="checkbox" name="active" id="station-active" value="Y" <?php echo ($active=='Y' ? 'checked' : ''); ?>>
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="delete">Delete</button>
        <div class="pull-right">
            <a href="stationMaint.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success" name="update">Update</button>
        </div>
    </div>
</form>

<?php
include('includes/footer.php');
?>