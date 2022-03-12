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
		$mid=$_GET["mid"];
		$result_tutorial=mysql_query("select * from tutorial where Tutorial_ID=$tid");
		$row_tutorial=mysql_fetch_assoc($result_tutorial);
		$file=$row_tutorial["Tutorial_Location"];
		
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

			$mail             = new PHPMailer();
			$body             = "You have downloaded a tutorial from our database.";//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Downloads at OpenTutorial";
			$mail->AltBody    = "Successful download message"; //Text Body
			$mail->WordWrap   = 50; // set word wrap

			$mail->MsgHTML($body);

			$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

			//$mail->AddAttachment("/path/to/file.zip");             // attachment
			//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
			
			$memail=$row["Member_Email"];
			$mail->AddAddress("{$memail}");

			$mail->IsHTML(true); // send as HTML
			
		if(isset($_GET["bid"]))
		{
			$bid=$_GET["bid"];
			$result_member=mysql_query("select * from member where Member_ID=$bid");
			$row_member=mysql_fetch_assoc($result_member);
			$credit=$row_member["Member_Credit"];
			$price=$row_tutorial["Tutorial_Price"];
			$result_download=mysql_query("select * from buy where Member_ID=$sess_id and Tutorial_ID=$tid") or die("SQL ERROR");
			if(mysql_num_rows($result_download))
			{
				$newprice=$price/2.0;
				$price=$newprice;
			}
			$newcredit=$credit-$price;
			mysql_query("update member set Member_Credit='$newcredit' where Member_ID='$bid'");
			
			$uploader=$row_tutorial["Member_ID"];
			$result_uploader=mysql_query("select * from member where Member_ID=$uploader");
			$row_uploader=mysql_fetch_assoc($result_uploader);
			$profit=$row_uploader["Member_Profit"]+$price;
			mysql_query("update member set Member_Profit='$profit' where Member_ID=$uploader");
		}
		
			$title=$row_tutorial["Tutorial_Title"];
			$date=date("Y-m-d H:i:s");
			mysql_query("insert into buy (Buy_Item,Buy_Price,Buy_Date,Member_ID,Tutorial_ID) values ('$title','$price','$date',$sess_id,$tid)");
		
		
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			header ("Location: tutorial_details.php?tid=$tid");
			exit;
		}
	}
?>