<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_REQUEST["sid"]))
	{
		$sid=$_REQUEST["sid"];
		$result_sub=mysql_query("select * from subject where Subject_ID = $sid");
		$row_sub=mysql_fetch_assoc($result_sub);
	}
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
		   $( "#catfrm" ).validate({
					rules:
					{
						subname: {required: true},
						course: {required: true},
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
								<p>Edit subject details if necessary.</p>
							</div>
							<div class="page-title">
								<h2>Update Subject</h2>
							</div>
							<div class="text-section-black">
								<form method="post" name="catfrm" id="catfrm">
										<p>Subject Details</p>
										<p>&nbsp;</p>
										<p>Subject Name &nbsp;: <input type="text" name="subname" id="subname" value="<?php echo $row_sub["Subject_Name"]; ?>" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Subject Course : <input type="text" name="course" id="course" value="<?php echo $row_sub["Subject_Course"]; ?>" size="50" style=""/></p>
										<p>&nbsp;</p>
										<p>Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="desc" id="desc" value="<?php echo $row_sub["Subject_Desc"]; ?>" size="50" style=""/></p>
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
		$name=$_POST["subname"];
		$course=$_POST["course"];
		$desc=$_POST["desc"];
		
		mysql_query("update subject set Subject_Name='$name', Subject_Desc='$desc', Subject_Course='$course' where Subject_ID=$sid") or die(mysql_error());
		header("location: subject.php");
	}
?>
?>