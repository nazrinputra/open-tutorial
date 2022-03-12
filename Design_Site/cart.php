<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	$num=0;
	
    $action = isset($_GET['action']) ? $_GET['action'] : "";
     
    if($action=='removed'){
        echo "<div>" . $_GET['name'] . " was removed from cart.</div>";
    }
     
    if(isset($_SESSION['cart']) && ($_SESSION['cart']!=0)){
        $tids = "";
        foreach($_SESSION['cart'] as $tid){
            $tids = $tids . $tid . ",";
        }
         
        // remove the last comma
        $tids = rtrim($tids, ',');
		
		$query = "SELECT * FROM tutorial WHERE Tutorial_ID IN ({$tids})";
		$cart_items=mysql_query($query);
		if($tids=="")
		{$num=0;}
		else
		{$num=mysql_num_rows($cart_items);}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<title>The Open Tutorial System</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="shortcut icon" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="css/reveal.css"/>
	<script language="javascript" type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.reveal.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/vpb_script.js"></script>
	<script type="text/javascript">
		function ask(){confirm("Are you sure you want to delete the selected items?");}
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
				<li><a href="logout.php" title="Logout">Logout</a></li>
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
            <h2>Shopping Cart</h2>
            <em>View or update your shopping cart here.</em>
<div class="cleaner h30"></div>
         
			<div>
				<div class="shopping_data">
				<?php
				if($num>0)
				{
				$total_cart=0;
				?>
				<table cellspacing='0'>
					<tr>
						<th>Title</th>
						<th>Price</th>
						<th>Remove</th>
					</tr><!-- Table Header -->
					<?php
					while($cart_row=mysql_fetch_assoc($cart_items))
					{
					$price=$cart_row['Tutorial_Price'];
					$total_cart+=$price;
					?>
					<tr>
						<td><a href="tutorial_details.php?tid=<?php echo $cart_row['Tutorial_ID']; ?>"><?php echo $cart_row['Tutorial_Title']; ?></a></td>
						<td><?php if($price==0){echo "Free";}else{echo "RM ".$price;} ?></td>
						<td><a href="RemoveFromCart.php?tid=<?php echo $cart_row['Tutorial_ID']; ?>&name=<?php echo $cart_row['Tutorial_Title']; ?>"><img src="images/remove-from-cart.png" style="width:50px;height:40px;"/></a></td>
					</tr><!-- Table Row -->
					<?php
					}
					?>
				</table>
				<?php
				}
				else
				{echo "Your shopping cart is empty";}
				?>
				</div>
				
				<div class="update">
				<br><br>
				<p><a href="tutorial.php"><input type="button" name="continue_shopping" value="Continue Shopping"/></a></p>
				</div>
				
				<?php
				if($num>0){
				?>
				<div class="total_cart">
					<h3>Grand Total :	RM <?php echo number_format((float)$total_cart, 2, '.', ''); ?></h3>
				</div>
				
				<?php
				if($row["Member_Credit"]<$total_cart)
				{
				?>
				<em style="margin-left:100px;color:red;">Warning: You have insufficient credit to complete checkout</em>
				<div class="checkout-error">
				<p><a href="credit_purchase.php"><input type="button" name="checkout" value="Purchase Credit"/></a></p>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="checkout">
				<br>
				<p><a href="checkout.php?tids=<?php echo $tids; ?>"><input type="button" name="checkout" value="Checkout"/></a></p>
				</div>
				<?php
				}
				}
				?>
				
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
