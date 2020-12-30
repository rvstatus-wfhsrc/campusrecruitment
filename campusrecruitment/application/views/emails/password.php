<head>
	<style>
	   .customBorder {
	      border:0 none;
	      border-collapse: separate;
	   }
	    .mailBoxShowdow {
	      -webkit-box-shadow: 0 3px 5px rgba(0,0,0,0.04);
	      -moz-box-shadow: 0 3px 5px rgba(0,0,0,0.04);
	      box-shadow: 0 3px 5px rgba(0,0,0,0.04);
	   }
	   .btnDesign {
	      color: #000000;
	      -webkit-border-radius: 4px;
	      font-weight: 500;
	      font-size: 13.63636px;
	      line-height: 15px;
	      display:inline-block;
	      letter-spacing: .7px;
	      text-decoration: none;
	      -moz-border-radius: 4px;
	      -ms-border-radius: 4px;
	      -o-border-radius: 4px;
	      border-radius: 4px;
	      background-color: #288BD5;
	      padding: 12px 24px;
	   }
	   .footerDesign {
	      border-color: #E3E3E3;
	      border-style: solid;
	      width: 100%;
	      background:#FFFFFF;
	      border-width: 1px;
	      font-size: 11px;
	      padding: 18px 40px 20px;
	   }
	   .vam {
	      vertical-align: middle;
	   }
	   .tac {
	      text-align: center;
	   }
	</style>
</head>
<body style="margin: 0; padding: 0;font-weight: 300; font-stretch: normal; font-size: 14px; letter-spacing: .35px; background: #EFF3F6; color: #333333;">
   <table border="1" cellpadding="0" cellspacing="0" align="center" class="customBorder" style="width: 91%;" width="720">
      <tbody>
         <tr class="customBorder" style="height: 50px;">
            <!-- <td class="customBorder vam" valign="middle">
               <table align="center" border="1" cellpadding="0" cellspacing="0" class="customBorder">
                  <tbody>
                     <tr align="center" class="customBorder" style="padding: 16px 0 15px;">
                        <td class="customBorder vam" valign="middle">
                        	<img src="" style="border: 0 none; line-height: 100%; outline: none; text-decoration: none;">
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td> -->
         </tr>
         <tr class="customBorder mailBoxShowdow">
            <td class="customBorder vam" valign="middle">
               <table align="center" border="1" cellpadding="0" cellspacing="0" class="customBorder" style="width: 100%;" width="100%">
                  <tbody>
                     <tr class="customBorder tac" align="center">
                        <td class="customBorder vam" valign="middle">
                           <table border="1" cellpadding="0" cellspacing="0" width="100%" class="customBorder" style="border-color: #E3E3E3; border-style: solid; width: 100%; border-width: 1px 1px 0; background: #FBFCFC; padding: 40px 54px 42px;">
                              <tbody>
                                 <tr class="customBorder">
                                    <td class="customBorder vam" style="font-weight: 300; color: #1D2531; font-size: 25.45455px;"
                                       valign="middle"><?php echo $name; ?>, recover your password.</td>
                                 </tr>
                                 <tr class="customBorder">
                                    <td class="customBorder vam" style="font-weight: 400; color: #7F8FA4; font-size: 15.45455px; padding-top: 20px;"
                                       valign="middle">Looks like you lost your password?</td>
                                 </tr>
                                 <tr class="customBorder">
                                    <td class="customBorder vam" style="font-weight: 500; font-size: 13.63636px; padding-top: 12px;"
                                       valign="middle">We’re here to help. Click on the button below to change your password.</td>
                                 </tr>
                                 <tr class="customBorder">
                                    <td class="customBorder vam" style="padding-top: 38px;" valign="middle">
                                       <a href="<?=site_url('LoginController/userVerification?email=' . urlencode($email) . '&token=' .  $token.'&flag='.$flag);?>" target="_blank" class="btnDesign" style="color: #ffffff;">Recover my password</a>
                                    </td>
                                 </tr>
                                 <tr class="customBorder">
                                    <td class="customBorder vam" style="font-weight: 300; font-size: 12.72727px; font-style: italic; padding-top: 52px;"
                                       valign="middle">If you didn’t ask to recover your password, please ignore this email.</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <tr class="customBorder">
                        <td class="customBorder vam" valign="middle">
                           <table border="1" cellpadding="0" cellspacing="0" width="100%" class="customBorder tac footerDesign">
                              <tbody>
                                 <tr class="customBorder">
                                    <td class="customBorder vam" valign="middle"><span>You receive this email because you or someone initiated a password recovery operation on your Campus Recruitment System Account.</span></td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <tr class="customBorder" style="height: 50px;"></tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</body>