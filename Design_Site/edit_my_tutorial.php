<?php
	ob_start();
	include ("dataconn.php");
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
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
                <li><a href="register.php" title="Register">Register</a></li>
				<li><a a href="javascript:void(0);" onClick="vpb_show_login_box();" title="Login">Login</a></li>
                <li>
                    <form>
                        <input type="text" placeholder="Search" />
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
					<form name="upload" method="" action="">
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
						<p><a href="view_my_tutorial.php"><input type="button" value="Update" name="uploadbtn"/></a></p>
					</form>
					
					<div class="back_btn">
					<p><a href="my_tutorial.php"><input type="button" name="back" value="Back" style="float:left;"/></a></p>
					</div>
					
				</div>
			</div>
			
            <div class="cleaner h30"></div>
            <a href="#top" class="gototop">Go to Top</a>
            <div class="cleaner"></div>
			
<!--JQUERY LOGIN-->
				<div id="vpb_pop_up_background"></div>
				<div id="vpb_login_pop_up_box" class="vpb_signup_pop_up_box">
				<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">Member Login</div><br clear="all">
				<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">To exit this login box, click outside this box..</div><br clear="all"><br clear="all">
			<form id="loginfrm" action="" method="post">
				<div style="width:100px; padding-top:10px;margin-left:30px;" align="center">Your Username:</div>
				<div style="width:300px;margin-left:30px;" align="center"><input type="text" id="musername" name="musername" placeholder="Username" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

				<div style="width:100px; padding-top:10px;margin-left:30px;" align="center">Your Password:</div>
				<div style="width:300px;margin-left:30px;" align="center"><input type="password" id="mpass" name="mpass" placeholder="Password" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">

				<div style="width:100px; padding-top:10px;" align="center">&nbsp;</div>
				<div style="width:400px;" align="center">
				<input type="submit" name="loginbtn" id="loginbtn" class="vpb_general_button" value="Login"/>
				</div>
			</form>
				<br clear="all"><br clear="all">
				</div>
<!--JQUERY LOGIN-->	
			
        </div> <!-- end of a content box -->
        <div class="content_box_bottom"></div>
		</div> <!-- end of main -->
    </div> <!-- end of content -->
    <div id="footer">
        <a href="../Admin_Site/login.php">Admin Login</a>
		<p></p>
        Copyright &copy; 2048
	</div>
</div> <!-- end of wrapper -->
</body>
</html>
<?php
	//JQUERY LOGIN
	if(isset($_POST["loginbtn"]))
	{
		$user=$_POST["musername"];
		$pass=$_POST["mpass"];
		$login=mysql_query("select * from MEMBER where Member_Username='$user' and Member_Password='$pass'");
		$login_row=mysql_fetch_assoc($login);
		
		if(mysql_num_rows($login)==1)
		{
			$_SESSION['login']=$login_row["Member_ID"];
			header("Location: dashboard.php");
		}
	}
	//JQUERY LOGIN
?>