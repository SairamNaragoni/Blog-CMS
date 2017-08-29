<?php include('includes/header.php'); ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: index.php");
      }
?>
<?php include("includes/connection.php"); ?>
<?php
	$uid = $_SESSION['uid'];
	$notification_query = "SELECT * FROM `notifications` 
						   WHERE `parent_id` = '$uid'
						   ORDER BY `notify_time` DESC ";
	$notification_result = mysqli_query($conn,$notification_query);
	$row_count = mysqli_num_rows($notification_result);
?>
<?php 
	function getUserName($user_id){
			include("includes/connection.php");
			$user_query = "SELECT `username` FROM `users` WHERE `id` = '$user_id'";
			$user_result = mysqli_query($conn,$user_query);
			$username = mysqli_fetch_array($user_result);
			return $username;
	}
?>
<div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Title -->
                <div class="card">
                <div class="card-header"><h3>All Notifications</h3></div>
                <?php if($row_count) : ?>
                <?php while($row = mysqli_fetch_array($notification_result)) : ?>
                <div class="card-block">
                	<p class="lead card-title">
                		<?php if($row['notification_type'] == 'L') : ?>
                			<a href="users.php?id=<?php echo $row['notifier_id']; ?>"><?php $username = getUserName($row['notifier_id']);echo $username['username']; ?> </a> liked Your
                			<a href="post.php?id=<?php echo $row['post_id']; ?>">post.</a>
                		<?php elseif($row['notification_type'] == 'C') : ?>
                			<a href="users.php?id=<?php echo $row['notifier_id']; ?>"><?php $username = getUserName($row['notifier_id']);echo $username['username']; ?> </a> commented on Your
                			<a href="post.php?id=<?php echo $row['post_id']; ?>">post.</a>
                		<?php elseif($row['notification_type'] == 'F') : ?>
                			<a href="users.php?id=<?php echo $row['notifier_id']; ?>"><?php $username = getUserName($row['notifier_id']);echo $username['username']; ?> </a> started following
                			<a href="users.php?id=<?php echo $row['parent_id']; ?>">you.</a>
                		<?php elseif($row['notification_type'] == 'N') : ?>
                			<a href="users.php?id=<?php echo $row['notifier_id']; ?>"><?php $username = getUserName($row['notifier_id']);echo $username['username']; ?> </a> posted a
                			<a href="post.php?id=<?php echo $row['post_id']; ?>"> new post.</a>
                		<?php endif; ?>
                	</p>
                	<h6 class="card-subtitle mb-2 text-muted">received at <?php echo date("F j,Y,g:i a",strtotime($row['notify_time']));?></h6>
                </div>
                <hr>
                <?php endwhile; ?>
                </div>
                <?php else : ?>
                	<div class="card text-center" style="margin-top: 200px;">
                    <div class="card-header"></div>
                    <div class="card-block">
                        <h4 class="card-title">No Notifications To Display</h4>
                        </div>
                    <div class="card-footer text-muted"></div>
                	</div>
                <?php endif; ?>
                </div>
                
         <?php include('includes/sidenav.php'); ?>
<?php include('includes/footer.php');?>