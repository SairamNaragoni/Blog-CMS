<?php
    include("includes/connection.php");
    session_start();
    $admin_result = 0;
    if(isset($_SESSION['uid']))
    {
        $id = $_SESSION['uid'];
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <title>Admin | Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/dashboard.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
  <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="../index.php" style="font-size:25px;"><strong>Blog</strong></a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php" >Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                 <ul class="navbar-nav ml-auto">
                 	<li class="nav-item">
                            <a href = "../users.php?id=<?php echo $id; ?>" class="btn btn-primary" style="margin-right: 5px;color: white;margin-bottom: 5px;"> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href = "../logout.php" class="btn btn-danger" style="margin-right: 5px;color: white;">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
  </nav>