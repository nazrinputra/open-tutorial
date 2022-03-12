<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_REQUEST["mid"]))
	{
		$mid=$_REQUEST["mid"];
		$result_uploader=mysql_query("select * from member where Member_ID=$mid");
		$row_uploader=mysql_fetch_assoc($result_uploader);
	}
	
	if(isset($_REQUEST["rating"]))
	{
		$rate=$_REQUEST["rating"];
		$mid=$_GET["mid"];
		$result_rate=mysql_query("select * from member_rating where Member_ID='$mid'");
		$row_rate=mysql_fetch_assoc($result_rate);
		$rating_id=$row_rate["Member_Rating_ID"];
		$value_1=$row_rate["Member_Rating_1"];
		$value_2=$row_rate["Member_Rating_2"];
		$value_3=$row_rate["Member_Rating_3"];
		$value_4=$row_rate["Member_Rating_4"];
		$value_5=$row_rate["Member_Rating_5"];
		$value_total=$row_rate["Member_Rating_Total"];
		$value_average=$row_rate["Member_Rating_Average"];
		
		if($rate==1)
		{
			$newvalue_1=$value_1+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $value_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_1='$newvalue_1', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==2)
		{
			$newvalue_2=$value_2+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $value_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_2='$newvalue_2', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==3)
		{
			$newvalue_3=$value_3+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $value_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_3='$newvalue_3', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==4)
		{
			$newvalue_4=$value_4+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $value_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_4='$newvalue_4', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==5)
		{
			$newvalue_5=$value_5+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $value_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_5='$newvalue_5', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		mysql_query("insert into rating_detail_member (Rating_Detail_Level,Rater_ID,Member_ID) values ($rate,$sess_id,$mid)");
		
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have a new rating for your profile from one of our member in our website.";//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Rating by Member at OpenTutorial";
			$mail->AltBody    = "Rating update message"; //Text Body
			$mail->WordWrap   = 50; // set word wrap

			$mail->MsgHTML($body);

			$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$result_member=mysql_query("select * from member where Member_ID=$mid");
			$row_member=mysql_fetch_assoc($result_member);
			$memail=$row_member["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
		
		header ("Location: uploader.php?mid=$mid");
	}
	
	if(isset($_REQUEST["method"]))
	{
		$rate=$_GET["rate"];
		$mid=$_GET["mid"];
		
		$result_rate=mysql_query("select * from member_rating where Member_ID='$mid'");
		$row_rate=mysql_fetch_assoc($result_rate);
		$value_1=$row_rate["Member_Rating_1"];
		$value_2=$row_rate["Member_Rating_2"];
		$value_3=$row_rate["Member_Rating_3"];
		$value_4=$row_rate["Member_Rating_4"];
		$value_5=$row_rate["Member_Rating_5"];
		$value_total=$row_rate["Member_Rating_Total"];
		$value_average=$row_rate["Member_Rating_Average"];
		
		$testimony=mysql_query("select * from rating_detail_member where Member_ID=$mid and Rater_ID=$sess_id");
		$row_testimony=mysql_fetch_assoc($testimony);
		$level=$row_testimony["Rating_Detail_Level"];
		mysql_query("update rating_detail_member set Rating_Detail_Level=$rate where Member_ID=$mid and Rater_ID=$sess_id");
		
		if($level==1)
		{
			$newvalue_1=$value_1-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($newvalue_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_1='$newvalue_1', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($level==2)
		{
			$newvalue_2=$value_2-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $newvalue_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_2='$newvalue_2', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($level==3)
		{
			$newvalue_3=$value_3-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $value_2*2 + $newvalue_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_3='$newvalue_3', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($level==4)
		{
			$newvalue_4=$value_4-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $newvalue_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_4='$newvalue_4', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($level==5)
		{
			$newvalue_5=$value_5-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $newvalue_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_5='$newvalue_5', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		$result_rate=mysql_query("select * from member_rating where Member_ID='$mid'");
		$row_rate=mysql_fetch_assoc($result_rate);
		$value_1=$row_rate["Member_Rating_1"];
		$value_2=$row_rate["Member_Rating_2"];
		$value_3=$row_rate["Member_Rating_3"];
		$value_4=$row_rate["Member_Rating_4"];
		$value_5=$row_rate["Member_Rating_5"];
		$value_total=$row_rate["Member_Rating_Total"];
		$value_average=$row_rate["Member_Rating_Average"];
		
		if($rate==1)
		{
			$newvalue_1=$value_1+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($newvalue_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_1='$newvalue_1', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==2)
		{
			$newvalue_2=$value_2+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $newvalue_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_2='$newvalue_2', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==3)
		{
			$newvalue_3=$value_3+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $newvalue_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_3='$newvalue_3', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==4)
		{
			$newvalue_4=$value_4+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $newvalue_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_4='$newvalue_4', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
		if($rate==5)
		{
			$newvalue_5=$value_5+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $newvalue_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update member_rating set Member_Rating_5='$newvalue_5', Member_Rating_Total='$newvalue_total', Member_Rating_Average='$newvalue_average' where Member_ID='$mid'");
		}
		
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have a new rating for your profile from one of our member in our website.";//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Rating by Member at OpenTutorial";
			$mail->AltBody    = "Rating update message"; //Text Body
			$mail->WordWrap   = 50; // set word wrap

			$mail->MsgHTML($body);

			$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$result_member=mysql_query("select * from member where Member_ID=$mid");
			$row_member=mysql_fetch_assoc($result_member);
			$memail=$row_member["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
		
		header ("Location: uploader.php?mid=$mid");
	}
	
	if(isset($_REQUEST["follow"]))
	{
		$follow=$_REQUEST["follow"];
		$mid=$_GET["mid"];
		$result_following=mysql_query("select * from follow where Follow_Follower='$mid' and Follow_Member='$follow'");
		if(mysql_num_rows($result_following))
		{
			mysql_query("delete from follow where Follow_Follower='$mid' and Follow_Member='$follow'");
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have unfollowed a member in our website.";//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Unfollow Member at OpenTutorial";
			$mail->AltBody    = "Successful unfollow message"; //Text Body
			$mail->WordWrap   = 50; // set word wrap

			$mail->MsgHTML($body);

			$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$memail=$row["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
			
			$mail2             = new PHPMailer();
			$body2             = "You have lost a follower in our website.";//message

			$mail2->IsSMTP();
			$mail2->SMTPAuth   = true;                  // enable SMTP authentication
			$mail2->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail2->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail2->Port       = 465;                   // set the SMTP port

			$mail2->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail2->Password   = "Pujangga_94";            // GMAIL password

			$mail2->From       = "open_tutorial@yourdomain.com";
			$mail2->FromName   = "Administrator";
			$mail2->Subject    = "Lost Follower at OpenTutorial";
			$mail2->AltBody    = "Lost follower message"; //Text Body
			$mail2->WordWrap   = 50; // set word wrap

			$mail2->MsgHTML($body2);

			$mail2->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$result_follow=mysql_query("select * from member where Member_ID=$follow");
			$row_follow=mysql_fetch_assoc($result_follow);
			$email=$row_follow["Member_Email"];
			$mail2->AddAddress("{$email}");

			$mail2->IsHTML(true); // send as HTML

			if(!$mail2->Send()) {
				echo "Mail error: " . $mail2->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
		}
		else
		{
			mysql_query("insert into follow (Follow_Follower,Follow_Member,Follow_Status)values('$mid','$follow','1')");
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have followed a member in our website.";//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Follow Member at OpenTutorial";
			$mail->AltBody    = "Successful follow message"; //Text Body
			$mail->WordWrap   = 50; // set word wrap

			$mail->MsgHTML($body);

			$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$memail=$row["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
			
			$mail2             = new PHPMailer();
			$body2             = "You have gain a new follower in our website.";//message

			$mail2->IsSMTP();
			$mail2->SMTPAuth   = true;                  // enable SMTP authentication
			$mail2->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail2->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail2->Port       = 465;                   // set the SMTP port

			$mail2->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail2->Password   = "Pujangga_94";            // GMAIL password

			$mail2->From       = "open_tutorial@yourdomain.com";
			$mail2->FromName   = "Administrator";
			$mail2->Subject    = "New Follower at OpenTutorial";
			$mail2->AltBody    = "New follower message"; //Text Body
			$mail2->WordWrap   = 50; // set word wrap

			$mail2->MsgHTML($body2);

			$mail2->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$result_follow=mysql_query("select * from member where Member_ID=$follow");
			$row_follow=mysql_fetch_assoc($result_follow);
			$email=$row_follow["Member_Email"];
			$mail2->AddAddress("{$email}");

			$mail2->IsHTML(true); // send as HTML

			if(!$mail2->Send()) {
				echo "Mail error: " . $mail2->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
		}
		header ("Location: uploader.php?mid=$follow");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="shortcut icon" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"/>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables_themeroller.css"/>
	<style type="text/css">
		* {
		padding:0;
		margin:0;
		list-style:none;
		}

		ul.rating{
		background:url(images/star.jpg) bottom;
		height:21px;
		width:115px;
		overflow:hidden;
		}

		ul.rating li{
		display:inline
		}

		.rating a {
		display:block;
		width:23px;
		height:21px;
		float:left;
		text-indent:-9999px;
		position:relative;
		}

		.rating a:hover {
		background:url(images/star.jpg) center;
		width:115px;
		margin-left:-92px;
		position:static;
		}

		.rating a:active {
		background-position:top;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript">
		$(document).ready( function () {
			$('#tutorial').DataTable({
			"searching": true,
			"oLanguage": {
				"sSearch": "Filter results: "
			  }
			});
		} );
	</script>
	<script>	
	function RateUploader()
		{
			document.getElementById("rating").innerHTML = "<div id='rating'><b>Rate this member:<b><br/><ul class='rating'><li><a href='uploader.php?method=2&rate=1&mid=<?php echo $mid; ?>' title='1 Star'>1</a></li><li><a href='uploader.php?method=2&rate=2&mid=<?php echo $mid; ?>' title='2 Stars'>2</a></li><li><a href='uploader.php?method=2&rate=3&mid=<?php echo $mid; ?>' title='3 Stars'>3</a></li><li><a href='uploader.php?method=2&rate=4&mid=<?php echo $mid; ?>' title='4 Stars'>4</a></li><li><a href='uploader.php?method=2&rate=5&mid=<?php echo $mid; ?>' title='5 Stars'>5</a></li></ul><br/></div>";
			document.getElementById("rated").innerHTML = "Pending new rating..";
		}
	</script>
</head>
<body>
<img src="images/left-top.png" style="margin-left:200px;margin-top:25px;"/>
<img src="images/right-top.png" style="margin-left:180px;margin-top:25px;"/>
<div id="wrapper">
    <div id="content">
		
        <nav style="margin-left:40px;">
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
            <h2><?php echo $row_uploader["Member_Username"];?></h2>
            
			<div class="profile_pic">
				<img src="images/Profile/<?php echo $row_uploader["Member_Profile"];?>" width="150px" height="150px" style="float:left;"/>
				<div class='testimony2'>
					<?php
					$testimony=mysql_query("select * from rating_detail_member where Member_ID=$mid and Rating_Detail_Comment!=''");
					while($row_testimony=mysql_fetch_assoc($testimony))
					{
					$testimony_author=$row_testimony["Rater_ID"];
					$author=mysql_query("select * from member where Member_ID='$testimony_author'");
					$row_author=mysql_fetch_assoc($author);
					$testimony_rating=$row_testimony["Rating_Detail_Level"];
					
					if($testimony_rating==1)
					{$img="images/1.png";}
					if($testimony_rating==2)
					{$img="images/2.png";}
					if($testimony_rating==3)
					{$img="images/3.png";}
					if($testimony_rating==4)
					{$img="images/4.png";}
					if($testimony_rating==5)
					{$img="images/5.png";}
					?>
					<div>
						<p class='testimonial-author2'><?php echo $row_author["Member_Username"]; ?> | <span <?php if($testimony_author==$sess_id){ echo 'id="rated"'; } ?>><img src="<?php echo $img ?>"/></span></p>
						<blockquote class='testimonial2'><p><?php echo $row_testimony["Rating_Detail_Comment"]; ?></p><?php if($testimony_author==$sess_id){ $_SESSION["review2"]=$row_testimony["Rating_Detail_Comment"];?><span style="font-size:8pt;"><a style="text-decoration:none;color:green;" href="edit_review2.php?mid=<?php echo $mid ?>">edit review</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#rated" onclick="RateUploader();" style="text-decoration:none;color:green;">edit rating</a></span><?php } ?></blockquote>
						<br><br>
					</div>
					<?php
					}
					?>
				</div>
				<div class="information">
					<br><br>
					<p style="width:300px;">
						<?php
							$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						?>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $actual_link ?>" style="text-decoration:none;" target="_blank">
							<img src="images/facebook.png" alt="Share on Facebook" title="Share on Facebook" style="width:140px;height:40px;margin-left:-8px;"/>
						</a>
						<a href="https://twitter.com/intent/tweet?text=Check out this uploader!&hashtags=OpenTutorial,GrowYourMind,Uploader&url=<?php echo $actual_link; ?>&via=OpenTutorial" class="twitter-share-button" data-size="large" data-count="none" target="_blank">
							<img src="images/twitter.png" alt="Share on Twitter" title="Share on Twitter" style="width:140px;height:40px;margin-left:-8px;"/>
						</a>
					</p>
				<p>Real name is <b><?php echo $row_uploader["Member_Name"];?></b></p>
				<p>
					<b>
						<?php
						$rating=$row_uploader["Rating_ID"];
						$result_rating=mysql_query("select * from member_rating where Member_Rating_ID=$rating");
						$row_rating=mysql_fetch_assoc($result_rating);
						$average=$row_rating["Member_Rating_Average"];
						if($average==0)
							echo "No";
						else
							echo $row_rating["Member_Rating_Average"];
						?>
					</b> overall rating</p>
				<?php
				$follow_member=$row_uploader['Member_ID'];
				if($follow_member==$sess_id)
				{echo "";}
				else
				{
				?>
				<p>
				<?php
					$rating_check=mysql_query("select * from rating_detail_member where Member_ID=$mid and Rater_ID=$sess_id");
					$row_rating_check=mysql_fetch_assoc($rating_check);
					$rated=$row_rating_check["Rating_Detail_Level"];
					if($rated==0)
					{
						if($mid==$sess_id)
						{}
						else
						{
						?>
						<b>Rate this member:<b>
							<ul class='rating'>
								<li><a href='uploader.php?rating=1&mid=<?php echo $row_uploader['Member_ID'] ?>' title='1 Star'>1</a></li>
								<li><a href='uploader.php?rating=2&mid=<?php echo $row_uploader['Member_ID'] ?>' title='2 Stars'>2</a></li>
								<li><a href='uploader.php?rating=3&mid=<?php echo $row_uploader['Member_ID'] ?>' title='3 Stars'>3</a></li>
								<li><a href='uploader.php?rating=4&mid=<?php echo $row_uploader['Member_ID'] ?>' title='4 Stars'>4</a></li>
								<li><a href='uploader.php?rating=5&mid=<?php echo $row_uploader['Member_ID'] ?>' title='5 Stars'>5</a></li>
							</ul>
						</p>
						<?php
						}
					}
					else
					{
						$reviewed=$row_rating_check["Rating_Detail_Comment"];
						if($reviewed=="")
						{
							if($mid==$sess_id)
							{}
							else
							{
							?>
							<div id="review">
								<form name="reviewfrm" id="reviewfrm" method="post" action="">
									<textarea name="review" rows="5" cols="40"></textarea><br><br>
									<input type="submit" name="reviewbtn" style="margin-left:10px;" class="style_btn" value="Submit Review"/><br><br>
								</form>
							</div>
							<?php
							}
						}
						else
						{
						}
					}
				}
				?>
				<label id="rating"/>
				<p>
					<b><?php $stat_follow=$row_uploader['Member_ID'];$result_stat_follow=mysql_query("select * from follow where Follow_Member='$stat_follow'");if(mysql_num_rows($result_stat_follow)){$total_follow=mysql_num_rows($result_stat_follow);echo $total_follow;}else{echo "No";} ?></b> Followers
				</p>
				<?php
				$follow_member=$row_uploader['Member_ID'];
				if($follow_member==$sess_id)
				{echo "";}
				else
				{
				?>
					<p id="follow"><a href="uploader.php?follow=<?php echo $row_uploader['Member_ID'] ?>&mid=<?php echo $sess_id ?>"><input type="button" name="follow" value="<?php $result_follow=mysql_query("select * from follow where Follow_Follower='$sess_id' and Follow_Member='$follow_member'");$row_follow=mysql_fetch_assoc($result_follow);$follow_status=$row_follow["Follow_Status"];if($follow_status==1){echo "Unfollow";}else {echo "Follow";} ?>"/></a></p>
				<?php
				}
				?>
				<p>&nbsp;</p>
				</div>
			</div>
			
			
			
			<div class="feedback_rating">
				
				<div style="margin-top:100px;">	
				<h2>Tutorials From This Uploader</h2> 
				
				<div class="item">
				
			<?php
			$mid=$_REQUEST["mid"];
			$result_tutorial=mysql_query("select * from tutorial where Member_ID='$mid'");
			if(mysql_num_rows($result_tutorial))
			{
			?>
				<table id="tutorial" size="700px">
					<thead>
					<tr>
						<th>Title</th>
						<th>Subject</th>
						<th>Category</th>
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
									<a href="tutorial_details.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
										<?php
											echo $row_tutorial["Tutorial_Title"];
										?>
									</a>
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
									<a href="tutorial_details.php?tid=<?php echo $row_tutorial["Tutorial_ID"]; ?>">
										<img src="images/view.png" width="30px" height="30px;"/>
									</a>
								</td>
							</tr>
							<?php
						}
					?>
					</tbody>
				</table>
			<?php
			}
			else
			{echo "<p style='margin-left:40px;'>No tutorial uploaded</p>";}
			?>
					
				</div>
				
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
	if(isset($_POST["reviewbtn"]))
	{
		$review=$_POST["review"];
		mysql_query("update rating_detail_member set Rating_Detail_Comment='$review' where Rater_ID=$sess_id and Member_ID=$mid") or die("SQL ERROR");
		header ("Location: uploader.php?mid=$mid");
	}
?>