<?php
require_once("library.php"); // include the library file
define('EMAIL_ADD', 'putranaz94@gmail.com'); // define any notification email
define('PAYPAL_EMAIL_ADD', 'opentutorial@mmu.com'); // facilitator email which will receive payments change this email to a live paypal account id when the site goes live
require_once("paypal_class.php");
$p 				= new paypal_class(); // paypal class
$p->admin_mail 	= EMAIL_ADD; // set notification email
$action 		= $_REQUEST["action"];
include ("dataconn.php");
$sess_id=$_SESSION["login"];
$result=mysql_query("select * from member where Member_ID=$sess_id");
$row=mysql_fetch_assoc($result);

switch($action){
	case "process": // case process insert the form data in DB and process to the paypal
		
		$prod=$_POST["product_name"];
		if($prod=="RM10 Topup")
		{$_SESSION["topup"]=10;
		$topup=3.17;}
		if($prod=="RM30 Topup")
		{$_SESSION["topup"]=30;
		$topup=9.52;}
		if($prod=="RM50 Topup")
		{$_SESSION["topup"]=50;
		$topup=15.86;}
		
		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount
		$p->add_field('cmd', $_POST["cmd"]); // cmd should be _cart for cart checkout
		$p->add_field('upload', '1');
		$p->add_field('return', $this_script.'?action=success'); // return URL after the transaction got over
		$p->add_field('cancel_return', $this_script.'?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction
		$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)
		$p->add_field('currency_code', $_POST["currency_code"]);
		$p->add_field('invoice', $_POST["invoice"]);
		$p->add_field('item_name', $_POST["product_name"]);
		$p->add_field('amount', $topup);
		$p->add_field('country', 'MY');
		$p->submit_paypal_post(); // POST it to paypal
		$p->dump_fields(); // Show the posted values for a reference, comment this line before app goes live
	break;
	
	case "success": // success case to show the user payment got success
		echo '<title>Payment Done Successfully</title>';
		echo '<style>.as_wrapper{
	font-family:Arial;
	color:#333;
	font-size:14px;
	padding:20px;
	border:2px dashed #17A3F7;
	width:600px;
	margin:0 auto;
}</style>
';		echo '<div class="as_wrapper">';
		echo "<h1>Payment Transaction Done Successfully</h1>";
		echo '<h4>You will be redirected in a few moments..</h4>';
		echo '</div>';
		
		$balance=$row["Member_Credit"];
		$topup=$_SESSION['topup'];
		$newbalance=$balance+$topup;
		$date=date("Y-m-d H:i:s");
		mysql_query("update member set Member_Credit='$newbalance' where Member_ID=$sess_id");
		mysql_query("insert into topup (Topup_Amount,Topup_Date,Member_ID) values ('$topup','$date',$sess_id)") or die (MYSQL_ERROR);
		
		header ("Refresh: 5; URL=../profile.php");
	break;
	
	case "cancel": // case cancel to show user the transaction was cancelled
		echo "<h1>Transaction Cancelled";
	break;
	
	case "ipn": // IPN case to receive payment information. this case will not displayed in browser. This is server to server communication. PayPal will send the transactions each and every details to this case in secured POST menthod by server to server. 
		$trasaction_id  = $_POST["txn_id"];
		$payment_status = strtolower($_POST["payment_status"]);
		$invoice		= $_POST["invoice"];
		$log_array		= print_r($_POST, TRUE);
		$log_query		= "SELECT * FROM `paypal_log` WHERE `txn_id` = '$trasaction_id'";
		$log_check 		= mysql_query($log_query);
		if(mysql_num_rows($log_check) <= 0){
			mysql_query("INSERT INTO `paypal_log` (`txn_id`, `log`, `posted_date`) VALUES ('$trasaction_id', '$log_array', NOW())");
		}else{
			mysql_query("UPDATE `paypal_log` SET `log` = '$log_array' WHERE `txn_id` = '$trasaction_id'");
		} // Save and update the logs array
		$paypal_log_fetch 	= mysql_fetch_array(mysql_query($log_query));
		$paypal_log_id		= $paypal_log_fetch["id"];
		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
			mysql_query("UPDATE `purchases` SET `trasaction_id` = '$trasaction_id ', `log_id` = '$paypal_log_id', `payment_status` = '$payment_status' WHERE `invoice` = '$invoice'");
			$subject = 'Instant Payment Notification - Recieved Payment';
			$p->send_report($subject); // Send the notification about the transaction
		}else{
			$subject = 'Instant Payment Notification - Payment Fail';
			$p->send_report($subject); // failed notification
		}
	break;
}
?>