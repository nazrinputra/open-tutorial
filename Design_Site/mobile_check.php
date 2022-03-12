<?php
include('dataconn.php');                                  
if (isset($_POST['mobile'])) {                                                               
    $mobile=($_POST['mobile']);                                  
    $check_for_mobile = mysql_query("SELECT * FROM member WHERE Member_Mobile='$mobile'"); 
    if (mysql_num_rows($check_for_mobile)) {
        echo json_encode(false);                                                                           
    } else {
        echo json_encode(true);
    }
}
exit;
?>