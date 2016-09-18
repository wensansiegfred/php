<form id="signup-free-plan-form" name="signup-free-plan-form" action="" method="post" onsubmit="return false">
	<ul>
		<li>
			<span id="err" class="errormessage">All fields are required.</span>
		</li>
		<li>
			<label for="email">Email:</label>
		</li>
		<li>
			<input type="text" name="email" id="email" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="emailconfirm">Retype Email:</label>
		</li>
		<li>
			<input type="text" name="emailconfirm" id="emailconfirm" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="password">Password:</label>
		</li>
		<li>
			<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="passwordconfirm">Retype Password:</label>
		</li>
		<li>
			<input type="password" name="passwordconfirm" id="passwordconfirm" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="name">Name:</label>
		</li>
		<li>
			<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" size="55"/>
		</li>
		<li>
			<label for="company">Company:</label>
		</li>
		<li>
			<input type="text" name="company" id="company" class="text ui-widget-content ui-corner-all" size="65"/>
		</li>
		<li>
			<label for="address">Address:</label>
		</li>
		<li>
			<input type="text" name="address" id="address" class="text ui-widget-content ui-corner-all" size="65"/>
		</li>
		<li>
			<label for="city">City:</label>
		</li>
		<li>
			<input type="text" name="city" id="city" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="state">State:</label>
		</li>
		<li>
			<input type="text" name="state" id="state" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="postalcode">Postal Code:</label>
		</li>
		<li>
			<input type="text" name="postalcode" id="postalcode" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="country">Country:</label>
		</li>
		<li>
			<select name="country" id="country">
				<?php 
				foreach($country as $key=>$values):
				?>
				<option value="<?php echo $values['countrycode'];?>"><?php echo $values['countryname'];?></option>
				<?php endforeach;?>
			</select>
		</li>
		<li>
			<label for="timezone">Time Zone:</label>
		</li>
		<li>
			<select name="timezone" id="timezone">
		      <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
		      <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
		      <option value="-10.0">(GMT -10:00) Hawaii</option>
		      <option value="-9.0">(GMT -9:00) Alaska</option>
		      <option value="-8.0">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
		      <option value="-7.0">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
		      <option value="-6.0">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
		      <option value="-5.0">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
		      <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
		      <option value="-3.5">(GMT -3:30) Newfoundland</option>
		      <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
		      <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
		      <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
		      <option value="0.0">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
		      <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
		      <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
		      <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
		      <option value="3.5">(GMT +3:30) Tehran</option>
		      <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
		      <option value="4.5">(GMT +4:30) Kabul</option>
		      <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
		      <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
		      <option value="5.75">(GMT +5:45) Kathmandu</option>
		      <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
		      <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
		      <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
		      <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
		      <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
		      <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
		      <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
		      <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
			</select>
		</li>
		<li>
			<label for="alertemail">Alert Email:</label>
		</li>
		<li>
			<input type="text" name="alertemail" id="alertemail" class="text ui-widget-content ui-corner-all" size="35"/>
		</li>
		<li>
			<label for="accnttype">Plan Type:</label>
		</li>
		<li>
			<select id="accnttype" name="accnttype">
				<option value="1">Paid Plan</option>
				<option value="2">Free Plan</option>
			</select>
		</li>
		<li>
			<hr/>
		</li>
		<li>
			<input type="submit" id="submit" name="submit" value="Sign In"/>&nbsp;<input type="button" id="close" value="Close"/> <span id="signupmessage">&nbsp;</span>
		</li>
	</ul>
</form>
<script>
	$(document).ready(function(){
		$('#close').click(function(){
			$( "#signup-form-dialog" ).dialog( "close" );
		});
		$('#signup-free-plan-form').validate({
			rules: {
				email: {required:true,email:true},
				emailconfirm: {required:true,email:true,equalTo:"#email"},
				password: {required:true},
				passwordconfirm: {required:true,equalTo:"#password"},
				name: {required:true},
				company: {required:true},
				address: {required:true},
				city: {required:true},
				state: {required:true},
				postalcode: {required:true},
				alertemail: {required:true,email:true}
			},
			submitHandler: function(form){
				
				var email = $("#email").val();
				var emailconfirm = $("#emailconfirm").val();
				var password = $("#password").val();
				var passwordconfirm = $("#passwordconfirm").val();
				var name = $("#name").val();
				var company = $("#company").val();
				var address = $("#address").val();
				var city = $("#city").val();
				var state = $("#state").val();
				var postalcode = $("#postalcode").val();
				var country = $("#country option:selected").val();
				var alert_email = $("alertemail").val();
				var timezone = $("#timezone option:selected").text();
				//sending user details to database
				var phpaction = 'signup/createfree';
				
				$.post(phpaction,
				{
					email:email,
					password:password,
					name:name,
					company:company,
					address:address,
					city:city,
					state:state,
					postalcode:postalcode,
					country:country,
					alertemail:alert_email,
					timezone:timezone
				},
					function(data)
					{
						
						if(data === 'SUCCESS')
						{
							$("#signupmessage").html("Sign Up Successfull.");
						}
						else
						{
							$("#signupmessage").html(data);
						}
					}
				);
			}
		});		
	});
</script>