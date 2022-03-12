<?php
	ob_start();
	include ("dataconn.php");
	
	if(isset($_POST["search"]))
	{
		$keyword=$_POST["search"];
		$search_result=mysql_query("SELECT Tutorial_Title,Subject_Name,Category_Name,Material_Name from tutorial,subject,category,material where Tutorial_Title,Subject_Name,Category_Name,Material_Name like '%$keyword%'");
		$numrows=mysql_num_rows($search_result);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
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
				<li><a a href="logout.php" title="Logout">Logout</a></li>
                <li>
                    <form name="search_frm" method="post" action="search.php">
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
            <h2>Search</h2>
            
<div class="cleaner h30"></div>
		
         <div class="search">
			 <form name="search" method="post" action="">
				  <input type="text" name="search" placeholder="Search"/>
				  <input type="radio" name="tutorial_title" value="Tutorial Title">Tutorial Title
				  <input type="radio" name="subject" value="Subject">Subject
				  <input type="radio" name="category" value="Category">Category
				  <input type="radio" name="material" value="Material">Material
				  <input type="radio" name="active" value="Active">Active
				  <input type="submit" name="search" value="Search"/>
			 </form>
		 </div>
		 
		 <div class="result_history">
			<?php "<p>" .$numrows. " result found for " .$keyword. "</p>";?>
		 </div>
		  
		 <div class="history">
			<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
				<tr><th><input type="checkbox"/></th><th>Tutorial Title</th><th>Subject</th><th>Category</th><th>Material</th><th>Active</th></tr><!-- Table Header -->
		  <?php
			while($row=mysql_fetch_assoc($search_result))
				$tutorial_title=$row['tutorial_title'];
				$subject=$row['subject'];
				$category=$row['category'];
				$material=$row['material'];
				$active=$row['active'];
		{
			?>
			<tr class='even'><td><input type="checkbox"/></td><td><a><?php echo $row['Tutorial_Title'];?></a></td><td><?php echo['Subject_Name']; ?></td><td><?php echo['Category_Name'];?></td><td><?php echo['Material_Name'];?></td><td><?php echo['isActive'];?></td></tr><!-- Darker Table Row -->
		<?php
		}
		?>
			</table>
			
			<div class="previous_btn_history">
				<input type="button" name="previous" value="Previous"/>
			</div>
			
			<div class="page">
				<p>Page 1</p>
			</div>
			
			<div class="next_btn_history">
				<input type="button" name="next" value="Next"/>
			</div>
		 </div>

            <div class="cleaner h30"></div>
            <a href="#top" class="gototop">Go to Top</a>
            <div class="cleaner"></div>	
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


<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
