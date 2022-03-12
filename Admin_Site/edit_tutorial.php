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
	<style>
		input.switch:empty
		{
			display:none;
		}

		input.switch:empty ~ label
		{
			position: relative;
			text-align:center;
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
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script>
		$(function() {
		   $( "#edit_tutorial" ).validate({
				messages:{
					
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
								<p>Edit tutorial details if necessary.</p>
							</div>
							<div class="page-title">
								<h2>Edit Tutorial</h2>
							</div>
							<div class="text-section-black">
								<form name="edit_tutorial" id="edit_tutorial" method="post" action="">
									<p></br></p>
									<p>Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="title" value="<?php echo $row_tutorial["Tutorial_Title"]; ?>" size="50"/></p>
									<p>Subject&nbsp;&nbsp;&nbsp;: <select name="subject" id="subject" class="required">
											<option value="" selected>Please select subject..</option>
											<?php
												$result_subject=mysql_query("select * from subject where isDelete=0");
												while($row_subject=mysql_fetch_assoc($result_subject))
												{
												$subject=$row_tutorial["Subject_ID"];
												?>
													<option <?php if ($row_subject["Subject_ID"] == $subject) echo ' selected="selected"'; ?> value="<?php echo $row_subject["Subject_ID"]; ?>"><?php echo $row_subject["Subject_Name"]; ?></option>
												<?php
												}
											?>
										</select>
									</p>
									<p>Category&nbsp;: <select name="category" id="category" class="required">
											<option value="" selected>Please select category..</option>
											<?php
												$result_category=mysql_query("select * from category where isDelete=0");
												while($row_category=mysql_fetch_assoc($result_category))
												{
												$category=$row_tutorial["Category_ID"];
												?>
													<option <?php if ($row_category["Category_ID"] == $category) echo ' selected="selected"'; ?> value="<?php echo $row_category["Category_ID"]; ?>"><?php echo $row_category["Category_Name"]; ?></option>
												<?php
												}
											?>
										</select>
									</p>
									<p>Material&nbsp;&nbsp;: <select name="material" id="material" class="required">
											<option value="" selected>Please select material..</option>
											<?php
												$result_material=mysql_query("select * from material where isDelete=0");
												while($row_material=mysql_fetch_assoc($result_material))
												{
												$material=$row_tutorial["Material_ID"];
												?>
													<option <?php if ($row_material["Material_ID"] == $material) echo ' selected="selected"'; ?> value="<?php echo $row_material["Material_ID"]; ?>"><?php echo $row_material["Material_Name"]; ?></option>
												<?php
												}
											?>
										</select>
									</p>
									<p>Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: RM<input type="number" name="price" size="2" value="<?php echo $row_tutorial["Tutorial_Price"]; ?>"/></p>
									<p>Active&nbsp;&nbsp;&nbsp;&nbsp;: 	<input type="checkbox" id="active" name="active" class="switch" value="1" <?php if($row_tutorial["isActive"] == '1'){echo ' checked="checked"';} ?>/>
											<label for="active">&nbsp;</label>
									</p>
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
		$title=$_POST["title"];
		$subject=$_POST["subject"];
		$category=$_POST["category"];
		$material=$_POST["material"];
		if(isset($_POST["active"]))
		{$active = $_POST["active"];}
		else
		{$active= 0;}
		$price=$_POST["price"];

		mysql_query("update tutorial set Tutorial_Title='$title', Subject_ID='$subject', Category_ID='$category', Material_ID='$material', Tutorial_Price='$price', isActive='$active' where Tutorial_ID=$tid");
		header("Location: tutorial.php");
	}
?>