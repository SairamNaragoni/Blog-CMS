<?php include("includes/connection.php"); ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: index.php");
      }
?>
<?php 
	session_start();
	$uid = $_SESSION['uid'];
	$delete_id = $_GET['id'];;
    $delete_query = "DELETE FROM `posts`
              WHERE `id` = '$delete_id' LIMIT 1" ;
    $delete_result = mysqli_query($conn,$delete_query);
    header("Location: users.php?id=$uid"); 
	
?>