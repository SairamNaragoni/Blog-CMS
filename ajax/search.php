<?php include('../includes/connection.php'); ?>
<?php 
	$key = $_POST['val'];
	//echo $key;
	$search_query = "SELECT `id`,`username` FROM `users` WHERE `username` LIKE '%$key%' ";
	$search_result = mysqli_query($conn,$search_query);
	$row_count = mysqli_num_rows($search_result);
	if($row_count>0)
	{
		$result = '';
		while($row = mysqli_fetch_array($search_result))
		{
			$result .= '<li class="list-group-item"><a href="users.php?id='.$row['id'].'">'.$row['username'].'</a></li>';
		}
		echo $result;
	}
	else
	{
		echo '<li class="list-group-item">User Not Found</li>';
	}
	
?>