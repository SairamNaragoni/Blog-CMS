# Blog-CMS
Copy the contents to </br>
>C:\xampp\htdocs\blog

## Setting Up SMTP ##

>Go to 
C:\xampp\php\php.ini

find : *[mail function]* And
Set The Following </br>
```
SMTP=smtp.gmail.com
smtp_port=465
sendmail_from = your-id@gmail.com
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
```

>Go to 
C:\xampp\sendmail\sendmail.ini

Copy Paste the following
```
[sendmail]
smtp_server=smtp.gmail.com
smtp_port=465
error_logfile=error.log
debug_logfile=debug.log
auth_username=your-id@gmail.com
auth_password=your-password
force_sender=your-id@gmail.com
```
>Open your gmail account > settings > Forwarding and POP/IMAP
enable IMAP and save
___
Your SMTP must be set now.</br>
If errors persists try changing `smtp_port` to `565` </br>
or remove semicolon before </br>
`;extension=php_openssl.dll` in `php.ini` </br>
Try installing the latest version of [Xampp](https://www.apachefriends.org/download.html "Xampp Download")</br>

If you are still facing any errors,</br>
Comment the `"mailUser"` function and its call in `register.php` and </br>
Comment out the commented part</br>
```
//session_start();
//$_SESSION['uid'] = $id;
//header("Location: index.php");
```
If you somehow manage to set up your SMTP,</br>
open `contact.php` and change `$to = your-mail@gmail.com`.</br>
`contact.php` won't work,if you cant set up SMTP. </br>

As of database, Create a database named `blog` in PHPmyAdmin
And Import the sql file `blog.sql` and you are good to go.


## Features Of the Blog: ##

__Authentication :__ Viewer | Blogger | Admin

__Viewer :__
* Can view Posts.
* Can view Blogger/Admin Profile.
* Can Contact Admin.
* Search For a particular user.
		
__Blogger :__ 
* All Rights of Viewer +
* Needs to Sign-Up with valid Email-id.
* An Activation link will be send from localhost(if you had your smtp set up)
* Blogger can post a new post.
* Can Comment on any post.
* Can Like/Unlike any post.
* Can Follow/UnFollow other bloggers/admin.
* See All his Followers/Following.
* Receives notification for LIKE/COMMENT on his post.
* Receives notification if anyone follows him/her.
* Receives notification if any user , a blogger follows makes any new post.

__Admin :__ 
* All Rights of Blogger +
* Can Delete any post he feels is spam.
* Can edit any post to remove offensive keywords.
* Can add/delete any new/existing category.
* Can make Any existing blogger as admin or remove him as admin.
* Can Delete the account of a blogger.
