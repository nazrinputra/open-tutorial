<?php
	ob_start();
	include ("dataconn.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="shortcut icon" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script>
		$(function() {
		   $( "#loginfrm" ).validate({
			   });
			});
	</script>
	<script>
		$(function() {
		   $( "#registerfrm" ).validate({
					   rules: {
							   realname: {
									   required: true,
							   },
							   username: {
										  required: true,
										  remote: {
											url: "username_check.php",
											type: "post",
										  }
							   },
							   email: {
									   required: true,
									   email: true,
									   remote: {
											url: "email_check.php",
											type: "post",
										  }
							   },
							   password: {
									   required: true,
									   minlength: 8,
							   },
							   mobile: {
									   required: true,
									   minlength: 10,
									   maxlength:10,
									   remote: {
											url: "mobile_check.php",
											type: "post",
										  }
							   },
					   },
					   messages: {
							   realname: {
									   required: "Please enter your name",
							   },
							   username: {
									   required: "Please choose a username",
									   remote: "Username is already in use",
							   },
							   email: {
									   required: "Please enter your email address",
									   email: "Email address not valid",
									   remote: "Email is already in use",
							   },
							   password: {
									   required: "Please pick a password",
									   minlength: "Password must be at least 8 characters",
							   },
							   mobile: {
									   required: "Please enter your mobile number without dashes",
									   minlength: "Mobile numbers must be 10 characters",
									   maxlength: "Mobile numbers must be 10 characters",
									   remote: "Number is already in use",
							   },
					   }
			   });
			});
	</script>
</head>
<body>
<img src="images/left-top.png" style="margin-left:200px;margin-top:25px;"/>
<img src="images/right-top.png" style="margin-left:180px;margin-top:25px;"/>
<div id="wrapper">
    <div id="content">
		
        <nav>
            <ul id="appleNav">
                <li><a href="index.php" title="Home"><img src="images/logo.png" alt="Home" style="width:30px;height:30px;" /></a></li>
                <li><a href="dashboard.php" title="Dashboard">Dashboard</a></li>
                <li><a href="profile.php" title="Profile">Profile</a></li>
                <li><a href="tutorial.php" title="Tutorials">Tutorials</a></li>
                <li><a href="cart.php" title="Cart">Cart</a></li>
                <li><a href="history.php" title="History">History</a></li>
                <?php
					if (isset($_SESSION['login']) && $_SESSION['login'] != '')
					{
					?>
					<li><a href="#" data-reveal-id="myModal"  data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal" title="Announcement">Announcement</a></li>
					<?php
					}
					else
					{
					?>
					<li><a a href="register.php" title="Register">Register</a></li>
					<?php
					}
				?>
				<li><a a href="javascript:void(0);" onClick="vpb_show_login_box();" title="Login">Login</a></li>
                <li>
                    <form name="search_frm" method="post" action="search.php?go">
                        <input type="text" name="search" placeholder="Search" />
                    </form>
                </li>
            </ul>
        </nav>
        
        <div id="main">
     
        <div id="home"></div>
        <div class="content_box_top"></div>
    <div class="content_box">
			<!-- EDIT HERE -->
            <h2>Register as a Member</h2>
			<em>Fill in required fields to register. Once registered, you may login using your username and password.</em>
			<br><br>
            <section id="login">
				<form id="registerfrm" action="register.php" method="post">
					<h1>Register Form</h1>
					<p>
						<input type="text" placeholder="Real Name" name="realname" id="realname" />
					</p>
					<p>
						<input type="text" placeholder="Username" class="required" name="username" id="username" />
					</p>
					<p>
						<input type="email" placeholder="Email" name="email" id="email" />
					</p>
					<p>
						<input type="password" placeholder="Password" name="password" id="password" />
					</p>
					<p>
						<input type="number" placeholder="Mobile Number (0123456789)" name="mobile" id="mobile" />
					</p>
					<p>
						<input type="submit" value="Register" name="registerbtn"/>
						<br/>
					</p>
					<div>
						<a href="forgot.php">Lost your password?</a>
						<center>
						<div style="width:400px; margin-top:50px;" align="center">

						<a href="javascript:void(0);" onClick="vpb_show_login_box();">Login</a>

						</div>
						</center>
					</div>
				</form><!-- form -->
		
<!--JQUERY LOGIN-->
				<div id="vpb_pop_up_background"></div>
				<div id="vpb_login_pop_up_box" class="vpb_signup_pop_up_box">
				<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Member Login</div><br clear="all">
				<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">To exit this login box, click outside this box..</div><br clear="all"><br clear="all">
			<form id="loginfrm" action="" method="post">
				<div style="width:100px; padding-top:10px;margin-left:30px;" align="center">Your Username:</div>
				<div style="width:300px;margin-left:30px;" align="center"><input type="text" id="musername" name="musername" class="required" placeholder="Username" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

				<div style="width:100px; padding-top:10px;margin-left:30px;" align="center">Your Password:</div>
				<div style="width:300px;margin-left:30px;" align="center"><input type="password" id="mpass" name="mpass" class="required" placeholder="Password" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

				<div style="width:100px; padding-top:10px;" align="center">&nbsp;</div>
				<div style="width:400px;" align="center">
				<input type="submit" name="loginbtn" id="loginbtn" class="vpb_general_button" value="Login"/>
				</div>
			</form>
				<br clear="all"><br clear="all">
				</div>
<!--JQUERY LOGIN-->			

<!--ANNOUNCEMENT-->
	<div id="myModal" class="reveal-modal">
		<h1>Admin Announcement</h1>
			<?php
				$announcement=mysql_query("select * from announcement where isDelete=0");
				if(mysql_num_rows($announcement))
				{
					while($row_announcement=mysql_fetch_assoc($announcement))
					{
						$title=$row_announcement["Announcement_Title"];
						$content=$row_announcement["Announcement_Content"];
						$author=$row_announcement["Admin_ID"];
						$result_author=mysql_query("select * from admin where Admin_ID=$author");
						$row_author=mysql_fetch_assoc($result_author);
						$author_name=$row_author["Admin_Name"];
						$author_pic=$row_author["Admin_Picture"];
						?>
						<br><br>
						<div style="background:#8FD8D8;padding:20px;">
							<em>Announcement from <u><?php echo $author_name ?></u></em>
							<br/><br/>
							<img src="../Admin_Site/images/<?php echo $author_pic; ?>" style="float:right;margin-right:40px;margin-top:-40px; width:100px;height:100px;"/>
							<h5><?php echo $title ?></h5>
							<p><b><?php echo $content ?></b></p>
						</div>
						<br><br>
						<?php
					}
				}
			?>
		<a class="close-reveal-modal">&#215;</a>
	</div>
<!--ANNOUNCEMENT-->

			</section><!-- content -->
  
            <div class="cleaner h30"></div>
            
            <div class="cleaner"></div>
    </div> <!-- end of a content box -->
        <div class="content_box_bottom"></div>
		</div> <!-- end of main -->
    </div> <!-- end of content -->
    <div id="footer">
			<div class="bottomNav"> 
					<ul class="bottomnavControls">
				   <li style="padding-bottom:5px;"><b>Member</b></li>
				   <li><a href="follow.php"  class="footer">Following</a></li>
				   <li><a href="profile.php"  class="footer">My Profile</a></li>
				   <li><a href="update_profile.php"  class="footer">Edit Profile</a></li>
					</ul>    

					<ul class="bottomnavControls">
				   <li style="padding-bottom:5px;"><b>Tutorial</b></li>
				   <li><a href="tutorial.php"  class="footer">All Tutorials</a></li>
				   <li><a href="my_tutorial.php"  class="footer">My Tutorial</a></li>
				   <li><a href="upload_tutorial.php"  class="footer">Upload Tutorial</a></li>
					</ul>

				   <ul class="bottomnavControls">
					 <li style="padding-bottom:5px;"><b>Links</b></li>
					 <li><a href="cart.php" class="footer">Shopping Cart</a></li>
					 <li><a href="credit_purchase.php" class="footer">Credit Purchase</a></li>
					 <li><a href="history.php" class="footer">Transaction History</a></li>
				   </ul>
		
			</div>
			<p>&nbsp;</p>
			<a href="../Admin_Site/login.php" style="color:white;">Admin Login</a>
			<p></p>
			Copyright &copy; 2048
		</div>
</div> <!-- end of wrapper -->
</body>
</html>
<?php
	if(isset($_POST["registerbtn"]))
	{
		$mrealname=$_POST["realname"];
		$musername=$_POST["username"];
		$memail=$_POST["email"];
		$mpassword=$_POST["password"];
		$mpassword=md5($mpassword);
		$mmobile=$_POST["mobile"];		
		
		mysql_query("insert into member (Member_Name,Member_Username,Member_Email,Member_Password,Member_Mobile) values ('$mrealname','$musername','$memail','$mpassword',$mmobile)");
		$mid=mysql_insert_id();
		mysql_query("insert into member_rating (Member_ID) values ('$mid')");
		$rating_id=mysql_insert_id();
		mysql_query("update member set Rating_ID=$rating_id where Member_ID=$mid");
		
		//SMS
		require "SMS/Services/Twilio.php";
		// set your AccountSid and AuthToken from www.twilio.com/user/account
		$AccountSid = "AC091ecf4f24db99b0737047cae5eb1596";
		$AuthToken = "a7fa8783bcd97ef646ae00f8f2b34a80";
		
		$client = new Services_Twilio($AccountSid, $AuthToken);
		 
		$message = $client->account->messages->create(array(
			"From" => "267-362-4610",
			"To" => "+6".$mmobile,
			"Body" => 'Dear '.$musername.', welcome to OpenTutorial. Thanks for using our system! "Grow your mind.."',
		));
		//SMS
		
		//PHPMAILER//
		include("PHPMailer/class.phpmailer.php");
		include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

		$mail             = new PHPMailer();
		$body             = "Congratulations ".$musername."! You are successfully registered to the OpenTutorial website.";//message

		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port

		$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
		$mail->Password   = "Pujangga_94";            // GMAIL password

		$mail->From       = "open_tutorial@yourdomain.com";
		$mail->FromName   = "Administrator";
		$mail->Subject    = "Registration at OpenTutorial";
		$mail->AltBody    = "Successful registration"; //Text Body
		$mail->WordWrap   = 50; // set word wrap

		$mail->MsgHTML($body);

		$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

		//$mail->AddAttachment("/path/to/file.zip");             // attachment
		//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

		$mail->AddAddress("{$memail}");

		$mail->IsHTML(true); // send as HTML

		if(!$mail->Send()) {
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('<?php echo "Registration error: " . $mail->ErrorInfo; ?>', {title: 'Register', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		} else {
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('<?php echo "Registration successful. An email has been sent to your email address."; ?>', {title: 'Register', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		}
		//PHPMAILER//
		header("refresh:0.5;url=index.php");
	}
	
	//JQUERY LOGIN
	if(isset($_POST["loginbtn"]))
	{
		$user=$_POST["musername"];
		$pass=$_POST["mpass"];
		$pass=md5($pass);
		$login=mysql_query("select * from MEMBER where Member_Username='$user' and Member_Password='$pass' and isDelete=0");
		$login_row=mysql_fetch_assoc($login);
		
		if(mysql_num_rows($login)==1)
		{
			$_SESSION['login']=$login_row["Member_ID"];
			header("location: dashboard.php");
		}
		else
		{
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('Wrong username or password!', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		}
	}
	//JQUERY LOGIN
?>