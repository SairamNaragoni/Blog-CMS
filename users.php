<?php include('includes/header.php'); ?>
<?php
    include('includes/connection.php');
    $user_id = $_GET['id'];
    $post_query = "SELECT p.id,p.title,p.body,p.create_date 
                  FROM `posts` AS p
                  WHERE p.user_id = $user_id
                  ORDER BY `create_date` DESC ";
    $post_result = mysqli_query($conn,$post_query);
    $row_count = mysqli_num_rows($post_result);
    $user_query = "SELECT * FROM `users` WHERE users.id = '$user_id'";
    $user_result = mysqli_query($conn,$user_query);
    if(isset($_SESSION['uid']))
    {
       if($user_id == $_SESSION['uid'])
        {
            $follow_flag = -1;
        }
        else
        {
            $follow_query = "SELECT * FROM `followers` WHERE `parent_id` = '$user_id' AND `follower_id` = '".$_SESSION['uid']."'";
            $follow_result = mysqli_query($conn,$follow_query);
            $follow_row_count = mysqli_num_rows($follow_result);
            if($follow_row_count==0)
            {
                $follow_flag = "Follow";
            }
            else
            {
                $follow_flag = "Unfollow";
            }
        } 
    }
    $followers_query = "SELECT * FROM `followers` WHERE `parent_id` = '$user_id'";
    $followers_result = mysqli_query($conn,$followers_query);
    $followers_count = mysqli_num_rows($followers_result);

    $following_query = "SELECT * FROM `followers` WHERE `follower_id` = '$user_id'";
    $following_result = mysqli_query($conn,$following_query);
    $following_count = mysqli_num_rows($following_result);   
?>
<?php
    function getLike($post_id)
    {
        include("includes/connection.php");
        $like_query = "SELECT * FROM `notifications` WHERE `post_id`='$post_id' AND `notifier_id`= '".$_SESSION['uid']."' AND `notification_type`='L' ";
        $like_result = mysqli_query($conn,$like_query);
        $like_row_count = mysqli_num_rows($like_result);
        if($like_row_count>0)
            return 1;
        else
            return 0;
    }
 ?>
 <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Title -->
                <?php if($row_count) : ?>
                <div class="card">
                <?php while($row = mysqli_fetch_array($post_result)) : ?>
                <div class="card-header"><h1 class="mt-4"><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h1></div>
                <div class="card-block" style="padding-bottom: 0px;">
                <!-- Date/Time -->
                <p>Posted on <?php echo date("F j,Y,g:i a",strtotime($row['create_date']));?></p>
                <hr>
                <!-- Preview Image 
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">-->
                <!-- Post Content -->
                <p class="lead"><?php echo $row['body']; ?></p>
                <?php if(isset($_SESSION['uid'])) : ?>
                <p>
                <div class="row">
                    <div class="col">
                    <span><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                        <a tabindex="0" data-toggle="popover" data-trigger="hover" data-content="" href="<?php echo $user_id.','.$row['id']; ?>" class="like"><?php if(getLike($row['id'])) : ?>Unlike <?php else : ?>Like <?php endif; ?></a></span>
                    </div>
                    <div class="col">
                      <span><i class="fa fa-comment-o fa-2x" aria-hidden="true"></i><a href="post.php?id=<?php echo $row['id']; ?>"> Comment </a></span>
                    </div>
                    <?php if($_SESSION['uid'] == $user_id) : ?>
                    <div class="col">
                      <span><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i><a href="editpost.php?id=<?php echo $row['id'];?>">Edit </a></span>
                    </div>
                    <div class="col">
                        <span><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></i><a href="delete_post.php?id=<?php echo $row['id']; ?>" class="delete_post" >Delete </a></span>
                    </div>
                    <?php else: ?>
                    <div class="col"></div>
                    <?php endif; ?>  
                </div> 
                </p>
                <?php endif; ?> 
                </div>
                <hr>
                <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div class="card text-center" style="margin-top: 200px;">
                    <div class="card-header"></div>
                    <div class="card-block">
                        <?php if($_SESSION['uid'] == $user_id) : ?>
                            <h4 class="card-title">You Haven't Posted Anything Yet.</h4>
                            <a href="addpost.php" class="btn btn-primary">Add Post</a>
                        <?php else: ?>
                            <h4 class="card-title">This User Haven't Posted Anything Yet.</h4>
                        <?php endif; ?>                          
                        </div>
                    <div class="card-footer text-muted"></div>
                </div>
            <?php endif; ?>
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Profile</h5>
                    <?php while($row = mysqli_fetch_array($user_result)) : ?>
                    <div class="card-block" style="margin: auto;">
                    	<?php
                    		if($row['avatar']!=0)
                    		{
								echo "<img class='d-flex mr-3 rounded-circle' style='Width:150px;height:150px;' src='images/avatars/".$row['avatar']."' >";
                    		}
                    		else
                    		{
                    			echo "<img class='d-flex mr-3 rounded-circle' src='http://placehold.it/150x150' alt='profile_img'>";
                    		}
						?>
                        <!---->
                    </div>
                    <div class="card-block" style="margin: auto;">
                        <h4 class="card-title"><?php echo $row['username'] ;?></h4>
                    </div>
                    <div class="card-block">
                        <p class="card-text">Authentication : <cite title="Source Title">
                            <?php
                                if($row['admin'] == 1)
                                    echo "Admin";
                                else
                                    echo "Blogger"; 
                            ?>
                        </cite></p>
                        <p class="card-text">Email : <cite title="Source Title"><?php echo $row['email']; ?></cite></p>
                        <p class="card-text">No. of Posts : <cite title="Source Title"><?php echo $row_count; ?></cite></p>
                        <p class="card-text"><a href="follow.php?id=<?php echo $user_id;?>&follow=ers">Followers : </a><cite title="Source Title" id="follower_count"><?php echo $followers_count; ?></cite></p>
                        <p class="card-text"><a href="follow.php?id=<?php echo $user_id;?>&follow=ing">Following : </a><cite title="Source Title"><?php echo $following_count; ?></cite></p>
                    <?php if(isset($_SESSION['uid'])) : ?>
                        <?php if($follow_flag!=-1) : ?>
                        <button id="do_follow" name="do_follow" type="submit"  class="btn btn-primary" style="color: white;"><?php echo $follow_flag; ?></button>
                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                    <?php endwhile;?>
                </div>
            </div>
         
<?php include('includes/footer.php'); ?>