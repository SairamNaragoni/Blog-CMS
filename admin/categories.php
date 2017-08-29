<?php include('includes/header.php'); ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: ../index.php");
      }
?>
<?php 
      include('includes/connection.php');
      $query = "SELECT `id`,`category` FROM `categories` ";
      $result = mysqli_query($conn,$query);
      if(isset($_GET['id']))
      {
        $id = $_GET['id'];
        $delete_query = "DELETE FROM `categories`
              WHERE `id` = '$id' LIMIT 1" ;
        $delete_result = mysqli_query($conn,$delete_query);
        header("Location: categories.php");
      }
      if(isset($_POST['new_category']))
      {
            $cate_name =  $_POST['cate_name'];
            $insert_query = "INSERT INTO `categories` (`category`)
                              VALUES('$cate_name')";
            $insert_result = mysqli_query($conn,$insert_query);
            header("Location: categories.php");
      }
      if(isset($_POST['edit_category']))
      {
            $edit_id = $_GET['editid'];
            $cate_name =  $_POST['edit_cate_name'];
            $update_query = "UPDATE `categories`
                            SET `category` = '$cate_name'
                            WHERE `id` = '$edit_id'";
            $update_result = mysqli_query($conn,$update_query);
            header("Location: categories.php");
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
              <a class="nav-link active" href="categories.php">Categories <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Users</a>
            </li>
          </ul>
        </nav>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h1>Dashboard</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="border: none;"><h2>Categories</h2></th>
                  <th style="border: none;"><a href="categories.php?new='true'"><button type="button" class="btn btn-info">Add Category</button></a></th>
                </tr>
              </thead>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Category</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php while($row = mysqli_fetch_array($result)) :?>
                <tr>
                  <td><?php echo $row['id'];?></td>
                  <?php if(isset($_GET['editid']) && $row['id'] == $_GET['editid']) :?>
                  <form method="POST" action="categories.php?editid=<?php echo $_GET['editid'];?>">
                  <td><input type="text" class="form-control" name="edit_cate_name" value="<?php echo $row['category']?>" style="max-width: 14em;margin: 0px;">
                  <td><button type="submit" name="edit_category" class="btn btn-success">Save</button></form>
                  <a href="categories.php" class="btn btn-danger">Cancel</a></td>
                  <?php else: ?>
                  <td><?php echo $row['category'];?></td>
                  <td><a href=" categories.php?editid=<?php echo $row['id'];?> " class = "btn btn-primary">Edit</a> <a href="categories.php?id=<?php echo $row['id'];?>" class="btn btn-danger">delete</a></td>
                <?php endif; ?>
                </tr>
              <?php endwhile; ?>
              <?php if(isset($_GET['new'])) : ?>
                <tr>
                  <td></td>
                  <form method="POST" action="categories.php">
                  <td><input type="text" class="form-control" name="cate_name" placeholder="Enter Category" style="max-width: 14em;margin: 0px;"></td>
                  <td><button type="submit" name="new_category" class="btn btn-success">Save</button></form>
                  <a href="categories.php" class="btn btn-danger">Cancel</a></td>
                </tr>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
<?php include('includes/footer.php'); ?>