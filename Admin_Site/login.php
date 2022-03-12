<?php
	ob_start();
	include ("dataconn.php");
?>
<!DOCTYPE html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmin.css" />
	<link rel="stylesheet" type="text/css" href="css/messi.min.css" />
	<link rel="shortcut icon" href="images/icon.png">
	<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script type="text/javascript">
		function error()
		{
			alert("Please login first!");
		}
	</script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		$('#submit').click(function(){
		var username=$('#user').val();
		var password=$('#pass').val();
		
		if(username=="" && password=="")
		{
			$('#dis').slideDown().html("<span style='color:red'>Please type username and password</span>");
			return false;
		}
		
		else if(username=="")
		{
			$('#dis').slideDown().html("<span style='color:red'>Please type username</span>");
			return false;
		}
		
		else if(password=="")
		{
			$('#dis').slideDown().html("<span style='color:red'>Please type password</span>");
			return false;
		}
		
		else
		{
			<?php
				{
					$user=$_POST["username"];
					$pass=$_POST["password"];
					$pass=md5($pass);
					$login=mysql_query("select * from ADMIN where Admin_Username='$user' and Admin_Password='$pass' and isDelete=0");
					$login_row=mysql_fetch_assoc($login);
					
					if(mysql_num_rows($login)==1)
					{
						$_SESSION['loginadmin']=$login_row["Admin_ID"];
						header("location: index.php");
					}
					
				}
			?>
		}
		
		});
		});
	</script>
	
	<style type="text/css">
		#dis
		{
		text-align:center;
		height: 25px;
		width: 250px;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div id="content">
			<div class="c1">
				<div class="controls">
					<nav class="links">
						
					</nav>
					<div class="profile-box">
						<span class="profile">
							<a href="#" class="section" onclick="error();">
								<span class="text-box">
									Welcome Guest
									<strong class="name">Please Login</strong>
								</span>
							</a>
							<a href="#" class="opener"></a>
						</span>
						<a href="#" class="btn-on">On</a>
					</div>
				</div>
				<div class="tabs">
					<div id="tab-1" class="tab">
						<article>
							<div class="text-section">
								<h1>Login</h1>
								<p>Please login to continue</p>
							</div>
							<div class="text-section-black">
								
								<form name="login" id="login" method="post" action="login.php">
									<p style="margin-top:100px;">Username: <input type="text" name="username" id="user" placeholder="Your username" size="30" style=""/></p>
									<p>Password:&nbsp;&nbsp;<input type="password" name="password" id="pass" placeholder="Your password" size="30" style=""/></p>
									<p><label id="dis">&nbsp;</label></p>
									<p><input type="submit" value="Login" name="loginbtn" id="submit"/></p>
								</form>
							
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