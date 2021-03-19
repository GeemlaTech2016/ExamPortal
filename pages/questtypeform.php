<?php 
$questtype = isset($_GET['questtype'])?$_GET['questtype']:"";
if($questtype=='1'){ ?>
    <tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="radio" class="mt-radio" name="optionsRadios" value="A" />
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" /></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="radio" class="mt-radio" name="optionsRadios" value="B" /></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" /></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="radio" class="mt-radio" name="optionsRadios" value="C" /></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" /></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="radio" class="mt-radio" name="optionsRadios" value="D" /></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" /></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="radio" class="mt-radio" name="optionsRadios" value="E" /></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" /></td>
    </tr>
<?php 
}elseif($questtype=='2'){
?>
<tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="A" />
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" /></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="B" /></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" /></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="C" /></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" /></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="D" /></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" /></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="E" /></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" /></td>
    </tr>
    <?php
     }elseif($questtype=='3'){
    ?>
    <tr>
        <td>Case Study</td>
        <td> <textarea name="casestudy" cols="60" class="form-control" rows="3" id="casestudy" ></textarea>
    </td>
    </tr>
    <tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="radio" class="mt-radio" name="optionsRadios" value="A" />
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" /></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="radio" class="mt-radio" name="optionsRadios" value="B" /></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" /></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="radio" class="mt-radio" name="optionsRadios" value="C" /></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" /></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="radio" class="mt-radio" name="optionsRadios" value="D" /></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" /></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="radio" class="mt-radio" name="optionsRadios" value="E" /></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" /></td>
    </tr>
    <?php 
    }elseif($questtype=='4'){
    ?>
    <tr>
        <td>Case Study</td>
        <td><textarea name="casestudy" cols="60" class="form-control" rows="3" id="casestudy" ></textarea>
    </td>
    </tr>
    <tr>
        <td colspan="2"> Available Choices (Select all that apply)</td>
    </tr>
    <tr>
        <td valign="bottom">A.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="A" />
        </td>
        <td>
        <input name="a" type="text" class="form-control" id="a" /></td>
    </tr>
    <tr>
        <td valign="bottom">B.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="B" /></td>
        <td>
        <input name="b" type="text" class="form-control" id="b" /></td>
    </tr>
    <tr>
        <td valign="bottom">C.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="C" /></td>
        <td>
        <input name="c" type="text" class="form-control" id="c" /></td>
    </tr>
    <tr>
        <td valign="bottom">D.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="D" /></td>
        <td>
        <input name="d" type="text" class="form-control" id="d" /></td>
    </tr>
    <tr>
        <td valign="bottom">E.
        <input type="checkbox" class="mt-checkbox" name="checklist[]" value="E" /></td>
        <td>
        <input name="e" type="text" class="form-control" id="e" /></td>
    </tr>
    <?php
    }elseif($questtype=='5'){
    ?>
    <tr>
        <td>Answer</td>
        <td><input type="text" name="fillanswer" class="form-control" id="fillanswer" /> </td>
    </tr>
    <?php } ?>