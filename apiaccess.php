<?php
/*
  Template Name: Api process
 */
get_header();
$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());
?><!-- new styles for the standard inline confirmation -->
<?php include plugin_dir_path( __FILE__ ) . '/api/apistyle.php';  ?>


<!--
Your free trial https://sdfdsfsd.microbiz.com is ready
Username : sdfdsfsd
Password : Test@123

-->



<!-- call the jQuery library if not already loaded in theme -->
<!-- the function to fade the confirmation text -->
		<script type="text/javascript">
    jQuery(document).ready(function ($) {
        setTimeout(function () {
            $("#gforms_confirmation_message").fadeOut("slow", function () {
                $("#gforms_confirmation_message").remove();
            });

        }, 2000);
    });
</script>
<div id="main-content">
<div class="container">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
		//show different confirmation messages based on the querystring value
		$email = $_GET['admin_email'];
		$company = $_GET['instance_name'];
		$string = preg_replace('/\s+/', '', $company);
		$admin_first_name = $_GET['admin_first_name'];
		$admin_last_name = $_GET['admin_last_name'];
		$Phone = $_GET['phone_number'];
		$plan = $_GET['plan'];		
		if($plan){ $instancetype="paid";}else{$instancetype="trial";}

		$parts = explode('@', $email);
		$user = $parts[0];
		$options = get_option('apico__settings');
		//echo $options[apico__text_field_0];
		$apiurl = $options[apico__text_field_0];
		$apiusername = $options[apico__text_field_1];
		$apipassword = $options[apico__text_field_2];
		$apiKey = $options[apico__text_field_3];
		$apioathoural = $options[apico__text_field_4];
		//echo $formconfirm.'<br>'.$name .'<br>'.$user;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $apiurl . "/gettestoauth",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"grant_type\"\r\n\r\nclient_credentials\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
			CURLOPT_HTTPHEADER => array(
				"authorization: Basic TWljcm9iaXpXZWJzaXRlVGVzdENsaWVudDpNaWNyb2JpeldlYnNpdGVUZXN0Q2xpZW50U2VjcmV0",
				"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$json = $response;
		$obj = json_decode($json);
		$rowtoken = $obj->{'access_token'};
		$token = "authorization: Bearer " . $rowtoken;
//echo $token;


if (!empty($_SERVER["HTTP_CLIENT_IP"])){$ip = $_SERVER["HTTP_CLIENT_IP"];}elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];}else{$ip = $_SERVER["REMOTE_ADDR"];}

		  $countrydata= array( "client_ip"=>$ip);
		  function post_to_url($url, $data, $token) {
		  $fields = '';
		  foreach($data as $key => $value) { $fields .= $key . '=' . $value . '&';}
		  rtrim($fields, '&');
		  $post = curl_init();
		  curl_setopt($post, CURLOPT_URL, $url);
		  curl_setopt($post, CURLOPT_HTTPHEADER, array('content-type: application/json'));
		  curl_setopt($post, CURLOPT_HTTPHEADER, array($token));
		  curl_setopt($post, CURLOPT_POST, count($data));
		  curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		  curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		  $response = curl_exec($post);
		  $err = curl_error($post);
		  curl_close($post);
		  $obj = json_decode($response);
		  $c_name = $obj->country_details->country_name;
		  $c_code = $obj->country_details->country_code;
		  $c_sumbol = $obj->country_details->currency_symbol;
		  $c_time_z = $obj->current_timezone;
		  echo "<label>Country &nbsp;<b>".$c_name."&nbsp;(".$c_code.")</b>&nbsp;&nbsp;&nbsp; Corrency &nbsp;<b>".$c_sumbol.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="time_icon"></span>&nbsp;'.$c_time_z."</label>";
		  }
		  
		?>

		
		<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h2>Ready to Login!</h2>
        </div>
        <div class="modal-body">
            Please wait a moment while we forward you to your new <span class="my_response"></span>
            <div class="gprnappend"></div>
        </div>
        <div class="modal-footer">
            <img src="/wp-content/uploads/2017/09/loader.gif" style="text-align:center; margin:auto;" />
        </div>
    </div>
</div>

<div class="et_pb_row et_pb_row_2 et_pb_row_1-4_1-2_1-4">
    <div class="et_pb_column et_pb_column_1_4  et_pb_column_3" style="margin: 2%;">
        <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2">
            <div class="et_pb_text_inner">
                <img src="/wp-content/uploads/2017/05/microbiz-logo-vertical-on-white-w-black-text-500x500-300-dpi-1.png" alt="">
            </div>
        </div>
    </div>
	
    <div class="et_pb_column et_pb_column_1_2  et_pb_column_4" style="margin: 0px;">
        <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_3">
            <div class="et_pb_text_inner">
                <div id="id01" class="" style="display: block;">
				<div id="oldconv">
				 <form class="" method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>">
								<h3 class="step1_title"> Set up your MicroBiz <?php echo $instancetype; ?> Store</h3>
								<input type="hidden" name="instance_type" value="<?php echo $instancetype; ?>">
								 <input type="hidden" name="plan_code" value="<?php echo $plan; ?>">
				                 <label><b>Instance Name</b></label>
                                <input type="text" id="inamess" placeholder="Instance Name" name="instance_namess" value="<?php echo $string; ?>" required />
                                <p class="formmassage">.microbiz.com</p>                                
				                <label><b>Username </b></label>
                                <input id="field_usernamess" title="Username must not be blank and contain only letters, numbers and underscores." type="text" pattern="[A-Za-z]{8,32}" name="usernamess" value="<?php echo $user; ?>" required />                            

                                <label><b>Password</b></label>
                                <input id="field_pwd1ss" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd1ss" />  

                                 <label><b>New Instance Name</b></label>
								 <input type="text" id="custoninstance" placeholder="New Instance Name" name="c_instance_namess" value="" /><p class="formmassage">.microbiz.com</p>
								
								<div class="clearfix"><button name="press" type="button" class="fback">Back</button><span>&nbsp;&nbsp;&nbsp;</span><button name="press" type="button" class="nextaction">Next</button></div>
                  </form>
				</div>
				
				
                    <form class="" id="mmform" method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>">
                        <div id='loadingmessage' style='display:none; text-align: center;padding-top: 50px;padding-bottom: 70px;'>
                            <p>This may take few seconds. Please do not close or refresh your browser.</p>
                            <img src="/wp-content/uploads/2017/09/loader.gif" />
                        </div>
                        <div class="container" id="hide" style=" padding: 0px;   width: 95%;">
                            <div id="loding" style=" background: #fff;">
                                <h4>Setup Under Way!</h4>
                                <p style="text-align: center;"><img src="/wp-content/uploads/2017/08/30.gif"></p>
                                <div id="myProgress">
                                    <div id="myBar">0%</div>
                                </div>
                                <div class="hafe">
                                    <p>Your store will be available in a few more moments.
                                        <br>
                                    </p>
                                    <p>An email will be sent to you with your login information and links to help and tutorials.
                                        <br>
                                    </p>
                                    <p>Your instance is set up with 1 store and 1 register. If you have purchased additional stores and registers these will be added.
                                        <br>
                                    </p>
                                    <p>We are very pleased you gave us this opportunity to be part of your business and if we can be of any further assistance please do not hestitate to contact us at cloudsupport@microbiz.com</p>
                                </div>
                                <br>
                            </div>
                            <div id="hideonmyBar">
                                <div class="head_title">
                                    <h3 class="step1_title"><?php the_title(); ?></h3>
                                </div>
								
                                <input type="hidden" name="instance_type" value="<?php echo $instancetype; ?>">
                                <input type="hidden" name="plan_code" value="<?php echo $plan; ?>">
                                <input type="hidden" name="admin_first_name" value="<?php echo $admin_first_name; ?>">
                                <input type="hidden" name="admin_last_name" value="<?php echo $admin_last_name; ?>">
                                <input type="hidden" name="phones" value="<?php echo $Phone; ?>">
                                <input type="hidden" name="country_code" value="US">
                                <input type="hidden" name="default_time_zone" value="America/Los_Angeles">
                                <label><b>Your Store Name</b></label>
                                <input type="text" placeholder="Store name" Id="StoreName" name="store_name" value="<?php echo $company; ?>" required onkeyup="change();" />

                                <label><b>Instance Name</b></label>
                                <input type="text" id="iname" placeholder="Instance Name" name="instance_name" value="<?php echo $string; ?>" required />
                                <p class="formmassage">.microbiz.com</p>
                                <span id="instancename" class="instance_name error"></span>

                                <label><b>Email</b></label>
                                <input type="text" placeholder="Enter Email" name="admin_email" value="<?php echo $email; ?>" required />
                                <span id="adminemail" class=" admin_email error"></span>

                                <label><b>Username </b></label>
                                <input id="field_username" title="Username must not be blank and contain only letters, numbers and underscores." type="text" pattern="[A-Za-z]{8,32}" name="username" value="<?php echo $user; ?>" required />
                                <span id="usermassage" class="error"></span>

                                <label><b>Password</b></label>
                                <input id="field_pwd1" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd1" />
                                <span id="passwordloc" class="passwordloc error"></span>

                                <label><b>Confirm Password</b></label>
                                <input id="field_pwd2" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pwd2" />
                                <span id="passwordloctwo" class="passwordloctwo error"></span>

                                <!--<progress id="progress" value="0" max="100"></progress>-->
								<?php 
										if($plan==="mbiz-chain-monthly"){
										echo '<div class="clearfix"><div class="clearfix"><button name="press" type="button" class="oldaccount">Convert My Free Trial</button><span>&nbsp;&nbsp;&nbsp;</span><button name="press" type="button" class="signupbtn">Create My Store</button></div>';
										}
										if($plan==="mbiz-single-monthly"){
										echo '<div class="clearfix"><div class="clearfix"><button name="press" type="button" class="oldaccount">Convert My Free Trial</button><span>&nbsp;&nbsp;&nbsp;</span><button name="press" type="button" class="signupbtn">Create My Store</button></div>';
										}
										if($plan==="mbiz-single-annual"){
										echo '<div class="clearfix"><div class="clearfix"><button name="press" type="button" class="oldaccount">Convert My Free Trial</button><span>&nbsp;&nbsp;&nbsp;</span><button name="press" type="button" class="signupbtn">Create My Store</button></div>';
										}
										if($plan==="mbiz-chain-annual"){
										echo '<div class="clearfix"><button name="nexTpress" type="button" class="oldaccount">Convert My Free Trial</button><span>&nbsp;&nbsp;&nbsp;</span><button name="press" type="button" class="signupbtn">Create My Store</button></div>';
										}
										if($plan===""){
										echo '<div class="clearfix">
                                    <button name="press" type="button" class="signupbtn">Create My Store</button>
                                </div>';
									}
										
								?>
								
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="et_pb_column et_pb_column_1_4  et_pb_column_5">
        <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_4">
            <div class="et_pb_text_inner">

                <div id="help" class="helplists">
                    <div class="helplist helplist1"><span></span><a target="_blank" href="https://microbiz.freshdesk.com/support/solutions/articles/9000055227-all-videos">Getting Started Video </a></div>
                    <div class="helplist helplist2"><span></span><a target="_blank" href="https://microbiz.freshdesk.com/solution/folders/9000164146">MicroBiz FAQ</a></div>
                    <div class="helplist helplist3"><span></span><a target="_blank" href="https://microbiz.freshdesk.com/support/home">Help &amp; Docs</a></div>
                    <!--<div class="helplist helplist4"><span></span><a href="#">Chat with Support</a></div>-->
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function change() {
var src = document.getElementById("StoreName");
var dest = document.getElementById("iname");
var gotandsore = src.value
dest.value = gotandsore.replace(/ /g, "");
}

jQuery(function () {
jQuery('#iname').on('keypress', function (e) {
if (e.which == 32)
	return false;
});
});

jQuery(document).ready(function ($) {
jQuery('#myProgress').hide();
jQuery('#loding').hide();
jQuery('#help').hide();
jQuery('#successs').hide();
jQuery('#myModal').hide();
jQuery('#oldconv').hide();
	
jQuery(".signupbtn").click(function () {
var instance_type = jQuery('input[name=instance_type]').val(), plan_code = jQuery('input[name=plan_code]').val(), instance_name = jQuery('input[name=instance_name ]').val(), admin_first_name = jQuery('input[name=admin_first_name]').val(), admin_last_name = jQuery('input[name=admin_last_name]').val(), phone_number = jQuery('input[name=phones]').val(), admin_email = jQuery('input[name=admin_email]').val(), username = jQuery('input[name=username]').val(),password = jQuery('input[name=pwd1]').val(), passwordtwo = jQuery('input[name=pwd2]').val(),country_code = jQuery('input[name=country_code]').val(), default_time_zone = jQuery('input[name=default_time_zone]').val(),store_name = jQuery('input[name=store_name]').val(), company_name = jQuery('input[name=store_name]').val(), str = 0,pstr = 0,istr = 0;

var froms = '<form id="mForm" name="myform" class="myform" action="https://'+ instance_name +'.microbiz.com/index.php/site/login" method="post" style="display: none;" > <input name="LoginForm[username]" id="login_form_username" type="text" value="'+username+'"> <input name="LoginForm[password]" id="login_form_password" type="text" value="'+password+'"> <input type="submit" value="Log In">  </form>';

/* instance_name validation messages */
if (instance_name != "") {
	re = /^\w+$/;
	if (instance_name.length < 8) {
		document.getElementById("instancename").innerHTML = "Error: Instance name must contain at least 8 characters!<br>";
		istr = 0;
	} else {
		document.getElementById("instancename").innerHTML = "";
		istr = 1;
	}

} else {

	document.getElementById("instancename").innerHTML = "Error: Instance name cannot be blank!<br>";
	istr = 0;
}
/* username validation messages */
if (username != "") {
	re = /^\w+$/;
	var letters = /^[A-Za-z]+$/;
	if (!re.test(username)) {
		document.getElementById("usermassage").innerHTML = "Error: Username must contain only letters, numbers and underscores!<br>";
		str = 0;
	} else if (username.length < 8) {
		document.getElementById("usermassage").innerHTML = "Error: Username must contain at least 8 characters!<br>";
		str = 0;
	} else if (!username.match(letters)) {
		document.getElementById("usermassage").innerHTML = "Error: Please input alphabet characters only as a user name!<br>";
		str = 0;
	} else {
		document.getElementById("usermassage").innerHTML = "";
		str = 1;
	}
} else {

	document.getElementById("usermassage").innerHTML = "Error: Username cannot be blank!<br>";
	str = 0;
}
/* password validation messages */
if (password != "" && password == passwordtwo) {
	nre = /[0-9]/;
	smare = /[a-z]/;
	campre = /[A-Z]/;

	if (password.length < 8) {
		document.getElementById("passwordloc").innerHTML = "Error: Password must contain at least 8 characters!<br>";
		pstr = 0;
	} else if (password == username) {
		document.getElementById("passwordloc").innerHTML = "Error: Password must be different from Username!<br>";
		pstr = 0;
	} else if (!nre.test(password)) {
		document.getElementById("passwordloc").innerHTML = "Error: Password must contain at least one number (0-9)!<br>";
		pstr = 0;
	} else if (!smare.test(password)) {
		document.getElementById("passwordloc").innerHTML = "Error: Password must contain at least one lowercase letter (a-z)!<br>";
		pstr = 0;
	} else if (!campre.test(password)) {
		document.getElementById("passwordloc").innerHTML = "Error: Password must contain at least one uppercase letter (A-Z)!<br>";
		pstr = 0;
	} else {
		pstr = 1;
		document.getElementById("passwordloc").innerHTML = " ";
		document.getElementById("passwordloctwo").innerHTML = " ";
	}
} else if (password == "") {
	document.getElementById("passwordloc").innerHTML = "Error: Passwords must not be empty!<br>";
	str = 0;
} else if (passwordtwo == "") {
	document.getElementById("passwordloctwo").innerHTML = "Error: Passwords must not be empty!<br>";
	str = 0;
} else {
	document.getElementById("passwordloc").innerHTML = "Error: Passwords do not match!<br>";
	document.getElementById("passwordloctwo").innerHTML = " ";
	str = 0;
}

if (str != 0 && pstr != 0 && istr != 0) {
	//alert("I am an alert box!");
	jQuery(".my_response").html('');
	$.ajax({
	url: "<?php echo $apiurl; ?>/instance-manager",
	beforeSend: function (xhr) {
	xhr.setRequestHeader("Authorization", "<?php echo $token; ?>");
	jQuery('#loadingmessage').show();
	jQuery('#hide').hide();
	},
	type: 'POST',
	dataType: 'json',
	contentType: 'application/json',
	processData: false,
	data: '{"instance_type":"'+ instance_type+'","instance_name":"' + instance_name + '","admin_first_name":"' + admin_first_name + '","admin_last_name":"' + admin_last_name + '","admin_email":"' + admin_email + '","username":"' + username + '","password":"' + password + '","confirm_password":"' + password + '","country_code":"US","default_time_zone":"America/Los_Angeles","store_name":"' + store_name + '","company_name":"' + store_name + '","is_required_sample_data":"1","plan_code":"'+ plan_code+'","phone_number":"' + phone_number + '"}',
success: function (data) {		
	jQuery('#loadingmessage').hide(); jQuery('#hide').show(); jQuery('#progress').show(); jQuery('#myProgress').show();
	jQuery('#loding').show(); jQuery('#success').show(); jQuery('#successs').show(); jQuery('#help').show();
	document.getElementById("passwordloc").innerHTML = " "; document.getElementById("passwordloctwo").innerHTML = " ";
	document.getElementById("adminemail").innerHTML = " "; document.getElementById("instancename").innerHTML = " ";
	jQuery('#hideonmyBar').hide();					
	var width = 10;
	var elem = document.getElementById("myBar");
	var intervalId = setInterval(function () {
		jQuery.get("<?php echo $apiurl; ?>/backgroundprocess?access_token=<?php echo $rowtoken; ?>&instance_name=" + instance_name).done(function (response) {
			if (response._embedded.background_processes[0].status === 'failed') {
				jQuery('#myModal').show();
				elem.style.backgroundColor = "red";
				jQuery(".my_response").append('<span class="sucess"> Please contact our support  (702) - 749-5353 </span> ');
			}
			if (response._embedded.background_processes[0].percent != 'undefined' && response._embedded.background_processes[0].status != 'failed') {
				if (response._embedded.background_processes[0].percent >= 100) {
					clearInterval(intervalId);
					if (data != null) {
					   	var res = data;
						jQuery('#myProgress').hide();
						jQuery('#loding').hide();
						jQuery('#help').hide();
						jQuery('#myModal').show();						
						jQuery(".gprnappend").append(froms);
						
						jQuery.each(res, function (index, value) {
							//console.log(value);
							if (index == 'instance_name') {
								jQuery(".my_response").append('<span class="sucess">Instance name: ' + value + '</span> ');
								var instance_names = value;
							}
						});
					}
					
					
					jQuery.ajax({
					type: "POST",
					url: "<?php echo get_template_directory_uri(); ?>/sendMail.php",
					data: {
						"instance_type":instance_type,"plan_code": plan_code,"is_required_sample_data":"1","admin_first_name":admin_first_name,"admin_last_name":admin_last_name,"instance_type":"trial","instance_name":instance_name,"admin_email":admin_email,"username":username,"password":password,"confirm_password":password,"country_code":"US","default_time_zone":"America/Los_Angeles","store_name":store_name,"company_name":store_name,"phone_number":phone_number},
					dataType: 'text',
					success:function(data){
                      var ress = data;
						//document.getElementById("mForm").submit();
						document.myform.submit();
					}
					});	
					
				}else {
					width++;
					elem.style.width = response._embedded.background_processes[0].percent + '%';
					elem.innerHTML = response._embedded.background_processes[0].percent * 1 + '%';
				}
				
				
			}
		});
	}, 2000);
},
	error: function (data) {
				$('#loadingmessage').hide();
				$('#hide').show();
				$('#myProgress').hide();
				document.getElementsByClassName("error").innerHTML = "";
				if (data.responseJSON != null) {
					var res = data.responseJSON;
					//console.log(res);
					jQuery.each(res, function (index, value) {
						///console.log(value);
						if (index == 'validation_messages') {
							document.getElementById("passwordloc").innerHTML = " ";	document.getElementById("passwordloctwo").innerHTML = " ";
							document.getElementById("adminemail").innerHTML = " "; document.getElementById("instancename").innerHTML = " ";
							//jQuery(".my_response").append('<li class="error">'+value+'</li>');
							jQuery.each(value, function (index, dataprpperty) {
								//console.log(dataprpperty);
								if (index == 'instance_name') { jQuery.each(dataprpperty, function (index, indexvalue) {jQuery(".instance_name").append('Error: ' + indexvalue + '<br>');})}
								if (index == 'admin_email') {jQuery.each(dataprpperty, function (index, indexvalue) {jQuery(".admin_email").append('Error: ' + indexvalue + '<br>');})}
								if (index == 'password') {jQuery.each(dataprpperty, function (index, indexvalue) {jQuery(".passwordloc").append('Error: ' + indexvalue + '<br>');})}
								if (index == 'confirm_password') { jQuery.each(dataprpperty, function (index, indexvalue) {jQuery(".passwordloctwo").append('Error: ' + indexvalue + '<br>');})}
							})
						}
					});
				}
			//console.log(data.responseJSON);
			}
			});

		}
	});

jQuery(".oldaccount").click(function () {
	jQuery('#oldconv').show();
	jQuery('#mmform').hide();
});

jQuery(".fback").click(function () {
	jQuery('#mmform').show();
	jQuery('#oldconv').hide();
	jQuery('custominstanc').remove();
});


jQuery(".nextaction").click(function () {
	var icn = jQuery('input[name=instance_namess]').val(); //trial_instance_name
	var icun = jQuery('input[name=usernamess]').val(); // username
	var icpass = jQuery('input[name=pwd1ss]').val(); // password
	var icpass = jQuery('input[name=pwd1ss]').val(); //paid_instance_name	
$.ajax({
	url: "<?php echo $apiurl; ?>/instance/convert",
	beforeSend: function (xhr) {
	xhr.setRequestHeader("Authorization", "<?php echo $token; ?>");
	jQuery('#loadingmessage').show();
	},
	type: 'POST',
	dataType: 'json',
	contentType: 'application/json',
	processData: false,
	data: '{"start_with_empty_instance:1","trial_instance_name:"' + icn + '","username":"' + icun + '","password":"' + icpass +'"}',
success: function (data) {
	jQuery('#loadingmessage').hide();
            console.log(data);
        },
error: function (data) {
	jQuery('#loadingmessage').hide();
            console.log(data);
        }
	
});


});

});
 </script>
 
                        <!-- end my code -->				
						
                        <div class="entry-content">
                            
                        </div> <!-- .entry-content -->
                       
                    </article> <!-- .et_pb_post -->
        </div> <!-- .container -->
</div> <!-- #main-content -->
<?php get_footer(); ?>

