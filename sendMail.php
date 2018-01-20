<?php

$message = '';
if($_POST){
	$admin_first_name = trim(stripslashes($_POST['admin_first_name']));
	$admin_last_name = trim(stripslashes($_POST['admin_last_name']));
	$instance_type = trim(stripslashes($_POST['instance_type']));
	$instance_name = trim(stripslashes($_POST['instance_name']));
	$admin_email = trim(stripslashes($_POST['admin_email']));
	$username = trim(stripslashes($_POST['username']));
	$password = trim(stripslashes($_POST['password']));
	$country_code = trim(stripslashes($_POST['country_code']));
	$default_time_zone = trim(stripslashes($_POST['default_time_zone']));
	$store_name = trim(stripslashes($_POST['store_name']));
	$company_name = trim(stripslashes($_POST['company_name']));
	$phone_number = trim(stripslashes($_POST['phone_number']));
	$subject = '';

	if ($subject == '') { $subject = "Free POS Trial Sign-up"; }


	$message ='<div style="margin:10px;height:auto;border:solid 1px #40454b;padding:0">
	<p style="background-color:#40454b;padding:7px">
	<img src="https://ci6.googleusercontent.com/proxy/ybCiAZRkwOAMB-knWLtgP5e4pGojYlXSW24DiKYdPDdnTnhmI0n2BM9aC_m9mrSieNoUgZFMhtZCIkUZYRMbiJa34HzvgVw_ozFzO5PedrGVB_40bPfaum3aUhfFymWuTA=s0-d-e1-ft#https://microbiz.com/skin/frontend/default/easy_cloud/images/email_logo.png" class="CToWUd"></p>
	<div style="padding: 10px; text-align: left;">'.$admin_first_name.',<br>
	<br>Thanks for your interest!<br><br>
	<div style="border:1px solid #eee;padding:5px;background-color:#eee">
	<table style="border:0 solid lightgray;border-collapse:separate;border-spacing:0 0.5em">
	<tbody><tr><td> Your free trial <a href="https://'.$instance_name.'.microbiz.com" target="_blank">https://'.$instance_name.'.microbiz.com</a> is ready </td></tr>
		
											<tr><td><b>Username</b> : '.$username.'</td></tr>
		
											<tr><td><b>Password</b> : '.$password.'</td></tr></tbody></table></div><br>Your trial expires on <span class="aBn" data-term="goog_1451393573" tabindex="0"><span class="aQJ">'.date('l d M Y', strtotime("+20 days")).'</span></span> <br><br>There are a lot of great features that may not be immediately obvious, so please call us at <a href="tel:(702)%20749-5353" value="+17027495353" target="_blank">702 749 5353</a> to schedule a one-on-one demo with a member of our sales team to answer any questions live.<br><br>To help you get started with setting up and using your trial take a look at some of our tutorials posted below!<br><br><a href="https://microbiz.freshdesk.com/support/solutions/articles/9000055171-microbiz-interactive-learning-directory" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://microbiz.freshdesk.com/support/solutions/articles/9000055171-microbiz-interactive-learning-directory&amp;source=gmail&amp;ust=1504195672043000&amp;usg=AFQjCNHjOjWSc3szbHYRiQ8zk754YI0UWQ"><u>MicroBiz Cloud Interactive Tutorials</u></a><br><br>
		
											 <a href="https://microbiz.freshdesk.com/support/solutions/9000106896" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://microbiz.freshdesk.com/support/solutions/9000106896&amp;source=gmail&amp;ust=1504195672043000&amp;usg=AFQjCNHRgon3bWYKSZ7tFrH8I1Do4dHJyQ"><u>Getting Started</u></a><br><br>
		
											 <a href="https://microbiz.freshdesk.com/support/solutions/articles/9000055275-setting-up-your-company" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://microbiz.freshdesk.com/support/solutions/articles/9000055275-setting-up-your-company&amp;source=gmail&amp;ust=1504195672043000&amp;usg=AFQjCNE_tucYOMrOYFdwaui6Kz2ozVexXg"><u>Setting Up Your Company</u></a><br><br>To connect your MicroBiz Instance with your Magento site please contact with our support team <a href="mailto:cloudsupport@microbiz.com" target="_blank">cloudsupport@microbiz.com</a> <br><br><br>Enjoy exploring your free trial, <br><br>Your Friends at MicroBiz.<div class="yj6qo"></div><div class="adL"><br></div></div></div>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if (!$error) { 
mail($admin_email, $subject, $message, $headers)
} 
else {	
echo "Error sending mail";
}
}

?>