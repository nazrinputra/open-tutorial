<?php
	ob_start();
	include ("dataconn.php");
	session_destroy();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<link rel="shortcut icon" href="images/icon.png">
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
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
				<?php
					if (!(isset($_SESSION['login']) && $_SESSION['login'] != ''))
					{
					?>
					<li><a a href="javascript:void(0);" onClick="vpb_show_login_box();" title="Login">Login</a></li>
					<li>
						<form name="search_frm" method="post" action="index.php?go">
							<input type="text" name="search" placeholder="Search"/>
						</form>
					</li>
					<?php
					}
					else
					{
					?>
					<li><a a href="logout.php" title="Logout">Logout</a></li>
					<li>
						<form name="search_frm" method="post" action="search.php?go">
							<input type="text" name="search" placeholder="Search" />
						</form>
					</li>
					<?php
					}
				?>
            </ul>
        </nav>
        
        <div id="main">
     
        <div id="home"></div>
        <div class="content_box_top"></div>
    <div class="content_box">
            <h2>Welcome to Open Tutorial</h2>
            <?php
			if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
			{
			?>
			<em style="color:red">Please login first before using our system or you will be redirected to the index page. If you do not have an account, please register first.</em>
			<br><br>
			<?php
			}
			?>
            <div class="image_wrapper image_fl"><span></span><img src="images/image_01.jpg" alt="Image" /></div>
			<p><br></p>
            <p><em>If you want to seek new knowledge, this is the place to be. If you want to share your knowledge, this is also the place to be. Everything you need for an innovative learning experience.</em></p>
            <p>View free tutorials, download and buy any tutorial you love, even upload yours for others! Share knowledge for free or at a price of your choice with us.</p>
<div class="cleaner h30"></div>
            <div>
			<h3>Top Free Tutorials</h3>
				<?php
					$result_free=mysql_query("select count(Buy_Item) as Count, Tutorial_ID from buy where Buy_Price=0 group by Buy_Item order by Count desc limit 5");
					while($row_free=mysql_fetch_assoc($result_free))
					{
						$tid=$row_free["Tutorial_ID"];
						$result_tut=mysql_query("select * from tutorial where Tutorial_ID=$tid");
						$row_tut=mysql_fetch_assoc($result_tut);
						$material=$row_tut["Material_ID"];
						$result_mat=mysql_query("Select * from material where Material_ID=$material");
						$row_mat=mysql_fetch_assoc($result_mat);
						$uploader=$row_tut["Member_ID"];
						$result_mem=mysql_query("select * from member where Member_ID=$uploader");
						$row_mem=mysql_fetch_assoc($result_mem);
						$result_rating=mysql_query("select * from tutorial_rating where Tutorial_ID=$tid");
						$row_rating=mysql_fetch_assoc($result_rating);
						$rating=$row_rating["Tutorial_Rating_Average"];
						$rating=round($rating);
						if($rating==1)
						{$icon="one_star.png";}
						if($rating==2)
						{$icon="two_star.png";}
						if($rating==3)
						{$icon="three_star.png";}
						if($rating==4)
						{$icon="four_star.png";}
						if($rating==5)
						{$icon="five_star.png";}
						?>
						<div id="top-free-tutorials">
						<a href="tutorial_details.php?tid=<?php echo $tid; ?>">
							<img src="images/<?php echo $row_mat["Material_Icon"]; ?>" width="100px" height="100px; float:left;">
							<span style="float:left;"><p><a href="tutorial_details.php?tid=<?php echo $tid; ?>"><?php echo $row_tut["Tutorial_Title"]; ?></a></br><img src="images/<?php echo $icon; ?>" width="50px" height="10px;"><span style="margin-left:70px; color:green; margin-left"><?php if($row_tut["Tutorial_Price"]==0){echo "Free";}else{echo "RM".$row_tut["Tutorial_Price"];} ?></span></br><i>uploaded by <?php echo $row_mem["Member_Username"]; ?></i></p></span>
						</a>
						</div>
						<?php
					}
				?>
			</div>
			<div class="cleaner h30"></div>
			<div>
			<h3>Top Paid Tutorials</h3>
				<?php
					$result_paid=mysql_query("select count(Buy_Item) as Count, Tutorial_ID from buy where Buy_Price<>0 group by Buy_Item order by Count desc limit 5");
					while($row_paid=mysql_fetch_assoc($result_paid))
					{
						$tid=$row_paid["Tutorial_ID"];
						$result_tut=mysql_query("select * from tutorial where Tutorial_ID=$tid");
						$row_tut=mysql_fetch_assoc($result_tut);
						$material=$row_tut["Material_ID"];
						$result_mat=mysql_query("Select * from material where Material_ID=$material");
						$row_mat=mysql_fetch_assoc($result_mat);
						$uploader=$row_tut["Member_ID"];
						$result_mem=mysql_query("select * from member where Member_ID=$uploader");
						$row_mem=mysql_fetch_assoc($result_mem);
						$result_rating=mysql_query("select * from tutorial_rating where Tutorial_ID=$tid");
						$row_rating=mysql_fetch_assoc($result_rating);
						$rating=$row_rating["Tutorial_Rating_Average"];
						$rating=round($rating);
						if($rating==1)
						{$icon="one_star.png";}
						if($rating==2)
						{$icon="two_star.png";}
						if($rating==3)
						{$icon="three_star.png";}
						if($rating==4)
						{$icon="four_star.png";}
						if($rating==5)
						{$icon="five_star.png";}
						?>
						<div id="top-paid-tutorials">
						<a href="tutorial_details.php?tid=<?php echo $tid; ?>">
							<img src="images/<?php echo $row_mat["Material_Icon"]; ?>" width="100px" height="100px; float:left;">
							<span style="float:left;"><p><a href="tutorial_details.php?tid=<?php echo $tid; ?>"><?php echo $row_tut["Tutorial_Title"]; ?></a></br><img src="images/<?php echo $icon; ?>" width="50px" height="10px;"><span style="margin-left:55px; color:green; margin-left"><?php if($row_tut["Tutorial_Price"]==0){echo "Free";}else{echo "RM".$row_tut["Tutorial_Price"];} ?></span></br><i>uploaded by <?php echo $row_mem["Member_Username"]; ?></i></p></span>
						</a>
						</div>
						<?php
					}
				?>
			</div>
            <div class="cleaner h30"></div>
            <a href="#top" class="gototop">Go to Top</a>
            <div class="cleaner"></div>
        </div> <!-- end of a content box -->
        <div class="content_box_bottom"></div>
			
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
				<input type="submit" name="loginbtn" id="loginbtn" class="vpb_general_button" value="Login" style="margin-left:170px;"/>
				</div>
			</form>
				<br clear="all"><br clear="all">
				</div>
<!--JQUERY LOGIN-->	
        
	</div> <!-- end of main -->
    
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
	//JQUERY LOGIN
	if(isset($_POST["loginbtn"]))
	{
		$user=$_POST["musername"];
		$pass=$_POST["mpass"];
		$pass=md5($pass);
		$login=mysql_query("select * from MEMBER where Member_Username='$user' and Member_Password='$pass'");
		$login_row=mysql_fetch_assoc($login);
		
		if(mysql_num_rows($login)==1)
		{
			$_SESSION['login']=$login_row["Member_ID"];
			header("Location: dashboard.php");
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
	
	if(isset($_GET['go']))
	{
		?>
			<script type="text/javascript">
				$(document).ready(function(){
					new Messi('Please login first before searching!', {title: 'Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});
				});
			</script>
		<?php
	}
?>