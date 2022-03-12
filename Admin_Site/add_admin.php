<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {
	header ("Location: login.php");
	}
	
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if($row["Admin_Level"]!="Master")
	{
		header ("Location: index.php");
	}
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="shortcut icon" href="images/icon.png">
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script>
		$(function() {
		   $( "#adminfrm" ).validate({
					rules:
					{
						name: {required: true},
						email: {required: true, email: true},
						mobile: {required: true},
						username: {required: true},
					},
					messages:
					{
						name: "Please enter your name",
						email: "Please enter a valid email address",
						mobile: "Please enter your mobile number",
						level: "Please select your admin level",
						username: "Please enter username",
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
								<p>Add administrator to the database.</p>
							</div>
							<div class="page-title">
								<h2>Add Admin</h2>
							</div>
							<div class="text-section-black">
								<form method="post" name="adminfrm" id="adminfrm" enctype="multipart/form-data">
										<p>New Admin Details</p>
										<p>&nbsp;</p>
										<p>Profile Picture:<br/><input type="file" name="profile" id="profile"></p>
										<p>&nbsp;</p>
										<p>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="name" id="name" placeholder="Name" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Username : <input type="text" name="username" id="username" placeholder="Username" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Password &nbsp;&nbsp;: <input type="text" name="password" id="password" placeholder="Password" style=""/></p>
										<p>&nbsp;</p>
										<p>Level &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <select name="level" id="level" class="required">
															<option value="" selected>Please select level..</option>
															<option value="Master">Master</option>
															<option value="Normal">Normal</option>
														  </select>
										</p>
										<p>&nbsp;</p>
										<p>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="email" name="email" id="email" placeholder="Email" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="mobile" id="mobile" placeholder="Mobile" size="11" style=""/></p>
										<p>&nbsp;</p>	
										<p><input type="submit" value="Save Info" name="savebtn"/></p>
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
	if(isset($_POST["savebtn"]))
	{
		$aname=$_POST["name"];
		$alevel=$_POST["level"];
		$aemail=$_POST["email"];
		$amobile=$_POST["mobile"];
		$ausername=$_POST["username"];
		$apassword=$_POST["password"];
		$apassword=md5($apassword);
		
		$tmpName  = $_FILES['profile']['tmp_name'];
		$info = pathinfo($_FILES['profile']['name']);
		$location = "images/Profile/" . $sess_id .".". $info['extension'];
		
		if ($_FILES["profile"]["error"] > 0) 
		{echo "Return Code: " . $_FILES["profile"]["error"] . "<br>";}
		else 
		{$profile = "Profile/" . $sess_id .".". $info['extension'];}
		move_uploaded_file($_FILES["profile"]["tmp_name"],$location);

		mysql_query("insert into ADMIN (Admin_Name,Admin_Username,Admin_Password,Admin_Level,Admin_Email,Admin_Mobile) values ('$aname','$ausername','$apassword','$alevel','$aemail','$amobile')") or die(mysql_error());
		if(isset($profile))
		{
			$aid=mysql_insert_id();
			mysql_query("update ADMIN set Admin_Picture='$profile' where Admin_ID=$aid");
		}
		header("location: admin.php");
	}
?>