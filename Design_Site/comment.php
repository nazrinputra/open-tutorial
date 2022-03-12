<?php
	ob_start();
	include ("dataconn.php");
	if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
	{header ("Location: Index.php");}
	$sess_id=$_SESSION["login"];
	$result=mysql_query("select * from member where Member_ID=$sess_id");
	$row=mysql_fetch_assoc($result);
	
	if(isset($_POST['commentbtn']))
	{
		$comment=$_POST["comment"];
		$result_comment=mysql_query("select * from rating_detail where Rating_Detail_Member=$sess_id and Rating_Detail_Tutorial=$tid");
		if(mysql_num_rows($result_comment))
		{
			mysql_query("update rating_detail set Rating_Detail_Comment='$comment' where Rating_Detail_Member=$sess_id and Rating_Detail_Tutorial=$tid");
		}
		else
		{
			mysql_query("insert into rating_detail (Rating_Detail_Comment,Rating_Detail_Member,Rating_Detail_Tutorial) values ('$comment',$sess_id,$tid)");
		}
	}
?>