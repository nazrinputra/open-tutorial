/*********************************************************************
* This script has been released with the aim that it will be useful.
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
***********************************************************************/


//This function is called automatically upon page load
$(document).ready(function() 
{	
	$("#vpb_pop_up_background").click(function()
	{
		$("#vpb_signup_pop_up_box").hide(); //Hides the sign-up box when clicked outside the form
		$("#vpb_login_pop_up_box").hide(); //Hides the login box when clicked outside the form
		$("#vpb_pop_up_background").fadeOut("slow");
	});
});

//This function displays the sign-up box when called
function vpb_show_sign_up_box()
{
	$("#vpb_pop_up_background").css({
		"opacity": "0.4"
	});
	$("#vpb_pop_up_background").fadeIn("slow");
	$("#vpb_signup_pop_up_box").fadeIn('fast');
	window.scroll(0,0);
}


//This function displays the login box when called
function vpb_show_login_box()
{
	$("#vpb_pop_up_background").css({
		"opacity": "0.4"
	});
	$("#vpb_pop_up_background").fadeIn("slow");
	$("#vpb_login_pop_up_box").fadeIn('fast');
	window.scroll(0,0);
}


//This function hides both the Sign-up Box and Login Box when called
function vpb_hide_popup_boxes()
{
	$("#vpb_signup_pop_up_box").hide(); //Hides the sign-up box when clicked outside the form
	$("#vpb_login_pop_up_box").hide(); //Hides the login box when clicked outside the form
	$("#vpb_pop_up_background").fadeOut("slow");
}