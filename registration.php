<?php 
$step = isset($_GET['step']) ? $_GET['step'] : 0 ;
$infouser = $user->get_info_user(@$_SESSION['register']['id']);
$infouser = json_decode($infouser);
//print_r($infouser);

if (isset($_SESSION['loggedin_time'])){
    //print_r(isset($_SESSION['loggedin_time']));
if($kategori->isregistrationSessionExpired()){
      session_destroy();
      echo "<script>alert('Waktu Anda Habis Silahkan Login untuk mengetahui detail tagihan');location.reload(); </script>";
}
}
?>

<div class="container kategori regis">
  <div class="row contenbottom boxed">
  <div class="col-md-8 col-xs-12 col-lg-9 ">
    <h3 class="title-tab">Subscription </h3>
    <div class="col-md-12 area">
      <br>
        <table class = "table table-striped" style="border:1px dotted #cfcfcf; border-radius:10px;">
   <thead>
      <tr>
         <th>Package Member</th>
         <th>Accessible Paragraphs</th>
         <th>News / Photo Search Period</th>
      </tr>
   </thead>
   
   <tbody>
      <tr>
         <td><b>Full Packgae Membership</b></td>
         <td>All</td>
         <td>All</td>
      </tr>
      <tr>
         <td><b>Custom Packgae Membership</b></td>
         <td>Spesifik Packgae</td>
         <td>Spesifik Packgae</td>
      </tr>
      
      <tr>
         <td><b>Non-registration</b></td>
         <td> Headlines only (excluding some stories)</td>
         <td> Headlines only (excluding some stories)</td>
      </tr>
   </tbody>
</table>
      <p>
         The online version of the Indonesia-English language service of Member Antara News provides real-time news, ranging from politics and business to society and sports, around the clock, serving as the best tool for analysis of developments in Indonesia and the Asia-Pacific region. <br>
        <br>
         We offer a broad range of subscription options according to customer needs. Nonsubscribers can read only limit news body, excluding the day's main stories and stories in some categories.
      </p>
      <br>
    
        <div id="rootwizard">

          <div class="navbar">
            <div class="navbar-inner">
              <div class="">
                <ul class="nav nav-pills">
                  <li><a href="?registration=1&amp;&amp;step=1">Registration</a></li>
                  <li ><a href="?registration=1&amp;&amp;step=2">Payment Methode</a></li>
                  <li><a href="?registration=1&amp;&amp;step=3" >Confirmation</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="bar" class="progress progress-striped active">
            <div class="bar">
            </div>
          </div>
          <div class="tab-content">
            <?php 
            if($step == 0 || $step == 1 ){
              ?>
          <form class="form-horizontal" action="#" method="POST">
            <div class="tab-pane" id="tab1">
              <div class="col-md-12">
                <div id="legend">
                  <?php
                  if(@$infouser[0]->status == 1){
                    echo '<h4 class="legend">Current Package *</h4>
                      <br>
                      Update Package
                    ';  
                  }
                  else{
                    echo '<h4 class="legend">Subscription Package *</h4>';
                  }
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <?php 
                  if(@$infouser[0]->status == 1){

                  }
                  elseif(@$infouser[0]->status == 0 && @$_SESSION['register']['id'] != null ){
                      echo 'Anda belum membayar paket, silahkan ke payment methode';
                      echo 'Atau Klik Ini untuk Ganti Paket';
                  }
                  else{
                ?>
                <fieldset>
                    <!-- Multiple Radios (inline) -->
                    <div class="form-group">
                      <div class="col-md-12"> 
                        <label class="radio-inline" for="radios-0">
                          <input name="radios-member" id="radios-0" value="2" type="radio" checked="">
                          Full Packgae Member Ship  (IDR 5.000.000)
                        </label> 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12"> 
                        <label class="radio-inline" for="radios-1">
                          <input name="radios-member" id="radios-1" value="1"  type="radio">
                          Custom Package (@packgae x 100 News)
                        </label>
                        <div class="custom-package" style="display:none;">
                        <?php 
                          $data=$kategori->listcategory();
                          $data = json_decode($data);
                          $i= 0;
                          foreach ($data as $key => $val) {
                          ?>
                              <div class="checkbox" id="pilihanumum" >
                                <label for="checkboxes-<?php echo $i ?>">
                                 <div class="pilihan">
                                      <input name="" id="checkboxes-<?php echo $i ?>" value="<?=$val->packge_price;?>" type="checkbox" class="cate">
                                      <?php echo $val->CATEGORY_NAME; ?>
                                      <br>
                                      <div class="jenisberita" style="float:left; padding-left:15px; display:none; margin-top:10px; margin-bottom:10px;">
                                      <div style="float:left;">
                                          <input name="p_category[<?=$val->ID_CATEGORY;?>][text]" value="1" type="checkbox">
                                          <p>Text</p>
                                      </div>
                                      <div style="float:left; margin-left:30px;">
                                          <input name="p_category[<?=$val->ID_CATEGORY;?>][foto]" value="1" type="checkbox">
                                          <p>Foto</p>
                                      </div>
                                      <div style="float:left; margin-left:30px;">
                                          <input name="p_category[<?=$val->ID_CATEGORY;?>][video]" value="1" type="checkbox">
                                          <p>Video</p>
                                      </div>
                                      <div style="float:left; margin-left:30px;">
                                          <input name="p_category[<?=$val->ID_CATEGORY;?>][infografis]" value="1" type="checkbox">
                                          <p>Infografis</p>
                                      </div>
                                      </div> 
                                  </div>
                                </label>
                              </div>
                              <?php $i++; } ?>
                              <div style="clear:both;"></div>
                              <br>
                            
                              <div class="total-amount"><b>Total Amount</b> <span class="kanan" id="output">0</span></div>
                            </div>
                      </div>
                    </div>

                </fieldset>
                  <?php } ?>
                 </div>
                 <div class="col-md-12">
                <div id="legend">
                  <h4 class="legend"> Fill In Your Details *</h4>
                 
                </div>
              </div>

                <div class="col-md-6">
                  <fieldset>
                    <input class="form-control" type="hidden" id="username" name="id_mem" value="<?php echo @$infouser[0]->id_mem?>" placeholder="" class="input-xlarge">
                    <div class="control-group">
                      <!-- Username -->
                      <label class="control-label" for="username">Username</label>
                      <div class="controls">
                        <input required="" class="form-control" type="text" id="username" name="username" value="<?=@$infouser[0]->user_name; ?>" placeholder="" class="input-xlarge">
                        <p class="help-block">
                          Username can contain any letters or numbers
                        </p>
                      </div>
                    </div>
                    <div class="control-group">
                      <!-- E-mail -->
                      <label class="control-label" for="email">E-mail</label>
                      <div class="controls">
                        <input required="" class="form-control" type="text" id="email" name="email" value="<?=@$infouser[0]->email?>" placeholder="" class="input-xlarge">
                        <p class="help-block">
                        </p>
                      </div>
                    </div>
                    <div class="control-group">
                      <!-- E-mail -->
                      <label class="control-label" for="fullname">Full Name</label>
                      <div class="controls">
                        <input required="" class="form-control" type="text" id="fullname" name="fullname" value="<?=@$infouser[0]->full_name?>" placeholder="" class="input-xlarge">
                        <p class="help-block">
                        </p>
                      </div>
                    </div>
                    <div class="control-group">
                      <!-- E-mail -->
                      <label class="control-label" for="company">Company</label>
                      <div class="controls">
                        <input required="" class="form-control" type="text" id="company" name="company" value="<?=@$infouser[0]->company?>" placeholder="" class="input-xlarge">
                        <p class="help-block">
                        </p>
                      </div>
                    </div>

                    <div class="control-group">
                      <!-- E-mail -->
                      <label class="control-label" for="Country">Country</label>
                      <div class="controls">
                        <select class="form-control" name="negara" id="negara" value="<?=@$infouser['negara']?>" placeholder="Country" >
                              <option value="AF">Afghanistan</option><option value="AX">Aland Islands</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BQ">Bonaire, Sint Eustatius and Saba</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote d'ivoire (Ivory Coast)</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CW">Curacao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="CD">Democratic Republic of the Congo</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadaloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID" selected="">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="XK">Kosovo</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Laos</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY" >Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldava</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar (Burma)</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="KP">North Korea</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestine</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Phillipines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option value="BL">Saint Barthelemy</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="MF">Saint Martin</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SX">Sint Maarten</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and the South Sandwich Islands</option><option value="KR">South Korea</option><option value="SS">South Sudan</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syria</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste (East Timor)</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican City</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VG">Virgin Islands, British</option><option value="VI">Virgin Islands, US</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>
                        <p class="help-block">
                        </p>
                      </div>
                    </div>

                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <div class="control-group">
                      <!-- Password-->
                      <label class="control-label" for="password">Password</label>
                      <div class="controls">
                        <input required="" class="form-control" type="password" id="txtNewPassword" name="password" placeholder="" class="input-xlarge">
                        <p class="help-block">
                          Password should be at least 4 characters
                        </p>
                      </div>
                    </div>
                    <div class="control-group">
                      <!-- Password -->
                      <label class="control-label" for="password_confirm">Password (Confirm)</label>
                      <div class="controls">
                        <input required="" class="form-control" type="password" id="txtConfirmPassword" onChange="checkPasswordMatch();" name="password_confirm" placeholder="" class="input-xlarge">
                        <p class="help-block">
                           <div class="registrationFormAlert" id="divCheckPasswordMatch">
                          </div>
                        </p>
                      </div>
                    </div>
                    <div class="control-group">
                      <!-- Password -->
                      <label class="control-label" for="phonenumber">Phone Number</label>
                      <div class="controls">
                        <input required="" class="form-control" type="text" id="phonenumber" value="<?=@$infouser[0]->phone_number?>" name="phonenumber" placeholder="" class="input-xlarge">
                        <p class="help-block">
                        </p>
                      </div>
                    </div>
                    <div class="control-group">
                      <!-- Password -->
                      <label class="control-label" for="address">Address</label>
                      <div class="controls">
                        <textarea required="" class="form-control" type="text" id="address" name="address" placeholder="" class="input-xlarge"><?=@$infouser[0]->addres?></textarea>
                        <p class="help-block">
                        </p>
                      </div>
                    </div>
                        <?php if(isset($_SESSION['register']['id']) && $_SESSION['register']['id']  != "") {
                          ?>
                          <button type="submit" class="btn btn-danger kanan" name ="submit" value="update">Update</button>
                          <?php } 
                          else {
                            ?>
                        <button type="submit" class="btn btn-danger kanan" name ="submit" value="registrasi">Submit</button>
                        <?php } ?>
                  </fieldset>
                </div>
              </div>
              </form>
              <?php } 
              else if($step ==2){
                $data = $user->getdatapayment(@$_SESSION['register']['id']);
              //print_r($data);
              ?>
              <form class="form-horizontal" action="#" method="post">
              <div class="tab-pane" id="tab2">
                <form action="#" method="post"  name="theForm" target="_self" id="theForm" autocomplete="off">

                <table border="" align="center" cellpadding="5" cellspacing="1" style="border-collapse: collapse;">
                    <tbody><tr>
                      <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr align="left" valign="middle">
                      <td width="26%">Pay To</td>
                      <td align="center" width="4%"><strong>:</strong></td>
                      <td width="70%">PERUM LKBN ANTARA</td>
                    </tr>
                    <tr align="left" valign="middle">
                      <td width="26%">Payment Collection</td>
                      <td align="center" width="4%"><strong>:</strong></td>
                      <td width="70%">Antara</td>
                    </tr>
                    <tr>
                    <td colspan="3"></td>
                    </tr>
                    <tr align="left" valign="middle">
                      <td width="26%">Payment ID</td>
                      <td align="center" width="4%"><strong>:</strong></td>
                      <td width="70%"><?php if(@$data[0]['id_payment'] == null){
                        echo "Silahkan Login / daftar jika anda belum memiliki akun";
                      }
                      else{
                        echo @$data[0]['id_payment'];
                      }
                       ?></td>
                      

                    </tr>
                    <tr align="left" valign="middle">
                      <td width="26%">Payment of</td>
                      <td align="center" width="4%"><strong>:</strong></td>
                      <td width="70%"> <?php if(@$data[0]['no_trans'] == null){
                        echo "Silahkan Login / daftar jika anda belum memiliki akun";
                      }
                      else{
                        echo @$data[0]['no_trans'];
                      }
                       ?></td>
                    </tr>
                    <tr align="left" valign="middle">
                      <td>Net Charges</td>
                      <td align="center"><strong>:</strong></td>
                      <td> <?php if(@$data[0]['total_amount'] == null){
                        echo "Silahkan Login / daftar jika anda belum memiliki akun";
                      }
                      else{
                        echo @$data[0]['total_amount'];
                      }
                       ?></td>
                    </tr>
                    <tr align="left" valign="middle">
                      <td>Status Pembayaran</td>
                      <td align="center"><strong>:</strong></td>
                      <td> <?php if(@$data[0]['status'] == 1){
                        echo "Tagihan Sudah Dibayar";
                      }
                      elseif(@$data[0]['status'] == 0){
                        echo "Belum Dibayar";
                      }
                      else{
                        echo "Anda Belum Terdaftar";
                      }
                       ?></td>
                      
                    </tr>
                    
                </tbody></table>
                <button  type="submit" class="btn btn-danger kanan" name ="submit" value="cancelpayment">Cancel</button>
                <button style="margin-right:5px;" type="submit" class="btn btn-danger kanan" name ="submit" value="paymentdone">Pay by Credit</button> 

                

                </form>
              </div>
              <?php } 
              else if($step == 3){
              ?>

              <div class="tab-pane" id="tab3">
                 3
              </div>
              <?php } ?>
              
              <div class="col-md-12">
                <ul class="pager wizard">
                  <li class="previous first" style="display:none;"><a href="#">First</a></li>
                  <li class="previous"><a href="#">Previous</a></li>
                  <li class="next last" style="display:none;"><a href="#">Last</a></li>
                  <li class="next"><a href="#">Next</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3 col-xs-12 col-lg-3  ">
      <?php include 'sidecategori.php'; ?>
    </div>
  </div>

<script type="text/javascript">
/*$(document).ready(function(){
  var current = 1,current_step,next_step,steps;
  steps = $("fieldset").length;
  $(".next").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().next();
    next_step.show();
    current_step.hide();
    setProgressBar(++current);
  });
  $(".previous").click(function(){
    current_step = $(this).parent();
    next_step = $(this).parent().prev();
    next_step.show();
    current_step.hide();
    setProgressBar(--current);
  });
  setProgressBar(current);
  // Change progress bar action
  function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  }
});*/
</script>  