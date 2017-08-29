<?php
    include("includes/connection.php");
    session_start();
    $admin_result = 0;
    if(isset($_SESSION['uid']))
    {
        $id = $_SESSION['uid'];
        $admin_query = "SELECT admin FROM `users` WHERE id = $id";
        $admin_result = mysqli_query($conn,$admin_query);
        $admin_result = mysqli_fetch_array($admin_result);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Sairam" content="">
    <title>Blog | Sairam</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">
    <!-- Temporary navbar container fix -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <!-- Navigation  -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse ">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="index.php" style="font-size:25px;"><strong>Blog</strong></a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <?php if(isset($_SESSION['uid'])) : ?>
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                            <a href = "addpost.php" class="btn btn-primary" style="margin-right: 5px;color: white;margin-bottom: 5px;"> Add Post</a>
                    </li>
                    <?php if($admin_result['admin'] == 1) : ?>
                        <li class="nav-item">
                            <a href = "admin/index.php" class="btn btn-primary" style="margin-right: 5px;color: white;margin-bottom: 5px;"> Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                            <a href = "users.php?id=<?php echo $id; ?>" class="btn btn-primary" style="margin-right: 5px;color: white;margin-bottom: 5px;"> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href = "logout.php" class="btn btn-danger" style="margin-right: 5px;color: white;">Sign Out</a>
                    </li>
                    <!--<li class="nav-item">
                        <a href="" class="fa fa-bell" id="bell" aria-hidden="true" style="color: white;font-size: 30px;text-decoration: none;margin-top: 5px;"></a>dropdown-toggle
                    </li>-->
                    <div class="btn-group">
                        <a href="" class="belltag" id="notify" data-toggle="dropdown" title="Toggle dropdown menu" style="color: white;" >
                        <i class="fa fa-bell fa-2x" aria-hidden="true"></i></a>
                        <span id="unread_count" style="color: white;font-size: 14px;"></span>
                        <div class="dropdown-menu dropdown-menu-right" id="notifications_drop"></div>
                    </div>
                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href = "login.php" class="btn btn-primary" style="margin-right: 5px;color: white;margin-bottom: 5px;"> Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a href = "register.php" class="btn btn-primary" style="margin-right: 5px;color: white;">Sign Up</a>
                    </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>