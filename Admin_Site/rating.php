<?php include ("dataconn.php");
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
							<li><a href="profile.php" class="ico1">Profile <span class="num">2</span></a></li>
							<li><a href="tutorial.php" class="ico2">Tutorials <!--<span class="num">77</span>--></a></li>
							<li><a href="add_announcement.php" class="ico3">Add Announcement <span class="num">!</span></a></li>
							<li><a href="search.php" class="ico4">Search <!--<span class="num">0</span>--></a></li>
							<li><a href="history.php" class="ico5">History <!--<span class="num">0</span>--></a></li>
							<li class="selected"><a href="viewtables.php" class="ico6">View Database</a></li>
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
								<h1>Dashboard</h1>
								<p>This is a quick overview of some features</p>
							</div>
							<div class="page-title">
								<h2>Rating Table</h2>
							</div>
							<div class="database">
								
								<table>
									<tr class="display_table">
										<th>Rating ID</th>
										<th>Rating Level</th>
										<th>Rating Description</th>
										<th>View</th>
										<th>Update</th>
										<th>Delete</th>
									</tr>
								<?php
									$x=0;
									$result=mysql_query("select * from rating");
									while($row=mysql_fetch_assoc($result))
									{
								?>
									<tr>
										<td><?php echo $row["rating_id"];?></td>
										<td><?php echo $row["rating_level"];?></td>
										<td><?php echo $row["rating_desc"];?></td>
										<td><a href="#">View</a></td>
										<td><a href="#">Update</a></td>
										<td><a href="#">Delete</a></td>
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