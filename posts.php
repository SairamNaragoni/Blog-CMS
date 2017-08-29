<?php include('includes/header.php'); ?>
<?php
    include('includes/connection.php');
    $cate_id = $_GET['id'];
    $cate_query = "SELECT p.id,p.title,p.body,p.create_date,u.username,u.id AS user_id
                  FROM `posts` AS p, `users` AS u 
                  WHERE p.user_id = u.id AND p.cate_id = $cate_id
                  ORDER BY `create_date` DESC";
    $result = mysqli_query($conn,$cate_query);
    $row_count = mysqli_num_rows($result);        
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
                <?php while($row = mysqli_fetch_array($result)) : ?>
                <h1 class="mt-4"><a href="post.php?id=<?php echo $row['id'];?>"><?php echo $row['title']; ?></a></h1>
                <!-- Author -->
                <p class="lead">
                    by <a href="users.php?id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
                </p>
                <hr>
                <!-- Date/Time -->
                <p>Posted on <?php echo date("F j,Y,g:i a",strtotime($row['create_date']));?></p>
                <hr>
                <!-- Preview Image 
                <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">-->
                <!-- Post Content -->
                <p class="lead"><?php echo $row['body']; ?></p>
                <hr>
                <p>
                <?php if(isset($_SESSION['uid'])) : ?>
                <div class="row">
                    <div class="col">
                      <span><i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                        <a tabindex="0" data-toggle="popover" data-trigger="hover" data-content="" href="<?php echo $row['user_id'].','.$row['id']; ?>" class="like"><?php if(getLike($row['id'])) : ?>Unlike <?php else : ?>Like <?php endif; ?></a></span>
                    </div>
                    <div class="col">
                      <span><i class="fa fa-comment-o fa-2x" aria-hidden="true"></i><a href="post.php?id=<?php echo $row['id']; ?>"> Comment </a></span>
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
                </div>
                <?php endif; ?> 
                </p>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="card text-center" style="margin-top: 200px;">
                    <div class="card-header"></div>
                    <div class="card-block">
                        <h4 class="card-title">No Posts To Display</h4>
                    </div>
                    <div class="card-footer text-muted"></div>
                </div>
            <?php endif; ?>
               
            </div>
            <?php include('includes/sidenav.php'); ?>
<?php include('includes/footer.php'); ?>