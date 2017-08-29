<?php include("../includes/connection.php"); ?>
<?php 
	function getUserName($user_id){
			include("../includes/connection.php");
			$user_query = "SELECT `username` FROM `users` WHERE `id` = '$user_id'";
			$user_result = mysqli_query($conn,$user_query);
			$username = mysqli_fetch_array($user_result);
			return $username['username'];
	}
?>
<?php 
	session_start();
	$uid = $_SESSION['uid'];
	$notification_query = "SELECT * FROM `notifications`
						   WHERE `parent_id` = '$uid'
						   ORDER BY `notify_time` DESC LIMIT 6 ";
	$notification_result = mysqli_query($conn,$notification_query);
	$notification_row_count = mysqli_num_rows($notification_result);

	if($notification_row_count)
	{
		while($row = mysqli_fetch_array($notification_result))
		{
			if($row['notification_read']==0)
			{	
				if($row['notification_type'] == 'L')
				{
					echo '<li class="dropdown-item" style="background:#f4f4f4;"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> liked your <a href="post.php?id='.$row['post_id'].'"> post.</a></li>';

				}
				elseif($row['notification_type'] == 'C')
				{
					echo '<li class="dropdown-item" style="background:#f4f4f4;"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> commented on your <a href="post.php?id='.$row['post_id'].'"> post.</a></li>';
				}
				elseif($row['notification_type'] == 'F')
				{
					echo '<li class="dropdown-item" style="background:#f4f4f4;"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> started following <a href="users.php?id='.$row['parent_id'].'">you.</a></li>';
				}
				elseif($row['notification_type'] == 'N')
				{
					echo '<li class="dropdown-item" style="background:#f4f4f4;"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> posted a new <a href="post.php?id='.$row['post_id'].'">post.</a></li>';
				}
			}
			else
			{
				if($row['notification_type'] == 'L')
				{
					echo '<li class="dropdown-item"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> liked your <a href="post.php?id='.$row['post_id'].'"> post.</a></li>';

				}
				elseif($row['notification_type'] == 'C')
				{
					echo '<li class="dropdown-item"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> commented on your <a href="post.php?id='.$row['post_id'].'"> post.</a></li>';
				}
				elseif($row['notification_type'] == 'F')
				{
					echo '<li class="dropdown-item"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> started following <a href="users.php?id='.$row['parent_id'].'">you.</a></li>';
				}
				elseif($row['notification_type'] == 'N')
				{
					echo '<li class="dropdown-item"><a href="users.php?id='.$row['notifier_id'].'">'.getUserName($row['notifier_id']).'</a> posted a new <a href="post.php?id='.$row['post_id'].'">post.</a></li>';
				}
			}
			
		}
		$update_read = "UPDATE `notifications`
                    SET `notification_read` = 1
                    WHERE `parent_id` = '$uid' ";
    	$update_result = mysqli_query($conn,$update_read);
		echo '<div class="dropdown-divider" style="padding: 0px;margin: 0px;"></div>';
    	echo '<a class="dropdown-item" href="notifications.php">See All Notifications</a>';
	}
	else
	{
		echo '<a class="dropdown-item" href="#">No Notifications To Display</a>';
	}
?>