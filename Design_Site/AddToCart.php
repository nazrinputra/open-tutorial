<?php
ob_start();
	
session_start();
 
// get the product id
$tid = isset($_GET['tid']) ? $_GET['tid'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 
/* 
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
 
// check if the item is in the array, if it is, do not add
if(in_array($tid, $_SESSION['cart'])){
    // redirect to product list and tell the user it was added to cart
    header('Location: tutorial_details.php?action=exists&tid=' . $tid . '&name=' . $name);
}
 
// else, add the item to the array
else{
    array_push($_SESSION['cart'], $tid);
     
    // redirect to product list and tell the user it was added to cart
    header('Location: tutorial_details.php?action=add&tid=' . $tid . '&name=' . $name);
}
 
?>