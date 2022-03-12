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
	<script>
		$(function() {
		   $( "#matfrm" ).validate({
					rules:
					{
						icon: {required: true},
						matname: {required: true},
						desc: {required: true},
					},
					messages:
					{
						
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
							<li><a href="profile.php" class="ico1">Profile <!--<span class="num">2</span>--></a></li>
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
								<p>Add material to the database.</p>
							</div>
							<div class="page-title">
								<h2>Add Material</h2>
							</div>
							<div class="text-section-black">
								<form method="post" name="matfrm" id="matfrm" enctype="multipart/form-data">
										<p>New Material Details</p>
										<p>&nbsp;</p>
										<p>Material Icon &nbsp;&nbsp;&nbsp;:<br/><input type="file" name="icon" id="icon"></p>
										<p>&nbsp;</p>
										<p>Material Name &nbsp;: <input type="text" name="matname" id="matname" placeholder="Name" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Material Details : <input type="text" name="desc" id="desc" placeholder="Description" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p><input type="submit" value="Save" name="savebtn"/></p>
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
		$name=$_POST["matname"];
		$detail=$_POST["desc"];
		
		$tmpName  = $_FILES['icon']['tmp_name'];
		$info = pathinfo($_FILES['icon']['name']);
		$location = "images/" . $sess_id .".". $info['extension'];
		
		if ($_FILES["icon"]["error"] > 0) 
		{echo "Return Code: " . $_FILES["icon"]["error"] . "<br>";}
		else 
		{$icon = $sess_id .".". $info['extension'];}
		move_uploaded_file($_FILES["icon"]["tmp_name"],$location);

		mysql_query("insert into material (Material_Name,Material_Detail,Material_Icon,isDelete) values ('$name','$detail','$icon',0)") or die(mysql_error());
		header("location: material.php");
	}
?>