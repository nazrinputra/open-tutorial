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
			var answer=confirm("Do you want to bar this material?");
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
								<p>View materials in the database.</p>
							</div>
							<div class="page-title">
								<h2>Material Table</h2>
							</div>
							<div class="text-section-black">
								<table class="display_table">
									<tr>
										<th>Material ID</th>
										<th>Material Name</th>
										<th>Material Detail</th>
										<th>Material Icon</th>
										<th>Status</th>
										<th>Update</th>
										<th>Bar</th>
									</tr>
								<?php
									$result_mat=mysql_query("select * from material");
									while($row_mat=mysql_fetch_assoc($result_mat))
									{
								?>
									<tr>
										<td><?php echo $row_mat["Material_ID"];?></td>
										<td><?php echo $row_mat["Material_Name"];?></td>
										<td><?php echo $row_mat["Material_Detail"];?></td>
										<td><img class="image" src="images/<?php echo $row_mat["Material_Icon"]; ?>" alt="image description" width="50" height="30" /></td>
										<td><?php if($row_mat["isDelete"]==0){echo 'Active';}else{echo 'Barred';}?></td>
										<td>
											<a href="edit_material.php?mid=<?php echo $row_mat["Material_ID"]; ?>">
												<img src="images/update.png" width="30px" height="30px;"/>
											</a>
										</td>
										<td>
											<?php
											if($row_mat["isDelete"]==1)
											{
											?>
											<a href="material.php?a_mid=<?php echo $row_mat["Material_ID"]; ?>">
												<img src="images/delete.png" width="30px" height="30px;"/>
											</a>
											<?php
											}
											else
											{
											?>
											<a href="material.php?mid=<?php echo $row_mat["Material_ID"]; ?>" onclick="return confirmdelete();">
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
								</table>
								<br><br><br>
								<a href="add_material.php"><input type="button" name="add_mat" id="add_mat" style="margin-left:250px;" value="Add Material"/></a>
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
	if(isset($_REQUEST["mid"]))
	{
		$mid=$_REQUEST["mid"];
		mysql_query("update material set isDelete=1 where Material_ID = $mid");
		header("Location: material.php");
	}
	
	if(isset($_REQUEST["a_mid"]))
	{
		$a_mid=$_REQUEST["a_mid"];
		mysql_query("update material set isDelete=0 where Material_ID = $a_mid");
		header("Location: material.php");
	}
?>