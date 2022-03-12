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
								<p>View your own profile details including profile picture.</p>
							</div>
							<div class="page-title">
								<h2>Profile</h2>
							</div>
							<div class="text-section-black">
							
							<?php $result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
								while($row=mysql_fetch_assoc($result))
								{
							?>
										<p>My Profile</p>
										<p>&nbsp;</p>
										<p><image src="../Admin_Site/images/<?php echo $row["Admin_Picture"]; ?>" style="width:100px;height:100px;"/></p>
										<p>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row["Admin_ID"]; ?></span></p>
										<p>&nbsp;</p>
										<p>Name&nbsp;&nbsp;: <span id="details"><?php echo $row["Admin_Name"]; ?></span></p>
										<p>&nbsp;</p>
										<p>Level&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row["Admin_Level"]; ?></span></p>
										<p>&nbsp;</p>
										<p>Email&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row["Admin_Email"]; ?></span></p>
										<p>&nbsp;</p>
										<p>Mobile&nbsp;: <span id="details"><?php echo $row["Admin_Mobile"]; ?></span></p>
										<p>&nbsp;</p>										
							<?php }
							?>
							
										<p style="float:left;"><a href="update_profile.php"><input type="button" value="Update Profile" name="savebtn"/></a></p>
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