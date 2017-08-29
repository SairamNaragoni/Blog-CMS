 <?php
    include("includes/connection.php");
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn,$query);
?>
 <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-block">
                        <div class="input-group">
                            <input type="text" id="search_bar" class="form-control" placeholder="Search ...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                        <div class="row" style="padding: 0px;">
                            <div class="col-lg-10" style="position: absolute;z-index: 100;">
                                <ul class="list-group" id="search_result">
                                </ul>
                        </div> 
                        </div>
                    </div>
                </div>
                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-group">
                                <li class="list-group-item"><a href="index.php">All Posts</a></li>
                                <?php while($row = mysqli_fetch_array($result)): ?>
                                  <li class="list-group-item"><a href="posts.php?id=<?php echo $row['id']?>"><?php echo $row['category']; ?></a></li>
                                <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>