<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>P.A.T. Trcker</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body style="padding-top: 60px;">            
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">

        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<?php
					if ($_SESSION['loggedInUser']) { //if user is logged in
				?>
				
                <a class="navbar-brand" href="locations.php">P.A.T. <strong>TRACKER</strong></a>
				
				<?php
					} else {
				?>
				
                <a class="navbar-brand" href="index.php">P.A.T. <strong>TRACKER</strong></a>
				
				<?php
					}
				?>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">

				<?php
					if ($_SESSION['loggedInUser']) { //if user is logged in
				?>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">Maintenance <span class="caret"></span></a>
						
						<ul class="dropdown-menu">
							<li><a href="stationMaint.php">Stations</a></li>
							<li><a href="userMaint.php">Users</a></li>
						</ul>                        
					</li>
				</ul>

				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">Reports <span class="caret"></span></a>
						
						<ul class="dropdown-menu">
							<li><a href="locations.php">Current Locations</a></li>
							<li><a href="history.php">History</a></li>
						</ul>                        
					</li>
				</ul>

                <ul class="nav navbar-nav navbar-right">
                    <!-- <p class="navbar-text">Aloha, Brad!</p> -->
                    <p class="navbar-text">Hello, <?php echo $_SESSION['loggedInUser']; ?>!</p>

                    <li><a href="logout.php">Log out</a></li>
                </ul>
				<?php
					} else {
				?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Log in</a></li>
                </ul>
				<?php
					}
				?>

            </div>

        </div>

    </nav>
        
    <div class="container">