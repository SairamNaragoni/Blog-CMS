<?php
    $error = "";  
    if (array_key_exists("submit", $_POST)) {
        include("includes/connection.php");
        if (!$_POST['email']) {
            $error .= "*An Email is required<br>";
        } 
        if (!$_POST['password']) {
            $error .= "*A Password is required<br>"; 
        } 
        if ($error == "") {
                    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);
                    if (isset($row)) {
                        if($row['active']==1)
                        {
                            $hashedPassword = md5(md5($row['id']).$_POST['password']);
                            if ($hashedPassword == $row['password']) {
                                session_start();
                                $_SESSION['uid'] = $row['id'];
                                header("Location: index.php");                                
                            } else {                            
                                $error = "That email/password combination could not be found.";                            
                            }
                        }
                        else
                        {
                            $error = "Activate Your Account to login.Check your registered email";     
                        }    
                    } else {                        
                        $error = "That email/password combination could not be found.";                        
                    }                                                
        }        
    }
?>
<?php  include("includes/header.php");
        if(isset($_SESSION['uid']))
        {
            header("Location: index.php"); 
        }
 ?>  
    <div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-1"></div>
            <div class="col-lg-4" style="border: 0.1px ; margin-top: 50px;">
                <div id="error">
                    <?php if ($error!="") {
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    } ?>  
                </div>
                <!-- Login Form -->
                <hr>
                <form method="post" id = "logInForm">                 
                    <p>Sign in using your Email and Password.</p>
                    <fieldset class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Your Email" style="max-width: 350px;">                
                    </fieldset>                    
                    <fieldset class="form-group">                  
                        <input class="form-control" type="password" name="password" placeholder="Password" style="max-width: 350px;">            
                     </fieldset>                    
                    <fieldset class="form-group">                       
                        <input class="btn btn-success" type="submit" name="submit" value="Log In!">                     
                    </fieldset>
                </form>   
            </div>
            <div class="col-lg-3"></div>
            <?php include("includes/sidenav.php"); ?>
<?php include("includes/footer.php"); ?>