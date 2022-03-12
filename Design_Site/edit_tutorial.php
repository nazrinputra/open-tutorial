<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_REQUEST["tid"]))
	{
		$tid=$_REQUEST["tid"];
		$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
		$row_tutorial=mysql_fetch_assoc($result_tutorial);
	}
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
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
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
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
				<li><a a href="logout.php" title="Logout">Logout</a></li>
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
            <h2>Update My Tutorial</h2>
            
			<div class="detail_item">
			
				<div class="element_item">				
					<form name="edit_tutorial" id="edit_tutorial" method="post" action="">
						<p>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" class="required" size="23" value="<?php echo $row_tutorial["Tutorial_Title"]; ?>"/></p>
						<p>Subject: &nbsp;&nbsp;<select name="subject" id="subject" class="required">
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
						<p>Category: <select name="category" id="category" class="required">
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
						<p>Material: &nbsp;&nbsp;<select name="material" id="material" class="required">
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
						<p>Price: RM 
							<input type="number" name="price" id="price" value="<?php echo $row_tutorial["Tutorial_Price"]; ?>" class="required"/>
						</p>
						<p>Active: 	&nbsp;&nbsp;&nbsp;<input type="checkbox" id="active" name="active" class="switch" value="1" <?php if($row_tutorial["isActive"] == '1'){echo ' checked="checked"';} ?>/>
								<label for="active">&nbsp;</label>
						</p>
						<p>
							<a href="my_tutorial.php"><input type="button" name="cancel"  style="float:left;" class="style_btn" value="Cancel"/></a>
							<input type="submit" value="Save"  style="margin-left:150px;;" class="style_btn" name="savebtn"/>
						</p>
					</form>					
				</div>
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
		header("location: tutorial.php");
	}
?>