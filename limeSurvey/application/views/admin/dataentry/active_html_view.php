<<<<<<< HEAD
<?php
$yii = Yii::app();

if ($thissurvey['active'] == "Y")
            { ?>

                <script type='text/javascript'>
    				  <!--
    					function saveshow(value)
    						{
    						if (document.getElementById(value).checked == true)
    							{
    							document.getElementById("closerecord").checked=false;
    							document.getElementById("closerecord").disabled=true;
    							document.getElementById("saveoptions").style.display="";
    							}
    						else
    							{
    							document.getElementById("saveoptions").style.display="none";
    							 document.getElementById("closerecord").disabled=false;
    							}
    						}
    				  //-->
    				  </script>
                <tr>
                <td colspan='3' align='center'>
                <table><tr><td align='left'>
                <input type='checkbox' class='checkboxbtn' name='closerecord' id='closerecord' checked='checked'/><label for='closerecord'><?php $clang->eT("Finalize response submission"); ?></label></td></tr>
                <input type='hidden' name='closedate' value='<?php echo dateShift(date("Y-m-d H:i:s"), "Y-m-d H:i:s", $yii->getConfig('timeadjust')); ?>' />

                <?php if ($thissurvey['allowsave'] == "Y")
                { ?>

                    <tr><td align='left'><input type='checkbox' class='checkboxbtn' name='save' id='save' onclick='saveshow(this.id)' /><label for='save'><?php $clang->eT("Save for further completion by survey user"); ?></label>
                    </td></tr></table>
                    <div name='saveoptions' id='saveoptions' style='display: none'>
                    <table align='center' class='outlinetable'>
    					  <tr><td align='right'><?php $clang->eT("Identifier:"); ?></td>
    					  <td><input type='text' name='save_identifier' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Password:"); ?></td>
    					  <td><input type='password' name='save_password' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Confirm Password:"); ?></td>
    					  <td><input type='password' name='save_confirmpassword' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Email:"); ?></td>
    					  <td><input type='email' name='save_email' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Start Language:"); ?></td>
    					  <td>
                    <select name='save_language'>
                    <?php foreach ($slangs as $lang)
                    {
                        if ($lang == $baselang) { ?>
                            <option value='<?php echo $lang; ?>' selected='selected'><?php echo getLanguageNameFromCode($lang,false); ?></option>
                            <?php }
                        else { ?>
                            <option value='<?php echo $lang; ?>'><?php echo getLanguageNameFromCode($lang,false); ?></option>
                            <?php }
                    } ?>
                    </select>


                    </td></tr></table></div>
                    </td>
                    </tr>
                <?php } ?>
                <tr>
                <td colspan='3' align='center'>
                <input type='submit' id='submitdata' value='<?php $clang->eT("Submit"); ?>'

                <?php if (tableExists('tokens_'.$thissurvey['sid']))
                { ?>
                     disabled='disabled'/>
                <?php }
                else
                { ?>
                     />
                <?php } ?>
                </td>
                </tr>
            <?php }
            elseif ($thissurvey['active'] == "N")
            { ?>
                <tr>
                <td colspan='3' align='center'>
                <font color='red'><strong><?php $clang->eT("This survey is not yet active. Your response cannot be saved"); ?>
                </strong></font></td>
                </tr>
            <?php }
            else
            { ?>
                </form>
                <tr>
                <td colspan='3' align='center'>";
                <font color='red'><strong><?php $clang->eT("Error"); ?></strong></font><br />
                <?php $clang->eT("The survey you selected does not exist"); ?><br /><br />
                <input type='submit' value='<?php $clang->eT("Main Admin Screen"); ?>' onclick="window.open('<?php echo $scriptname; ?>', '_top')" />
                </td>
                </tr>
                </table>
                <?php exit(); ?>
            <?php } ?>
            <tr>
            <td>
            <input type='hidden' name='subaction' value='insert' />
            <input type='hidden' name='sid' value='<?php echo $surveyid; ?>' />
            <input type='hidden' name='language' value='<?php echo $sDataEntryLanguage; ?>' />
            </td>
            </tr>
            </table>
=======
<?php
$yii = Yii::app();

if ($thissurvey['active'] == "Y")
            { ?>

                <script type='text/javascript'>
    				  <!--
    					function saveshow(value)
    						{
    						if (document.getElementById(value).checked == true)
    							{
    							document.getElementById("closerecord").checked=false;
    							document.getElementById("closerecord").disabled=true;
    							document.getElementById("saveoptions").style.display="";
    							}
    						else
    							{
    							document.getElementById("saveoptions").style.display="none";
    							 document.getElementById("closerecord").disabled=false;
    							}
    						}
    				  //-->
    				  </script>
                <tr>
                <td colspan='3' align='center'>
                <table><tr><td align='left'>
                <input type='checkbox' class='checkboxbtn' name='closerecord' id='closerecord' checked='checked'/><label for='closerecord'><?php $clang->eT("Finalize response submission"); ?></label></td></tr>
                <input type='hidden' name='closedate' value='<?php echo dateShift(date("Y-m-d H:i:s"), "Y-m-d H:i:s", $yii->getConfig('timeadjust')); ?>' />

                <?php if ($thissurvey['allowsave'] == "Y")
                { ?>

                    <tr><td align='left'><input type='checkbox' class='checkboxbtn' name='save' id='save' onclick='saveshow(this.id)' /><label for='save'><?php $clang->eT("Save for further completion by survey user"); ?></label>
                    </td></tr></table>
                    <div name='saveoptions' id='saveoptions' style='display: none'>
                    <table align='center' class='outlinetable'>
    					  <tr><td align='right'><?php $clang->eT("Identifier:"); ?></td>
    					  <td><input type='text' name='save_identifier' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Password:"); ?></td>
    					  <td><input type='password' name='save_password' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Confirm Password:"); ?></td>
    					  <td><input type='password' name='save_confirmpassword' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Email:"); ?></td>
    					  <td><input type='email' name='save_email' /></td></tr>
    					  <tr><td align='right'><?php $clang->eT("Start Language:"); ?></td>
    					  <td>
                    <select name='save_language'>
                    <?php foreach ($slangs as $lang)
                    {
                        if ($lang == $baselang) { ?>
                            <option value='<?php echo $lang; ?>' selected='selected'><?php echo getLanguageNameFromCode($lang,false); ?></option>
                            <?php }
                        else { ?>
                            <option value='<?php echo $lang; ?>'><?php echo getLanguageNameFromCode($lang,false); ?></option>
                            <?php }
                    } ?>
                    </select>


                    </td></tr></table></div>
                    </td>
                    </tr>
                <?php } ?>
                <tr>
                <td colspan='3' align='center'>
                <input type='submit' id='submitdata' value='<?php $clang->eT("Submit"); ?>'

                <?php if (tableExists('tokens_'.$thissurvey['sid']))
                { ?>
                     disabled='disabled'/>
                <?php }
                else
                { ?>
                     />
                <?php } ?>
                </td>
                </tr>
            <?php }
            elseif ($thissurvey['active'] == "N")
            { ?>
                <tr>
                <td colspan='3' align='center'>
                <font color='red'><strong><?php $clang->eT("This survey is not yet active. Your response cannot be saved"); ?>
                </strong></font></td>
                </tr>
            <?php }
            else
            { ?>
                </form>
                <tr>
                <td colspan='3' align='center'>";
                <font color='red'><strong><?php $clang->eT("Error"); ?></strong></font><br />
                <?php $clang->eT("The survey you selected does not exist"); ?><br /><br />
                <input type='submit' value='<?php $clang->eT("Main Admin Screen"); ?>' onclick="window.open('<?php echo $scriptname; ?>', '_top')" />
                </td>
                </tr>
                </table>
                <?php exit(); ?>
            <?php } ?>
            <tr>
            <td>
            <input type='hidden' name='subaction' value='insert' />
            <input type='hidden' name='sid' value='<?php echo $surveyid; ?>' />
            <input type='hidden' name='language' value='<?php echo $sDataEntryLanguage; ?>' />
            </td>
            </tr>
            </table>
>>>>>>> refs/remotes/origin/master
            </form>
