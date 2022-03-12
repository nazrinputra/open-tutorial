<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="shortcut icon" href="images/icon.png">
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
	<script>	
	function hidedownload_1()
		{
			document.getElementById("downloadlink_1").innerHTML = "waiting..";
		}
	function hidedownload_2()
		{
			document.getElementById("downloadlink_2").innerHTML = "waiting..";
		}
	function hidedownload_3()
		{
			document.getElementById("downloadlink_3").innerHTML = "waiting..";
		}
	function hidedownload_4()
		{
			document.getElementById("downloadlink_4").innerHTML = "waiting..";
		}
	function hidedownload_5()
		{
			document.getElementById("downloadlink_5").innerHTML = "waiting..";
		}
	function hidedownload_6()
		{
			document.getElementById("downloadlink_6").innerHTML = "waiting..";
		}
	function hidedownload_7()
		{
			document.getElementById("downloadlink_7").innerHTML = "waiting..";
		}
	function hidedownload_8()
		{
			document.getElementById("downloadlink_8").innerHTML = "waiting..";
		}
	function hidedownload_9()
		{
			document.getElementById("downloadlink_9").innerHTML = "waiting..";
		}
	function hidedownload_10()
		{
			document.getElementById("downloadlink_10").innerHTML = "waiting..";
		}
	</script>
</head>
<body>
<img src="images/left-top.png" style="margin-left:200px;margin-top:25px;"/>
<img src="images/right-top.png" style="margin-left:180px;margin-top:25px;"/>
<div id="wrapper">
    <div id="content">
		
        <nav>
            <ul id="appleNav">
                <li><a href="index.php" title="Home"><img src="images/logo.png" alt="Home" style="width:30px;height:30px;" /></a></li>
                <li><a href="dashboard.php" title="Dashboard">Dashboard</a></li>
                <li><a href="profile.php" title="Profile">Profile</a></li>
                <li><a href="tutorial.php" title="Tutorials">Tutorials</a></li>
                <li><a href="cart.php" title="Cart">Cart</a></li>
                <li><a href="history.php" title="History">History</a></li>
                <?php
					if (isset($_SESSION['login']) && $_SESSION['login'] != '')
					{
					?>
					<li><a href="#" data-reveal-id="myModal"  data-animation="fadeAndPop" data-animationspeed="300" data-closeonbackgroundclick="true" data-dismissmodalclass="close-reveal-modal" title="Announcement">Announcement</a></li>
					<?php
					}
					else
					{
					?>
					<li><a a href="register.php" title="Register">Register</a></li>
					<?php
					}
				?>
				<li><a href="logout.php" title="Logout">Logout</a></li>
                <li>
                    <form name="search_frm" method="post" action="search.php?go">
                        <input type="text" name="search" placeholder="Search" />
                    </form>
                </li>
            </ul>
        </nav>
        
        <div id="main">
     
        <div id="home"></div>
        <div class="content_box_top"></div>
    <div class="content_box">
			<!-- EDIT HERE -->
            <h2>Checkout</h2>
            <em>Please click on all download links before clicking done.</em>
<div class="cleaner h30"></div>

		 <div class="result">
			<?php
			$tids=$_GET["tids"];
			$result_tutorial=mysql_query("SELECT * FROM tutorial WHERE Tutorial_ID IN ({$tids})");
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
						<th>Download</th>
					</tr>
					</thead>
					<tbody>
					<?php
					$x=1;
					while($row_tutorial=mysql_fetch_assoc($result_tutorial))
						{
							?>
							<tr>
								<td>
									<a href="tutorial_details.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>"><?php echo $row_tutorial["Tutorial_Title"]; ?></a>
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
									<?php
										if($row_tutorial["Tutorial_Price"]==0)
										{echo "Free";}
										else
										{echo "RM ".$row_tutorial["Tutorial_Price"];}
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
									<a id="downloadlink_<?php echo $x; ?>" href="download.php?tid=<?php echo $row_tutorial["Tutorial_ID"] ?>&bid=<?php echo $sess_id ?>&mid=<?php echo $sess_id ?>">
										<img src="images/download.png" width="30px" height="30px;" onclick="hidedownload_<?php echo $x; ?>();"/>
									</a>
								</td>
							</tr>
							<?php
							$x++;
						}
					?>
					</tbody>
				</table>
			<?php
			}
			$tids=0;
			?>
			</div>
			
			<div class="checkout">
			<br>
			<p><a href="index.php"><input type="button" name="done" value="Done"/></a></p>
			</div>

            <div class="cleaner h30"></div>
            <a href="#top" class="gototop">Go to Top</a>
            <div class="cleaner"></div>

        </div> <!-- end of a content box -->
        <div class="content_box_bottom"></div>
		<!--ANNOUNCEMENT-->
	<div id="myModal" class="reveal-modal">
		<h1>Admin Announcement</h1>
			<?php
				$announcement=mysql_query("select * from announcement where isDelete=0");
				if(mysql_num_rows($announcement))
				{
					while($row_announcement=mysql_fetch_assoc($announcement))
					{
						$title=$row_announcement["Announcement_Title"];
						$content=$row_announcement["Announcement_Content"];
						$author=$row_announcement["Admin_ID"];
						$result_author=mysql_query("select * from admin where Admin_ID=$author");
						$row_author=mysql_fetch_assoc($result_author);
						$author_name=$row_author["Admin_Name"];
						$author_pic=$row_author["Admin_Picture"];
						?>
						<br><br>
						<div style="background:#8FD8D8;padding:20px;">
							<em>Announcement from <u><?php echo $author_name ?></u></em>
							<br/><br/>
							<img src="../Admin_Site/images/<?php echo $author_pic; ?>" style="float:right;margin-right:40px;margin-top:-40px; width:100px;height:100px;"/>
							<h5><?php echo $title ?></h5>
							<p><b><?php echo $content ?></b></p>
						</div>
						<br><br>
						<?php
					}
				}
			?>
		<a class="close-reveal-modal">&#215;</a>
	</div>
<!--ANNOUNCEMENT-->
		</div> <!-- end of main -->
    </div> <!-- end of content -->
    <div id="footer">
			<div class="bottomNav"> 
					<ul class="bottomnavControls">
				   <li style="padding-bottom:5px;"><b>Member</b></li>
				   <li><a href="follow.php"  class="footer">Following</a></li>
				   <li><a href="profile.php"  class="footer">My Profile</a></li>
				   <li><a href="update_profile.php"  class="footer">Edit Profile</a></li>
					</ul>    

					<ul class="bottomnavControls">
				   <li style="padding-bottom:5px;"><b>Tutorial</b></li>
				   <li><a href="tutorial.php"  class="footer">All Tutorials</a></li>
				   <li><a href="my_tutorial.php"  class="footer">My Tutorial</a></li>
				   <li><a href="upload_tutorial.php"  class="footer">Upload Tutorial</a></li>
					</ul>

				   <ul class="bottomnavControls">
					 <li style="padding-bottom:5px;"><b>Links</b></li>
					 <li><a href="cart.php" class="footer">Shopping Cart</a></li>
					 <li><a href="credit_purchase.php" class="footer">Credit Purchase</a></li>
					 <li><a href="history.php" class="footer">Transaction History</a></li>
				   </ul>
		
			</div>
			<p>&nbsp;</p>
			<a href="../Admin_Site/login.php" style="color:white;">Admin Login</a>
			<p></p>
			Copyright &copy; 2048
		</div>
</div> <!-- end of wrapper -->

</body>
</html>
<?php
	unset($_SESSION['cart']);
?>