<?php include('includes/header.php'); ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: ../index.php");
      }
?>
<?php 
    include("includes/connection.php");
    $query = "SELECT `id`,`username`,`email`,`admin` FROM `users` ";
    $result = mysqli_query($conn,$query);
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $delete_query = "DELETE FROM `users`
              WHERE `id` = '$id' LIMIT 1" ;
        $delete_result = mysqli_query($conn,$delete_query);
        header("Location: users.php");
    }
    if(isset($_GET['mid']))
    {
      $mid = $_GET['mid'];
      $update_query = "UPDATE `users`
                            SET `admin` = '1'
                            WHERE `id` = '$mid'";
      $update_result = mysqli_query($conn,$update_query);
      header("Location: users.php");
    }
    if(isset($_GET['rid']))
    {
      $rid = $_GET['rid'];
      $update_query = "UPDATE `users`
                            SET `admin` = '0'
                            WHERE `id` = '$rid'";
      $update_result = mysqli_query($conn,$update_query);
      header("Location: users.php");
    }
?>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categories.php">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="users.php">Users <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </nav>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h1>Dashboard</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="border: none;"><h2>Users</h2></td>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th>#</th>
                  <th>UserName</th>
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php while($row = mysqli_fetch_array($result)) :?>
                <tr>
                  <td><?php echo $row['id'];?></td>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <?php if($row['admin']==1) : ?>
                    <td><a href="users.php?rid=<?php echo $row['id']; ?> " class = "btn btn-primary">Remove Admin</a> <a href="users.php?id=<?php echo $row['id'];?>" class="btn btn-danger">delete</a></td>
                  <?php else: ?>
                  <td><a href="users.php?mid=<?php echo $row['id']; ?> " class = "btn btn-primary">Make Admin</a> <a href="users.php?id=<?php echo $row['id'];?>" class="btn btn-danger">delete</a></td>
                  <?php endif; ?>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
<?php include('includes/footer.php'); ?>