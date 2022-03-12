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
	<script>
	$(function() {
	   $( "#profilefrm" ).validate({
			rules:
			{
				name: {required: true},
				email: {required: true, email: true},
				mobile: {required: true}
			},
			messages:
			{
				name: "Please enter your name",
				email: "Please enter a valid email address",
				mobile: "Please enter your mobile number",
				level: "Please select your admin level"
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
							<li class="selected"><a href="profile.php" class="ico1">Profile <!--<span class="num">2</span>--></a></li>
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
								<p>Update your own profile details including profile picture.</p>
							</div>
							<div class="page-title">
								<h2>Update Profile</h2>
							</div>
							<div class="text-section-black">				
									<form name="profilefrm" id="profilefrm" method="post" action="" enctype="multipart/form-data">
										<p>Public Profile Settings</p>
										<p>&nbsp;</p>
										<p><image src="../Admin_Site/images/<?php echo $row["Admin_Picture"]; ?>" style="width:100px;height:100px;"/></p>
										<p>Profile Picture:<br/><input type="file" name="profile" id="profile"></p>
										<p>&nbsp;</p>
										<p>ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row["Admin_ID"]; ?>
										<p>&nbsp;</p>
										<p>Name : <input type="text" name="name" id="name" value="<?php echo $row["Admin_Name"]; ?>" size="50" style=""/><label id="disname">&nbsp;</label></p>
										<p>&nbsp;</p>
										<p>Email &nbsp;: <input type="email" name="email" id="email" value="<?php echo $row["Admin_Email"]; ?>" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Mobile : <input type="text" name="mobile" id="mobile" value="<?php echo $row["Admin_Mobile"]; ?>" size="11" style=""/></p>
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
		$aemail=$_POST["email"];
		$amobile=$_POST["mobile"];
		
		$tmpName  = $_FILES['profile']['tmp_name'];
		$info = pathinfo($_FILES['profile']['name']);
		$location = "images/Profile/" . $sess_id .".". $info['extension'];
		
		if ($_FILES["profile"]["error"] > 0) 
		{echo "Return Code: " . $_FILES["profile"]["error"] . "<br>";}
		else 
		{$profile = "Profile/" . $sess_id .".". $info['extension'];}
		move_uploaded_file($_FILES["profile"]["tmp_name"],$location);

		mysql_query("update ADMIN set Admin_Name='$aname', Admin_Email='$aemail', Admin_Mobile='$amobile' where Admin_ID=$sess_id") or die(mysql_error());
		if(isset($profile))
		{mysql_query("update ADMIN set Admin_Picture='$profile' where Admin_ID=$sess_id");}
		header("location: profile.php");
	}
?>