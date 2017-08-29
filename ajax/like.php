<?php include("../includes/connection.php"); ?>
<?php 
	session_start();
	$post_id = $_POST['post_id'];
	$parent_id = $_POST['parent_id'];
	$notifier_id = $_SESSION['uid'];
	if($_POST['ftype']=='Like ')
	{
		$insert_query = "INSERT INTO `notifications` (`post_id`,`parent_id`,`notifier_id`,`notification_type`)
                         VALUES('$post_id','$parent_id','$notifier_id','L')";
    	$insert_result = mysqli_query($conn,$insert_query);
    	echo "Unlike ";
	}
	else if($_POST['ftype']=='Unlike ')
	{
		$delete_query = "DELETE FROM `notifications`
						 WHERE `post_id`= '$post_id' AND `parent_id` = '$parent_id' AND `notifier_id` = '$notifier_id' AND `notification_type` = 'L' ";
    	$delete_result = mysqli_query($conn,$delete_query);
		echo "Like ";
	} 
?>