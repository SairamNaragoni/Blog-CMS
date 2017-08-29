<?php include("../includes/connection.php"); ?>
<?php
	session_start();
	$id = $_SESSION['uid'];
	$notification_query = "SELECT `id` FROM `notifications` 
                           WHERE `parent_id` = '$id' AND `notification_read` = 0 ";
    $notification_result = mysqli_query($conn,$notification_query);
    $notification_row_count = mysqli_num_rows($notification_result);
    echo $notification_row_count;
?>