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
		$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
		$row_tutorial=mysql_fetch_assoc($result_tutorial);
	}
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
								<p>View details of a specific tutorial.</p>
							</div>
							<div class="page-title">
								<h2>View Tutorial</h2>
							</div>
							<div class="text-section-black">
										<p style="margin-left:50px;">Tutorial Details</p>
										<?php
											$material=$row_tutorial["Material_ID"];
											$result_material=mysql_query("select * from material where Material_ID='$material'");
											$row_material=mysql_fetch_assoc($result_material);
										?>
										<p style="margin-left:-70px;float:left;"><img src="images/<?php echo $row_material["Material_Icon"] ?>" style="width:120px;height:90px;"/></p>
										<p style="margin-left:50px;">Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row_tutorial["Tutorial_Title"] ?></span></p>
										<?php
											$subject=$row_tutorial["Subject_ID"];
											$result_subject=mysql_query("select * from subject where Subject_ID='$subject'");
											$row_subject=mysql_fetch_assoc($result_subject)
										?>
										<p style="margin-left:50px;">Subject&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row_subject["Subject_Name"] ?></span></p>
										<?php
											$category=$row_tutorial["Category_ID"];
											$result_category=mysql_query("select * from category where Category_ID='$category'");
											$row_category=mysql_fetch_assoc($result_category);
										?>
										<p style="margin-left:50px;">Category&nbsp;: <span id="details"><?php echo $row_category["Category_Name"]; ?></span></p>
										<p style="margin-left:50px;">Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="details">RM <?php echo $row_tutorial["Tutorial_Price"]; ?></span></p>
										<p style="margin-left:50px;">Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="details"><?php $active=$row_tutorial["isActive"];if($active==1){echo "Yes";}else{echo "No";} ?></span></p>
										<?php
										if($row_tutorial["isDelete"]==1)
										{
										?>
										<p style="margin-left:50px;">Banned&nbsp;&nbsp;&nbsp;: <span id="details">Yes</span></p>
										<p style="margin-left:50px;">Reason&nbsp;&nbsp;&nbsp;: <span id="details"><?php echo $row_tutorial["Tutorial_Bar"]; ?></span></p>
										<?php
										}
										?>
										<p style="margin-left:50px;"><a href="edit_tutorial.php?tid=<?php echo $tid; ?>"><input type="button" value="Edit" name="editbtn"/></a></p>
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