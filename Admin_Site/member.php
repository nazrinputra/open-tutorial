<?php 
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="shortcut icon" href="images/icon.png">
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript">
		function confirmdelete()
		{
			var answer=confirm("Do you want to bar this member?");
			return answer;
		}
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
							<li><a href="add_announcement.php" class="ico3">Add Announcement <!--<span class="num">!</span>--></a></li>
							<li><a href="search.php" class="ico4">Search <!--<span class="num">0</span>--></a></li>
							<li><a href="history.php" class="ico5">History <!--<span class="num">0</span>--></a></li>
							<li class="selected"><a href="viewtables.php" class="ico6">View Database</a></li>
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
								<p>View members in the database.</p>
							</div>
							<div class="page-title">
								<h2>Member Table</h2>
							</div>
							<div class="database">
								<table>
									<tr class="display_table">
										<th>Member ID</th>
										<th>Member Name</th>
										<th>Member Picture</th>
										<th>Member Username</th>
										<th>Member Email</th>
										<th>Member Mobile</th>
										<th>Member Profit</th>
										<th>Member Status</th>
										<th>View</th>
										<th>Bar</th>
									</tr>
								<?php
									$result_member=mysql_query("select * from member");
									while($row_member=mysql_fetch_assoc($result_member))
									{
								?>
									<tr>
										<td><?php echo $row_member["Member_ID"];?></td>
										<td><?php echo $row_member["Member_Name"];?></td>
										<td><img class="image" src="../Design_Site/images/Profile/<?php echo $row_member["Member_Profile"]; ?>" alt="image description" width="26" height="26" /></td>
										<td><?php echo $row_member["Member_Username"];?></td>
										<td><?php echo $row_member["Member_Email"];?></td>
										<td><?php echo $row_member["Member_Mobile"];?></td>
										<td>RM <?php echo $row_member["Member_Profit"];?></td>
										<td><?php if($row_member["isDelete"]==0){echo 'Active';}else{echo 'Barred';}?></td>
										<td>
											<a href="view_member.php?mid=<?php echo $row_member["Member_ID"]; ?>">
												<img src="images/view.png" width="30px" height="30px;"/>
											</a>
										</td>
										<td>
											<?php
											if($row_member["isDelete"]==1)
											{
											?>
											<a href="member.php?a_mid=<?php echo $row_member["Member_ID"]; ?>">
												<img src="images/delete.png" width="30px" height="30px;"/>
											</a>
											<?php
											}
											else
											{
											?>
											<a href="member.php?mid=<?php echo $row_member["Member_ID"]; ?>">
												<img src="images/add.png" width="30px" height="30px;" onclick="return confirmdelete();"/>
											</a>
											<?php
											}
											?>
										</td>
									</tr>
								<?php
									}
								?>
								</table>
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
	if(isset($_REQUEST["mid"]))
	{
		$mid=$_REQUEST["mid"];
		mysql_query("update member set isDelete=1 where Member_ID = $mid");
		
			//PHPMAILER//
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
			
			$result_member=mysql_query("select * from member where Member_ID=$mid");
			$row_member=mysql_fetch_assoc($result_member);
			$name=$row_member["Member_Username"];
			$email=$row_member["Member_Email"];
			
			$mail             = new PHPMailer();
			$body             = 'Dear '.$name.', you has been banned by an admin. You will no longer be able to login to our website unless the banning is removed. Thank you. "Grow your mind.."';//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Banned at OpenTutorial";
			$mail->AltBody    = "Banned"; //Text Body
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
		
		header("Location: member.php");
	}
	
	if(isset($_REQUEST["a_mid"]))
	{
		$a_mid=$_REQUEST["a_mid"];
		mysql_query("update member set isDelete=0 where Member_ID = $a_mid");
		
			//PHPMAILER//
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
			
			$result_member=mysql_query("select * from member where Member_ID=$mid");
			$row_member=mysql_fetch_assoc($result_member);
			$name=$row_member["Member_Username"];
			$email=$row_member["Member_Email"];
			
			$mail             = new PHPMailer();
			$body             = 'Dear '.$name.', you has been unbanned by an admin. You may now login to our website again. Thank you. "Grow your mind.."';//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Unbanned at OpenTutorial";
			$mail->AltBody    = "Unbanned"; //Text Body
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
		
		header("Location: member.php");
	}
?>