<?php
	ob_start();
	include ("dataconn.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script type="text/javascript">
		function ask(){confirm("Are you sure you want to remove the selected items from favourites?");}
		function checkall()
		{
			if(document.getElementById('1').checked)
			{
				document.getElementById('2').checked=true;
				document.getElementById('3').checked=true;
				document.getElementById('4').checked=true;
				document.getElementById('5').checked=true;
			}
			else
			{
				document.getElementById('2').checked=false;
				document.getElementById('3').checked=false;
				document.getElementById('4').checked=false;
				document.getElementById('5').checked=false;
			}
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
                <li><a href="register.php" title="Register">Register</a></li>
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
            <h2>My Favourite Tutorials</h2>
			
			<div class="result">
				<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
	<tr><th><input type="checkbox" onchange="checkall();" id="1"/></th><th>Title</th><th>Level</th><th>Paper</th><th>Student</th><th>View</th></tr><!-- Table Header -->
    
<tr><td><input type="checkbox" id="2"/></td><td><a href="tutorial_details.php">Kertas 1 Pep Akhir Tahun Ting 4 Terengganu 2001</a></td><td>Secondary School</td><td>SPM</td><td>Form 4</td><td><a href="tutorial_details.php"><img src="images/view.png"/></a></td></tr><!-- Table Row -->
	<tr class='even'><td><input type="checkbox" id="3"/></td><td><a href="tutorial_details.php">Kertas 1 Pep Akhir Tahun Ting 4 Terengganu 2001</a></td><td>Secondary School</td><td>SPM</td><td>Form 4</td><td><a href="tutorial_details.php"><img src="images/view.png"/></a></td></tr><!-- Darker Table Row -->

	<tr><td><input type="checkbox" id="4"/></td><td><a href="tutorial_details.php">Kertas 1 Pep Akhir Tahun Ting 4 Terengganu 2001</a></td><td>Secondary School</td><td>SPM</td><td>Form 4</td><td><a href="tutorial_details.php"><img src="images/view.png"/></a></td></tr>
	<tr class='even'><td><input type="checkbox" id="5"/></td><td><a href="tutorial_details.php">Kertas 1 Pep Akhir Tahun Ting 4 Terengganu 2001</a></td><td>Secondary School</td><td>SPM</td><td>Form 4</td><td><a href="tutorial_details.php"><img src="images/view.png"/></a></td></tr>

</table>
			</p>
				
				<div class="delete_btn">
				<p><input type="button" name="delete" value="Remove From Favourites" onclick="ask();"/></p>
				</div>
				
				<div class="previous_btn">
				<p><input type="button" name="previous" value="Previous"/></p>
				</div>
				
				<div class="next_btn">
				<p><input type="button" name="next" value="Next"/></p>
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