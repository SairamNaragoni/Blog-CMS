<?php include("../includes/connection.php"); ?>
<?php
	session_start();
	$post_id = $_POST['post_id'];
        $like_query = "SELECT * FROM `notifications` WHERE `post_id`='$post_id' AND `notification_type`='L' ";
        $like_result = mysqli_query($conn,$like_query);
        $like_row_count = mysqli_num_rows($like_result);
        echo $like_row_count;
?>