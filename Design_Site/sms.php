<?php
 
require "SMS/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = 'AC091ecf4f24db99b0737047cae5eb1596'; 
$AuthToken = 'a7fa8783bcd97ef646ae00f8f2b34a80'; 
 
$client = new Services_Twilio($AccountSid, $AuthToken);
 
$message = $client->account->messages->create(array(
    "From" => "267-362-4610",
    "To" => "+60135711937",
    "Body" => "Welcome to OpenTutorial. You may now login to our website and access our tutorials.",
));
 
// Display a confirmation message on the screen
echo "Message Sent";

?>