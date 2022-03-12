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
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables_themeroller.css"/>
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
			var answer=confirm("Do you want to bar this announcement?");
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
								<p>View announcements in the database.</p>
							</div>
							<div class="page-title">
								<h2>Announcement Table</h2>
							</div>
							<div class="database">
								
								<table class="display_table">
									<thead>
									<tr>
										<th>Announcement Title</th>
										<th>Announcement Content</th>
										<th>Announcement Author</th>
										<th>Active</th>
										<th>Bar</th>
									</tr>
									</thead>
									<tbody>
								<?php
									$result_announcement=mysql_query("select * from announcement");
									while($row_announcement=mysql_fetch_assoc($result_announcement))
									{
								?>
										<tr>
											<td><?php echo $row_announcement["Announcement_Title"];?></td>
											<td><?php echo $row_announcement["Announcement_Content"];?></td>
											<td><?php echo $row_announcement["Admin_ID"];?></td>
											<td><?php if($row_announcement["isDelete"]==1){echo 'No';}else{echo 'Yes';}?></td>
											<td>
											<?php
											if($row_announcement["isDelete"]==1)
											{
											?>
												<a href="announcement.php?a_id=<?php echo $row_announcement["Announcement_ID"]; ?>">
													<img src="images/delete.png" width="30px" height="30px;"/>
												</a>
											<?php
											}
											else
											{
											?>
												<a href="announcement.php?id=<?php echo $row_announcement["Announcement_ID"]; ?>" onclick="return confirmdelete();">
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
								<br><br><br>
								<a href="add_announcement.php"><input type="button" name="add_announce" id="add_announce" style="margin-left:400px;" value="Add Announcement"/></a>
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
	if(isset($_REQUEST["id"]))
	{
		$id=$_REQUEST["id"];
		mysql_query("update announcement set isDelete=1 where Announcement_ID = $id");
		header("Location: announcement.php");
	}
	
	if(isset($_REQUEST["a_id"]))
	{
		$a_id=$_REQUEST["a_id"];
		mysql_query("update announcement set isDelete=0 where Announcement_ID = $a_id");
		header("Location: announcement.php");
	}
?>