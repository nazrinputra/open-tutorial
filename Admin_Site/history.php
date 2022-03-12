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
	<script language="javascript" type="text/javascript" src="js/external.js"></script>
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
							<li class="selected"><a href="history.php" class="ico5">History <!--<span class="num">0</span>--></a></li>
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
								<p>View transaction history of all members and print PDF reports.</p>
							</div>
							<div class="page-title">
								<h2>Member's History</h2>
							</div>
							<div class="text-section-black">
								<table>
									<tr>
										<th>Member Profile</th>
										<th>Member Name</th>
										<th>Member Username</th>
										<th>Member Email</th>
										<th>Member Mobile</th>
										<th>Member Credit</th>
										<th>History</th>
									</tr>
									<?php
									$history=mysql_query("select distinct Member_ID from buy");
									while($row_history=mysql_fetch_assoc($history))
									{
										$member=$row_history["Member_ID"];
										$result_member=mysql_query("select * from member where Member_ID=$member");
										$row_member=mysql_fetch_assoc($result_member);
										?>
										<tr>
											<td><img src="../Design_Site/images/Profile/<?php echo $row_member["Member_Profile"]; ?>" width="50px" height="50px;"/></td>
											<td><?php echo $row_member["Member_Name"]; ?></td>
											<td><?php echo $row_member["Member_Username"]; ?></td>
											<td><?php echo $row_member["Member_Email"]; ?></td>
											<td><?php echo $row_member["Member_Mobile"]; ?></td>
											<td>RM <?php echo $row_member["Member_Credit"]; ?></td>
											<td><a href="history.php?mid=<?php echo $member; ?>"><img src="images/view.png" width="30px" height="30px;"/></a></td>
										</tr>
										<?php
									}
									?>
								</table>
								<?php
								if(isset($_GET["mid"]))
								{
									$mid=$_GET["mid"];
									
									$buy=mysql_query("select * from buy where Member_ID=$mid");
									$tids = "";
									
									while($row_buy=mysql_fetch_assoc($buy)){
										$tid=$row_buy["Tutorial_ID"];
										$tids = $tids . $tid . ",";
									} 
									// remove the last comma
									$tids = rtrim($tids, ',');
									
									$result_tutorial=mysql_query("SELECT * FROM tutorial WHERE Tutorial_ID IN ({$tids})");
									$print="";
									if($result_tutorial!="")
									{
									?>
									<div style="margin-left:70px;margin-top:50px;">
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
															<a href="view_tutorial.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>"><?php echo $row_tutorial["Tutorial_Title"];$print=$print.$row_tutorial["Tutorial_Title"].";"; ?></a>
														</td>
														<td>
															<?php
																$subject=$row_tutorial["Subject_ID"];
																$result_subject=mysql_query("select * from subject where Subject_ID='$subject'");
																$row_subject=mysql_fetch_assoc($result_subject);
																echo $row_subject["Subject_Name"];
																$print=$print.$row_subject["Subject_Name"].";";
															?>
														</td>
														<td>
															<?php
																$category=$row_tutorial["Category_ID"];
																$result_category=mysql_query("select * from category where Category_ID='$category'");
																$row_category=mysql_fetch_assoc($result_category);
																echo $row_category["Category_Name"];
																//$print=$print.$row_category["Category_Name"].";";
															?>
														</td>
														<td>
															<?php
																$member=$row_tutorial["Member_ID"];
																$result_member=mysql_query("select * from member where Member_ID=$member");
																$row_member=mysql_fetch_assoc($result_member);
																echo $row_member["Member_Username"];
																//$print=$print.$row_member["Member_Username"].";";
															?>
														</td>
														<td>
															<?php
																$material=$row_tutorial["Material_ID"];
																$result_material=mysql_query("select * from material where Material_ID='$material'");
																$row_material=mysql_fetch_assoc($result_material);
																echo $row_material["Material_Name"];
																$print=$print.$row_material["Material_Name"].";";
															?>
														</td>
														<td>
															RM <?php
																echo $row_tutorial["Tutorial_Price"];
																$print=$print."RM ".$row_tutorial["Tutorial_Price"].PHP_EOL;
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
															<a href="view_tutorial.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
																<img src="images/view.png" width="30px" height="30px;"/>
															</a>
														</td>
													</tr>
													<?php
												}
											$file = 'report_member.txt';
											$data = $print;
											file_put_contents($file, $data);
											?>
											</tbody>
										</table>
									</div>
									<div style="margin-left:100px;">
										<br><br>
										<p><a href="pdf.php?mid=<?php echo $mid ?>" rel="external"><input type="button" name="pdf" style="margin-left:370px;" value="PDF Report"/></a></p>
									</div>
									<?php
									}
									else
									{echo "No previous purchase";}
								}
								?>
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