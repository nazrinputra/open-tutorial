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
			var answer=confirm("Do you want to bar this subject?");
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
								<p>View subjects in the database.</p>
							</div>
							<div class="page-title">
								<h2>Subject Table</h2>
							</div>
							<div class="text-section-black">
								
								<table>
									<tr class="display_table">
										<th>Subject ID</th>
										<th>Subject Name</th>
										<th>Subject Course</th>
										<th>Subject Description</th>
										<th>Status</th>
										<th>Update</th>
										<th>Bar</th>
									</tr>
								<?php
									$result_subject=mysql_query("select * from subject");
									while($row_subject=mysql_fetch_assoc($result_subject))
									{
								?>
									<tr>
										<td><?php echo $row_subject["Subject_ID"];?></td>
										<td><?php echo $row_subject["Subject_Name"];?></td>
										<td><?php echo $row_subject["Subject_Course"];?></td>
										<td><?php echo $row_subject["Subject_Desc"];?></td>
										<td><?php if($row_subject["isDelete"]==0){echo 'Active';}else{echo 'Barred';}?></td>
										<td>
											<a href="edit_subject.php?sid=<?php echo $row_subject["Subject_ID"]; ?>">
												<img src="images/update.png" width="30px" height="30px;"/>
											</a>
										</td>
										<?php
										if($row_subject["isDelete"]==1)
										{
										?>
										<td>
											<a href="subject.php?a_sid=<?php echo $row_subject["Subject_ID"]; ?>">
												<img src="images/delete.png" width="30px" height="30px;"/>
											</a>
										</td>
										<?php
										}
										else
										{
										?>
										<td>
											<a href="subject.php?sid=<?php echo $row_subject["Subject_ID"]; ?>">
												<img src="images/add.png" width="30px" height="30px;" onclick="return confirmdelete();"/>
											</a>
										</td>
										<?php
										}
										?>
									</tr>
								<?php
									}
								?>
								</table>
								<br><br><br>
								<a href="add_subject.php"><input type="button" name="add_sub" id="add_sub" style="margin-left:370px;" value="Add Subject"/></a>
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
	if(isset($_REQUEST["sid"]))
	{
		$sid=$_REQUEST["sid"];
		mysql_query("update subject set isDelete=1 where Subject_ID = $sid");
		header("Location: subject.php");
	}
	
	if(isset($_REQUEST["a_sid"]))
	{
		$a_sid=$_REQUEST["a_sid"];
		mysql_query("update subject set isDelete=0 where Subject_ID = $a_sid");
		header("Location: subject.php");
	}
?>