<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_GET["mid"]))
	{
		$member=$_GET["mid"];
		$result_member=mysql_query("select * from member where Member_ID=$member");
		$row_member=mysql_fetch_assoc($result_member);
	}
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="shortcut icon" href="images/icon.png">
	<style>
		input.switch:empty
		{
			display:none;
			padding-left:200px;
		}

		input.switch:empty ~ label
		{
			position: relative;
			float: left;
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
								<p>View details of a specific member.</p>
							</div>
							<div class="page-title">
								<h2>Profile</h2>
							</div>
							<div class="text-section-black">
								<p>Public Profile</p>
								<p>&nbsp;</p>
								<p><image src="../Design_Site/images/Profile/<?php echo $row_member["Member_Profile"]; ?>" style="width:100px;height:100px;"/></p>
								<p>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row_member["Member_ID"]; ?></span></p>
								<p>&nbsp;</p>
								<p>Name&nbsp;&nbsp;: <span id="details"><?php echo $row_member["Member_Name"]; ?></span></p>
								<p>&nbsp;</p>
								<p>Email&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row_member["Member_Email"]; ?></span></p>
								<p>&nbsp;</p>
								<p>Mobile&nbsp;: <span id="details"><?php echo $row_member["Member_Mobile"]; ?></span></p>
								<p>&nbsp;</p>
								<p>Profit&nbsp;&nbsp;&nbsp;: <span id="details">RM <?php echo $row_member["Member_Profit"]; ?></span></p>
								<p>&nbsp;</p>
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