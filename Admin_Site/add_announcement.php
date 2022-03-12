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
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<style>
		input.switch:empty
		{
			display:none;
			padding-left:200px;
		}

		input.switch:empty ~ label
		{
			position: relative;
			float: left;
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
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script>
		$(function() {
		   $( "#announcementfrm" ).validate({
				rules:{
					title:{
						required:true,
					},
					content:{
						required:true,
					}
				},
				messages:{
					title:{
						required:"Please enter a title",
					},
					content:{
						required:"Content cannot be empty",
					}
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
							<li class="selected"><a href="add_announcement.php" class="ico3">Add Announcement <!--<span class="num">!</span>--></a></li>
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
								<p>Add announcement to the database.</p>
							</div>
							<div class="page-title">
								<h2>Add Announcement</h2>
							</div>
							<div class="text-section-black">
								<form method="post" name="announcementfrm" id="announcementfrm" action="">
									<p>Title:<br><input type="text" name="title" id="title" style="width:50em;" class="required"/></p>
									<p>Message:<br><textarea name="content" id="content" style="width:44em;height:20em;float:none;" class="required"></textarea></p>
									<p><input type="submit" name="add" value="Add Announcement"/></p>
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
	if(isset($_POST["add"]))
	{
		$title=$_POST["title"];
		$content=$_POST["content"];
		$query="insert into announcement (Announcement_Title,Announcement_Content,Admin_ID,isDelete) values ('$title','$content',$sess_id,0)";
		mysql_query($query) or die("SQL ERROR". mysql_error());
		?>
			<script type="text/javascript">
				$(document).ready(function(){
				new Messi('Announcement Posted', {title: 'Successful', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
				});
			</script>
		<?php
		header("Location: announcement.php");
	}
?>