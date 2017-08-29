<?php include("includes/header.php");
    if(isset($_SESSION['uid']))
    {
            header("Location: index.php"); 
    }
 ?>
 <?php
    function mailUser($email,$hash)
    {
        $to=$email;
        $subject="Your confirmation link is here :";
        $header="From:";
        $message="Click the link below to activate your account\n\n http://localhost/blog/confirmMail.php?email=$email&hash=$hash";
        $sentmail = mail($to,$subject,$message,$header);
        if($sentmail){
            $error = "Your Activation link Has Been Sent To Your Email Address.";
        }
        else {
            $error =  "Cannot send Activation link to your E-mail address";
        }
        return $error;
    }
  ?>
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
                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $error = "User with that Email already exists.";
                } 
                else {
                    $hash = md5( rand(0,1000) );
                    if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
                    {
                        $target = "images/avatars/".basename($_FILES['image']['name']);
                        $image = $_FILES['image']['name'];
                    }
                    else
                    {
                        $image = '0';
                    }
                    $query = "INSERT INTO `users` (`username`,`email`, `password`,`hash`,`avatar`) VALUES ('".mysqli_real_escape_string($conn, $_POST['username'])."','".mysqli_real_escape_string($conn, $_POST['email'])."', '".mysqli_real_escape_string($conn, $_POST['password'])."','".mysqli_real_escape_string($conn, $hash)."','$image')";
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                        $error = "Failed to upload image";
                    }
                    if (!mysqli_query($conn, $query)) {
                        $error = "<p>Could not sign you up - please try again later.</p>";
                    } 
                    else {
                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($conn)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($conn)." LIMIT 1";                        
                        $id = mysqli_insert_id($conn);                   
                        mysqli_query($conn, $query);                     
                        //session_start();
                        //$_SESSION['uid'] = $id;
                        //header("Location: index.php");
                        $error = mailUser($_POST['email'],$hash);
                        
                    }
                }                 
        }        
    }
?>
    <div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-1"></div>
            <div class="col-lg-4" style=" margin-top: 50px;">
                <div id="error">
                    <?php if ($error!="") {
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    } ?>  
                </div>
                <!-- Login Form -->
                <hr>
               <form method="POST" id = "signUpForm" action="register.php" enctype="multipart/form-data">   
                <p>Interested? Sign up now.</p>
                    <fieldset class="form-group">
                        <input class="form-control" type="text" name="username" placeholder="Username" style="max-width: 350px;">                
                    </fieldset>                                
                    <fieldset class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email" style="max-width: 350px;">                                   
                    </fieldset>                               
                    <fieldset class="form-group">                                
                        <input class="form-control" type="password" name="password" placeholder="Password" style="max-width: 350px;">                  
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="image">Choose your Profile pic :</label>
                        <input type="file" name="image" class="form-control-file">
                    </fieldset>
                    <fieldset class="form-group">
                        <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
                    </fieldset> 
                </form>       
            </div>
            <div class="col-lg-3"></div>                   
    <?php include("includes/sidenav.php"); ?>
<?php include("includes/footer.php"); ?>
