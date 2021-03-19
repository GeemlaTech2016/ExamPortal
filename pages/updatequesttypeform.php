<?php 
//$questtype = isset($_GET['questtype'])?$_GET['questtype']:"";
if($questtype=='1'){ ?>
    <tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="radio" class="mt-radio" name="optionsRadios" value="A" <?php if($getQuest['ans']=='A') echo "checked" ?> />
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" value="<?php echo $getQuest['optiona']?>" /></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="radio" class="mt-radio" name="optionsRadios" value="B" <?php if($getQuest['ans']=='B') echo "checked" ?> /></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" value="<?php echo $getQuest['optionb']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="radio" class="mt-radio" name="optionsRadios" value="C" <?php if($getQuest['ans']=='C') echo "checked" ?>/></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" value="<?php echo $getQuest['optionc']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="radio" class="mt-radio" name="optionsRadios" value="D" <?php if($getQuest['ans']=='D') echo "checked" ?>/></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" value="<?php echo $getQuest['optiond']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="radio" class="mt-radio" name="optionsRadios" value="E" <?php if($getQuest['ans']=='E') echo "checked" ?>/></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" value="<?php echo $getQuest['optione']?>"/></td>
    </tr>
<?php 
}elseif($questtype=='2'){
    $arr = explode(",", $getQuest['ans']);
?>
<tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="A" <?php if (in_array("A", $arr)) echo "checked" ?> />
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" value="<?php echo $getQuest['optiona']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="B" <?php if (in_array("B", $arr)) echo "checked" ?> /></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" value="<?php echo $getQuest['optionb']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="C" <?php if (in_array("C", $arr)) echo "checked" ?> /></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" value="<?php echo $getQuest['optionc']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="D" <?php if (in_array("D", $arr)) echo "checked" ?> /></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" value="<?php echo $getQuest['optiond']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="E" <?php if (in_array("E", $arr)) echo "checked" ?> /></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" value="<?php echo $getQuest['optione']?>"/></td>
    </tr>
    <?php
     }elseif($questtype=='3'){
    ?>
    <tr>
        <td>Case Study</td>
        <td> <textarea name="casestudy" cols="60" class="form-control" rows="3" id="casestudy" >value="<?php echo $getQuest['casestudy']?>"</textarea>
    </td>
    </tr>
    <tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="radio" class="mt-radio" name="optionsRadios" value="A" <?php if($getQuest['ans']=='A') echo "checked" ?>/>
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" value="<?php echo $getQuest['optiona']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="radio" class="mt-radio" name="optionsRadios" value="B" <?php if($getQuest['ans']=='B') echo "checked" ?>/></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" value="<?php echo $getQuest['optionb']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="radio" class="mt-radio" name="optionsRadios" value="C" <?php if($getQuest['ans']=='C') echo "checked" ?>/></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" value="<?php echo $getQuest['optionc']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="radio" class="mt-radio" name="optionsRadios" value="D" <?php if($getQuest['ans']=='D') echo "checked" ?>/></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" value="<?php echo $getQuest['optiond']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="radio" class="mt-radio" name="optionsRadios" value="E" <?php if($getQuest['ans']=='E') echo "checked" ?>/></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" value="<?php echo $getQuest['optione']?>"/></td>
    </tr>
    <?php 
    }elseif($questtype=='4'){
        $arr = explode(",", $getQuest['ans']);
    ?>
    <tr>
        <td>Case Study</td>
        <td><textarea name="casestudy" cols="60" class="form-control" rows="3" id="casestudy" >value="<?php echo $getQuest['casestudy']?>"</textarea>
    </td>
    </tr>
    <tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="A" <?php if (in_array("A", $arr)) echo "checked" ?>/>
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" value="<?php echo $getQuest['optiona']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="B" <?php if (in_array("B", $arr)) echo "checked" ?>/></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" value="<?php echo $getQuest['optionb']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="C" <?php if (in_array("C", $arr)) echo "checked" ?>/></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" value="<?php echo $getQuest['optionc']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="D" <?php if (in_array("D", $arr)) echo "checked" ?>/></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" value="<?php echo $getQuest['optiond']?>"/></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="E" <?php if (in_array("E", $arr)) echo "checked" ?>/></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" value="<?php echo $getQuest['optione']?>"/></td>
    </tr>
    <?php
    }elseif($questtype=='5'){
    ?>
    <tr>
        <td>Answer</td>
        <td><input type="text" name="fillanswer" class="form-control" id="fillanswer" value="<?php echo $getQuest['ans']?>" /> </td>
    </tr>
    <?php } ?>