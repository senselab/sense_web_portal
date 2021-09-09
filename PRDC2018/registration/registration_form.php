<h3 id="form">Registration Form</h3>
<br><br>
<form action="<?php require_once "include/servername.php"; echo $prdc;?>/registration/helper_registration.php" accept-charset="UTF-8" method="post" onSubmit="return validateForm()">
	<input type="hidden" name="RqID" id="RqID" value="1" />
		<!--  IEEE member  -->
	<div class="form-group "> 
		<label for="reg_type">Registration type</label>
		<select class="form-control" id="reg_type" name="reg_type" onChange="checkOptions()">
		<?php
			date_default_timezone_set('Asia/Taipei');
			$deadline = date("18-11-04 23:59");
			if(date("y-m-d h:i:s") < $deadline){
				foreach($OPT_REG_TYPE as $idx=>$reg_type){
					if($idx > 4) continue;	// skip non-early bird
					$desc = $reg_type['desc'];
					$twd = $reg_type['twd'];

					echo "<option value=$idx>$desc - TWD $twd</option>";
				}
			}
			else{
				foreach($OPT_REG_TYPE as $idx=>$reg_type){
					if($idx < 5) continue;	// skip early bird
					$desc = $reg_type['desc'];
					$twd = $reg_type['twd'];

					echo "<option value=$idx>$desc - TWD $twd</option>";
				}
			}
		?>
		</select>
	</div>

	<div class="form-group" id="div_member_num" style="margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="member_num">IEEE Membership Number <span style="color:rgb(255,0,0);">*</span></label>
			<input type="text" name="member_num" id="member_num" value="" class="form-control"/>
			<small id="notehelp_membernum" class="form-text text-muted">For those who choose Non-IEEE Member tickets in registration type above, simply leave blank.</small>
		</div>
	</div>

	
	<!--  Title  -->
	<div class="form-group">
		<label for="title">Title</label>
		<select class="form-control" id="title" name="title">
		<?php
			foreach($OPT_TITLE as $k=>$v){
				echo "<option value=$k>$v</option>";
			}
		?>
		</select>
	</div>
	
	<!--  Name  -->
	<div class="form-group">
		<label for="name">First Name <span style="color:rgb(255,0,0);">*</label>
		<input type="text" name="first" id="name" value="" class="form-control" required="required"/>
		<label for="name">Last Name <span style="color:rgb(255,0,0);">*</label>
		<input type="text" name="last" id="name" value="" class="form-control" required="required"/>
	</div>

	<!--  Affiliation  -->
	<div class="form-group">
	  <label for="affiliation">Company/Orgnization <span style="color:rgb(255,0,0);">*</label>
	  <input type="text" name="affiliation" id="affiliation" value="" class="form-control" required="required"/>
	</div>

	<!--  Department  -->
	<div class="form-group">
	  <label for="department">Department</label>
	  <input type="text" name="department" id="department" value="" class="form-control"/>
	</div>

	<!--  Department  -->
	<div class="form-group">
	  <label for="job">Job Title <span style="color:rgb(255,0,0);">*</label>
	  <input type="text" name="job" id="job" value="" class="form-control" required="required"/>
	</div>

	<!--  Address  -->
	<div class="form-group">
	  <label for="address1">Address <span style="color:rgb(255,0,0);">*</label>
	  <input type="text" name="address1" id="address1" value="" class="form-control" required="required"/>
	</div>
	<div class="form-group">
	  <label for="address2">Address 2</label>
	  <input type="text" name="address2" id="address2" value="" class="form-control"/>
	</div>
	<div class="form-group">
	  <label for="address3">Address 3</label>
	  <input type="text" name="address3" id="address3" value="" class="form-control"/>
	</div>

	<!--  Zip Code  -->
	<div class="form-group">
	  <label for="zipcode">Zip Code <span style="color:rgb(255,0,0);">*</label>
	  <input type="text" name="zipcode" id="zipcode" value="" class="form-control" required="required"/>
	</div>

	<!--  City  -->
	<div class="form-group">
	  <label for="city">City <span style="color:rgb(255,0,0);">*</label>
	  <input type="text" name="city" id="city" value="" class="form-control" required="required"/>
	</div>

	<!--  Country  -->
	<div class="form-group">
	  <label for="country">Country <span style="color:rgb(255,0,0);">*</span></label>
	  <select class="form-control"  name="country" id="country">
																<option value="" selected="selected">Choose a Country</option>
																<option value="Albania">Albania</option>

																<option value="Algeria">Algeria</option>

																<option value="Andorra">Andorra</option>

																<option value="Angola">Angola</option>

																<option value="Anguilla">Anguilla</option>

																<option value="Antigua and Barbuda">Antigua and Barbuda</option>

																<option value="Argentina">Argentina</option>

																<option value="Armenia">Armenia</option>

																<option value="Aruba">Aruba</option>

																<option value="Australia">Australia</option>

																<option value="Austria">Austria</option>

																<option value="Azerbaijan Republic">Azerbaijan Republic</option>

																<option value="Bahamas">Bahamas</option>

																<option value="Bahrain">Bahrain</option>

																<option value="Barbados">Barbados</option>

																<option value="Belgium">Belgium</option>

																<option value="Belize">Belize</option>

																<option value="Benin">Benin</option>

																<option value="Bermuda">Bermuda</option>

																<option value="Bhutan">Bhutan</option>

																<option value="Bolivia">Bolivia</option>

																<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>

																<option value="Botswana">Botswana</option>

																<option value="Brazil">Brazil</option>

																<option value="British Virgin Islands">British Virgin Islands</option>

																<option value="Brunei">Brunei</option>

																<option value="Bulgaria">Bulgaria</option>

																<option value="Burkina Faso">Burkina Faso</option>

																<option value="Burundi">Burundi</option>

																<option value="Cambodia">Cambodia</option>

																<option value="Canada">Canada</option>

																<option value="Cape Verde">Cape Verde</option>

																<option value="Cayman Islands">Cayman Islands</option>

																<option value="Chad">Chad</option>

																<option value="Chile">Chile</option>

																<option value="China">China</option>

																<option value="Colombia">Colombia</option>

																<option value="Comoros">Comoros</option>

																<option value="Cook Islands">Cook Islands</option>

																<option value="Costa Rica">Costa Rica</option>

																<option value="Croatia">Croatia</option>

																<option value="Cyprus">Cyprus</option>

																<option value="Czech Republic">Czech Republic</option>

																<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>

																<option value="Denmark">Denmark</option>

																<option value="Djibouti">Djibouti</option>

																<option value="Dominica">Dominica</option>

																<option value="Dominican Republic">Dominican Republic</option>

																<option value="Ecuador">Ecuador</option>

																<option value="El Salvador">El Salvador</option>

																<option value="Eritrea">Eritrea</option>

																<option value="Estonia">Estonia</option>

																<option value="Ethiopia">Ethiopia</option>

																<option value="Falkland Islands">Falkland Islands</option>

																<option value="Faroe Islands">Faroe Islands</option>

																<option value="Federated States of Micronesia">Federated States of Micronesia</option>

																<option value="Fiji">Fiji</option>

																<option value="Finland">Finland</option>

																<option value="France">France</option>

																<option value="French Guiana">French Guiana</option>

																<option value="French Polynesia">French Polynesia</option>

																<option value="Gabon Republic">Gabon Republic</option>

																<option value="Gambia">Gambia</option>

																<option value="Germany">Germany</option>

																<option value="Gibraltar">Gibraltar</option>

																<option value="Greece">Greece</option>

																<option value="Greenland">Greenland</option>

																<option value="Grenada">Grenada</option>

																<option value="Guadeloupe">Guadeloupe</option>

																<option value="Guatemala">Guatemala</option>

																<option value="Guinea">Guinea</option>

																<option value="Guinea Bissau">Guinea Bissau</option>

																<option value="Guyana">Guyana</option>

																<option value="Honduras">Honduras</option>

																<option value="Hong Kong">Hong Kong</option>

																<option value="Hungary">Hungary</option>

																<option value="Iceland">Iceland</option>

																<option value="India">India</option>

																<option value="Indonesia">Indonesia</option>

																<option value="Ireland">Ireland</option>
                                                                                                                                <
																<option value="Israel">Israel</option>

																<option value="Italy">Italy</option>

																<option value="Jamaica">Jamaica</option>

																<option value="Japan">Japan</option>

																<option value="Jordan">Jordan</option>

																<option value="Kazakhstan">Kazakhstan</option>

																<option value="Kenya">Kenya</option>

																<option value="Kiribati">Kiribati</option>

																<option value="Kuwait">Kuwait</option>

																<option value="Kyrgyzstan">Kyrgyzstan</option>

																<option value="Laos">Laos</option>

																<option value="Latvia">Latvia</option>

																<option value="Lesotho">Lesotho</option>

																<option value="Liechtenstein">Liechtenstein</option>

																<option value="Lithuania">Lithuania</option>

																<option value="Luxembourg">Luxembourg</option>

																<option value="Madagascar">Madagascar</option>

																<option value="Malawi">Malawi</option>

																<option value="Malaysia">Malaysia</option>

																<option value="Maldives">Maldives</option>

																<option value="Mali">Mali</option>

																<option value="Malta">Malta</option>

																<option value="Marshall Islands">Marshall Islands</option>

																<option value="Martinique">Martinique</option>

																<option value="Mauritania">Mauritania</option>

																<option value="Mauritius">Mauritius</option>

																<option value="Mayotte">Mayotte</option>

																<option value="Mexico">Mexico</option>

																<option value="Mongolia">Mongolia</option>

																<option value="Montserrat">Montserrat</option>

																<option value="Morocco">Morocco</option>

																<option value="Mozambique">Mozambique</option>

																<option value="Namibia">Namibia</option>

																<option value="Nauru">Nauru</option>

																<option value="Nepal">Nepal</option>

																<option value="Netherlands">Netherlands</option>

																<option value="Netherlands Antilles">Netherlands Antilles</option>

																<option value="New Caledonia">New Caledonia</option>

																<option value="New Zealand">New Zealand</option>

																<option value="Nicaragua">Nicaragua</option>

																<option value="Niger">Niger</option>

																<option value="Niue">Niue</option>

																<option value="Norfolk Island">Norfolk Island</option>

																<option value="Norway">Norway</option>

																<option value="Oman">Oman</option>

																<option value="Palau">Palau</option>

																<option value="Panama">Panama</option>

																<option value="Papua New Guinea">Papua New Guinea</option>

																<option value="Peru">Peru</option>

																<option value="Philippines">Philippines</option>

																<option value="Pitcairn Islands">Pitcairn Islands</option>

																<option value="Poland">Poland</option>

																<option value="Portugal">Portugal</option>

																<option value="Qatar">Qatar</option>

																<option value="Republic of the Congo">Republic of the Congo</option>

																<option value="Reunion">Reunion</option>

																<option value="Romania">Romania</option>

																<option value="Russia">Russia</option>

																<option value="Rwanda">Rwanda</option>

																<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>

																<option value="Samoa">Samoa</option>

																<option value="San Marino">San Marino</option>

																<option value="S脙拢o Tom脙漏 and Pr脙颅ncipe">S脙拢o Tom脙漏 and Pr脙颅ncipe</option>

																<option value="Saudi Arabia">Saudi Arabia</option>

																<option value="Senegal">Senegal</option>

																<option value="Seychelles">Seychelles</option>

																<option value="Singapore">Singapore</option>

																<option value="Sierra Leone">Sierra Leone</option>

																<option value="Slovakia">Slovakia</option>

																<option value="Slovenia">Slovenia</option>

																<option value="Solomon Islands">Solomon Islands</option>

																<option value="Somalia">Somalia</option>

																<option value="South Africa">South Africa</option>

																<option value="South Korea">South Korea</option>

																<option value="Spain">Spain</option>

																<option value="Sri Lanka">Sri Lanka</option>

																<option value="St. Helena">St. Helena</option>

																<option value="St. Kitts and Nevis">St. Kitts and Nevis</option>

																<option value="St. Lucia">St. Lucia</option>

																<option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>

																<option value="Suriname">Suriname</option>

																<option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>

																<option value="Swaziland">Swaziland</option>

																<option value="Sweden">Sweden</option>

																<option value="Switzerland">Switzerland</option>

																<option value="Taiwan">Taiwan</option>

																<option value="Tajikistan">Tajikistan</option>

																<option value="Tanzania">Tanzania</option>

																<option value="Thailand">Thailand</option>

																<option value="Togo">Togo</option>

																<option value="Tonga">Tonga</option>

																<option value="Trinidad and Tobago">Trinidad and Tobago</option>

																<option value="Tunisia">Tunisia</option>

																<option value="Turkey">Turkey</option>

																<option value="Turkmenistan">Turkmenistan</option>

																<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>

																<option value="Tuvalu">Tuvalu</option>

																<option value="Uganda">Uganda</option>

																<option value="Ukraine">Ukraine</option>

																<option value="United Arab Emirates">United Arab Emirates</option>

																<option value="United Kingdom">United Kingdom</option>

																<option value="United States">United States</option>

																<option value="Uruguay">Uruguay</option>

																<option value="Vanuatu">Vanuatu</option>

																<option value="Vatican City State">Vatican City State</option>

																<option value="Venezuela">Venezuela</option>

																<option value="Vietnam">Vietnam</option>

																<option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>

																<option value="Yemen">Yemen</option>

																<option value="Zambia">Zambia</option>

	</select>
	</div>

	<!--  Phone  -->
	<div class="form-group">
	  <label for="phone">Phone Number <span style="color:rgb(255,0,0);">*</label>
	  <input type="text" name="phone" id="phone" value="" class="form-control" required="required"/>
	</div>


	<!--  Paper  -->
	<div class="form-group" id="div_form_group_id" style="display:block; margin:0 auto;">
		<label for="paper">Are you authors in any of the conference tracks? <span style="color:rgb(255,0,0);">*</span></label>
		<select class="form-control" id="paper" name="paper" onChange="checkOptions()">
		<option value=""></option>
		<option value="1">Yes</option>
		<option value="0">No</option>
		</select>
	</div>
	<div class="form-group" id="div_paper_id" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="paper_id">Paper ID (EasyChair Submission Number) <span style="color:rgb(255,0,0);">*</span></label>
			<input type="text" name="paper_id" id="paper_id" value="" class="form-control"/>
			<small id="notehelp_paper_id" class="form-text text-muted">For those who didn't submit paper, simply leave blank.</small>
		</div>
	</div>

	<div class="form-group" id="div_paper_title" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="paper_title">Paper Title <span style="color:rgb(255,0,0);">*</span></label>
			<input type="text" name="paper_title" id="paper_title" value="" class="form-control"/>
			<small id="notehelp_paper_title" class="form-text text-muted">For those who didn't submit paper, simply leave blank.</small>
		</div>
	</div>

	<div class="form-group" id="div_paper_type" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="paper_type">Paper Type <span style="color:rgb(255,0,0);">*</span></label>
			<select class="form-control" id="paper_types" name="paper_types" onChange="checkOptions()">
				<option value="1">Regular Paper (main track)</option>
				<option value="2">Fast Abstracts</option>
				<option value="3">Industry Track Papers</option>
				<option value="4">Posters</option>
			</select>
		</div>
	</div>

	<div class="form-group" id="div_paper_add_pages" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="paper_pages">Purchase Addtional Pages <span style="color:rgb(255,0,0);">*</span></label>
			<select class="form-control" id="paper_pages" name="paper_pages" onChange="checkOptions()">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<small id="notehelp_paper_id" class="form-text text-muted">TWD 3200 (approximately USD 100) per page</small>
		</div>
	</div>

	<!--  Meal  -->
	<div class="form-group">
		<label for="meal">Meal Type <span style="color:rgb(255,0,0);">*</span></label>
		<select class="form-control" name="meal" id="meal">
			<option selected="selected" value="Any">Any</option>
			<option value="Vegetarian">Vegetarian</option>
		</select>
	</div>


	<!--  Additional banquet tickets  -->
	<div class="form-group">
		<label for="banquet_tickets">Additional banquet tickets</label>
		<select class="form-control" id="banquet_tickets" name="banquet_tickets">
			<?php
				for($i = 0; $i < 11; $i+=1){
					echo "<option value=$i>$i</option>";
				}
			?>
		</select>
		<small id="notehelp_banquet_tickets" class="form-text text-muted">TWD 2500 (USD 85) per ticket</small>
	</div>

    <!--  Do you need Visa supporting letter?   -->
    <div class="form-group">
		<label for="visa">Do you need Visa supporting letter? <span style="color:rgb(255,0,0);">*</span></label>
		<select class="form-control" style="width: 20%" id="visa" name="visa" onChange="checkOptions()">
		<option value=""></option>
		<option value="1">Yes</option>
		<option value="0">No</option>
		</select>
	</div>

	<!--  Nationality   -->
	<div class="form-group" id="div_visa_nation" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="visa_nation">Nationality <span style="color:rgb(255,0,0);">*</span></label>
			<select class="form-control"  name="visa_nation" id="visa_nation">
																	<option value="" selected="selected">Choose a Country</option>
																	<option value="Albania">Albania</option>

																	<option value="Algeria">Algeria</option>

																	<option value="Andorra">Andorra</option>

																	<option value="Angola">Angola</option>

																	<option value="Anguilla">Anguilla</option>

																	<option value="Antigua and Barbuda">Antigua and Barbuda</option>

																	<option value="Argentina">Argentina</option>

																	<option value="Armenia">Armenia</option>

																	<option value="Aruba">Aruba</option>

																	<option value="Australia">Australia</option>

																	<option value="Austria">Austria</option>

																	<option value="Azerbaijan Republic">Azerbaijan Republic</option>

																	<option value="Bahamas">Bahamas</option>

																	<option value="Bahrain">Bahrain</option>

																	<option value="Barbados">Barbados</option>

																	<option value="Belgium">Belgium</option>

																	<option value="Belize">Belize</option>

																	<option value="Benin">Benin</option>

																	<option value="Bermuda">Bermuda</option>

																	<option value="Bhutan">Bhutan</option>

																	<option value="Bolivia">Bolivia</option>

																	<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>

																	<option value="Botswana">Botswana</option>

																	<option value="Brazil">Brazil</option>

																	<option value="British Virgin Islands">British Virgin Islands</option>

																	<option value="Brunei">Brunei</option>

																	<option value="Bulgaria">Bulgaria</option>

																	<option value="Burkina Faso">Burkina Faso</option>

																	<option value="Burundi">Burundi</option>

																	<option value="Cambodia">Cambodia</option>

																	<option value="Canada">Canada</option>

																	<option value="Cape Verde">Cape Verde</option>

																	<option value="Cayman Islands">Cayman Islands</option>

																	<option value="Chad">Chad</option>

																	<option value="Chile">Chile</option>

																	<option value="China">China</option>

																	<option value="Colombia">Colombia</option>

																	<option value="Comoros">Comoros</option>

																	<option value="Cook Islands">Cook Islands</option>

																	<option value="Costa Rica">Costa Rica</option>

																	<option value="Croatia">Croatia</option>

																	<option value="Cyprus">Cyprus</option>

																	<option value="Czech Republic">Czech Republic</option>

																	<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>

																	<option value="Denmark">Denmark</option>

																	<option value="Djibouti">Djibouti</option>

																	<option value="Dominica">Dominica</option>

																	<option value="Dominican Republic">Dominican Republic</option>

																	<option value="Ecuador">Ecuador</option>

																	<option value="El Salvador">El Salvador</option>

																	<option value="Eritrea">Eritrea</option>

																	<option value="Estonia">Estonia</option>

																	<option value="Ethiopia">Ethiopia</option>

																	<option value="Falkland Islands">Falkland Islands</option>

																	<option value="Faroe Islands">Faroe Islands</option>

																	<option value="Federated States of Micronesia">Federated States of Micronesia</option>

																	<option value="Fiji">Fiji</option>

																	<option value="Finland">Finland</option>

																	<option value="France">France</option>

																	<option value="French Guiana">French Guiana</option>

																	<option value="French Polynesia">French Polynesia</option>

																	<option value="Gabon Republic">Gabon Republic</option>

																	<option value="Gambia">Gambia</option>

																	<option value="Germany">Germany</option>

																	<option value="Gibraltar">Gibraltar</option>

																	<option value="Greece">Greece</option>

																	<option value="Greenland">Greenland</option>

																	<option value="Grenada">Grenada</option>

																	<option value="Guadeloupe">Guadeloupe</option>

																	<option value="Guatemala">Guatemala</option>

																	<option value="Guinea">Guinea</option>

																	<option value="Guinea Bissau">Guinea Bissau</option>

																	<option value="Guyana">Guyana</option>

																	<option value="Honduras">Honduras</option>

																	<option value="Hong Kong">Hong Kong</option>

																	<option value="Hungary">Hungary</option>

																	<option value="Iceland">Iceland</option>

																	<option value="India">India</option>

																	<option value="Indonesia">Indonesia</option>

																	<option value="Ireland">Ireland</option>
	                                                                                                                                <
																	<option value="Israel">Israel</option>

																	<option value="Italy">Italy</option>

																	<option value="Jamaica">Jamaica</option>

																	<option value="Japan">Japan</option>

																	<option value="Jordan">Jordan</option>

																	<option value="Kazakhstan">Kazakhstan</option>

																	<option value="Kenya">Kenya</option>

																	<option value="Kiribati">Kiribati</option>

																	<option value="Kuwait">Kuwait</option>

																	<option value="Kyrgyzstan">Kyrgyzstan</option>

																	<option value="Laos">Laos</option>

																	<option value="Latvia">Latvia</option>

																	<option value="Lesotho">Lesotho</option>

																	<option value="Liechtenstein">Liechtenstein</option>

																	<option value="Lithuania">Lithuania</option>

																	<option value="Luxembourg">Luxembourg</option>

																	<option value="Madagascar">Madagascar</option>

																	<option value="Malawi">Malawi</option>

																	<option value="Malaysia">Malaysia</option>

																	<option value="Maldives">Maldives</option>

																	<option value="Mali">Mali</option>

																	<option value="Malta">Malta</option>

																	<option value="Marshall Islands">Marshall Islands</option>

																	<option value="Martinique">Martinique</option>

																	<option value="Mauritania">Mauritania</option>

																	<option value="Mauritius">Mauritius</option>

																	<option value="Mayotte">Mayotte</option>

																	<option value="Mexico">Mexico</option>

																	<option value="Mongolia">Mongolia</option>

																	<option value="Montserrat">Montserrat</option>

																	<option value="Morocco">Morocco</option>

																	<option value="Mozambique">Mozambique</option>

																	<option value="Namibia">Namibia</option>

																	<option value="Nauru">Nauru</option>

																	<option value="Nepal">Nepal</option>

																	<option value="Netherlands">Netherlands</option>

																	<option value="Netherlands Antilles">Netherlands Antilles</option>

																	<option value="New Caledonia">New Caledonia</option>

																	<option value="New Zealand">New Zealand</option>

																	<option value="Nicaragua">Nicaragua</option>

																	<option value="Niger">Niger</option>

																	<option value="Niue">Niue</option>

																	<option value="Norfolk Island">Norfolk Island</option>

																	<option value="Norway">Norway</option>

																	<option value="Oman">Oman</option>

																	<option value="Palau">Palau</option>

																	<option value="Panama">Panama</option>

																	<option value="Papua New Guinea">Papua New Guinea</option>

																	<option value="Peru">Peru</option>

																	<option value="Philippines">Philippines</option>

																	<option value="Pitcairn Islands">Pitcairn Islands</option>

																	<option value="Poland">Poland</option>

																	<option value="Portugal">Portugal</option>

																	<option value="Qatar">Qatar</option>

																	<option value="Republic of the Congo">Republic of the Congo</option>

																	<option value="Reunion">Reunion</option>

																	<option value="Romania">Romania</option>

																	<option value="Russia">Russia</option>

																	<option value="Rwanda">Rwanda</option>

																	<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>

																	<option value="Samoa">Samoa</option>

																	<option value="San Marino">San Marino</option>

																	<option value="S脙拢o Tom脙漏 and Pr脙颅ncipe">S脙拢o Tom脙漏 and Pr脙颅ncipe</option>

																	<option value="Saudi Arabia">Saudi Arabia</option>

																	<option value="Senegal">Senegal</option>

																	<option value="Seychelles">Seychelles</option>

																	<option value="Singapore">Singapore</option>

																	<option value="Sierra Leone">Sierra Leone</option>

																	<option value="Slovakia">Slovakia</option>

																	<option value="Slovenia">Slovenia</option>

																	<option value="Solomon Islands">Solomon Islands</option>

																	<option value="Somalia">Somalia</option>

																	<option value="South Africa">South Africa</option>

																	<option value="South Korea">South Korea</option>

																	<option value="Spain">Spain</option>

																	<option value="Sri Lanka">Sri Lanka</option>

																	<option value="St. Helena">St. Helena</option>

																	<option value="St. Kitts and Nevis">St. Kitts and Nevis</option>

																	<option value="St. Lucia">St. Lucia</option>

																	<option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>

																	<option value="Suriname">Suriname</option>

																	<option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>

																	<option value="Swaziland">Swaziland</option>

																	<option value="Sweden">Sweden</option>

																	<option value="Switzerland">Switzerland</option>

																	<option value="Taiwan">Taiwan</option>

																	<option value="Tajikistan">Tajikistan</option>

																	<option value="Tanzania">Tanzania</option>

																	<option value="Thailand">Thailand</option>

																	<option value="Togo">Togo</option>

																	<option value="Tonga">Tonga</option>

																	<option value="Trinidad and Tobago">Trinidad and Tobago</option>

																	<option value="Tunisia">Tunisia</option>

																	<option value="Turkey">Turkey</option>

																	<option value="Turkmenistan">Turkmenistan</option>

																	<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>

																	<option value="Tuvalu">Tuvalu</option>

																	<option value="Uganda">Uganda</option>

																	<option value="Ukraine">Ukraine</option>

																	<option value="United Arab Emirates">United Arab Emirates</option>

																	<option value="United Kingdom">United Kingdom</option>

																	<option value="United States">United States</option>

																	<option value="Uruguay">Uruguay</option>

																	<option value="Vanuatu">Vanuatu</option>

																	<option value="Vatican City State">Vatican City State</option>

																	<option value="Venezuela">Venezuela</option>

																	<option value="Vietnam">Vietnam</option>

																	<option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>

																	<option value="Yemen">Yemen</option>

																	<option value="Zambia">Zambia</option>
			</select>
		</div>
	</div>

	<!--  Passport   -->
	<div id="div_passport" class="form-group" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="passport" class="col-sm-4 control-label">Passport No. <span style="color:rgb(255,0,0);">*</span></label>
			<input name="passport" id="passport" type="text" placeholder="Passport No.">
		</div>
	</div>

	<!--  Place of Birth   -->
	<div id="div_place" class="form-group" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="place" class="col-sm-4 control-label">Place of Birth <span style="color:rgb(255,0,0);">*</span></label>
			<input name="place" id="place" type="text">
		</div>
	</div>

	<!--  Date of issue    -->
	<div id="div_issue" class="form-group" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="issue">Date of Issue (YYYY/MM/DD) <span style="color:rgb(255,0,0);">*</span></label>
			<input name="issue" id="issue" type="date" >
		</div>
	</div>

	<!--  Date of expiration   -->
	<div id="div_expiration" class="form-group" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="expiration">Date of Expiration (YYYY/MM/DD) <span style="color:rgb(255,0,0);">*</span></label>
			<input name="expiration" id="expiration" type="date" >
		</div>
	</div>

	<!--  Date of Birth   -->
	<div id="div_birth" class="form-group" style="display:none; margin:0 auto;">
		<div style="margin-left:5%;">
			<label for="birth">Date of Birth (YYYY/MM/DD) <span style="color:rgb(255,0,0);">*</span></label>
			<input name="birth" id="birth" type="date" >
		</div>
	</div>

	<!--  Payment method  -->
	<div class="form-group">
		<label for="payment_method">Payment method</label>
		<select class="form-control" id="payment_method" name="payment_method">
		<?php
			foreach($OPT_PAYMENT_METHOD as $k=>$v){
				echo "<option value=$k>$v</option>";
			}
		?>
		</select>
	</div>


	<!--  Email  -->
	<div class="form-group">
	  <label for="email">Email <span style="color:rgb(255,0,0);">*</span></label>
	  <input type="text" name="email" id="email" value="" class="form-control" required="required"/>
	</div>

	<div class="form-group">
	  <label for="reemail">Re-enter Email <span style="color:rgb(255,0,0);">*</span></label>
	  <input type="text" name="reemail" id="reemail" value="" class="form-control" required="required"/>
	</div>

	<!--  Agree  -->
	<div class="form-group">
		<input type="checkbox" name="confirmation" value="check" id="confirmation" required="required"/>
		I agree with the <a href="https://www.ieee.org/security-privacy.html">IEEE Privacy Policy</a> and the PRDC 2018 registration policy.
	</div>

	<!--  CAPTCHA  -->
	<!-- <div class="form-group"> -->
		<?php
            // require_once 'libs/securimage/securimage.php';
            // echo Securimage::getCaptchaHtml();
        ?>
	<!-- </div> -->
	<div id="recaptcha" class="g-recaptcha" data-sitekey="6Lc29loUAAAAAPzUY2krx47_v8KUwpsA0Hv-ckiP"></div>
	<!-- <div class="g-recaptcha" data-sitekey="6Lc29loUAAAAAPzUY2krx47_v8KUwpsA0Hv-ckiP"></div> -->
	<button id="registerBtn" name="button" type="submit" class="btn btn-primary" style="height: 30%; width: 100%"><strong>Register</strong></button>
	<div style="padding-bottom: 5%"></div>
</form>

<script type="text/javascript">
	function checkOptions(){
		var reg_type = document.getElementById("reg_type");
		var mem_num = document.getElementById("div_member_num");
		var form_paper = document.getElementById("div_form_group_id");
		var anypaper = document.getElementById("paper");
		var papertitle = document.getElementById("div_paper_title");
		var papertitlefield = document.getElementById("paper_title");
		var paperid = document.getElementById("div_paper_id");
		var paperidfield = document.getElementById("paper_id");
		var papertype = document.getElementById("div_paper_type");
		var papertypefield = document.getElementById("paper_types");
		var paperpages = document.getElementById("div_paper_add_pages");
		var paperpagefield = document.getElementById("paper_pages");
		var visa = document.getElementById("visa");
		var visa_nation = document.getElementById("div_visa_nation");
		var passport = document.getElementById("div_passport");
		var place = document.getElementById("div_place");
		var issue = document.getElementById("div_issue");
		var expiration = document.getElementById("div_expiration");
		var birth = document.getElementById("div_birth");

		if (reg_type.value == 1 || reg_type.value == 3 || reg_type.value == 6 || reg_type.value == 8){
			mem_num.style.display = 'none';
		} else{
			mem_num.style.display = 'block';
		}

		if (reg_type.value == 0 || reg_type.value == 1 || reg_type.value == 5 || reg_type.value == 6){
			form_paper.style.display = 'block';
		} else{
			anypaper.value = 0;
			form_paper.style.display = 'none';
		}

		if (anypaper.value == 1){
			papertitle.style.display = 'block';
			paperid.style.display = 'block';
			papertype.style.display = 'block';

			papertitlefield.required = true;
			paperidfield.required = true;
			papertypefield.required = true;

			if (papertypefield.value == 1 || papertypefield.value == 3){
				paperpages.style.display = 'block';
				paperpagefield.required = true;
			} else{
				paperpages.style.display = 'none';
				paperpagefield.required = false;
				paperpagefield.value = 0;
			}

		} else if (anypaper.value == 0){
			papertitle.style.display = 'none';
			paperid.style.display = 'none';
			papertype.style.display = 'none';
			paperpages.style.display = 'none';

			papertitlefield.required = false;
			paperidfield.required = false;
			papertypefield.required = false;
			paperpagefield.required = false;

			papertitlefield.value = '';
			paperidfield.value = '';
			papertypefield.value = 0;
			paperpagefield.value = 0;
		}

		

		if (visa.value == 1){
			visa_nation.style.display = 'block';
			passport.style.display = 'block';
			place.style.display = 'block';
			issue.style.display = 'block';
			expiration.style.display = 'block';
			birth.style.display = 'block';
		} else if (visa.value == 0){
			visa_nation.style.display = 'none';
			passport.style.display = 'none';
			place.style.display = 'none';
			issue.style.display = 'none';
			expiration.style.display = 'none';
			birth.style.display = 'none';
		}		

	}

	function validateForm(){
		var reg_type = document.getElementById("reg_type");
		var mem_num = document.getElementById("member_num");
		var country = document.getElementById("country");
		var email = document.getElementById("email");
		var reemail = document.getElementById("reemail");
		var agree = document.getElementById("confirmation");
		var visa = document.getElementById("visa");

		if (email.value != reemail.value){
			alert("E-mails do not match.");
			return false;
		}

		if (visa.value == 1){
			var visa_nation = document.getElementById("visa_nation");
			var passport = document.getElementById("passport");
			var place = document.getElementById("place");
			var issue = document.getElementById("issue");
			var expiration = document.getElementById("expiration");
			var birth = document.getElementById("birth");
			if (visa_nation.value == ""){
				alert("Choose a nationality.");
				return false;
			}
			else if (passport.value ==  ""){
				alert("Please input Passport No.");
				return false;
			}
			else if (place.value ==  ""){
				alert("Please input Place of Birth.");
				return false;
			}
			else if (issue.value == ""){
				alert("Please select Date of Issue.");
				return false;
			}
			else if (expiration.value == ""){
				alert("Please select Date of Expiration.");
				return false;
			}
			else if (birth.value == ""){
				alert("Please select Date of Birth.");
				return false;
			}
		}

		if (IsEmpty(country)){
			alert("Choose a country");
			return false;
		}	
		if (reg_type.value == 0 || reg_type.value == 2 || reg_type.value == 4 || reg_type.value == 5 || reg_type.value == 7 || reg_type.value == 9){
			if (IsEmpty(mem_num)){
				alert("Member number cannot be empty");
				return false;
			}
		}

		if (agree.checked == false) {
			alert("You have to confirm the acceptance of above terms before you can submit your order");
			return false;
		}

		// var check = false;
	 //    jQuery.ajax({
	 //        url: '<?php echo $sense;?>/registration/checkCAPTCHA.php',
	 //        type: 'POST',
	 //        data: jQuery('#captcha_code').serialize(),
	 //        dataType: 'json',
	 //        async : false
	 //    }).done(function(isValid) {
	 //        if (isValid == false) {
	 //            alert("Incorrect CAPTCHA.\n\n");
	 //            if (typeof window.captcha_image_audioObj !== 'undefined') captcha_image_audioObj.refresh(); 
	 //            document.getElementById('captcha_image').src = '<?php echo $sense;?>/registration/libs/securimage/securimage_show.php?' + Math.random();
	 //            jQuery('#captcha_code').val('');
	 //        } else{
	 //        	check = true;
	 //        }
	 //    });
	 //    return check;
        if(grecaptcha.getResponse() == '') {
            alert("Please complete the I'm-not-a-robot widget before submitting your entry.");
            //document.forms["entryForm"]["acceptAgrmt"].focus();
            return false;
        }
	}

	function IsEmpty(obj) {

		if (obj !== null){
			// first we trim leading and trailing spaces

			val = obj.value.trim();

			// now we check for the length of the string

			// and return true when v is not an 'empty string'

			return val.length == 0;	
		}
		return 1;
	}
</script>
