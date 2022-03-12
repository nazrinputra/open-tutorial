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
							<li class="selected"><a href="message.php" class="ico7">Messages</a></li>
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
								<p>Contains messages related to tutorial and profit claiming. Click done button once required action has been taken.</p>
							</div>
							<div class="page-title">
								<h2>Messages for Admin</h2>
							</div>
							<div class="text-section-black">
								<div style="padding-left:20px;border-spacing:100px;margin-left:-30px;border:5px outset cyan;width:830px;">
								<h3>Tutorial Related</h3>
									<?php
											$result_message=mysql_query("select * from message where Message_Title not like 'Profit Claim'");
											while($row_message=mysql_fetch_assoc($result_message))
											{
												$title=$row_message["Message_Title"];
												$content=$row_message["Message_Text"];
												$author=$row_message["Member_ID"];
												$result_author=mysql_query("select * from member where Member_ID=$author");
												$row_author=mysql_fetch_assoc($result_author);
												$author_name=$row_author["Member_Username"];
												$author_pic=$row_author["Member_Profile"];
									?>
										<div class="dashboard_item">
											<em>Message from <u><?php echo $author_name ?></u></em>
											<br/><br/>
											<img src="../Design_Site/images/Profile/<?php echo $author_pic; ?>" style="float:right;margin-top:-30px; width:100px;height:100px;"/>
											<h3><?php echo $title ?></h3>
											<p><b><?php echo $content ?></b></p>
											<p>Status: <?php $status=$row_message["isDelete"];if($status==1){ ?><img src="images/add.png" style="vertical-align:-30%" width="20px" height="20px;"/><?php } else { ?> <img src="images/delete.png" style="vertical-align:-50%" width="20px" height="20px;"/> <?php } ?></p>
											<?php
											if($status==0)
											{
											?>
											<p><a href="message.php?id=<?php echo $row_message["Message_ID"]; ?>"><input type="button" name="done" value="Done"/></a></p>
											<?php
											}
											else
											{
											?>
											<p><a href="message.php?a_id=<?php echo $row_message["Message_ID"]; ?>"><input type="button" name="undone" value="Undo"/></a></p>
											<?php
											}
											?>
										</div>
										<p>&nbsp;</p>
									<?php
											}
									?>
								</div>
								<p><br><br><br></p><p><br><br><br></p>
								<div style="padding-left:20px;border-spacing:100px;margin-left:-30px;border:5px outset cyan;width:830px;">
								<h3>Profit Related</h3>
									<?php
											$result_message=mysql_query("select * from message where Message_Title like 'Profit Claim'");
											while($row_message=mysql_fetch_assoc($result_message))
											{
												$title=$row_message["Message_Title"];
												$content=$row_message["Message_Text"];
												$author=$row_message["Member_ID"];
												$result_author=mysql_query("select * from member where Member_ID=$author");
												$row_author=mysql_fetch_assoc($result_author);
												$author_name=$row_author["Member_Username"];
												$author_pic=$row_author["Member_Profile"];
									?>
										<div class="dashboard_item">
											<em>Message from <u><?php echo $author_name ?></u></em>
											<br/><br/>
											<img src="../Design_Site/images/Profile/<?php echo $author_pic; ?>" style="float:right;margin-top:-30px; width:100px;height:100px;"/>
											<h3><?php echo $title ?></h3>
											<p><b><?php echo $content ?></b></p>
											<p>Status: <?php $status=$row_message["isDelete"];if($status==1){ ?><img src="images/add.png" style="vertical-align:-30%" width="20px" height="20px;"/><?php } else { ?> <img src="images/delete.png" style="vertical-align:-50%" width="20px" height="20px;"/> <?php } ?></p>
											<?php
											if($status==0)
											{
											?>
											<p><a href="message.php?id=<?php echo $row_message["Message_ID"]; ?>"><input type="button" name="done" value="Done"/></a></p>
											<?php
											}
											else
											{
											?>
											<p><a href="message.php?a_id=<?php echo $row_message["Message_ID"]; ?>"><input type="button" name="undone" value="Undo"/></a></p>
											<?php
											}
											?>
										</div>
										<p>&nbsp;</p>
									<?php
											}
									?>
								</div>
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
		mysql_query("update message set isDelete=1 where Message_ID = $id");
		header("Location: message.php");
	}
	
	if(isset($_REQUEST["a_id"]))
	{
		$a_id=$_REQUEST["a_id"];
		mysql_query("update message set isDelete=0 where Message_ID = $a_id");
		header("Location: message.php");
	}
?>