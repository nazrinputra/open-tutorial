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
							<li><a href="profile.php" class="ico1">Profile <!--<span class="num">2</span>--></a></li>
							<li><a href="tutorial.php" class="ico2">Tutorials <!--<span class="num">77</span>--></a></li>
							<li><a href="add_announcement.php" class="ico3">Add Announcement <!--<span class="num">!</span>--></a></li>
							<li><a href="search.php" class="ico4">Search <!--<span class="num">0</span>--></a></li>
							<li><a href="history.php" class="ico5">History <!--<span class="num">0</span>--></a></li>
							<li><a href="viewtables.php" class="ico6">View Database</a></li>
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
								<p>This system is designed for administrator only</p>
							</div>
							<div class="page-title">
								<h2>Index Page</h2>
							</div>
							<div class="text-section-black">
								<table id="dashboard">
									<tr id="dashboard">
										<th id="dashboard">
											<a href="profile.php"><img src="images/profile_dashboard.png" width="100px" height="100px;"/></br>Profile</a>
										</th>
										<th id="dashboard">
											<a href="tutorial.php"><img src="images/tutorial_dashboard.png" width="100px" height="100px;"/></br>Tutorial</a>
										</th>
										<th id="dashboard">
											<a href="search.php"><img src="images/search_dashboard.png" width="100px" height="100px;"/></br>Search</a>
										</th>
										<th id="dashboard">
											<a href="history.php"><img src="images/history_dashboard.png" width="100px" height="100px;"/></br>History</a>
										</th>
										<?php if ($row["Admin_Level"] == 'Master') echo ' <th id="dashboard">
											<a href="add_admin.php"><img src="images/newadmin_dashboard.png" width="100px" height="100px;"/></br>New Admin</a>
										</th>'; ?>
										
									</tr>
								</table>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
		<aside id="sidebar">
			<strong class="logo"><a href="index_logged.php">ot</a></strong>
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