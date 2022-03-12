<?php
include('dataconn.php');                                  
if (isset($_POST['email'])) {                                                               
    $email=($_POST['email']);                                  
    $check_for_email = mysql_query("SELECT * FROM member WHERE Member_Email='$email'"); 
    if (mysql_num_rows($check_for_email)) {
        echo json_encode(false);                                                                           
    } else {
        echo json_encode(true);
    }
}
exit;
?>