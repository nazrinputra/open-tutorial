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
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script>	
	function ClaimProfit()
		{
			document.getElementById("claim").innerHTML = '<form method="post" id="claim" style="margin-left:170px;">Enter claim amount :<span id="profile_details"> RM </span><input type="number" name="claim" size="3" placeholder="0"/><input type="submit" name="claimbtn" id="claimbtn" value="Submit Claim" class="style_btn" style="margin-left:20px;padding:8px;"></form>';
		}
	</script>
	<script>
		$(function() {
		   $( "#claim" ).validate({
				   rules: {
						claim: {
							required: true,
						},
				   },
				   messages: {
						claim: {
							required: "Please enter claim amount",
						},
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
            <h2>My Profile</h2>
			<em>You can gain profit by uploading paid tutorials to our system. Every time a user buy your tutorials, you will receive your fair share. You can also claim your profit by contacting an admin.</em>
			<br><br>
			<div id="profile">
				<p style="float:left;margin-right:50px;"><img src="images/Profile/<?php echo $row["Member_Profile"];?>" style="width:150px;height:200px;"/></p>
				<p>ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span id="profile_details"><?php echo $row["Member_ID"];?></span></p>
				<p>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span id="profile_details"><?php echo $row["Member_Name"];?></span></p>
				<p>Username &nbsp;&nbsp&nbsp;&nbsp;: <span id="profile_details"><?php echo $row["Member_Username"];?></span></p>
				<p>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="profile_details"><?php echo $row["Member_Email"];?></span></p>
				<p>Contact &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span id="profile_details"><?php echo $row["Member_Mobile"];?></span></p>
				<p>Credit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span id="profile_details">RM <?php echo $row["Member_Credit"];?></span></p>
				<p>Profit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span id="profile_details">RM <?php echo $row["Member_Profit"];?></span></p>
		<p><a href="update_profile.php"><input type="button" value="Update Profile" name="updatebtn"/></a><?php if($row["Member_Profit"]!=0){ ?><a href="#claim"><input type="button" value="Claim Profit" name="profitbtn" onclick="ClaimProfit();"/></a><?php } ?></p>
        <br><br><br><br>
		<p><span id="claim"></span></p>
			</div>
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
	if(isset($_POST["claimbtn"]))
	{
		$claim=$_POST["claim"];
		if($claim>$row["Member_Profit"] || $claim==0)
		{
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('Not enough profit balance to claim or claim amount is empty.', {title: 'Claim Error', titleClass: 'anim error', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		}
		else
		{
			$text="Profit claim from member named ".$row["Member_Username"]." for RM ".number_format((float)$claim, 2, '.', '').". Available profit balance for this member: RM ".number_format((float)$row["Member_Profit"], 2, '.', '');
			mysql_query("insert into message (Message_Title,Message_Text,Member_ID) values ('Profit Claim','$text',$sess_id)");
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('<?php echo "Claim successful. An email will be sent to your email address once your claim has been processed."; ?>', {title: 'Claim Success', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		}
	}
?>