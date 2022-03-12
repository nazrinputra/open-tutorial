<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_REQUEST["tid"]))
	{
		$tid=$_REQUEST["tid"];
	}
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="shortcut icon" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script>
		$(function() {
		   $( "#banfrm" ).validate({
				rules:{
					reason:{
						required:true,
					},
				},
				messages:{
					reason:{
						required:"Please enter your reason",
					},
				}
			   });
			});
	</script>
</head>
<body>
	<div id="wrapper">
		<div id="content">
			<div class="c1">
				<div class="controls">
					<nav class="links">
						<ul>
							<li><a href="profile.php" class="ico1">Profile <!--<span class="num">2</span>--></a></li>
							<li><a href="tutorial.php" class="ico2">Tutorials <!--<span class="num">77</span>--></a></li>
							<li class="selected"><a href="add_announcement.php" class="ico3">Add Announcement <!--<span class="num">!</span>--></a></li>
							<li><a href="search.php" class="ico4">Search <!--<span class="num">0</span>--></a></li>
							<li><a href="history.php" class="ico5">History <!--<span class="num">0</span>--></a></li>
							<li><a href="viewtables.php" class="ico6">View Database</a></li>
							<li><a href="message.php" class="ico7">Messages</a></li>
						</ul>
					</nav>
					<div class="profile-box">
						<span class="profile">
							<a href="profile.php" class="section">
								<img class="image" src="images/<?php echo $row["Admin_Picture"]; ?>" alt="image description" width="26" height="26" />
								<span class="text-box">
									Welcome
									<strong class="name"><?php echo $row["Admin_Name"]; ?></strong>
								</span>
							</a>
							<a href="#" class="opener">opener</a>
						</span>
						<a href="logout.php" class="btn-on">On</a>
					</div>
				</div>
				<div class="tabs">
					<div id="tab-1" class="tab">
						<article>
							<div class="text-section">
								<h1>Administrator</h1>
								<p>Insert reason for banning this tutorial.</p>
							</div>
							<div class="page-title">
								<h2>Reason for Banning</h2>
							</div>
							<div class="text-section-black">
								<form method="post" name="banfrm" id="banfrm" action="">
									<p>Reason:<br><textarea name="reason" id="reason" style="width:44em;height:5em;float:none;" class="required"></textarea></p>
									<p><a href="tutorial.php"><input type="button" name="cancel" value="Cancel"/></a><input type="submit" name="add" value="Add Reason"/></p>
								</form>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
		<aside id="sidebar">
			<strong class="logo"><a href="index.php">ot</a></strong>
			<ul class="tabset buttons">
				<li class="active">
					<a href="#tab-1" class="ico1"><span>Dashboard</span><em></em></a>
					<span class="tooltip"><span>Dashboard</span></span>
				</li>
				
			</ul>
		</aside>
	</div>
</body>
</html>
<?php
	if(isset($_POST["add"]))
	{
		$reason=$_POST["reason"]." - banned by ".$row["Admin_Username"];
		mysql_query("update tutorial set Tutorial_Bar='$reason',isDelete=1 where Tutorial_ID=$tid");
		header("Location: tutorial.php");
		
			//PHPMAILER//
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
			
			$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
			$row_tutorial=mysql_fetch_assoc($result_tutorial);
			$mid=$row_tutorial["Member_ID"];
			$tutorial_title=$row_tutorial["Tutorial_Title"];
			$result_member=mysql_query("select * from member where Member_ID=$mid");
			$row_member=mysql_fetch_assoc($result_member);
			$name=$row_member["Member_Username"];
			$email=$row_member["Member_Email"];
			
			$mail             = new PHPMailer();
			$body             = 'Dear '.$name.', thanks for using our system. Your tutorial titled "'.$tutorial_title.'" has been banned by an admin. The reason for banning is "'.$reason.'". Thank you. "Grow your mind.."';//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Tutorial Banned at OpenTutorial";
			$mail->AltBody    = "Tutorial Banned"; //Text Body
			$mail->WordWrap   = 50; // set word wrap

			$mail->MsgHTML($body);

			$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$mail->AddAddress("{$email}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
			//PHPMAILER//
	}
?>