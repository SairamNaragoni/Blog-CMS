<?php include('includes/header.php'); ?>
<?php
    include('includes/connection.php');
    $user_id = $_GET['id'];
    $type = $_GET['follow'];
    $count = 0;
    if($type=="ers")
    {  
        $follow_query = "SELECT * FROM `followers` WHERE `parent_id` = '$user_id' ";
        $follow_result = mysqli_query($conn,$follow_query);
        $row_count = mysqli_num_rows($follow_result);

    }
    else if($type = "ing")
    {
        $follow_query = "SELECT * FROM `followers` WHERE `follower_id` = '$user_id' ";
        $follow_result = mysqli_query($conn,$follow_query);
        $row_count = mysqli_num_rows($follow_result);
    }
    $user_query = "SELECT * FROM `users` WHERE users.id = '$user_id'";
    $user_result = mysqli_query($conn,$user_query);
    $followers_query = "SELECT * FROM `followers` WHERE `parent_id` = '$user_id'";
    $followers_result = mysqli_query($conn,$followers_query);
    $followers_count = mysqli_num_rows($followers_result);

    $following_query = "SELECT * FROM `followers` WHERE `follower_id` = '$user_id'";
    $following_result = mysqli_query($conn,$following_query);
    $following_count = mysqli_num_rows($following_result);
    
    
?>
<?php 
    function getUserName($user_id){
            include("includes/connection.php");
            $user_query = "SELECT `id`,`username` FROM `users` WHERE `id` = '$user_id'";
            $user_result = mysqli_query($conn,$user_query);
            $username = mysqli_fetch_array($user_result);
            return $username;
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
                <?php if($type=="ers") : ?>
                <div class="card-header"><h1 class="mt-4">Followers</h1></div>
                <?php else: ?>
                <div class="card-header"><h1 class="mt-4">Following</h1></div>
                <?php endif; ?>
                <table class="table table-striped ">
                    <thead class="thead-inverse">
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                        </tr>
                    </thead>
                <tbody>
                <?php while($row = mysqli_fetch_array($follow_result)) : ?>
                <div class="card-block" style="padding-bottom: 0px;">
                <?php if($type=="ers") : ?>
                    <tr>
                      <th scope="row"><?php $count = $count+1;echo $count;?></th>
                      <?php $follower = getUserName($row['follower_id']);?>
                      <td><a style="text-decoration: none;color: black;" href="users.php?id=<?php echo $follower['id'];?>"><?php echo $follower['username']; ?></a></td>
                    </tr>
                <?php else: ?>
                    <tr>
                      <th scope="row"><?php $count = $count+1;echo $count;?></th>
                      <?php $following = getUserName($row['parent_id']); ?>
                      <td><a style="text-decoration: none;color: black;" href="users.php?id=<?php echo $following['id'];?>"><?php echo $following['username']; ?></a></td>
                    </tr>
                <?php endif; ?>
                </div>
                <?php endwhile; ?>
                </tbody>
                </table>
                </div>
            <?php else : ?>
                <div class="card text-center" style="margin-top: 100px;">
                    <div class="card-header"></div>
                    <div class="card-block"><h4 class="card-title">No Followers.</h4></div>
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
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/150x150" alt="profile_img">
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
                    </div>
                    <?php endwhile;?>
                </div>
            </div>
<?php include('includes/footer.php'); ?>