<?php	include('includes/header.php');
		include("includes/connection.php"); ?>
<?php
    function mailAdmin($email,$user_subject,$body)
    {
    	$subject = "You got a response from user $email";
        $to='your-mail@gmail.com';
        $header="From:";
        $message="FROM : $email\nSUBJECT : $user_subject\n $body\n";
        $sentmail = mail($to,$subject,$message,$header);
        if($sentmail){
            $msg = '<div class="alert alert-success" role="alert">Admin will get back to you shortly.</div>';
        }
        else {
            $msg =  '<div class="alert alert-danger" role="alert">"Failed to send email.</div>';
        }
        return $msg;
    }
?>
<?php
	$msg = '';
	if(isset($_POST['submit']))
	{
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$text = $_POST['text'];
		$msg = mailAdmin($email,$subject,$text);
	}
?>
<?php
 ?>
 	
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                	<div  style="margin-top: 30px;">
                		<?php if($msg!="")
                				echo $msg; ?>
                	</div>
                	<div class="card-header"><h1 class="mt-4">Contact</h1></div>
                	<div class="card-block" style="padding-bottom: 0px;">
                		<form method="POST" action="contact.php">
						  <div class="form-group">
						    <label for="email">Email</label>
						    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
						  </div>
						  <div class="form-group">
						    <label for="subject">Subject</label>
						    <input type="text" name="subject" class="form-control" id="subject" placeholder="subject">
						  </div>
						  <div class="form-group">
						    <label for="text">Message</label>
						    <textarea class="form-control" name="text" id="text" rows="3"></textarea>
						  </div>
						  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</form>
                		<p class="lead card-title"></p>
	                	<div class="row">
	                    	<div class="col"></div>
	                	</div>
                	</div>
                </div>
            </div>
          <?php include('includes/sidenav.php'); ?>
<?php include('includes/footer.php');?>
