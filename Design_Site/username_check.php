<?php
include('dataconn.php');                                  
if (isset($_POST['username'])) {                                                               
    $username=($_POST['username']);                                  
    $check_for_username = mysql_query("SELECT * FROM MEMBER WHERE username='$username'"); 
    if (mysql_num_rows($check_for_username)) {
        echo json_encode(false);                                                                           
    } else {
        echo json_encode(true);
    }
}
exit;
?>