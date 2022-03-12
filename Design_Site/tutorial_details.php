<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_GET["tid"]))
	{
		$tid=$_GET["tid"];
		$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
		$row_tutorial=mysql_fetch_assoc($result_tutorial);
	}
	
	if(isset($_REQUEST["rating"]))
	{
		$rate=$_REQUEST["rating"];
		$tid=$_GET["tid"];
		$result_rate=mysql_query("select * from tutorial_rating where Tutorial_ID='$tid'");
		$row_rate=mysql_fetch_assoc($result_rate);
		$value_1=$row_rate["Tutorial_Rating_1"];
		$value_2=$row_rate["Tutorial_Rating_2"];
		$value_3=$row_rate["Tutorial_Rating_3"];
		$value_4=$row_rate["Tutorial_Rating_4"];
		$value_5=$row_rate["Tutorial_Rating_5"];
		$value_total=$row_rate["Tutorial_Rating_Total"];
		$value_average=$row_rate["Tutorial_Rating_Average"];
		
		if($rate==1)
		{
			$newvalue_1=$value_1+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($newvalue_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_1='$newvalue_1', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==2)
		{
			$newvalue_2=$value_2+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $newvalue_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_2='$newvalue_2', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==3)
		{
			$newvalue_3=$value_3+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $newvalue_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_3='$newvalue_3', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==4)
		{
			$newvalue_4=$value_4+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $newvalue_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_4='$newvalue_4', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==5)
		{
			$newvalue_5=$value_5+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $newvalue_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_5='$newvalue_5', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		mysql_query("insert into rating_detail (Rating_Detail_Level,Rating_Detail_Member,Rating_Detail_Tutorial) values ($rate,$sess_id,$tid)");
		
			$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
			$row_tutorial=mysql_fetch_assoc($result_tutorial);
			$tutorial_name=$row_tutorial["Tutorial_Title"];
			
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have a new rating for your tutorial $tutorial_name from one of our member in our website.";//message

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
			
			$uploader_id=$row_tutorial["Member_ID"];
			$result_following=mysql_query("select * from member where Member_ID=$uploader_id");
			$row_following=mysql_fetch_assoc($result_following);
			$memail=$row_following["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
		
		header ("Location: tutorial_details.php?tid=$tid");
	}
	
	if(isset($_REQUEST["method"]))
	{
		$rate=$_GET["rate"];
		$tid=$_GET["tid"];
		
		$result_rate=mysql_query("select * from tutorial_rating where Tutorial_ID='$tid'");
		$row_rate=mysql_fetch_assoc($result_rate);
		$value_1=$row_rate["Tutorial_Rating_1"];
		$value_2=$row_rate["Tutorial_Rating_2"];
		$value_3=$row_rate["Tutorial_Rating_3"];
		$value_4=$row_rate["Tutorial_Rating_4"];
		$value_5=$row_rate["Tutorial_Rating_5"];
		$value_total=$row_rate["Tutorial_Rating_Total"];
		$value_average=$row_rate["Tutorial_Rating_Average"];
		
		$testimony=mysql_query("select * from rating_detail where Rating_Detail_Tutorial=$tid and Rating_Detail_Member=$sess_id");
		$row_testimony=mysql_fetch_assoc($testimony);
		$level=$row_testimony["Rating_Detail_Level"];
		mysql_query("update rating_detail set Rating_Detail_Level=$rate where Rating_Detail_Tutorial=$tid and Rating_Detail_Member=$sess_id");
		
		if($level==1)
		{
			$newvalue_1=$value_1-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($newvalue_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_1='$newvalue_1', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($level==2)
		{
			$newvalue_2=$value_2-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $newvalue_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_2='$newvalue_2', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($level==3)
		{
			$newvalue_3=$value_3-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $value_2*2 + $newvalue_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_3='$newvalue_3', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($level==4)
		{
			$newvalue_4=$value_4-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $newvalue_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_4='$newvalue_4', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($level==5)
		{
			$newvalue_5=$value_5-1;
			$newvalue_total=$value_total-1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $newvalue_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_5='$newvalue_5', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		
		
		if($rate==1)
		{
			$newvalue_1=$value_1+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($newvalue_1 + $value_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_1='$newvalue_1', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==2)
		{
			$newvalue_2=$value_2+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $newvalue_2*2 + $value_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_2='$newvalue_2', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==3)
		{
			$newvalue_3=$value_3+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $newvalue_3*3 + $value_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_3='$newvalue_3', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==4)
		{
			$newvalue_4=$value_4+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $newvalue_4*4 + $value_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_4='$newvalue_4', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
		if($rate==5)
		{
			$newvalue_5=$value_5+1;
			$newvalue_total=$value_total+1;
			$newvalue_average=(($value_1 + $value_2*2 + $value_3*3 + $value_4*4 + $newvalue_5*5) / $newvalue_total);
			$rating_id=round($newvalue_average);
			mysql_query("update tutorial_rating set Tutorial_Rating_5='$newvalue_5', Tutorial_Rating_Total='$newvalue_total', Tutorial_Rating_Average='$newvalue_average', Rating_ID='$rating_id' where Tutorial_ID='$tid'");
		}
		
			$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
			$row_tutorial=mysql_fetch_assoc($result_tutorial);
			$tutorial_name=$row_tutorial["Tutorial_Title"];
			
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have a new rating for your tutorial $tutorial_name from one of our member in our website.";//message

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
			
			$uploader_id=$row_tutorial["Member_ID"];
			$result_following=mysql_query("select * from member where Member_ID=$uploader_id");
			$row_following=mysql_fetch_assoc($result_following);
			$memail=$row_following["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML

			if(!$mail->Send()) {
				echo "Mail error: " . $mail->ErrorInfo;
			} else {
				echo "Mail successful. An email has been sent to your email address.";
			}
		
		header ("Location: tutorial_details.php?tid=$tid");
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
		header ("Location: tutorial_details.php?tid=$tid");
	}
	
	// if session 'cart' was set, count it, else set it to 0
	$cartItemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
	
	$action = isset($_GET['action']) ? $_GET['action'] : "";
	$name = isset($_GET['name']) ? $_GET['name'] : "";
	if($action=='add'){
		echo "<div>" . $name . " was added to your cart.</div>";
		header ("Location: tutorial_details.php?tid=$tid");
	}
	 
	if($action=='exists'){
		echo "<div>" . $name . " already exists in your cart.</div>";
		header ("Location: tutorial_details.php?tid=$tid");
	}
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="shortcut icon" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="css/messi.min.css"/>
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
	<script language="javascript" type="text/javascript" src="js/messi.js"></script>
	<script>	
	function confirmBuy()
		{
			return confirm("You already bought this tutorial before. Are you sure you want to add this tutorial to your shopping cart?");
		}
	function RateTutorial()
		{
			document.getElementById("rating").innerHTML = "<div id='rating'><b>Rate this tutorial:<b><br/><ul class='rating'><li><a href='tutorial_details.php?method=2&rate=1&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='1 Star'>1</a></li><li><a href='tutorial_details.php?method=2&rate=2&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='2 Stars'>2</a></li><li><a href='tutorial_details.php?method=2&rate=3&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='3 Stars'>3</a></li><li><a href='tutorial_details.php?method=2&rate=4&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='4 Stars'>4</a></li><li><a href='tutorial_details.php?method=2&rate=5&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='5 Stars'>5</a></li></ul><br/></div>";
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
            <h2>Tutorial Details</h2>
            
			<div class="icon_item">
				<?php
					$material=$row_tutorial["Material_ID"];
					$result_material=mysql_query("select * from material where Material_ID='$material'");
					$row_material=mysql_fetch_assoc($result_material);
				?>
				<img src="images/<?php echo $row_material["Material_Icon"] ?>" alt="tutorial" title="tutorial" width="90px" height="50px"/>
			</div>
			
			<div class="detail_item">
			
				<div class="element_item">
					<h3><?php echo $row_tutorial["Tutorial_Title"] ?></h3>
				
					<?php
							$result_download=mysql_query("select * from buy where Member_ID=$sess_id and Tutorial_ID=$tid") or die("SQL ERROR");
							$price=$row_tutorial["Tutorial_Price"];
							if(mysql_num_rows($result_download))
							{
								$newprice=$price/2.0;
								$price=$newprice;
							}
					?>
					<p>Price: <b><?php if($row_tutorial["Tutorial_Price"]==0){echo "Free";}else{echo "RM ".number_format((float)$price, 2, '.', '');} ?></b></p>
					<p>
						<?php
							$member=$row_tutorial["Member_ID"];
							$result_member=mysql_query("select * from member where Member_ID='$member'");
							$row_member=mysql_fetch_assoc($result_member);
						?>
						Uploaded by: <a href="uploader.php?mid=<?php echo $row_tutorial["Member_ID"]; ?>"><?php echo $row_member["Member_Username"]; ?></a> 
					</p>
					<p>
						<?php
							$category=$row_tutorial["Category_ID"];
							$result_category=mysql_query("select * from category where Category_ID='$category'");
							$row_category=mysql_fetch_assoc($result_category);
						?>
						Category:<b> <?php echo $row_category["Category_Name"]; ?> </b>
					</p>
					<p>
						Size:<b> <?php echo $row_tutorial["Tutorial_Size"] ?> KB </b>
					</p>
					<p>
						<?php
							$result_rating=mysql_query("select * from tutorial_rating where Tutorial_ID='$tid'");
							$row_rating=mysql_fetch_assoc($result_rating);
						?>
						Rating:<b> <?php echo $row_rating["Tutorial_Rating_Average"]; ?> </b>
					</p>
					<p>
						<?php
							$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						?>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $actual_link; ?>" style="text-decoration:none;" target="_blank">
							<img src="images/facebook.png" alt="Share on Facebook" title="Share on Facebook" style="width:140px;height:40px;margin-left:-8px;"/>
						</a>
						<a href="https://twitter.com/intent/tweet?text=Check out this tutorial!&hashtags=OpenTutorial,GrowYourMind,Tutorial&url=<?php echo $actual_link; ?>&via=OpenTutorial" class="twitter-share-button" data-size="large" data-count="none" target="_blank">
							<img src="images/twitter.png" alt="Share on Twitter" title="Share on Twitter" style="width:140px;height:40px;margin-left:-8px;"/>
						</a>
					</p>
					<p>&nbsp;</p>
					<p>
					<?php
					$member=$row_tutorial["Member_ID"];
					if($member!=$sess_id)
					{
					?>
						<button class="cart"><a href='AddToCart.php?tid=<?php echo $tid ?>&name=<?php echo $name ?>' <?php $result_download=mysql_query("select * from buy where Tutorial_ID=$tid and Member_ID=$sess_id");if(mysql_num_rows($result_download)){ ?> onclick="return confirmBuy();" <?php }else{}?>>Add To Cart</a></button>
					<?php
					}
					?>
					</p>
					
				</div>
				
				<div class="uploader_information">
				
					<fieldset style="border-color:blue; padding:20px; border-radius:10px; box-shadow:0 0 10px #666; background:white;">
						<h4>Uploader's Information</h4>
						<p>Username: <a href="uploader.php?mid=<?php echo $row_tutorial["Member_ID"]; ?>" style="text-decoration:none;font-weight:bold;"><?php echo $row_member["Member_Name"]; ?></a></p>
						<p>Rating: <b>
							<?php 
								$rating=$row_member["Rating_ID"];
								$result_rating=mysql_query("select * from member_rating where Member_Rating_ID=$rating");
								$row_rating=mysql_fetch_assoc($result_rating);
								$average=$row_rating["Member_Rating_Average"];
								if($average==0)
									echo "No rating";
								else
									echo $row_rating["Member_Rating_Average"];
							?>
							</b>
						</p>
						<?php 
							$follow_member=$row_member['Member_ID'];
							if($follow_member==$sess_id)
							{echo "";}
							else
							{$tid=$row_tutorial["Tutorial_ID"];
							$result_follow=mysql_query("select * from follow where Follow_Follower='$sess_id' and Follow_Member='$follow_member'");
							$row_follow=mysql_fetch_assoc($result_follow);$follow_status=$row_follow["Follow_Status"];
							if($follow_status==0)
								{
								?>
									<span id="follow"><a href="tutorial_details.php?follow=<?php echo $row_member['Member_ID'] ?>&mid=<?php echo $sess_id ?>&tid=<?php echo $tid ?>" style="text-decoration:none; color:green;cursor:pointer;"><img src="images/green_plus.png" style="width: 15px; height:15px;" /> Follow this uploader</a></span>
								<?php
								}
							else
								{
								?>
									<span id="follow"><a href="tutorial_details.php?follow=<?php echo $row_member['Member_ID'] ?>&mid=<?php echo $sess_id ?>&tid=<?php echo $tid ?>" style="text-decoration:none; color:red;cursor:pointer;"><img src="images/red_minus.png" style="width: 15px; height:15px;" /> Unfollow this uploader</a></span>
								<?php
								}
							}
						?>
						<p><a href="sale.php?mid=<?php echo $row_member['Member_ID'] ?>&tid=<?php echo $tid; ?>" style="text-decoration:none; margin-top:15px; color:purple;"><img src="images/pointer_right.png" style="width: 20px; height:20px;margin-top:5px;"/> See other items</a></p>	
					</fieldset>
				</div>
			</div>
			
            <div class="cleaner h30"></div>
            <div class="cleaner"></div>
        </div> <!-- end of a content box -->
        <div class="content_box_bottom"></div>
		
				<div class="content_box">
					<h2>Your Shopping Cart</h2>
					<?php 
						if($cartItemCount==0)
						{echo "Your shopping cart is empty<br><br>";}
						else
						{echo "$cartItemCount item(s) in your shopping cart<br><br>";
						echo "<button class='cart'><a href='cart.php'>View Cart</a></button>";}
					?>
					<br>
					<br>
					<br>
					<br>
				</div>
		<div class="content_box_bottom"></div>
		
		<div class="content_box">
			<a id="rater"></a>
			<h2>Ratings for this Tutorial</h2>
			<p>
					<?php
						if(mysql_num_rows($result_download))
						{
							$rating_check=mysql_query("select * from rating_detail where Rating_Detail_Member=$sess_id and Rating_Detail_Tutorial=$tid");
							$row_rating_check=mysql_fetch_assoc($rating_check);
							$rated=$row_rating_check["Rating_Detail_Level"];
							if($rated==0)
							{
								?>
								<div id="rating">
									<b>Rate this tutorial:<b><br/>
										<ul class='rating'>
											<li><a href='tutorial_details.php?rating=1&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='1 Star'>1</a></li>
											<li><a href='tutorial_details.php?rating=2&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='2 Stars'>2</a></li>
											<li><a href='tutorial_details.php?rating=3&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='3 Stars'>3</a></li>
											<li><a href='tutorial_details.php?rating=4&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='4 Stars'>4</a></li>
											<li><a href='tutorial_details.php?rating=5&tid=<?php echo $row_tutorial['Tutorial_ID'] ?>' title='5 Stars'>5</a></li>
										</ul>
									<br/>
								</div>
								<?php
							}
							else
							{
								$reviewed=$row_rating_check["Rating_Detail_Comment"];
								if($reviewed=="")
								{
									?>
									<div id="review">
										<form name="reviewfrm" id="reviewfrm" method="post" action="">
											<textarea name="review" rows="5" cols="40"></textarea><br><br>
											<input type="submit" name="reviewbtn" style="margin-left:100px;" class="style_btn" value="Submit Review"/><br><br>
										</form>
									</div>
									<?php
								}
								else
								{
								}
							}
						}
					?>
			<label id="rating"/>
			</p>
			<div>
				<br/>
				<span style="font-size:40pt;">
				<?php
					$result_rating=mysql_query("select * from tutorial_rating where Tutorial_ID='$tid'");
					$row_rating=mysql_fetch_assoc($result_rating);
					echo $row_rating["Tutorial_Rating_Average"];
				?>
				</span>
				<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;overall rating
				<b>
				<ul style="float:right;margin-top:-50px;font-size:12pt;text-align:right;">
					<li style=""><span style="vertical-align:25%;"><?php echo $row_rating["Tutorial_Rating_5"]; ?> user(s) rated this tutorial as </span><span style="vertical-align:25%;color:#006400;">5 </span><img src="images/star.png"/></li>
					<li style=""><span style="vertical-align:25%;"><?php echo $row_rating["Tutorial_Rating_4"]; ?> user(s) rated this tutorial as </span><span style="vertical-align:25%;color:green;">4 </span><img src="images/star.png"/></li>
					<li style=""><span style="vertical-align:25%;"><?php echo $row_rating["Tutorial_Rating_3"]; ?> user(s) rated this tutorial as </span><span style="vertical-align:25%;color:#e5e500;">3 </span><img src="images/star.png"/></li>
					<li style=""><span style="vertical-align:25%;"><?php echo $row_rating["Tutorial_Rating_2"]; ?> user(s) rated this tutorial as </span><span style="vertical-align:25%;color:orange;">2 </span><img src="images/star.png"/></li>
					<li style=""><span style="vertical-align:25%;"><?php echo $row_rating["Tutorial_Rating_1"]; ?> user(s) rated this tutorial as </span><span style="vertical-align:25%;color:red;">1 </span><img src="images/star.png"/></li>
				</ul>
				</b>
			</div>
			<div>
				<?php
					$member=$row_tutorial["Member_ID"];
					if($member==$sess_id)
					{
						$download_stat=mysql_query("select * from buy where Tutorial_ID=$tid");
						$download_time=mysql_num_rows($download_stat);
						echo "downloaded $download_time times";
					}
				?>
			</div>
			<div style="float:left;">
				<?php
					$five=$row_rating["Tutorial_Rating_5"];
					$four=$row_rating["Tutorial_Rating_4"];
					$three=$row_rating["Tutorial_Rating_3"];
					$two=$row_rating["Tutorial_Rating_2"];
					$one=$row_rating["Tutorial_Rating_1"];
					$like=$five+$four+$three;
					$dislike=$two+$one;
				?>
				&nbsp;<img src="images/like.png"/>
				<img src="images/dislike.png"/><br/>
				<?php echo $like; ?> people
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dislike; ?> people
			</div>
			<div class='testimony'>
				<?php
				$testimony=mysql_query("select * from rating_detail where Rating_Detail_Tutorial=$tid and Rating_Detail_Comment!=''");
				while($row_testimony=mysql_fetch_assoc($testimony))
				{
				$testimony_author=$row_testimony["Rating_Detail_Member"];
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
					<p class='testimonial-author' style="margin-left:220px;"><a style="text-decoration:none;" href="uploader.php?mid=<?php echo $testimony_author; ?>"><?php echo $row_author["Member_Username"]; ?></a> | <span <?php if($testimony_author==$sess_id){ echo 'id="rated"'; } ?>><img src="<?php echo $img ?>"/></span></p>
					<blockquote class='testimonial'><p><?php echo $row_testimony["Rating_Detail_Comment"]; ?></p><?php if($testimony_author==$sess_id){ $_SESSION["review"]=$row_testimony["Rating_Detail_Comment"];?><span style="font-size:8pt;"><a style="text-decoration:none;color:green;" href="edit_review.php?tid=<?php echo $tid ?>">edit review</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#rater" onclick="RateTutorial();" style="text-decoration:none;color:green;">edit rating</a></span><?php } ?></blockquote>
					<br><br>
				</div>
				<?php
				}
				?>
			</div>
			<div class="cleaner h30"></div>
            <a href="#top" class="gototop">Go to Top</a>
            <div class="cleaner"></div>
		</div>
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
		mysql_query("update rating_detail set Rating_Detail_Comment='$review' where Rating_Detail_Member=$sess_id and Rating_Detail_Tutorial=$tid") or die("SQL ERROR");
		header ("Location: tutorial_details.php?tid=$tid");
	}
?>