<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
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
	<style>
		input.switch:empty
		{
			display:none;
			padding-left:200px;
		}

		input.switch:empty ~ label
		{
			position: relative;
			float: left;
			line-height: 1.6em;
			text-indent: 4em;
			margin: 0.2em 0;
			cursor: pointer;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		}

		input.switch:empty ~ label:before, 
		input.switch:empty ~ label:after
		{
			position: absolute;
			display: block;
			top: 0;
			bottom: 0;
			left: 0;
			content: ' ';
			width: 3.6em;
			background-color: #c33;
			border-radius: 0.3em;
			box-shadow: inset 0 0.2em 0 rgba(0,0,0,0.3);
			-webkit-transition: all 100ms ease-in;
		  transition: all 100ms ease-in;
		}

		input.switch:empty ~ label:after
		{
			width: 1.4em;
			top: 0.1em;
			bottom: 0.1em;
			margin-left: 0.1em;
			background-color: #fff;
			border-radius: 0.15em;
			box-shadow: inset 0 -0.2em 0 rgba(0,0,0,0.2);
		}

		input.switch:checked ~ label:before
		{
			background-color: #393;
		}

		input.switch:checked ~ label:after
		{
			margin-left: 2.1em;
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
		$(function() {
		   $( "#uploadfrm" ).validate({
				rules:{
					subject:{
						required:true,
					},
					material:{
						required:true,
					},
					category:{
						required:true,
					},
					userfile:{
						required:true,
					},
				},
				messages:{
					title:{
						required: "Please enter a title",
					},
					price:{
						required: "Please enter a price",
					},
					subject:{
						required: "Please choose a subject",
					},
					material:{
						required: "Please choose a material type",
					},
					category:{
						required: "Please choose a category",
					},
					userfile:{
						required: "Please choose a file",
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
            <h2>Upload Tutorial</h2>
			<em style="color:red;">Can't find your subjects, materials, or category? Contact an administrator to figure it out by clicking <a href="contact.php">HERE</a></em>
			<form method="post" name="uploadfrm" id="uploadfrm" enctype="multipart/form-data">
				<table width="200">
					<tr>
						<td>
							<p>Tutorial Title:</p>
						</td>
						<td>
							<input type="text" name="title" id="title" class="required"/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Tutorial Subject:</p>
						</td>
						<td>
							<select name="subject" id="subject" class="required">
								<option value="">Please select subject..</option>
								<?php
									$result_subject=mysql_query("select * from subject where isDelete=0");
									while($row_subject=mysql_fetch_assoc($result_subject))
									{
									?>
										<option value="<?php echo $row_subject["Subject_ID"]; ?>"><?php echo $row_subject["Subject_Name"]; ?></option>
									<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<p>Tutorial Category:</p>
						</td>
						<td>
							<select name="category" id="category" class="required">
								<option value="">Please select category..</option>
								<?php
									$result_category=mysql_query("select * from category where isDelete=0");
									while($row_category=mysql_fetch_assoc($result_category))
									{
									?>
										<option value="<?php echo $row_category["Category_ID"]; ?>"><?php echo $row_category["Category_Name"]; ?></option>
									<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<p>Tutorial Material:</p>
						</td>
						<td>
							<select name="material" id="material" class="required">
								<option value="">Please select material..</option>
								<?php
									$result_material=mysql_query("select * from material where isDelete=0");
									while($row_material=mysql_fetch_assoc($result_material))
									{
									?>
										<option value="<?php echo $row_material["Material_ID"]; ?>"><?php echo $row_material["Material_Name"]; ?></option>
									<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<p>Tutorial Price:</p>
						</td>
						<td>
							RM <input type="number" name="price" id="price" class="required"/>
						</td>
					</tr>
					<tr>
						<td>Upload to all members:</td>
						<td style="padding-left:180px;">
							<input type="checkbox" id="active" name="active" class="switch" value="1" checked="checked"/>
							<label for="active">&nbsp;</label>
						</td>
					</tr>
					<tr> 
						<td>
							<input name="userfile" type="file" id="userfile"> 
						</td>
					<td><input name="upload" type="submit" class="box" id="upload" value="Upload Tutorial"></td>
					</tr>
				</table>
			</form>
        
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
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$fileName = $_POST["title"];
	$subject = $_POST["subject"];
	$category = $_POST["category"];
	$material = $_POST["material"];
	if(isset($_POST["active"]))
	{$active = $_POST["active"];}
	else
	{$active= 0;}
	$price=$_POST["price"];
	$info = pathinfo($_FILES['userfile']['name']);
	$ext = $info['extension'];
	$location = "Upload/" . $sess_id .".". $fileName .".". $ext;

	  if ($_FILES["userfile"]["error"] > 0) {
		echo "Return Code: " . $_FILES["userfile"]["error"] . "<br>";
	  } else {
		echo "Upload: " . $_FILES["userfile"]["name"] . "<br>";
		echo "Type: " . $_FILES["userfile"]["type"] . "<br>";
		echo "Size: " . ($_FILES["userfile"]["size"] / 1024) . " kB<br>";
		echo "Temp file: " . $_FILES["userfile"]["tmp_name"] . "<br>";
		if (file_exists("Upload/" . $fileName)) {
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('File <?php echo $fileName . " already exists. "; ?>', {title: 'Upload Error', titleClass: 'anim warning', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
		} else {
		  move_uploaded_file($_FILES["userfile"]["tmp_name"],
		  "Upload/" . $sess_id .".". $fileName .".". $ext);
		  echo "Stored in: Upload/" . $sess_id .".". $fileName .".". $ext;
		  
			$query = "INSERT INTO tutorial (Tutorial_Title, Tutorial_Size, Tutorial_Type, Tutorial_Price, Tutorial_Location, Member_ID, Subject_ID, Category_ID, Material_ID, isActive) ".
			"VALUES ('$fileName', '$fileSize', '$fileType', '$price', '$location', '$sess_id', '$subject', '$category', '$material', '$active')";

			mysql_query($query) or die('Error, query failed');
			$tid=mysql_insert_id();
			mysql_query("insert into tutorial_rating (Tutorial_ID) values ('$tid')");
			
			?>
				<script type="text/javascript">
					$(document).ready(function(){
						new Messi('File <?php echo "$fileName"; ?> uploaded', {title: 'Upload Successful', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
					});
				</script>
			<?php
			
			include("PHPMailer/class.phpmailer.php");
			include("PHPMailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
			//phpmailer
			$mail             = new PHPMailer();
			$body             = "Your tutorial $fileName have been uploaded to our database.";//message

			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port

			$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
			$mail->Password   = "Pujangga_94";            // GMAIL password

			$mail->From       = "open_tutorial@yourdomain.com";
			$mail->FromName   = "Administrator";
			$mail->Subject    = "Uploads at OpenTutorial";
			$mail->AltBody    = "Successful upload message"; //Text Body
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
			//phpmailer
			
			$result_follower=mysql_query("select * from follow where Follow_Member=$sess_id");
			while($row_follower=mysql_fetch_assoc($result_follower))
			{
				$following=$row_follower["Follow_Follower"];
				$result_following=mysql_query("select * from member where Member_ID=$following");
				$row_following=mysql_fetch_assoc($result_following);
				$email_following=$row_following["Member_Email"];
				$name_following=$row_following['Member_Username'];
				$name=$row["Member_Username"];
				
				//phpmailer
				$mail             = new PHPMailer();
				$body             = "Dear ".$name_following.", a member you are following in our site, ".$name."  has uploaded a new tutorial entitled ".$fileName.".";//message

				$mail->IsSMTP();
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port

				$mail->Username   = "putranaz94@gmail.com";  // GMAIL username
				$mail->Password   = "Pujangga_94";            // GMAIL password

				$mail->From       = "open_tutorial@yourdomain.com";
				$mail->FromName   = "Administrator";
				$mail->Subject    = "Following at OpenTutorial";
				$mail->AltBody    = "Follower Feeds"; //Text Body
				$mail->WordWrap   = 50; // set word wrap

				$mail->MsgHTML($body);

				$mail->AddReplyTo("replyto@yourdomain.com","Administrator");

				//$mail->AddAttachment("/path/to/file.zip");             // attachment
				//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment
				
				$mail->AddAddress("{$email_following}");

				$mail->IsHTML(true); // send as HTML

				if(!$mail->Send()) {
					echo "Mail error: " . $mail->ErrorInfo;
				} else {
					echo "Mail successful. An email has been sent to your email address.";
				}
				//phpmailer
			}
			
			header ("location: dashboard.php");
		}
	  }
} 
?>