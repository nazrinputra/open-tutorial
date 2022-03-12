<?php
	ob_start();
	include ("dataconn.php");
	
	if(isset($_GET["mid"]))
	{
		$mid=$_GET["mid"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
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
		   $( "#loginfrm" ).validate({
			   });
			});
	</script>
	<script>
		$(function() {
		   $( "#forgotfrm" ).validate({
					   rules: {
							   password: {
									   required: true,
									   minlength: 8,
							   },
					   },
					   messages: {
							   password: {
									   required: "Please enter your new password",
									   minlength: "Password must be at least 8 characters long",
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
				<li><a a href="javascript:void(0);" onClick="vpb_show_login_box();" title="Login">Login</a></li>
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
            <h2>Lost Password</h2>
            <section id="login">
				<form id="forgotfrm" action="" method="post">
					<h1>Set New Password</h1>
					<p>
						<input type="password" placeholder="New Password" name="password" id="password" />
					</p>
					<p>
						<input type="submit" value="Submit" name="sendbtn"/>
						<br/>
						<br/>
					</p>
					<div>
						&nbsp;
					</div>
				</form><!-- form -->
		
<!--JQUERY LOGIN-->
				<div id="vpb_pop_up_background"></div>
				<div id="vpb_login_pop_up_box" class="vpb_signup_pop_up_box">
				<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Member Login</div><br clear="all">
				<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">To exit this login box, click outside this box..</div><br clear="all"><br clear="all">
			<form id="loginfrm" action="" method="post">
				<div style="width:100px; padding-top:10px;margin-left:30px;" align="center">Your Username:</div>
				<div style="width:300px;margin-left:30px;" align="center"><input type="text" id="musername" name="musername" class="required" placeholder="Username" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

				<div style="width:100px; padding-top:10px;margin-left:30px;" align="center">Your Password:</div>
				<div style="width:300px;margin-left:30px;" align="center"><input type="password" id="mpass" name="mpass" class="required" placeholder="Password" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

				<div style="width:100px; padding-top:10px;" align="center">&nbsp;</div>
				<div style="width:400px;" align="center">
				<input type="submit" name="loginbtn" id="loginbtn" class="vpb_general_button" value="Login"/>
				</div>
			</form>
				<br clear="all"><br clear="all">
				</div>
<!--JQUERY LOGIN-->			
			
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
			
			</section><!-- content -->
  
            <div class="cleaner h30"></div>
            
            <div class="cleaner"></div>
    </div> <!-- end of a content box -->
        <div class="content_box_bottom"></div>
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
	if(isset($_POST["sendbtn"]))
	{
		if(isset($_POST["password"]))
		{
			$pass=$_POST["password"];
			$pass=md5($pass);
			mysql_query("update member set Member_Password='$pass' where Member_ID=$mid")or die(MYSQL_ERROR());
			
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('New password received', {title: 'Change Successful', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
			
			header("refresh: 0.5; URL= index.php");
		}	
	}
	
	//JQUERY LOGIN
	if(isset($_POST["loginbtn"]))
	{
		$user=$_POST["musername"];
		$pass=$_POST["mpass"];
		$pass=md5($pass);
		$login=mysql_query("select * from MEMBER where Member_Username='$user' and Member_Password='$pass' and isDelete=0");
		$login_row=mysql_fetch_assoc($login);
		
		if(mysql_num_rows($login)==1)
		{
			$_SESSION['login']=$login_row["Member_ID"];
			header("location: dashboard.php");
		}
		else
		{
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('Wrong username or password!', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		}
	}
	//JQUERY LOGIN
?>