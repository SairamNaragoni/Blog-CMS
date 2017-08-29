<?php include('includes/header.php');?>
<?php
    include("includes/connection.php");
    $post_id = $_GET['id'];
    $post_query = "SELECT p.title,p.body,p.create_date,u.username,c.category,u.id AS user_id
                 FROM `posts` AS p, `users` AS u,`categories` AS c 
                 WHERE p.id = $post_id AND p.user_id = u.id AND p.cate_id = c.id";
    $post_result = mysqli_query($conn,$post_query);
    $comment_query = "SELECT c.comment,c.com_date,u.username FROM `comments` AS c, `users` AS u
                        WHERE c.post_id = $post_id AND c.user_id = u.id";
    $comment_result = mysqli_query($conn,$comment_query);
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
                <div class="card">
               <?php while($row = mysqli_fetch_array($post_result)) : ?>
                <div class="card-header"><h1 class="mt-4"><?php echo $row['title']; ?></h1></div>
                <div class="card-block" style="padding-bottom: 0px;">
                <!-- Author -->
                <p class="lead card-title">
                    by <a href="users.php?id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
                </p>
                <!-- Date/Time -->
                <p>Posted on <?php echo date("F j,Y,g:i a",strtotime($row['create_date']));?></p>
                <hr>
                <!-- Preview Image 
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">-->
                <!-- Post Content -->
                <p class="lead"><?php echo $row['body']; ?></p>
                <p>
                <?php if(isset($_SESSION['uid'])) : ?>
                <div class="row">
                    <div class="col">
                      <span><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                        <a tabindex="0" data-toggle="popover" data-trigger="hover" data-content="" href="<?php echo $row['user_id'].','.$post_id; ?>" class="like"><?php if(getLike($post_id)) : ?>Unlike <?php else : ?>Like <?php endif; ?></a></span>
                    </div>
                    <?php if($_SESSION['uid'] == $row['user_id']) : ?>
                    <div class="col">
                      <span><i class="fa fa-comment-o fa-2x" aria-hidden="true"></i><a href="editpost.php?id=<?php echo $post_id;?>"> Edit </a></span>
                    </div>
                    <div class="col">
                        <span><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></i><a href="#" class="delete_post" >Delete </a></span>
                    </div>
                    <?php else: ?>
                        <div class="col"></div>
                    <?php endif; ?>
                    <div class="col"></div> 
                    <div class="col"></div>
                </div>
                <?php endif; ?>   
                </p>
                </div>
                <?php endwhile; ?>
                </div>
                <!-- Comments Form -->
                <?php if(isset($_SESSION['uid'])) : ?>
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-block">
                    <!--action="post.php?id=<?php $post_id; ?>" method="post"-->
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="post_comment" id="post_comment"></textarea>
                                <input type="hidden" class="post_id" value="<?php echo $post_id; ?>">
                            </div>
                            <button name="do_comment" type="submit" id="do_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                    <div class="card my-4">
                        <h5 class="card-header"><a href="login.php">Sign In a Comment</a> </h5>
                    </div>
                <?php endif; ?> 
                <!--Comments -->
                <div class="comments">
                <?php while($row = mysqli_fetch_array($comment_result)) : ?>
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body" id="here">
                        <h5 class="mt-0"><?php echo $row['username']; ?></h5>
                        <?php echo date("F j,Y,g:i a",strtotime($row['com_date'])); ?>
                        <br><?php echo $row['comment']; ?>
                    </div>
                </div>
                <?php endwhile; ?>
                </div>
            </div>
            <?php include('includes/sidenav.php'); ?>
<?php include('includes/footer.php'); ?>