<?php include("../includes/connection.php"); ?>
<?php 
	session_start();
	if($_POST['ftype']=='Follow')
	{
		$insert_query = "INSERT INTO `followers` (`parent_id`,`follower_id`)
                         VALUES('".$_POST['parent_id']."','".$_SESSION['uid']."')";
    	$insert_result = mysqli_query($conn,$insert_query);
    	$insert_notification_query = "INSERT INTO `notifications` (`parent_id`,`notifier_id`,`notification_type`)
                         VALUES('".$_POST['parent_id']."','".$_SESSION['uid']."','F')";
    	$insert_notification_result = mysqli_query($conn,$insert_notification_query);
    	echo "Unfollow";
	}
	else
	{
		$delete_query = "DELETE FROM `followers`
						 WHERE `parent_id` = '".$_POST['parent_id']."' AND `follower_id` = '".$_SESSION['uid']."' ";
    	$delete_result = mysqli_query($conn,$delete_query);
    	$delete_notification_query = "DELETE FROM `notifications`
						 WHERE `parent_id` = '".$_POST['parent_id']."' AND `notifier_id` = '".$_SESSION['uid']."' AND `notification_type` = 'F' ";
		$delete_notification_result = mysqli_query($conn,$delete_notification_query);
		echo "Follow";
	} 
?>