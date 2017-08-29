<?php include('includes/header.php') ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: ../index.php");
      }
?>
<?php 
      include('includes/connection.php');
      $query = "SELECT * FROM `categories`";
      $result = mysqli_query($conn,$query);
      if(isset($_POST['post_submit']))
      {
          $query = "INSERT INTO `posts` (`title`,`body`,`user_id`,`cate_id`)
                    VALUES('".$_POST['title']."','".$_POST['body']."','".$_SESSION['uid']."','".$_POST['category']."')";
          $result = mysqli_query($conn,$query);
          if($result)
          {
              header("location: index.php");
          }
          else
          {
            echo "string<br><br>";
            echo mysqli_error($conn);
          }
      }
?>
    <div class="container">
      <form action="addpost.php" style="margin:25px;" method="post">
        <div class="form-group">
          <label for="title"><h3>Title</h3></label>
          <input type="text" class="form-control" id="title" name="title"  placeholder="Enter Title">
        </div>
        <div class="form-group">
          <label for="category"><h3>Category</h3></label>
            <select class="form-control" id="category" name="category">
              <?php while($row = mysqli_fetch_array($result) ): ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
              <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
          <label for="body"><h3>Body</h3></label>
          <textarea class="form-control" id="body" name="body" rows="9"></textarea>
        </div>
        <button type="submit" name="post_submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
<?php include('includes/footer.php'); ?>
