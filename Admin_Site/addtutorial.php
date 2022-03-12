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
							<li><a href="profile.php" class="ico1">Profile <span class="num">2</span></a></li>
							<li><a href="tutorial.php" class="ico2">Tutorials <span class="num">77</span></a></li>
							<li class="selected"><a href="addtutorial.php" class="ico3">Add Tutorials <!--<span class="num">!</span>--></a></li>
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
								<h2>Add Tutorial</h2>
							</div>
							<div class="text-section-black">
								<form name="upload" method="" action="">
									<p>Add New Tutorial</p>
									<p><input type="text" placeholder="tutorial source path" name="sourcepath" style="float:left"/>
										<input type="button" value="Browse..." name="browsebtn" style="float:left"/>
									</p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<p style="clear:both;">Level: <input type="text" name="level" placeholder="education level" size="13"style="margin-left:15px;"/></p>
									<p>Subject: <input type="text" name="subject" placeholder="tutorial subject" style=""/></p>
									<p>Title: <input type="text" name="title" placeholder="tutorial title" size="50" style="margin-left:18px;"/></p>
									<p>Type: <select name="type" style="margin-left:14px;">
												<option>Image</option>
												<option>Documents</option>
											</select>
									</p>
									<p>File: <input type="text" name="extension" placeholder="extension" size="10" style="margin-left:24px;"/></p>
									<p>Price: <input type="text" name="price" value="RM" style="margin-left:15px;"/></p>
									<p><a href="view_tutorial.php"><input type="button" value="Upload" name="uploadbtn"/></a></p>
								</form>
							</div>
							<ul class="states">
								<li class="warning">Warning : Previous upload are not complete.</li>
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
				<li>
					<a href="#tab-2" class="ico2"><span>Gallery</span><em></em></a>
					<span class="tooltip"><span>Gallery</span></span>
				</li>
				<li>
					<a href="#tab-3" class="ico3"><span>Pages</span><em></em></a>
					<span class="tooltip"><span>Pages</span></span>
				</li>
				<li>
					<a href="#tab-4" class="ico4"><span>Tools</span><em></em></a>
					<span class="tooltip"><span>Tools</span></span>
				</li>
				<li>
					<a href="#tab-5" class="ico5"><span>Archive</span><em></em></a>
					<span class="tooltip"><span>Archive</span></span>
				</li>
				<li>
					<a href="#tab-6" class="ico6">
						<span>Comments</span><em></em>
					</a>
					<span class="num">ERROR</span>
					<span class="tooltip"><span>Comments</span></span>
				</li>
				<li>
					<a href="#tab-7" class="ico7"><span>Connection</span><em></em></a>
					<span class="tooltip"><span>Connection</span></span>
				</li>
				<li>
					<a href="#tab-8" class="ico8"><span>Settings</span><em></em></a>
					<span class="tooltip"><span>Settings</span></span>
				</li>
			</ul>
		</aside>
	</div>
</body>
</html>