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
	<script type="text/javascript">
		function disableSearch()
		{
			document.getElementById('searchbox').innerHTML="<input type='text' name='keyword' placeholder='Enter a keyword to search database..' style='width:400px;height:20px;' disabled/>";
		}
		function enableSearch()
		{
			document.getElementById('searchbox').innerHTML="<input type='text' name='keyword' placeholder='Enter a keyword to search database..' style='width:400px;height:20px;'/>";
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
							<li class="selected"><a href="search.php" class="ico4">Search <!--<span class="num">0</span>--></a></li>
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
								<p>Search tutorials in the database.</p>
							</div>
							<div class="page-title">
								<h2>Search</h2>
							</div>
							<div class="text-section-black">
							<form name="search" method="post" action="search_result.php?go">
								<p id="searchbox">
									<input type="text" name="keyword" placeholder="Enter a keyword to search database.." style="width:400px;height:20px;"/><br/>
								</p>
								<p>
									<input type="radio" name="search" value="Title" checked="checked" onclick="enableSearch();">Title
									<input type="radio" name="search" value="Subject" onclick="enableSearch();">Subject
									<input type="radio" name="search" value="Category" onclick="enableSearch();">Category
									<input type="radio" name="search" value="Material" onclick="enableSearch();">Material
									<input type="radio" name="search" value="Active" onclick="disableSearch();">Active<br/>
								</p>
								<p>
									<input type="submit" name="searchbtn" value="Search"/>
								</p>
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