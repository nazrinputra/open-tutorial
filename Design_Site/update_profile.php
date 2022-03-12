<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("location: index.php");
	}
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
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script>
		$(function() {
		   $( "#update" ).validate({
				   rules: {
						name: {
							required: true,
						},
						email: {
							required: true,
							email: true,
						},
						mobile: {
							required: true,
						}
				   },
				   messages: {
						name: {
							required: "Please type your name",
						},
						email: {
							required: "Please type your email",
						},
						mobile: {
							required: "Please type your mobile number",
						}
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
            <h2>Update Profile</h2>
			
            <form name="update" method="post" id="update" enctype="multipart/form-data">
			<div id="profile_details">
				<p>
					<img src="images/Profile/<?php echo $row["Member_Profile"];?>" style="width:150px;height:200px; float:left; padding-right:15px;"/>
					<div class="edit_detail">
						<p>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="name" size="50" value="<?php echo $row["Member_Name"]; ?>"/></p>
						<p>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: <input type="email" name="email" size="25" value="<?php echo $row["Member_Email"]; ?>"/></p>
						<p>Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="mobile" size="12" value="<?php echo $row["Member_Mobile"]; ?>" /></p>
						<p>Profile Picture &nbsp;:<input type="file" name="profile" id="profile"></p>
					</div>

			</div>
				<p><input type="submit" name="savebtn" id="savebtn" value="Save Info" class="style_btn" style="margin-left:10px;"></p>
            </form>
            
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p><a href="#top" class="gototop">Go to Top</a></p>
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
	//savebtn
	if(isset($_POST["savebtn"]))
	{
		$uname=$_POST["name"];
		$uemail=$_POST["email"];
		$umobile=$_POST["mobile"];
		
		$tmpName  = $_FILES['profile']['tmp_name'];
		$info = pathinfo($_FILES['profile']['name']);
		$location = "images/Profile/" . $sess_id .".". $info['extension'];
		
		if ($_FILES["profile"]["error"] > 0) 
		{echo "Return Code: " . $_FILES["profile"]["error"] . "<br>";}
		else 
		{$profile = $sess_id .".". $info['extension'];}
		move_uploaded_file($_FILES["profile"]["tmp_name"],$location);
		
		if(isset($profile))
		{mysql_query("update member set Member_Profile='$profile' where Member_ID=$sess_id") or die(mysql_error());}
		mysql_query("update member set Member_Name='$uname', Member_Email='$uemail', Member_Mobile='$umobile' where Member_ID=$sess_id") or die(mysql_error());
		
		header("refresh:0.5;url=profile.php");
	}
	//savebtn
?>