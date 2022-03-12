<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['loginadmin']) && $_SESSION['loginadmin'] != '')) {

	header ("Location: login.php");

	}
	$sess_id=$_SESSION["loginadmin"];
	$result=mysql_query("select * from ADMIN where Admin_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_GET['go']))
	{
		$keyword=$_POST['search'];
		if(isset($_POST["searchbtn"]))
		{
			$search=$_POST["search"];
			if(isset($_POST['keyword']))
			{$keyword=$_POST["keyword"];}
			switch($search)
			{
				case "Title":
					$query="select * from tutorial where Tutorial_Title like '%$keyword%'";
					break;
				case "Subject":
					$query="select * from tutorial inner join subject on subject.Subject_ID=tutorial.Subject_ID where subject.Subject_Name like '%$keyword%'";
					break;
				case "Category":
					$query="select * from tutorial inner join category on category.Category_ID=tutorial.Category_ID where category.Category_Name like '%$keyword%'";
					break;
				case "Material":
					$query="select * from tutorial inner join material on material.Material_ID=tutorial.Material_ID where material.Material_Name like '%$keyword%'";
					break;
				case "Active":
					$query="select * from tutorial where isActive=1";
					break;
			}
		}
		else
		{
			$query="select * from tutorial where Tutorial_Title like '%$keyword%' or Tutorial_Type like '%$keyword%' or Tutorial_Price like '%$keyword%'";
		}
		
		$result_tutorial=mysql_query($query);
	}
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
							<form name="search" method="post" action="">
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
							<?php
							if(mysql_num_rows($result_tutorial))
							{
							?>
								<table id="tutorial">
									<thead>
									<tr>
										<th>Title</th>
										<th>Subject</th>
										<th>Category</th>
										<th>Uploader</th>
										<th>Material</th>
										<th>Price</th>
										<th>Rating</th>
										<th>Active</th>
										<th>View</th>
									</tr>
									</thead>
									<tbody>
									<?php
									while($row_tutorial=mysql_fetch_assoc($result_tutorial))
										{
											?>
											<tr>
												<td>
													<a href="tutorial_details.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
														<?php
															echo $row_tutorial["Tutorial_Title"];
														?>
													</a>
												</td>
												<td>
													<?php
														$subject=$row_tutorial["Subject_ID"];
														$result_subject=mysql_query("select * from subject where Subject_ID='$subject'");
														$row_subject=mysql_fetch_assoc($result_subject);
														echo $row_subject["Subject_Name"];
													?>
												</td>
												<td>
													<?php
														$category=$row_tutorial["Category_ID"];
														$result_category=mysql_query("select * from category where Category_ID='$category'");
														$row_category=mysql_fetch_assoc($result_category);
														echo $row_category["Category_Name"];
													?>
												</td>
												<td>
													<?php
														$member=$row_tutorial["Member_ID"];
														$result_member=mysql_query("select * from member where Member_ID=$member");
														$row_member=mysql_fetch_assoc($result_member);
														echo $row_member["Member_Username"];
													?>
												</td>
												<td>
													<?php
														$material=$row_tutorial["Material_ID"];
														$result_material=mysql_query("select * from material where Material_ID='$material'");
														$row_material=mysql_fetch_assoc($result_material);
														echo $row_material["Material_Name"];
													?>
												</td>
												<td>
													RM <?php
														echo $row_tutorial["Tutorial_Price"];
													?>
												</td>
												<td>
													<?php
														$tid=$row_tutorial["Tutorial_ID"];
														$result_rating=mysql_query("select * from tutorial_rating where Tutorial_ID='$tid'");
														$row_rating=mysql_fetch_assoc($result_rating);
														echo $row_rating["Tutorial_Rating_Average"];
													?>
												</td>
												<td>
													<?php
														$active=$row_tutorial["isActive"];
														if($active==1)
															{echo "Yes";}
														else
															{echo "No";}
													?>
												</td>
												<td>
													<a href="tutorial_details.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
														<img src="images/view.png" width="30px" height="30px;"/>
													</a>
												</td>
											</tr>
											<?php
										}
									?>
									</tbody>
								</table>
							</div>
							<?php
							}
							else
							{
							?>
							</div>
							<ul class="states">
								<li class="error">Error : No results found.</li>
							</ul>
							<?php
							}
							?>
							
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