<?php include('includes/header.php'); ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: ../index.php");
      }
?>
<?php
    include('includes/connection.php');
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $delete_query = "DELETE FROM `posts`
              WHERE `id` = '$id' LIMIT 1" ;
      $delete_result = mysqli_query($conn,$delete_query);
    }
    $query = "SELECT p.`id`,p.`title`,LEFT(p.`body`,60) AS body,u.`username`,p.`create_date`
              FROM `posts` p, `users` u
              WHERE p.`user_id` = u.`id`";
    $result = mysqli_query($conn,$query);
?>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2  bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Posts <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categories.php">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Users</a>
            </li>
          </ul>
        </nav>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h1>Dashboard</h1>
          <h2> </h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="border: none;"><h2>Posts</h2></th>
                  <th style="border: none;"></th>
                  <th style="border: none;"><a href="addpost.php"><button type="button" class="btn btn-info float-right">Add Posts</button></a></th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th >#</th>
                  <th >Title</th>
                  <th >Post</th>
                  <th >Author</th>
                  <th >Date</th>
                  <th >Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while($row = mysqli_fetch_array($result)) :?>
                <tr>
                  <td><?php echo $row['id'];?></td>
                  <td><?php echo $row['title'];?></td>
                  <td><?php echo $row['body']."........";?></td>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['create_date'];?></td>
                  <td><a href=" editpost.php?id=<?php echo $row['id'] ; ?> " class = "btn btn-primary">Edit</a> <a href="index.php?id=<?php echo $row['id'] ; ?>"class="btn btn-danger">delete</a></td>
                </tr>
              <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
<?php include('includes/footer.php'); ?>