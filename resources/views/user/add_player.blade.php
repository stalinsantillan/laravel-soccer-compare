@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('user_assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('erp_assets/select2/select2.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .rangeslider--horizontal {
            height: 15px;
            top: 11px;
        }
        .rangeslider__handle {
            width: 25px;
            height: 25px;
        }
        .rangeslider--horizontal .rangeslider__handle {
            top: -5px;
        }
        .rangeslider__fill {
            background: #36A2EB;
        }
        .rangeslider__handle {
            background: #adb5b2;
            border: #bfced0;
        }
        .rangeslider {
            background: #adb5bd;
        }

        .custom-select
        {
            padding: 0 !important;
        }
        .select2-choice
        {
            padding-left: 17px !important;
            padding-top: 5px !important;
            height: 38px !important;
            color: #d2d9dc !important;
            border: 1px solid #3c4853 !important;
            background-image: linear-gradient(to top, #3c4853 0%, #3c4853 0%) !important;
        }
        .select2-arrow
        {
            padding-top: 5px !important;
            background-image: linear-gradient(to top, #3c4853 0%, #3c4853 0%) !important;
            border-left: none !important;
        }
        .select2-dropdown-open .select2-choice {
            color: #f3f4f4;
            border-bottom-color: #485561 !important;
            -webkit-box-shadow: 0 0px 0 #485561 inset;
            box-shadow: 0 0px 0 #485561 inset;
        }
        .select2-container.form-control
        {
            padding: 0 !important;
            border: none;
        }
        .select2-drop.select2-display-none.select2-with-searchbox.select2-drop-auto-width.select2-drop-active
        {
            width: 200px;
            z-index: 9999;
            max-height: 355px !important;
            overflow-y: auto;
            background: #485561;
            color: white;
        }
        .select2-drop.select2-display-none.select2-drop-auto-width.select2-drop-active
        {
            width: 200px;
            z-index: 9999;
            max-height: 355px !important;
            overflow-y: auto;
            background: #485561;
            color: white;
        }
        .select2-search
        {
            background: #485561 !important;
        }
        .select2-results .select2-no-results, .select2-results .select2-searching, .select2-results .select2-ajax-error, .select2-results .select2-selection-limit
        {
            background: #485561 !important;
        }
        .select2-drop-mask
        {
            /* z-index: -1 !important; */
        }
        .custom-select
        {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/">Soccer</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('cruds.player.title') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('global.add') }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('global.add') }} {{ trans('cruds.player.title') }}</h4>
        </div>
    </div>
</div>
<!-- end page title --> 
<div class="card">
    <div class="card-header font-16">
        Profile
    </div>
    <div class="card-body">
        <form role="form" class="parsley-examples">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="name" class="col-md-4 col-form-label text-right">
                                Name<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="surname" class="col-md-4 col-form-label text-right">
                                Surname
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="surname" name="surname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="nationality" class="col-md-4 col-form-label text-right">
                                Nationality<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <select class="custom-select mr-sm-2" id="touch_country">
{{--                                    <option data-countryCode="DZ" value="213">Algeria (+213)</option>--}}
{{--                                    <option data-countryCode="AD" value="376">Andorra (+376)</option>--}}
{{--                                    <option data-countryCode="AO" value="244">Angola (+244)</option>--}}
{{--                                    <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>--}}
{{--                                    <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>--}}
{{--                                    <option data-countryCode="AR" value="54">Argentina (+54)</option>--}}
{{--                                    <option data-countryCode="AM" value="374">Armenia (+374)</option>--}}
{{--                                    <option data-countryCode="AW" value="297">Aruba (+297)</option>--}}
{{--                                    <option data-countryCode="AU" value="61">Australia (+61)</option>--}}
{{--                                    <option data-countryCode="AT" value="43">Austria (+43)</option>--}}
{{--                                    <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>--}}
{{--                                    <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>--}}
{{--                                    <option data-countryCode="BH" value="973">Bahrain (+973)</option>--}}
{{--                                    <option data-countryCode="BD" value="880">Bangladesh (+880)</option>--}}
{{--                                    <option data-countryCode="BB" value="1246">Barbados (+1246)</option>--}}
{{--                                    <option data-countryCode="BY" value="375">Belarus (+375)</option>--}}
{{--                                    <option data-countryCode="BE" value="32">Belgium (+32)</option>--}}
{{--                                    <option data-countryCode="BZ" value="501">Belize (+501)</option>--}}
{{--                                    <option data-countryCode="BJ" value="229">Benin (+229)</option>--}}
{{--                                    <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>--}}
{{--                                    <option data-countryCode="BT" value="975">Bhutan (+975)</option>--}}
{{--                                    <option data-countryCode="BO" value="591">Bolivia (+591)</option>--}}
{{--                                    <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>--}}
{{--                                    <option data-countryCode="BW" value="267">Botswana (+267)</option>--}}
{{--                                    <option data-countryCode="BR" value="55">Brazil (+55)</option>--}}
{{--                                    <option data-countryCode="BN" value="673">Brunei (+673)</option>--}}
{{--                                    <option data-countryCode="BG" value="359">Bulgaria (+359)</option>--}}
{{--                                    <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>--}}
{{--                                    <option data-countryCode="BI" value="257">Burundi (+257)</option>--}}
{{--                                    <option data-countryCode="KH" value="855">Cambodia (+855)</option>--}}
{{--                                    <option data-countryCode="CM" value="237">Cameroon (+237)</option>--}}
{{--                                    <option data-countryCode="CA" value="1">Canada (+1)</option>--}}
{{--                                    <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>--}}
{{--                                    <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>--}}
{{--                                    <option data-countryCode="CF" value="236">Central African Republic (+236)</option>--}}
{{--                                    <option data-countryCode="CL" value="56">Chile (+56)</option>--}}
{{--                                    <option data-countryCode="CN" value="86">China (+86)</option>--}}
{{--                                    <option data-countryCode="CO" value="57">Colombia (+57)</option>--}}
{{--                                    <option data-countryCode="KM" value="269">Comoros (+269)</option>--}}
{{--                                    <option data-countryCode="CG" value="242">Congo (+242)</option>--}}
{{--                                    <option data-countryCode="CK" value="682">Cook Islands (+682)</option>--}}
{{--                                    <option data-countryCode="CR" value="506">Costa Rica (+506)</option>--}}
{{--                                    <option data-countryCode="HR" value="385">Croatia (+385)</option>--}}
{{--                                    <option data-countryCode="CU" value="53">Cuba (+53)</option>--}}
{{--                                    <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>--}}
{{--                                    <option data-countryCode="CY" value="357">Cyprus South (+357)</option>--}}
{{--                                    <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>--}}
{{--                                    <option data-countryCode="DK" value="45">Denmark (+45)</option>--}}
{{--                                    <option data-countryCode="DJ" value="253">Djibouti (+253)</option>--}}
{{--                                    <option data-countryCode="DM" value="1809">Dominica (+1809)</option>--}}
{{--                                    <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>--}}
{{--                                    <option data-countryCode="EC" value="593">Ecuador (+593)</option>--}}
{{--                                    <option data-countryCode="EG" value="20">Egypt (+20)</option>--}}
{{--                                    <option data-countryCode="SV" value="503">El Salvador (+503)</option>--}}
{{--                                    <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>--}}
{{--                                    <option data-countryCode="ER" value="291">Eritrea (+291)</option>--}}
{{--                                    <option data-countryCode="EE" value="372">Estonia (+372)</option>--}}
{{--                                    <option data-countryCode="ET" value="251">Ethiopia (+251)</option>--}}
{{--                                    <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>--}}
{{--                                    <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>--}}
{{--                                    <option data-countryCode="FJ" value="679">Fiji (+679)</option>--}}
{{--                                    <option data-countryCode="FI" value="358">Finland (+358)</option>--}}
{{--                                    <option data-countryCode="FR" value="33">France (+33)</option>--}}
{{--                                    <option data-countryCode="GF" value="594">French Guiana (+594)</option>--}}
{{--                                    <option data-countryCode="PF" value="689">French Polynesia (+689)</option>--}}
{{--                                    <option data-countryCode="GA" value="241">Gabon (+241)</option>--}}
{{--                                    <option data-countryCode="GM" value="220">Gambia (+220)</option>--}}
{{--                                    <option data-countryCode="GE" value="7880">Georgia (+7880)</option>--}}
{{--                                    <option data-countryCode="DE" value="49">Germany (+49)</option>--}}
{{--                                    <option data-countryCode="GH" value="233">Ghana (+233)</option>--}}
{{--                                    <option data-countryCode="GI" value="350">Gibraltar (+350)</option>--}}
{{--                                    <option data-countryCode="GR" value="30">Greece (+30)</option>--}}
{{--                                    <option data-countryCode="GL" value="299">Greenland (+299)</option>--}}
{{--                                    <option data-countryCode="GD" value="1473">Grenada (+1473)</option>--}}
{{--                                    <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>--}}
{{--                                    <option data-countryCode="GU" value="671">Guam (+671)</option>--}}
{{--                                    <option data-countryCode="GT" value="502">Guatemala (+502)</option>--}}
{{--                                    <option data-countryCode="GN" value="224">Guinea (+224)</option>--}}
{{--                                    <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>--}}
{{--                                    <option data-countryCode="GY" value="592">Guyana (+592)</option>--}}
{{--                                    <option data-countryCode="HT" value="509">Haiti (+509)</option>--}}
{{--                                    <option data-countryCode="HN" value="504">Honduras (+504)</option>--}}
{{--                                    <option data-countryCode="HK" value="852">Hong Kong (+852)</option>--}}
{{--                                    <option data-countryCode="HU" value="36">Hungary (+36)</option>--}}
{{--                                    <option data-countryCode="IS" value="354">Iceland (+354)</option>--}}
{{--                                    <option data-countryCode="IN" value="91">India (+91)</option>--}}
{{--                                    <option data-countryCode="ID" value="62">Indonesia (+62)</option>--}}
{{--                                    <option data-countryCode="IR" value="98">Iran (+98)</option>--}}
{{--                                    <option data-countryCode="IQ" value="964">Iraq (+964)</option>--}}
{{--                                    <option data-countryCode="IE" value="353">Ireland (+353)</option>--}}
{{--                                    <option data-countryCode="IL" value="972">Israel (+972)</option>--}}
{{--                                    <option data-countryCode="IT" value="39">Italy (+39)</option>--}}
{{--                                    <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>--}}
{{--                                    <option data-countryCode="JP" value="81">Japan (+81)</option>--}}
{{--                                    <option data-countryCode="JO" value="962">Jordan (+962)</option>--}}
{{--                                    <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>--}}
{{--                                    <option data-countryCode="KE" value="254">Kenya (+254)</option>--}}
{{--                                    <option data-countryCode="KI" value="686">Kiribati (+686)</option>--}}
{{--                                    <option data-countryCode="KP" value="850">Korea North (+850)</option>--}}
{{--                                    <option data-countryCode="KR" value="82">Korea South (+82)</option>--}}
{{--                                    <option data-countryCode="KW" value="965">Kuwait (+965)</option>--}}
{{--                                    <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>--}}
{{--                                    <option data-countryCode="LA" value="856">Laos (+856)</option>--}}
{{--                                    <option data-countryCode="LV" value="371">Latvia (+371)</option>--}}
{{--                                    <option data-countryCode="LB" value="961">Lebanon (+961)</option>--}}
{{--                                    <option data-countryCode="LS" value="266">Lesotho (+266)</option>--}}
{{--                                    <option data-countryCode="LR" value="231">Liberia (+231)</option>--}}
{{--                                    <option data-countryCode="LY" value="218">Libya (+218)</option>--}}
{{--                                    <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>--}}
{{--                                    <option data-countryCode="LT" value="370">Lithuania (+370)</option>--}}
{{--                                    <option data-countryCode="LU" value="352">Luxembourg (+352)</option>--}}
{{--                                    <option data-countryCode="MO" value="853">Macao (+853)</option>--}}
{{--                                    <option data-countryCode="MK" value="389">Macedonia (+389)</option>--}}
{{--                                    <option data-countryCode="MG" value="261">Madagascar (+261)</option>--}}
{{--                                    <option data-countryCode="MW" value="265">Malawi (+265)</option>--}}
{{--                                    <option data-countryCode="MY" value="60">Malaysia (+60)</option>--}}
{{--                                    <option data-countryCode="MV" value="960">Maldives (+960)</option>--}}
{{--                                    <option data-countryCode="ML" value="223">Mali (+223)</option>--}}
{{--                                    <option data-countryCode="MT" value="356">Malta (+356)</option>--}}
{{--                                    <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>--}}
{{--                                    <option data-countryCode="MQ" value="596">Martinique (+596)</option>--}}
{{--                                    <option data-countryCode="MR" value="222">Mauritania (+222)</option>--}}
{{--                                    <option data-countryCode="YT" value="269">Mayotte (+269)</option>--}}
{{--                                    <option data-countryCode="MX" value="52">Mexico (+52)</option>--}}
{{--                                    <option data-countryCode="FM" value="691">Micronesia (+691)</option>--}}
{{--                                    <option data-countryCode="MD" value="373">Moldova (+373)</option>--}}
{{--                                    <option data-countryCode="MC" value="377">Monaco (+377)</option>--}}
{{--                                    <option data-countryCode="MN" value="976">Mongolia (+976)</option>--}}
{{--                                    <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>--}}
{{--                                    <option data-countryCode="MA" value="212">Morocco (+212)</option>--}}
{{--                                    <option data-countryCode="MZ" value="258">Mozambique (+258)</option>--}}
{{--                                    <option data-countryCode="MN" value="95">Myanmar (+95)</option>--}}
{{--                                    <option data-countryCode="NA" value="264">Namibia (+264)</option>--}}
{{--                                    <option data-countryCode="NR" value="674">Nauru (+674)</option>--}}
{{--                                    <option data-countryCode="NP" value="977">Nepal (+977)</option>--}}
{{--                                    <option data-countryCode="NL" value="31">Netherlands (+31)</option>--}}
{{--                                    <option data-countryCode="NC" value="687">New Caledonia (+687)</option>--}}
{{--                                    <option data-countryCode="NZ" value="64">New Zealand (+64)</option>--}}
{{--                                    <option data-countryCode="NI" value="505">Nicaragua (+505)</option>--}}
{{--                                    <option data-countryCode="NE" value="227">Niger (+227)</option>--}}
{{--                                    <option data-countryCode="NG" value="234">Nigeria (+234)</option>--}}
{{--                                    <option data-countryCode="NU" value="683">Niue (+683)</option>--}}
{{--                                    <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>--}}
{{--                                    <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>--}}
{{--                                    <option data-countryCode="NO" value="47">Norway (+47)</option>--}}
{{--                                    <option data-countryCode="OM" value="968">Oman (+968)</option>--}}
{{--                                    <option data-countryCode="PW" value="680">Palau (+680)</option>--}}
{{--                                    <option data-countryCode="PA" value="507">Panama (+507)</option>--}}
{{--                                    <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>--}}
{{--                                    <option data-countryCode="PY" value="595">Paraguay (+595)</option>--}}
{{--                                    <option data-countryCode="PE" value="51">Peru (+51)</option>--}}
{{--                                    <option data-countryCode="PH" value="63">Philippines (+63)</option>--}}
{{--                                    <option data-countryCode="PL" value="48">Poland (+48)</option>--}}
{{--                                    <option data-countryCode="PT" value="351">Portugal (+351)</option>--}}
{{--                                    <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>--}}
{{--                                    <option data-countryCode="QA" value="974">Qatar (+974)</option>--}}
{{--                                    <option data-countryCode="RE" value="262">Reunion (+262)</option>--}}
{{--                                    <option data-countryCode="RO" value="40">Romania (+40)</option>--}}
{{--                                    <option data-countryCode="RU" value="7">Russia (+7)</option>--}}
{{--                                    <option data-countryCode="RW" value="250">Rwanda (+250)</option>--}}
{{--                                    <option data-countryCode="SM" value="378">San Marino (+378)</option>--}}
{{--                                    <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>--}}
{{--                                    <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>--}}
{{--                                    <option data-countryCode="SN" value="221">Senegal (+221)</option>--}}
{{--                                    <option data-countryCode="CS" value="381">Serbia (+381)</option>--}}
{{--                                    <option data-countryCode="SC" value="248">Seychelles (+248)</option>--}}
{{--                                    <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>--}}
{{--                                    <option data-countryCode="SG" value="65">Singapore (+65)</option>--}}
{{--                                    <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>--}}
{{--                                    <option data-countryCode="SI" value="386">Slovenia (+386)</option>--}}
{{--                                    <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>--}}
{{--                                    <option data-countryCode="SO" value="252">Somalia (+252)</option>--}}
{{--                                    <option data-countryCode="ZA" value="27">South Africa (+27)</option>--}}
{{--                                    <option data-countryCode="ES" value="34">Spain (+34)</option>--}}
{{--                                    <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>--}}
{{--                                    <option data-countryCode="SH" value="290">St. Helena (+290)</option>--}}
{{--                                    <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>--}}
{{--                                    <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>--}}
{{--                                    <option data-countryCode="SD" value="249">Sudan (+249)</option>--}}
{{--                                    <option data-countryCode="SR" value="597">Suriname (+597)</option>--}}
{{--                                    <option data-countryCode="SZ" value="268">Swaziland (+268)</option>--}}
{{--                                    <option data-countryCode="SE" value="46">Sweden (+46)</option>--}}
{{--                                    <option data-countryCode="CH" value="41">Switzerland (+41)</option>--}}
{{--                                    <option data-countryCode="SI" value="963">Syria (+963)</option>--}}
{{--                                    <option data-countryCode="TW" value="886">Taiwan (+886)</option>--}}
{{--                                    <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>--}}
{{--                                    <option data-countryCode="TH" value="66">Thailand (+66)</option>--}}
{{--                                    <option data-countryCode="TG" value="228">Togo (+228)</option>--}}
{{--                                    <option data-countryCode="TO" value="676">Tonga (+676)</option>--}}
{{--                                    <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>--}}
{{--                                    <option data-countryCode="TN" value="216">Tunisia (+216)</option>--}}
{{--                                    <option data-countryCode="TR" value="90">Turkey (+90)</option>--}}
{{--                                    <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>--}}
{{--                                    <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>--}}
{{--                                    <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>--}}
{{--                                    <option data-countryCode="TV" value="688">Tuvalu (+688)</option>--}}
{{--                                    <option data-countryCode="UG" value="256">Uganda (+256)</option>--}}
{{--                                    <option data-countryCode="UA" value="380">Ukraine (+380)</option>--}}
{{--                                    <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>--}}
{{--                                    <option data-countryCode="UY" value="598">Uruguay (+598)</option>--}}
{{--                                    <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>--}}
{{--                                    <option data-countryCode="VU" value="678">Vanuatu (+678)</option>--}}
{{--                                    <option data-countryCode="VA" value="379">Vatican City (+379)</option>--}}
{{--                                    <option data-countryCode="VE" value="58">Venezuela (+58)</option>--}}
{{--                                    <option data-countryCode="VN" value="84">Vietnam (+84)</option>--}}
{{--                                    <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>--}}
{{--                                    <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>--}}
{{--                                    <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>--}}
{{--                                    <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>--}}
{{--                                    <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>--}}
{{--                                    <option data-countryCode="ZM" value="260">Zambia (+260)</option>--}}
{{--                                    <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="birthdate" class="col-md-4 col-form-label text-right">
                                Date of birth<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="birthdate" name="birthdate">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="height" class="col-md-4 col-form-label text-right">
                                Height<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="height" name="height">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="weight" class="col-md-4 col-form-label text-right">
                                Weight<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="weight" name="weight">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label for="foot" class="col-md-4 col-form-label text-right">
                                Foot<span class="text-danger">*</span>
                            </label>
                            <div class="col-md-7">
                                <input type="text" required class="form-control" id="foot" name="foot">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <label for="photo1" class="col-md-3 col-form-label text-right">
                            Photo
                        </label>
                        <div class="col-md-7">
                            {{-- <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo" id="photo">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                            </div> --}}
                            <input type="file" id="photo" name="photo" class="dropify" data-max-file-size="1M" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- end card-box-->
<div class="card">
    <div class="card-header font-16">
        Technical features
    </div>
    <div class="card-body">
        <form role="form" class="parsley-examples">
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="cur_team" class="col-md-4 col-form-label text-right">
                        Current Team<span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7">
                        <input type="text" required class="form-control" id="cur_team" name="cur_team">
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="main_pos" class="col-md-4 col-form-label text-right">
                        Main Position<span class="text-danger">*</span>
                    </label>
                    <div class="col-md-7">
                        <select class="custom-select mr-sm-2" required id="main_pos" name="main_pos">
                            <option>Defender</option>
                            <option>Midfielder</option>
                            <option>Forward</option>
                            <option>Goalkeeper</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="sec_pos" class="col-md-4 col-form-label text-right">
                        Secondary Position
                    </label>
                    <div class="col-md-7">
                        <select class="custom-select mr-sm-2" required id="sec_pos" name="sec_pos">
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6 row third_pos" style="display: none;">
                    <label for="third_pos" class="col-md-4 col-form-label text-right">
                        Third Position
                    </label>
                    <div class="col-md-7">
                        <select class="custom-select mr-sm-2" required id="third_pos" name="third_pos">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row fourth_pos" style="display: none;">
                    <label for="fourth_pos" class="col-md-4 col-form-label text-right">
                        Fourth Position
                    </label>
                    <div class="col-md-7">
                        <select class="custom-select mr-sm-2" required id="fourth_pos" name="fourth_pos">
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6 row fifth_pos" style="display: none;">
                    <label for="fifth_pos" class="col-md-4 col-form-label text-right">
                        Fifth Position
                    </label>
                    <div class="col-md-7">
                        <select class="custom-select mr-sm-2" required id="fifth_pos" name="fifth_pos">
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> <!-- end card-box-->
<div class="card">
    <div class="card-header font-16">
        Attribute
    </div>
    <div class="card-body">
        <form role="form" class="parsley-examples">
            <div class="card-title font-15 font-weight-bold">
                Technical
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="corners" class="col-md-3 col-form-label text-right">
                        Coreners
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="corners" name="corners">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1" match="corners" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="crossing" class="col-md-3 col-form-label text-right">
                        Crossing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="crossing" name="crossing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="crossing" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="dribbling" class="col-md-3 col-form-label text-right">
                        Dribbling
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="dribbling" name="dribbling">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="dribbling" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="finishing" class="col-md-3 col-form-label text-right">
                        Finishing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="finishing" name="finishing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="finishing" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="first_touch" class="col-md-3 col-form-label text-right">
                        First Touch
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="first_touch" name="first_touch">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="first_touch" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="free_kick" class="col-md-3 col-form-label text-right">
                        Free Kick Taking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="free_kick" name="free_kick">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="free_kick" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="heading" class="col-md-3 col-form-label text-right">
                        Heading
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="heading" name="heading">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="heading" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="long_shots" class="col-md-3 col-form-label text-right">
                        Long Shots
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="long_shots" name="long_shots">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="long_shots" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="long_throws" class="col-md-3 col-form-label text-right">
                        Long Throws
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="long_throws" name="long_throws">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="long_throws" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="marking" class="col-md-3 col-form-label text-right">
                        Marking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="marking" name="marking">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="marking" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="passing" class="col-md-3 col-form-label text-right">
                        Passing
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="passing" name="passing">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="passing" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="penalty_taking" class="col-md-3 col-form-label text-right">
                        Penalty Taking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="penalty_taking" name="penalty_taking">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="penalty_taking" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="tacking" class="col-md-3 col-form-label text-right">
                        Tacking
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="tacking" name="tacking">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="tacking" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="technique" class="col-md-3 col-form-label text-right">
                        Technique
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="technique" name="technique">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="technique" data-rangeslider>
                    </div>
                </div>
            </div>

            <div class="card-title font-15 font-weight-bold">
                Mental
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="aggression" class="col-md-3 col-form-label text-right">
                        Aggression
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="aggression" name="aggression">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1" match="aggression" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="articipation" class="col-md-3 col-form-label text-right">
                        Articipation
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="articipation" name="articipation">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="articipation" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="bravery" class="col-md-3 col-form-label text-right">
                        Bravery
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="bravery" name="bravery">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="bravery" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="composure" class="col-md-3 col-form-label text-right">
                        Composure
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="composure" name="composure">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="composure" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="concentration" class="col-md-3 col-form-label text-right">
                        Concentration
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="concentration" name="concentration">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="concentration" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="decisions" class="col-md-3 col-form-label text-right">
                        Decisions
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="decisions" name="decisions">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="decisions" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="determination" class="col-md-3 col-form-label text-right">
                        Determination
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="determination" name="determination">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="determination" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="flair" class="col-md-3 col-form-label text-right">
                        Flair
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="flair" name="flair">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="flair" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="leadership" class="col-md-3 col-form-label text-right">
                        Leadership
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="leadership" name="leadership">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="leadership" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="off_ball" class="col-md-3 col-form-label text-right">
                        Off The Ball
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="off_ball" name="off_ball">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="off_ball" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="positioning" class="col-md-3 col-form-label text-right">
                        Positioning
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="positioning" name="positioning">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="positioning" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="teamwork" class="col-md-3 col-form-label text-right">
                        Teamwork
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="teamwork" name="teamwork">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="teamwork" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="vision" class="col-md-3 col-form-label text-right">
                        Vision
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="vision" name="vision">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="vision" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="work_rate" class="col-md-3 col-form-label text-right">
                        Work Rate
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="work_rate" name="work_rate">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="work_rate" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="card-title font-15 font-weight-bold">
                Physical
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="acceleration" class="col-md-3 col-form-label text-right">
                        Acceleration
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="acceleration" name="acceleration">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1" match="acceleration" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="agility" class="col-md-3 col-form-label text-right">
                        Agility
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="agility" name="agility">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="agility" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="balance" class="col-md-3 col-form-label text-right">
                        Balance
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="balance" name="balance">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="balance" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="jumping_reach" class="col-md-3 col-form-label text-right">
                        Jumping Reach
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="jumping_reach" name="jumping_reach">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="jumping_reach" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="natural_fitness" class="col-md-3 col-form-label text-right">
                        Natural Fitness
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="natural_fitness" name="natural_fitness">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="natural_fitness" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="pace" class="col-md-3 col-form-label text-right">
                        Pace
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="pace" name="pace">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="pace" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 row">
                    <label for="stamina" class="col-md-3 col-form-label text-right">
                        Stamina
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="stamina" name="stamina">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="stamina" data-rangeslider>
                    </div>
                </div>
                <div class="form-group col-md-6 row">
                    <label for="strength" class="col-md-3 col-form-label text-right">
                        Strength
                    </label>
                    <div class="col-md-4">
                        <input type="text" attrtype="range_input" class="form-control" id="strength" name="strength">
                    </div>
                    <div class="col-md-5">
                        <input type="range" min="0" value="0" max="100" step="0.1"  match="strength" data-rangeslider>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <button type="submit" class="btn btn-block btn-danger waves-effect waves-light">Save</button>
                </div>
            </div>
        </form>
    </div>
</div> <!-- end card-box-->

@endsection
@section('scripts')
@parent
    <script src="{{ asset('user_assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('user_assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('erp_assets/rangeslider-2.3.0/rangeslider.js') }}"></script>

    <script src="{{ asset('erp_assets/select2/select2.js') }}"></script>
    <script>
        $(document).ready(function(){
            var inputs = document.querySelectorAll( '.custom-file-input' );
            Array.prototype.forEach.call( inputs, function( input )
            {
                var labelVal = $( '.custom-file-label' ).text();

                input.addEventListener( 'change', function( e )
                {
                    var fileName = '';
                    if( this.files && this.files.length > 1 )
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    else
                        fileName = e.target.value.split( '\\' ).pop();

                    if( fileName )
                        $( '.custom-file-label' ).text(fileName);
                    else
                        $( '.custom-file-label' ).text(labelVal);
                });
            });

            $(".dropify").dropify({
                messages: {
                    default: "Photo",
                    replace: "Drag and drop or click to replace",
                    remove: "Remove",
                    error: "Ooops, something wrong appended."
                },
                error: {
                    fileSize: "The file size is too big (1M max)."
                }
            });

            $("#birthdate").flatpickr();
            $('[data-rangeslider]').rangeslider({

                // Deactivate the feature detection
                polyfill: false,

                // Callback function
                onInit: function() {
                    $match = $(this.$element.get(0)).attr("match");
                    value = $(this.$element.get(0)).val();
                    $('#' + $match).val(value);
                },

                // Callback function
                onSlide: function(position, value) {
                    $match = $(this.$element.get(0)).attr("match");
                    $('#' + $match).val(value);
                },

                // Callback function
                onSlideEnd: function(position, value) {
                    console.log('onSlideEnd');
                    console.log('position: ' + position, 'value: ' + value);
                }
            });
            $("[attrtype=range_input]").change(function(){
                $match = $(this).attr("id");
                console.log($match);
                $("[match=" + $match + "]").val($(this).val()).change();
            })
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://ajayakv-rest-countries-v1.p.rapidapi.com/rest/v1/all",
                "method": "GET",
                "headers": {
                    "x-rapidapi-host": "ajayakv-rest-countries-v1.p.rapidapi.com",
                    "x-rapidapi-key": "596585807fmsh94116d249e0cd64p1d139cjsn6b7b5407af9b"
                }
            }
            $.ajax(settings).done(function (response) {
                for(ind in response)
                {
                    $('#touch_country').append($("<option></option>").text(response[ind].name).attr("value", response[ind].name));
                }
                $('#touch_country').select2({
                    allowClear: false,
                    dropdownAutoWidth: true,
                    width: 'element',
                    minimumResultsForSearch: 20, //prevent filter input
                    maximumSelectionSize: 20 // prevent scrollbar
                });
            });
            $("#main_pos").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $("#sec_pos").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $("#third_pos").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $("#fourth_pos").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            $("#fifth_pos").select2({
                allowClear: false,
                dropdownAutoWidth: true,
                width: 'element',
                minimumResultsForSearch: 20, //prevent filter input
                maximumSelectionSize: 20 // prevent scrollbar
            });
            let arrDefender = ["Centre-back", "Sweeper", "Full-back", "Wing-back"];
            let arrMidfielder = ["Centre midfield", "Defensive midfield", "Attacking midfield", "Wide midfield"];
            let arrForward = ["Centre forward", "Second striker", "Winger"];
            $("#main_pos").change(function (e) {
                let main_pos = $( "#main_pos option:selected" ).text();
                $("#sec_pos option").remove();
                $('#sec_pos').select2('val', null);
                $("#third_pos option").remove();
                $('#third_pos').select2('val', null);
                $("#fourth_pos option").remove();
                $('#fourth_pos').select2('val', null);
                $("#fifth_pos option").remove();
                $('#fifth_pos').select2('val', null);
                $(".third_pos").css("display", "none");
                $(".fourth_pos").css("display", "none");
                $(".fifth_pos").css("display", "none");
                if (main_pos == "Defender")
                {
                    for (let i = 0; i < arrDefender.length; i++)
                    {
                        $('#sec_pos').append($("<option></option>").text(arrDefender[i]));
                    }
                } else if (main_pos == "Midfielder")
                {
                    for (let i = 0; i < arrMidfielder.length; i++)
                    {
                        $('#sec_pos').append($("<option></option>").text(arrMidfielder[i]));
                    }
                } else if (main_pos == "Forward")
                {
                    for (let i = 0; i < arrForward.length; i++)
                    {
                        $('#sec_pos').append($("<option></option>").text(arrForward[i]));
                    }
                }
            });
            $("#main_pos").trigger("change");
            $("#sec_pos").change(function (e) {
                let main_pos = $( "#main_pos option:selected" ).text();
                let sec_pos = $( "#sec_pos option:selected" ).text();
                if (sec_pos == null && sec_pos == "") return;
                $("#third_pos option").remove();
                $('#third_pos').select2('val', null);
                $("#fourth_pos option").remove();
                $('#fourth_pos').select2('val', null);
                $("#fifth_pos option").remove();
                $('#fifth_pos').select2('val', null);
                $(".fourth_pos").css("display", "none");
                $(".fifth_pos").css("display", "none");
                $(".third_pos").css("display", "flex");
                if (main_pos == "Defender")
                {
                    for (let i = 0; i < arrDefender.length; i++)
                    {
                        if (sec_pos != arrDefender[i])
                            $('#third_pos').append($("<option></option>").text(arrDefender[i]));
                    }
                } else if (main_pos == "Midfielder")
                {
                    for (let i = 0; i < arrMidfielder.length; i++)
                    {
                        if (sec_pos != arrMidfielder[i])
                            $('#third_pos').append($("<option></option>").text(arrMidfielder[i]));
                    }
                } else if (main_pos == "Forward")
                {
                    for (let i = 0; i < arrForward.length; i++)
                    {
                        if (sec_pos != arrForward[i])
                            $('#third_pos').append($("<option></option>").text(arrForward[i]));
                    }
                }
            });
            $("#third_pos").change(function (e) {
                let main_pos = $( "#main_pos option:selected" ).text();
                let sec_pos = $( "#sec_pos option:selected" ).text();
                let third_pos = $( "#third_pos option:selected" ).text();
                if (third_pos == null && third_pos == "") return;
                $("#fourth_pos option").remove();
                $('#fourth_pos').select2('val', null);
                $("#fifth_pos option").remove();
                $('#fifth_pos').select2('val', null);
                $(".fourth_pos").css("display", "flex");
                $(".fifth_pos").css("display", "none");
                if (main_pos == "Defender")
                {
                    for (let i = 0; i < arrDefender.length; i++)
                    {
                        if (sec_pos != arrDefender[i] && third_pos != arrDefender[i])
                            $('#fourth_pos').append($("<option></option>").text(arrDefender[i]));
                    }
                } else if (main_pos == "Midfielder")
                {
                    for (let i = 0; i < arrMidfielder.length; i++)
                    {
                        if (sec_pos != arrMidfielder[i] && third_pos != arrMidfielder[i])
                            $('#fourth_pos').append($("<option></option>").text(arrMidfielder[i]));
                    }
                } else if (main_pos == "Forward")
                {
                    for (let i = 0; i < arrForward.length; i++)
                    {
                        if (sec_pos != arrForward[i] && third_pos != arrForward[i])
                            $('#fourth_pos').append($("<option></option>").text(arrForward[i]));
                    }
                }
            });
            $("#fourth_pos").change(function (e) {
                let main_pos = $( "#main_pos option:selected" ).text();
                let sec_pos = $( "#sec_pos option:selected" ).text();
                let third_pos = $( "#third_pos option:selected" ).text();
                let fourth_pos = $( "#fourth_pos option:selected" ).text();
                if (fourth_pos == null && fourth_pos == "") return;
                $("#fifth_pos option").remove();
                $('#fifth_pos').select2('val', null);
                $(".fifth_pos").css("display", "flex");
                if (main_pos == "Defender")
                {
                    for (let i = 0; i < arrDefender.length; i++)
                    {
                        if (sec_pos != arrDefender[i] && third_pos != arrDefender[i] && fourth_pos != arrDefender[i])
                            $('#fifth_pos').append($("<option></option>").text(arrDefender[i]));
                    }
                } else if (main_pos == "Midfielder")
                {
                    for (let i = 0; i < arrMidfielder.length; i++)
                    {
                        if (sec_pos != arrMidfielder[i] && third_pos != arrMidfielder[i] && fourth_pos != arrMidfielder[i])
                            $('#fifth_pos').append($("<option></option>").text(arrMidfielder[i]));
                    }
                } else if (main_pos == "Forward")
                {
                    for (let i = 0; i < arrForward.length; i++)
                    {
                        if (sec_pos != arrForward[i] && third_pos != arrForward[i] && fourth_pos != arrForward[i])
                            $('#fifth_pos').append($("<option></option>").text(arrForward[i]));
                    }
                }
            });
        })
    </script>
@endsection