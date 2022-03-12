<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="shortcut icon" href="images/icon.png">
	<script type="text/javascript"/>
		function confirmdelete()
		{
			var ask;
			ask=confirm("Are you sure you want to delete this tutorial?");
			return ask;
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
							<li class="selected"><a href="tutorial.php" class="ico2">Tutorials <!--<span class="num">77</span>--></a></li>
							<li><a href="add_announcement.php" class="ico3">Add Announcement <!--<span class="num">!</span>--></a></li>
							<li><a href="search.php" class="ico4">Search <!--<span class="num">0</span>--></a></li>
							<li><a href="history.php" class="ico5">History <!--<span class="num">0</span>--></a></li>
							<li><a href="viewtables.php" class="ico6">View Database</a></li>
						</ul>
					</nav>
					<div class="profile-box">
						<span class="profile">
							<a href="profile.php" class="section">
								<img class="image" src="images/img1.png" alt="image description" width="26" height="26" />
								<span class="text-box">
									Welcome
									<strong class="name">Admin Name</strong>
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
								<h1>Dashboard</h1>
								<p>This is a quick overview of some features</p>
							</div>
							<div class="page-title">
								<h2>Tutorial</h2>
							</div>
							<div class="text-section-black">
								<table width="800px" style="text-align:center;">
									<tr>
										<th>Level</th>
										<th>Subject</th>
										<th>Title</th>
										<th>View</th>
										<th>Delete</th>
										<th>Edit</th>
									</tr>
									<tr>
										<td>Degree</td>
										<td>English</td>
										<td>Essay Writing</td>
										<td><a href="view_tutorial.php"><img src="images/view.png" width="20px" height="20px;"/></a></td>
										<td><a href="#"><img src="images/delete.png" width="20px" height="20px;" onclick="confirmdelete();"/></a></td>
										<td><a href="edit_tutorial.php"><img src="images/update.png" width="20px" height="20px;"/></a></td>
									</tr>
									<tr>
										<td>Diploma</td>
										<td>Mathematics</td>
										<td>Advanced Calculus 2</td>
										<td><a href="view_tutorial.php"><img src="images/view.png" width="20px" height="20px;"/></a></td>
										<td><a href="#"><img src="images/delete.png" width="20px" height="20px;" onclick="confirmdelete();"/></a></td>
										<td><a href="edit_tutorial.php"><img src="images/update.png" width="20px" height="20px;"/></a></td>
									</tr>
									<tr>
										<td>SPM</td>
										<td>Biology</td>
										<td>Paper 1(Objective)</td>
										<td><a href="view_tutorial.php"><img src="images/view.png" width="20px" height="20px;"/></a></td>
										<td><a href="#"><img src="images/delete.png" width="20px" height="20px;" onclick="confirmdelete();"/></a></td>
										<td><a href="edit_tutorial.php"><img src="images/update.png" width="20px" height="20px;"/></a></td>
									</tr>
									<tr>
										<td>PMR</td>
										<td>Geography</td>
										<td>Trial Question</td>
										<td><a href="view_tutorial.php"><img src="images/view.png" width="20px" height="20px;"/></a></td>
										<td><a href="#"><img src="images/delete.png" width="20px" height="20px;" onclick="confirmdelete();"/></a></td>
										<td><a href="edit_tutorial.php"><img src="images/update.png" width="20px" height="20px;"/></a></td>
									</tr>
									<tr>
										<td>UPSR</td>
										<td>Science</td>
										<td>Pre-UPSR Questions</td>
										<td><a href="view_tutorial.php"><img src="images/view.png" width="20px" height="20px;"/></a></td>
										<td><a href="#"><img src="images/delete.png" width="20px" height="20px;" onclick="confirmdelete();"/></a></td>
										<td><a href="edit_tutorial.php"><img src="images/update.png" width="20px" height="20px;"/></a></td>
									</tr>
								</table>
								<p><a href="profile.php" style="margin-left:325px;"><input type="button" value="Back to My Profile" name="backbtn"/></a></p>
							</div>
							<ul class="states">
								<li class="success">Success : 77 new tutorials added.</li>
								<li class="warning">Warning : Some tutorials are missing.</li>
							</ul>
						</article>
					</div>
				</div>
			</div>
		</div>
		<aside id="sidebar">
			<strong class="logo"><a href="index_logged.php">ot</a></strong>
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