<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create a Member Account</title>
    <link rel="shortcut icon" href="./img/favicon.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Simple Notify -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
</head>

<style>
    .form-container {
        padding-top: 10px;
        /* Adjust the value as needed */
    }

    body {
        /* background-image: url('/img/about-img.jpg'); */
        background-image: linear-gradient(to bottom, #0d7ef4, #00d4ff);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .form-container {
        padding-top: 10px;
        /* Adjust the value as needed */
    }
</style>

<body>

    <div style="color: #000;margin-bottom:10px">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-6">
                    <strong>
                        <form id="signupsubmit">
                            <div class="bg-light rounded h-100 p-4">
                                <img src="./UC User/img/uc logo.png" alt="UCCash Tours & Travels Logo"
                                    style="width: 150px; display: block; margin: 15px auto;"><br>
                                <h3 style="text-align: center;">Create an Account</h3>
                                <p style="text-align: center;">Sign Up to access <span style="color: #f7c128;">UCCASH
                                        TOURISM</span></p>
                                <hr>

                                <label for="Sponser ID" id="sponseridlabel"><a href="#"><span style="color: #000;">Sponser ID</a></span><a
                                        onclick="autoid()">
                                        <span style="font-size:13px;color:#f7c128;cursor: pointer;">I don't know →</span>
                                    </a>

                                </label>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="sponserid" placeholder="Sponser ID"
                                        oninput="checksponser()" onclick="clearerror()" required>
                                    <div id="sponseridShow">
                                    </div>
                                </div>

                                <label for="Name">Name<span style="color: red;"> *</span></label>
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" id="name" placeholder="Full Name"
                                        onclick="clearerror()" required>
                                </div>

                                <label for="email">Email ID<span style="color: red;"> *</span></label>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email Address"
                                        oninput="checkmail()" onclick="clearerror()" required>
                                    <div id="emailidshow">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="otp">OTP<span style="color: red;"> *</span></label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="otp" onclick="clearerror()"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label> </label>
                                        <div id="getotpactive">
                                            <button style="height: 60px;width: 100%" class="btn otpbtn btn-primary"
                                                disabled>Get OTP</button>
                                        </div>
                                    </div>
                                </div>
                                <label for="tel">Phone No<span style="color: red;"> *</span></label>
                                <div class="form-floating mb-3">
                                    <div class="input-group" style="width: 100% !important; height:calc(3.5rem + 2px);">
                                        <select id="countrycode" class="form-select form-select-sm"
                                            style="width:10px !important;">
                                            <option data-countryCode="IN" value="+91">India (+91)</option>
                                            <option value="+1">+1 (USA)</option>
                                            <option value="+44">+44 (UK)</option>
                                            <option data-countryCode="DZ" value="+213">Algeria (+213)</option>
                                            <option data-countryCode="AD" value="+376">Andorra (+376)</option>
                                            <option data-countryCode="AO" value="+244">Angola (+244)</option>
                                            <option data-countryCode="AI" value="+1264">Anguilla (+1264)</option>
                                            <option data-countryCode="AG" value="+1268">Antigua &amp; Barbuda (+1268)
                                            </option>
                                            <option data-countryCode="AR" value="+54">Argentina (+54)</option>
                                            <option data-countryCode="AM" value="+374">Armenia (+374)</option>
                                            <option data-countryCode="AW" value="+297">Aruba (+297)</option>
                                            <option data-countryCode="AU" value="+61">Australia (+61)</option>
                                            <option data-countryCode="AT" value="+43">Austria (+43)</option>
                                            <option data-countryCode="AZ" value="+994">Azerbaijan (+994)</option>
                                            <option data-countryCode="BS" value="+1242">Bahamas (+1242)</option>
                                            <option data-countryCode="BH" value="+973">Bahrain (+973)</option>
                                            <option data-countryCode="BD" value="+880">Bangladesh (+880)</option>
                                            <option data-countryCode="BB" value="+1246">Barbados (+1246)</option>
                                            <option data-countryCode="BY" value="+375">Belarus (+375)</option>
                                            <option data-countryCode="BE" value="+32">Belgium (+32)</option>
                                            <option data-countryCode="BZ" value="+501">Belize (+501)</option>
                                            <option data-countryCode="BJ" value="+229">Benin (+229)</option>
                                            <option data-countryCode="BM" value="+1441">Bermuda (+1441)</option>
                                            <option data-countryCode="BT" value="+975">Bhutan (+975)</option>
                                            <option data-countryCode="BO" value="+591">Bolivia (+591)</option>
                                            <option data-countryCode="BA" value="+387">Bosnia Herzegovina (+387)
                                            </option>
                                            <option data-countryCode="BW" value="+267">Botswana (+267)</option>
                                            <option data-countryCode="BR" value="+55">Brazil (+55)</option>
                                            <option data-countryCode="BN" value="+673">Brunei (+673)</option>
                                            <option data-countryCode="BG" value="+359">Bulgaria (+359)</option>
                                            <option data-countryCode="BF" value="+226">Burkina Faso (+226)</option>
                                            <option data-countryCode="BI" value="+257">Burundi (+257)</option>
                                            <option data-countryCode="KH" value="+855">Cambodia (+855)</option>
                                            <option data-countryCode="CM" value="+237">Cameroon (+237)</option>
                                            <option data-countryCode="CA" value="+1">Canada (+1)</option>
                                            <option data-countryCode="CV" value="+238">Cape Verde Islands (+238)
                                            </option>
                                            <option data-countryCode="KY" value="+1345">Cayman Islands (+1345)</option>
                                            <option data-countryCode="CF" value="+236">Central African Republic (+236)
                                            </option>
                                            <option data-countryCode="CL" value="+56">Chile (+56)</option>
                                            <option data-countryCode="CN" value="+86">China (+86)</option>
                                            <option data-countryCode="CO" value="+57">Colombia (+57)</option>
                                            <option data-countryCode="KM" value="+269">Comoros (+269)</option>
                                            <option data-countryCode="CG" value="+242">Congo (+242)</option>
                                            <option data-countryCode="CK" value="+682">Cook Islands (+682)</option>
                                            <option data-countryCode="CR" value="+506">Costa Rica (+506)</option>
                                            <option data-countryCode="HR" value="+385">Croatia (+385)</option>
                                            <option data-countryCode="CU" value="+53">Cuba (+53)</option>
                                            <option data-countryCode="CY" value="+90392">Cyprus North (+90392)</option>
                                            <option data-countryCode="CY" value="+357">Cyprus South (+357)</option>
                                            <option data-countryCode="CZ" value="+42">Czech Republic (+42)</option>
                                            <option data-countryCode="DK" value="+45">Denmark (+45)</option>
                                            <option data-countryCode="DJ" value="+253">Djibouti (+253)</option>
                                            <option data-countryCode="DM" value="+1809">Dominica (+1809)</option>
                                            <option data-countryCode="DO" value="+1809">Dominican Republic (+1809)
                                            </option>
                                            <option data-countryCode="EC" value="+593">Ecuador (+593)</option>
                                            <option data-countryCode="EG" value="+20">Egypt (+20)</option>
                                            <option data-countryCode="SV" value="+503">El Salvador (+503)</option>
                                            <option data-countryCode="GQ" value="+240">Equatorial Guinea (+240)</option>
                                            <option data-countryCode="ER" value="+291">Eritrea (+291)</option>
                                            <option data-countryCode="EE" value="+372">Estonia (+372)</option>
                                            <option data-countryCode="ET" value="+251">Ethiopia (+251)</option>
                                            <option data-countryCode="FK" value="+500">Falkland Islands (+500)</option>
                                            <option data-countryCode="FO" value="+298">Faroe Islands (+298)</option>
                                            <option data-countryCode="FJ" value="+679">Fiji (+679)</option>
                                            <option data-countryCode="FI" value="+358">Finland (+358)</option>
                                            <option data-countryCode="FR" value="+33">France (+33)</option>
                                            <option data-countryCode="GF" value="+594">French Guiana (+594)</option>
                                            <option data-countryCode="PF" value="+689">French Polynesia (+689)</option>
                                            <option data-countryCode="GA" value="+241">Gabon (+241)</option>
                                            <option data-countryCode="GM" value="+220">Gambia (+220)</option>
                                            <option data-countryCode="GE" value="+7880">Georgia (+7880)</option>
                                            <option data-countryCode="DE" value="+49">Germany (+49)</option>
                                            <option data-countryCode="GH" value="+233">Ghana (+233)</option>
                                            <option data-countryCode="GI" value="+350">Gibraltar (+350)</option>
                                            <option data-countryCode="GR" value="+30">Greece (+30)</option>
                                            <option data-countryCode="GL" value="+299">Greenland (+299)</option>
                                            <option data-countryCode="GD" value="+1473">Grenada (+1473)</option>
                                            <option data-countryCode="GP" value="+590">Guadeloupe (+590)</option>
                                            <option data-countryCode="GU" value="+671">Guam (+671)</option>
                                            <option data-countryCode="GT" value="+502">Guatemala (+502)</option>
                                            <option data-countryCode="GN" value="+224">Guinea (+224)</option>
                                            <option data-countryCode="GW" value="+245">Guinea - Bissau (+245)</option>
                                            <option data-countryCode="GY" value="+592">Guyana (+592)</option>
                                            <option data-countryCode="HT" value="+509">Haiti (+509)</option>
                                            <option data-countryCode="HN" value="+504">Honduras (+504)</option>
                                            <option data-countryCode="HK" value="+852">Hong Kong (+852)</option>
                                            <option data-countryCode="HU" value="+36">Hungary (+36)</option>
                                            <option data-countryCode="IS" value="+354">Iceland (+354)</option>
                                            <option data-countryCode="ID" value="+62">Indonesia (+62)</option>
                                            <option data-countryCode="IR" value="+98">Iran (+98)</option>
                                            <option data-countryCode="IQ" value="+964">Iraq (+964)</option>
                                            <option data-countryCode="IE" value="+353">Ireland (+353)</option>
                                            <option data-countryCode="IL" value="+972">Israel (+972)</option>
                                            <option data-countryCode="IT" value="+39">Italy (+39)</option>
                                            <option data-countryCode="JM" value="+1876">Jamaica (+1876)</option>
                                            <option data-countryCode="JP" value="+81">Japan (+81)</option>
                                            <option data-countryCode="JO" value="+962">Jordan (+962)</option>
                                            <option data-countryCode="KZ" value="+7">Kazakhstan (+7)</option>
                                            <option data-countryCode="KE" value="+254">Kenya (+254)</option>
                                            <option data-countryCode="KI" value="+686">Kiribati (+686)</option>
                                            <option data-countryCode="KP" value="+850">Korea North (+850)</option>
                                            <option data-countryCode="KR" value="+82">Korea South (+82)</option>
                                            <option data-countryCode="KW" value="+965">Kuwait (+965)</option>
                                            <option data-countryCode="KG" value="+996">Kyrgyzstan (+996)</option>
                                            <option data-countryCode="LA" value="+856">Laos (+856)</option>
                                            <option data-countryCode="LV" value="+371">Latvia (+371)</option>
                                            <option data-countryCode="LB" value="+961">Lebanon (+961)</option>
                                            <option data-countryCode="LS" value="+266">Lesotho (+266)</option>
                                            <option data-countryCode="LR" value="+231">Liberia (+231)</option>
                                            <option data-countryCode="LY" value="+218">Libya (+218)</option>
                                            <option data-countryCode="LI" value="+417">Liechtenstein (+417)</option>
                                            <option data-countryCode="LT" value="+370">Lithuania (+370)</option>
                                            <option data-countryCode="LU" value="+352">Luxembourg (+352)</option>
                                            <option data-countryCode="MO" value="+853">Macao (+853)</option>
                                            <option data-countryCode="MK" value="+389">Macedonia (+389)</option>
                                            <option data-countryCode="MG" value="+261">Madagascar (+261)</option>
                                            <option data-countryCode="MW" value="+265">Malawi (+265)</option>
                                            <option data-countryCode="MY" value="+60">Malaysia (+60)</option>
                                            <option data-countryCode="MV" value="+960">Maldives (+960)</option>
                                            <option data-countryCode="ML" value="+223">Mali (+223)</option>
                                            <option data-countryCode="MT" value="+356">Malta (+356)</option>
                                            <option data-countryCode="MH" value="+692">Marshall Islands (+692)</option>
                                            <option data-countryCode="MQ" value="+596">Martinique (+596)</option>
                                            <option data-countryCode="MR" value="+222">Mauritania (+222)</option>
                                            <option data-countryCode="YT" value="+269">Mayotte (+269)</option>
                                            <option data-countryCode="MX" value="+52">Mexico (+52)</option>
                                            <option data-countryCode="FM" value="+691">Micronesia (+691)</option>
                                            <option data-countryCode="MD" value="+373">Moldova (+373)</option>
                                            <option data-countryCode="MC" value="+377">Monaco (+377)</option>
                                            <option data-countryCode="MN" value="+976">Mongolia (+976)</option>
                                            <option data-countryCode="MS" value="+1664">Montserrat (+1664)</option>
                                            <option data-countryCode="MA" value="+212">Morocco (+212)</option>
                                            <option data-countryCode="MZ" value="+258">Mozambique (+258)</option>
                                            <option data-countryCode="MN" value="+95">Myanmar (+95)</option>
                                            <option data-countryCode="NA" value="+264">Namibia (+264)</option>
                                            <option data-countryCode="NR" value="+674">Nauru (+674)</option>
                                            <option data-countryCode="NP" value="+977">Nepal (+977)</option>
                                            <option data-countryCode="NL" value="+31">Netherlands (+31)</option>
                                            <option data-countryCode="NC" value="+687">New Caledonia (+687)</option>
                                            <option data-countryCode="NZ" value="+64">New Zealand (+64)</option>
                                            <option data-countryCode="NI" value="+505">Nicaragua (+505)</option>
                                            <option data-countryCode="NE" value="+227">Niger (+227)</option>
                                            <option data-countryCode="NG" value="+234">Nigeria (+234)</option>
                                            <option data-countryCode="NU" value="+683">Niue (+683)</option>
                                            <option data-countryCode="NF" value="+672">Norfolk Islands (+672)</option>
                                            <option data-countryCode="NP" value="+670">Northern Marianas (+670)</option>
                                            <option data-countryCode="NO" value="+47">Norway (+47)</option>
                                            <option data-countryCode="OM" value="+968">Oman (+968)</option>
                                            <option data-countryCode="PW" value="+680">Palau (+680)</option>
                                            <option data-countryCode="PA" value="+507">Panama (+507)</option>
                                            <option data-countryCode="PG" value="+675">Papua New Guinea (+675)</option>
                                            <option data-countryCode="PY" value="+595">Paraguay (+595)</option>
                                            <option data-countryCode="PE" value="+51">Peru (+51)</option>
                                            <option data-countryCode="PH" value="+63">Philippines (+63)</option>
                                            <option data-countryCode="PL" value="+48">Poland (+48)</option>
                                            <option data-countryCode="PT" value="+351">Portugal (+351)</option>
                                            <option data-countryCode="PR" value="+1787">Puerto Rico (+1787)</option>
                                            <option data-countryCode="QA" value="+974">Qatar (+974)</option>
                                            <option data-countryCode="RE" value="+262">Reunion (+262)</option>
                                            <option data-countryCode="RO" value="+40">Romania (+40)</option>
                                            <option data-countryCode="RU" value="+7">Russia (+7)</option>
                                            <option data-countryCode="RW" value="+250">Rwanda (+250)</option>
                                            <option data-countryCode="SM" value="+378">San Marino (+378)</option>
                                            <option data-countryCode="ST" value="+239">Sao Tome &amp; Principe (+239)
                                            </option>
                                            <option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
                                            <option data-countryCode="SN" value="+221">Senegal (+221)</option>
                                            <option data-countryCode="CS" value="+381">Serbia (+381)</option>
                                            <option data-countryCode="SC" value="+248">Seychelles (+248)</option>
                                            <option data-countryCode="SL" value="+232">Sierra Leone (+232)</option>
                                            <option data-countryCode="SG" value="+65">Singapore (+65)</option>
                                            <option data-countryCode="SK" value="+421">Slovak Republic (+421)</option>
                                            <option data-countryCode="SI" value="+386">Slovenia (+386)</option>
                                            <option data-countryCode="SB" value="+677">Solomon Islands (+677)</option>
                                            <option data-countryCode="SO" value="+252">Somalia (+252)</option>
                                            <option data-countryCode="ZA" value="+27">South Africa (+27)</option>
                                            <option data-countryCode="ES" value="+34">Spain (+34)</option>
                                            <option data-countryCode="LK" value="+94">Sri Lanka (+94)</option>
                                            <option data-countryCode="SH" value="+290">St. Helena (+290)</option>
                                            <option data-countryCode="KN" value="+1869">St. Kitts (+1869)</option>
                                            <option data-countryCode="SC" value="+1758">St. Lucia (+1758)</option>
                                            <option data-countryCode="SD" value="+249">Sudan (+249)</option>
                                            <option data-countryCode="SR" value="+597">Suriname (+597)</option>
                                            <option data-countryCode="SZ" value="+268">Swaziland (+268)</option>
                                            <option data-countryCode="SE" value="+46">Sweden (+46)</option>
                                            <option data-countryCode="CH" value="+41">Switzerland (+41)</option>
                                            <option data-countryCode="SI" value="+963">Syria (+963)</option>
                                            <option data-countryCode="TW" value="+886">Taiwan (+886)</option>
                                            <option data-countryCode="TJ" value="+7">Tajikstan (+7)</option>
                                            <option data-countryCode="TH" value="+66">Thailand (+66)</option>
                                            <option data-countryCode="TG" value="+228">Togo (+228)</option>
                                            <option data-countryCode="TO" value="+676">Tonga (+676)</option>
                                            <option data-countryCode="TT" value="+1868">Trinidad &amp; Tobago (+1868)
                                            </option>
                                            <option data-countryCode="TN" value="+216">Tunisia (+216)</option>
                                            <option data-countryCode="TR" value="+90">Turkey (+90)</option>
                                            <option data-countryCode="TM" value="+7">Turkmenistan (+7)</option>
                                            <option data-countryCode="TM" value="+993">Turkmenistan (+993)</option>
                                            <option data-countryCode="TC" value="+1649">Turks &amp; Caicos Islands
                                                (+1649)</option>
                                            <option data-countryCode="TV" value="+688">Tuvalu (+688)</option>
                                            <option data-countryCode="UG" value="+256">Uganda (+256)</option>
                                            <!-- <option data-countryCode="GB" value="+44">UK (+44)</option> -->
                                            <option data-countryCode="UA" value="+380">Ukraine (+380)</option>
                                            <option data-countryCode="AE" value="+971">United Arab Emirates (+971)
                                            </option>
                                            <option data-countryCode="UY" value="+598">Uruguay (+598)</option>
                                            <!-- <option data-countryCode="US" value="+1">USA (+1)</option> -->
                                            <option data-countryCode="UZ" value="+7">Uzbekistan (+7)</option>
                                            <option data-countryCode="VU" value="+678">Vanuatu (+678)</option>
                                            <option data-countryCode="VA" value="+379">Vatican City (+379)</option>
                                            <option data-countryCode="VE" value="+58">Venezuela (+58)</option>
                                            <option data-countryCode="VN" value="+84">Vietnam (+84)</option>
                                            <option data-countryCode="VG" value="+84">Virgin Islands - British (+1284)
                                            </option>
                                            <option data-countryCode="VI" value="+84">Virgin Islands - US (+1340)
                                            </option>
                                            <option data-countryCode="WF" value="+681">Wallis &amp; Futuna (+681)
                                            </option>
                                            <option data-countryCode="YE" value="+969">Yemen (North)(+969)</option>
                                            <option data-countryCode="YE" value="+967">Yemen (South)(+967)</option>
                                            <option data-countryCode="ZM" value="+260">Zambia (+260)</option>
                                            <option data-countryCode="ZW" value="+263">Zimbabwe (+263)</option>
                                        </select>
                                        <input type="tel" id="phonenumber" class="form-control" placeholder=""
                                            style="width:70% !important" onclick="clearerror()"
                                            pattern="[7-9]{1}[0-9]{9}" required>
                                    </div>
                                </div>
                                <label for="text">Address<span style="color: red;"> *</span></label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Address" type="address" name="address"
                                        id="address" style="height: 110px;" required></textarea>
                                </div>
                                <br>

                                <label for="city">City<span style="color: red;"> *</span></label>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="city" onclick="clearerror()"
                                        placeholder="city">
                                </div>

                                <label for="pin">Postal Code/ZIP<span style="color: red;"> *</span></label>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control form-control-lg mb-1  mt-1" name="pin"
                                        value="" onclick="clearerror()"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" id="pin">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="country">Country<span style="color: red;"> *</span></label>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="country">
                                                <option value="" selected disabled>Select Country</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="China">China</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="North Korea">North Korea</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-Leste">Timor-Leste</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Yemen">Yemen</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state">State<span style="color: red;"> *</span></label>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="state">
                                                <option value="" selected disabled>Select State</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands
                                                </option>
                                                <option value="Chandigarh">Chandigarh</option>
                                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                                <option value="Daman and Diu">Daman and Diu</option>
                                                <option value="Lakshadweep">Lakshadweep</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Puducherry">Puducherry</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <label for="Password">Password<span style="color: red;"> *</span></label>
                                <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                    <input type="password" class="form-control" id="password" onclick="clearerror()"
                                        oninput="checkrepass()" placeholder=""
                                        pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}' required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                    </button>
                                </div>
                                <div style="font-size:15px;color:red" class="mb-3 col-md-6">
                                    <div id="uppercase"><span style="font-size:20px;color:red">*</span> A capital (UPPERCASE) Letter &nbsp;</div>
                                    <div id="lowercase"><span style="font-size:20px;color:red">*</span> A lowercase (LOWERCASE) letter &nbsp;
                                    </div>
                                    <div id="special"><span style="font-size:20px;color:red">*</span> A Special Character &nbsp;</div>
                                    <div id="min8"><span style="font-size:20px;color:red">*</span> Minimum 8 characters &nbsp;</div>
                                </div>
                                <label for="rePassword">Re-enter Password<span style="color: red;"> *</span></label>
                                <div class="input-group mb-3 col-md-6" style="height: 60px;">
                                    <input type="password" class="form-control" id="repassword" oninput="checkrepass()"
                                        placeholder="" onclick="clearerror()" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglerePassword">
                                        <i class="bi bi-eye-slash" id="reeyeIcon"></i>
                                    </button>
                                </div>
                                <div id="passwordshow">
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" name="terms" type="checkbox" value="1"
                                        id="agreement" onclick="clearerror()" required>
                                    <label class="form-check-label" for="invalidCheck2">
                                        I Agree to the <a id="terms_conditions" data-terms="" target="_blank"
                                            href="./UC User/img/UCCASH Tourism Terms and Conditions.pdf">terms and
                                            conditions</a> and <a id="privacy_policy" data-privacy="" target="_blank"
                                            href="./UC User/img/UCCASH Tourism Privacy Policy.pdf">Privacy Policy</a>
                                        and <a id="payment_agreement" data-payment="" target="_blank"
                                            href="./UC User/img/UCCASH Tourism Payment Agreement.pdf">Payment
                                            Agreement</a>
                                        mentioned in this site.
                                    </label>
                                </div>
                                <div style="width:100%;" id="errorshow" align="center">

                                </div>
                                <br>
                                <div id="registerbtn" style="width:100%;" align="center">
                                    <button style="height: 60px;width: 100%" class="btn btn-primary" type="submit"
                                        disabled>Register</button>
                                </div>
                        </form><br>
                        <p style="text-align: center;">I have an Account <a href="signin.php"><span> Login
                                    →</span></a></p>
                        <div style="text-align: center;font-size:20px">
                            <a href="index.php" class="text-center mb-0">
                                <i class="fa fa-sign-out-alt"></i> Back to Site
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div></strong>




    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!--user js-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const passwordField = document.getElementById("repassword");
            const toggleButton = document.getElementById("togglerePassword");
            const eyeIcon = document.getElementById("reeyeIcon");

            toggleButton.addEventListener("click", function () {
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeIcon.classList.remove("bi-eye-slash");
                    eyeIcon.classList.add("bi-eye");
                } else {
                    passwordField.type = "password";
                    eyeIcon.classList.remove("bi-eye");
                    eyeIcon.classList.add("bi-eye-slash");
                }
            });
        });
    </script>
    <script src="./requiredFiles/js/signup.js"></script>
</body>

</html>