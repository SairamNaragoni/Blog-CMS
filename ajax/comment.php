<?php include("../includes/connection.php");
	if($_POST['post_comment']!='')
    {
    	session_start();
        $insert_query = "INSERT INTO `comments` (`post_id`,`comment`,`user_id`)
                         VALUES('".$_POST['post_id']."','".$_POST['post_comment']."','".$_SESSION['uid']."')";
        $insert_result = mysqli_query($conn,$insert_query);

        $comment_query = "SELECT c.comment,c.com_date,u.username FROM `comments` AS c, `users` AS u
                        WHERE c.post_id = '".$_POST['post_id']."' AND u.id = '".$_SESSION['uid']."' AND c.comment = '".$_POST['post_comment']."' ";
        $comment_result = mysqli_query($conn,$comment_query);

        $parent_extract_query = "SELECT `user_id` FROM `posts` WHERE `id` = '".$_POST['post_id']."' ";
        $parent_extract_result = mysqli_query($conn,$parent_extract_query);
        $parent_extract = mysqli_fetch_array($parent_extract_result);

        $insert_notification_query = "INSERT INTO `notifications` (`post_id`,`parent_id`,`notifier_id`,`notification_type`)
                         VALUES('".$_POST['post_id']."','".$parent_extract['user_id']."','".$_SESSION['uid']."','C')";
        $insert_notification_result = mysqli_query($conn,$insert_notification_query);
    	
    	$row = mysqli_fetch_array($comment_result);

                echo '<div class="media mb-4" id="append_comment">' ;
                echo '<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">';
                echo '<div class="media-body" id="here">';
                echo '<h5 class="mt-0">'.$row['username'].'</h5>';
                echo $_SESSION['uid'];
                echo date("F j,Y,g:i a",strtotime($row['com_date']));
                echo '<br>';
                echo $row['comment'];
                echo '</div>';
                echo '</div>';
    }
    else
    {
    	echo "empty";
    }
?>