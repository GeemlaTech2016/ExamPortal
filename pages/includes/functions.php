<?php

include 'resize_class.php';

function redirect($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

// Generate token
function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited
  
    for ($i=0; $i < $length; $i++) {
      $token .= $codeAlphabet[mt_rand(0, $max-1)];
    }
  
    return $token;
  }
  
//Upload and Crop images 
function upload_passport($path, $ext, $sn) {
    $img_url = 'passport' . $sn . '-' . date('mdYHis.') . $ext;
    move_uploaded_file($path, "temp_img/" . $img_url);
    $resizeObj = new resize("temp_img/" . $img_url);
    $resizeObj->resizeImage(280, 350, 'crop');
    $resizeObj->saveImage("pics/" . $img_url, 100);
    unlink("temp_img/" . $img_url);
    return $img_url;
}

function ternary_op($val) {
    $op_val = isset($val) ? $val : "";
    return $op_val;
}

function masterRemarks($position) {

    $position = trim($position);

    if ($position == 1) {

        $rem = "Excellent";
    } elseif ($position == 2) {

        $rem = "Very Good";
    } elseif ($position == 3) {

        $rem = "Good";
    } else {

        $rem = "Passed - <i>Can Do Better</i>";
    }

    return $rem;
}

function position($positionValue) {
    $len = strlen($positionValue);
    $lastDigit = substr($positionValue, -1);
    $last2Digits = substr($positionValue, -2);
    $seclast = substr($positionValue, -2, 1);
    if ($len > 1 && $seclast == '1') {

        $posit = $positionValue . "th";
    } elseif ($lastDigit == '1') {

        $posit = $positionValue . "st";
    } elseif ($lastDigit == '2') {

        $posit = $positionValue . "nd";
    } elseif ($lastDigit == '3') {

        $posit = $positionValue . "rd";
    } else {

        $posit = $positionValue . "th";
    }
    return $posit;
}

function principalRemarks($average) {

    $average = trim(round($average));

    if ($average <= 40) {

        $rem = "You need to sit up";
    } elseif ($average >= 41 && $average <= 65) {

        $rem = "Well done! You can do better";
    } elseif ($average >= 66) {

        $rem = "Very Good!. Keep it up";
    }

    return $rem;
}

function teacherRemarks($average) {

    $average = trim(round($average));

    if ($average <= 40) {

        $rem = "Poor Performance, You need to improve";
    } elseif ($average >= 41 && $average <= 65) {

        $rem = "Well done but there is still room for improvement";
    } elseif ($average >= 66 && $average <= 74) {

        $rem = "Very Good!. Keep it up";
    } elseif ($average >= 75 && $average <= 100) {
        $rem = "Great Result!. Keep up the good work";
    }

    return $rem;
}

function dataRead($f) {
    $fieldValue = $_POST['$f'];
    return $fieldValue;
}

function weekDay() {
//timestamp=date("d");
    $n = date("w");
    $n;
    switch ($n) {
        case 1: $d1 = "Monday";
            break;
        case 2: $d1 = "Tuesday";
            break;
        case 3: $d1 = "Wednesday";
            break;
        case 4: $d1 = "Thursday";
            break;
        case 5: $d1 = "Friday";
            break;
        case 6: $d1 = "Saturday";
            break;
        case 7: $d1 = "Sunday";
            break;
    }
    return $d1;
}

function thisTime() {
    $now = date("h:i:s A");
    return $now;
}

function thisMonth() {
    $m = date("m");
    switch ($m) {
        case 1: $month = "January";
            break;
        case 2: $month = "February";
            break;
        case 3: $month = "March";
            break;
        case 4: $month = "April";
            break;
        case 5: $month = "May";
            break;
        case 6: $month = "June";
            break;
        case 7: $month = "July";
            break;
        case 8: $month = "August";
            break;
        case 9: $month = "September";
            break;
        case 10: $month = "October";
            break;
        case 11: $month = "November";
            break;
        case 12: $month = "December";
            break;
    }
    return $month;
}

function toMonth($n) {

    switch ($n) {
        case 1: $month = "January";
            break;
        case 2: $month = "February";
            break;
        case 3: $month = "March";
            break;
        case 4: $month = "April";
            break;
        case 5: $month = "May";
            break;
        case 6: $month = "June";
            break;
        case 7: $month = "July";
            break;
        case 8: $month = "August";
            break;
        case 9: $month = "September";
            break;
        case 10: $month = "October";
            break;
        case 11: $month = "November";
            break;
        case 12: $month = "December";
            break;
    }
    return $month;
}

function toLetters($n) {

    switch ($n) {
        case 1: $alpha = "A";
            break;
        case 2: $alpha = "B";
            break;
        case 3: $alpha = "C";
            break;
        case 4: $alpha = "D";
            break;
        case 5: $alpha = "E";
            break;
        case 6: $alpha = "F";
            break;
        case 7: $alpha = "G";
            break;
        case 8: $alpha = "H";
            break;
        case 9: $alpha = "I";
            break;
        case 10: $alpha = "J";
            break;
        case 11: $alpha = "K";
            break;
        case 12: $alpha = "L";
            break;
        case 13: $alpha = "M";
            break;
        case 14: $alpha = "N";
            break;
        case 15: $alpha = "O";
            break;
        case 16: $alpha = "P";
            break;
        case 17: $alpha = "Q";
            break;
        case 18: $alpha = "R";
            break;
        case 19: $alpha = "S";
            break;
        case 20: $alpha = "T";
            break;
        case 21: $alpha = "U";
            break;
        case 22: $alpha = "V";
            break;
        case 23: $alpha = "W";
            break;
        case 24: $alpha = "X";
            break;
        case 25: $alpha = "Y";
            break;
        case 26: $alpha = "Z";
            break;
    }
    return $alpha;
}

function convertQtype($n) {

    switch ($n) {
        case 1: $alpha = "Multiple Choice (Single Select)";
            break;
        case 2: $alpha = "Multiple Choice (Multiple Select)";
            break;
        case 3: $alpha = "Single Select with Case study";
            break;
        case 4: $alpha = "Multiple Select with Case study";
            break;
        case 5: $alpha = "Fill in the gap";
            break;
        case 6: $alpha = "F";
            break;
        case 7: $alpha = "G";
            break;
    }
    return $alpha;
}

function grade($score) {

    $score = trim($score);

    if ($score <= 39.99) {

        $grd = 'E';
    } elseif ($score >= 40 and $score <= 54.99) {

        $grd = 'D';
    } elseif ($score >= 55 and $score <= 64.99) {

        $grd = 'C';
    } elseif ($score >= 65 and $score <= 74.99) {

        $grd = 'B';
    } elseif ($score >= 75 and $score <= 100) {

        $grd = 'A';
    } else {
        $grd = '';
    }

    return $grd;
}

function annualAvgRemark($score, $class) {

    $score = trim($score);

    if ($score < 50 && ($class == 'SSS 1' || $class == 'SSS 2')) {

        $grd = 'Failed - To Repeat';
    } elseif ($score < 40 and $class == 'JSS 1') {
        $grd = 'Failed - To Repeat';
    } elseif ($score < 45 and $class == 'JSS 2') {
        $grd = 'Failed - To Repeat';
    } else {

        $grd = 'Pass - PROMOTED';
    }

    return $grd;
}

function termlyAvgRemark($score, $class) {

    $score = trim($score);

    if ($score < 50 && ($class == 'SSS 1' || $class == 'SSS 2')) {

        $grd = 'Failed';
    } elseif ($score < 40 and $class == 'JSS 1') {
        $grd = 'Failed';
    } elseif ($score < 45 and $class == 'JSS 2') {
        $grd = 'Failed';
    } else {

        $grd = 'Pass';
    }

    return $grd;
}

function scoreRemark($score) {

    $score = trim($score);

    if ($score <= 39.99) {

        $grd = 'POOR';
    } elseif ($score >= 40 and $score <= 54.99) {

        $grd = 'FAIR';
    } elseif ($score >= 55 and $score <= 64.99) {

        $grd = 'GOOD';
    } elseif ($score >= 65 and $score <= 74.99) {

        $grd = 'VERY GOOD';
    } elseif ($score >= 75 and $score <= 100) {

        $grd = 'EXCELLENT';
    } else {
        $grd = 'INVALID SCORE';
    }

    return $grd;
}

function remGrade($score) {

    $score = trim($score);

    if ($score == 'F') {

        $grd = "Fail";
    } elseif ($score == 'E') {

        $grd = "Pass";
    } elseif ($score == 'D') {

        $grd = "Pass";
    } elseif ($score == 'C') {

        $grd = "Credit";
    } elseif ($score == 'B') {

        $grd = "Very Good";
    } elseif ($score == 'A') {

        $grd = "Distinction";
    } else {
        $grd = '';
    }

    return $grd;
}

function thisDate() {
    $d = date("d");
    $m = thisMonth();
    $y = date("y");
    $date = $d . " " . $m . ", 20" . $y;
    return $date;
}

function allRows($tname) {
    $r2 = mysqli_query($conn, "select * from `$tname`");
    $no2 = mysqli_num_rows($r2);
    return $no2;
}

function toAge($d1, $m1, $y1) {

    $y2 = "20" . date("y");
    $m2 = date("m");
    $d2 = date("d");
    $y = $y2 - $y1;
    $m = $m2 - $m1;
    $d = $d2 - $d1;
    if ($m < 1 || $d < 1) {
        $y = $y - 1;
    }
    return $y;
}

function convert_number_to_words($number) {
    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}

?>