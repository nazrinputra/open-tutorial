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
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables_themeroller.css"/>
	<style>
		input.switch:empty
		{
			display:none;
		}

		input.switch:empty ~ label
		{
			position: relative;
			text-align:center;
			line-height: 1.6em;
			text-indent: 4em;
			margin: 0.2em 0;
			cursor: pointer;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		}

		input.switch:empty ~ label:before, 
		input.switch:empty ~ label:after
		{
			position: absolute;
			display: block;
			top: 0;
			bottom: 0;
			left: 0;
			content: ' ';
			width: 3.6em;
			background-color: #c33;
			border-radius: 0.3em;
			box-shadow: inset 0 0.2em 0 rgba(0,0,0,0.3);
			-webkit-transition: all 100ms ease-in;
		  transition: all 100ms ease-in;
		}

		input.switch:empty ~ label:after
		{
			width: 1.4em;
			top: 0.1em;
			bottom: 0.1em;
			margin-left: 0.1em;
			background-color: #fff;
			border-radius: 0.15em;
			box-shadow: inset 0 -0.2em 0 rgba(0,0,0,0.2);
		}

		input.switch:checked ~ label:before
		{
			background-color: #393;
		}

		input.switch:checked ~ label:after
		{
			margin-left: 2.1em;
		}
	</style>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript">
		function confirmbar()
		{
			var answer=confirm("Do you want to bar this tutorial? You will be redirected to another page to enter banning reason afterwards.");
			return answer;
		}
		function confirmunbar()
		{
			var answer=confirm("Do you want to unbar this tutorial?");
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
							<li class="selected"><a href="tutorial.php" class="ico2">Tutorials <!--<span class="num">77</span>--></a></li>
							<li><a href="add_announcement.php" class="ico3">Add Announcement <!--<span class="num">!</span>--></a></li>
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
								<p>View tutorials in the database.</p>
							</div>
							<div class="page-title">
								<h2>Tutorial</h2>
							</div>
							<div class="database">
								<?php
								$result_tutorial=mysql_query("select * from tutorial");
								if(mysql_num_rows($result_tutorial))
								{
								?>
									<table id="tutorial">
										<thead>
										<tr>
											<th>Title</th>
											<th>Subject</th>
											<th>Category</th>
											<th>Uploader</th>
											<th>Material</th>
											<th>Price</th>
											<th>Rating</th>
											<th>Active</th>
											<th>Barred</th>
											<th>View</th>
											<th>Edit</th>
											<th>Bar</th>
										</tr>
										</thead>
										<tbody>
										<?php
										while($row_tutorial=mysql_fetch_assoc($result_tutorial))
											{
												?>
												<tr>
													<td>
														<a href="view_tutorial.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>"><?php echo $row_tutorial["Tutorial_Title"]; ?></a>
													</td>
													<td>
														<?php
															$subject=$row_tutorial["Subject_ID"];
															$result_subject=mysql_query("select * from subject where Subject_ID='$subject'");
															$row_subject=mysql_fetch_assoc($result_subject);
															echo $row_subject["Subject_Name"];
														?>
													</td>
													<td>
														<?php
															$category=$row_tutorial["Category_ID"];
															$result_category=mysql_query("select * from category where Category_ID='$category'");
															$row_category=mysql_fetch_assoc($result_category);
															echo $row_category["Category_Name"];
														?>
													</td>
													<td>
														<?php
															$member=$row_tutorial["Member_ID"];
															$result_member=mysql_query("select * from member where Member_ID=$member");
															$row_member=mysql_fetch_assoc($result_member);
															echo $row_member["Member_Username"];
														?>
													</td>
													<td>
														<?php
															$material=$row_tutorial["Material_ID"];
															$result_material=mysql_query("select * from material where Material_ID='$material'");
															$row_material=mysql_fetch_assoc($result_material);
															echo $row_material["Material_Name"];
														?>
													</td>
													<td>
														RM <?php
															echo $row_tutorial["Tutorial_Price"];
														?>
													</td>
													<td>
														<?php
															$tid=$row_tutorial["Tutorial_ID"];
															$result_rating=mysql_query("select * from tutorial_rating where Tutorial_ID='$tid'");
															$row_rating=mysql_fetch_assoc($result_rating);
															echo $row_rating["Tutorial_Rating_Average"];
														?>
													</td>
													<td>
														<?php
															$active=$row_tutorial["isActive"];
															if($active==1)
																{echo "Yes";}
															else
																{echo "No";}
														?>
													</td>
													<td>
														<?php
															$delete=$row_tutorial["isDelete"];
															if($delete==1)
																{echo "Yes";}
															else
																{echo "No";}
														?>
													</td>
													<td>
														<a href="view_tutorial.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
															<img src="images/view.png" width="30px" height="30px;"/>
														</a>
													</td>
													<td>
														<a href="edit_tutorial.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
															<img src="images/update.png" width="30px" height="30px;"/>
														</a>
													</td>
													<td>
													<?php
														$delete=$row_tutorial["isDelete"];
														if($delete==1)
														{
														?>
														<a href="tutorial.php?a_tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>" onclick="return confirmunbar();">
															<img src="images/delete.png" width="30px" height="30px;"/>
														</a>
														<?php
														}
														else
														{
														?>
														<a href="ban.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>" onclick="return confirmbar();">
															<img src="images/add.png" width="30px" height="30px;"/>
														</a>
														<?php
														}
														?>
													</td>
												</tr>
												<?php
											}
										?>
										</tbody>
									</table>
								<?php
								}
								else
								{echo "No tutorial uploaded";}
								?>
							</div>
							<!--<ul class="states">
								<li class="success">Success : 77 new tutorials added.</li>
								<li class="warning">Warning : Some tutorials are missing.</li>
							</ul>-->
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
	if(isset($_REQUEST["a_tid"]))
	{
		$a_tid=$_REQUEST["a_tid"];
		mysql_query("update tutorial set Tutorial_Bar='',isDelete=0 where Tutorial_ID = $a_tid");
		header("Location: tutorial.php");
		
			//PHPMAILER//
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
			
			$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$a_tid");
			$row_tutorial=mysql_fetch_assoc($result_tutorial);
			$mid=$row_tutorial["Member_ID"];
			$tutorial_title=$row_tutorial["Tutorial_Title"];
			$result_member=mysql_query("select * from member where Member_ID=$mid");
			$row_member=mysql_fetch_assoc($result_member);
			$name=$row_member["Member_Username"];
			$email=$row_member["Member_Email"];
			
			$mail             = new PHPMailer();
			$body             = 'Dear '.$name.', thanks for using our system. Your tutorial titled "'.$tutorial_title.'" has been unbanned by an admin. Sorry for any inconvenience. Thank you. "Grow your mind.."';//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Tutorial Unbanned at OpenTutorial";
			$mail->AltBody    = "Tutorial Unbanned"; //Text Body
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