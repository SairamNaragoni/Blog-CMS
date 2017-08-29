<?php include('includes/header.php'); ?>
<?php if(!isset($_SESSION['uid']))
      {
        header("location: index.php");
      }
?>
<?php 
      include('includes/connection.php');
      $id = $_GET['id'];
      $post_query = "SELECT * FROM `posts` WHERE `id` = '$id'";
      $post_result = mysqli_query($conn,$post_query);
      $post_result = mysqli_fetch_array($post_result);
      $query = "SELECT * FROM `categories`";
      $result = mysqli_query($conn,$query);
      $user_id = $post_result['user_id'];
      if(isset($_POST['post_submit']))
      {   
          $title = $_POST['title'];
          $body = $_POST['body'];
          $category = $_POST['category'];
          $query = "UPDATE `posts`
                    SET `title` = '$title',
                        `body` = '$body',
                        `cate_id` = '$category'
                    WHERE `id` = '$id' ";
          $result = mysqli_query($conn,$query);
          if($result)
          {
              header("location: users.php?id=$user_id");
          }
          else{
            echo "query failed";
          }
      }
?>
    <div class="container">
      <form action="editpost.php?id=<?php echo $id; ?>" method="post" style="margin:25px;">
        <div class="form-group">
          <label for="title"><h3>Title</h3></label>
          <input type="text" class="form-control" name="title"  placeholder="Enter Title" 
            value="<?php echo $post_result['title'];?>">
        </div>
        <div class="form-group">
          <label for="category"><h3>Category</h3></label>
            <select class="form-control" id="category" name="category">
              <?php while($row = mysqli_fetch_array($result) ): ?>
              <?php if($row['id'] == $post_result['cate_id']): ?>
                <option value="<?php echo $row['id']; ?>" selected = "selected"><?php echo $row['category']; ?></option>
              <?php else: ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
              <?php endif; ?>
              <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
          <label for="body"><h3>Body</h3></label>
          <textarea class="form-control" id="body" name="body" rows="9"><?php echo $post_result['body'];?></textarea>
        </div>
        <button type="submit" name="post_submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
<?php include('includes/footer.php'); ?>