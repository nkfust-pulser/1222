<?php 
session_start();
/*require_once("connect_members.php");
$sql = "SELECT measure_time FROM peaks WHERE measure_time = ?";
if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, 's', $param_time);
    $param_time = $_SESSION['latest_date'];
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            $temps = array_fill(0, 12, 0);
            $theData = $_SESSION['theData'];
            $indexes = explode(" ", $theData[1]);
            $numbers = explode(" ",$theData[2]);
            $values = explode(" ",$theData[3]);

            foreach($numbers as $key => $vals){
                $temps[$key] = $vals;
            }
            foreach($values as $key => $vals){
                $temps[$key] = $temps[$key].'-'.$vals;
            }
            
            $date = date('Y-m-d H:i:s');
            $sql2 = "INSERT INTO peaks (userid, measure_time, firstPeaks, secondPeaks, thirdPeaks, fourthPeaks, fifthPeaks, sixthPeaks, seventhPeaks, eighthPeaks, ninthPeaks, tenthPeaks, eleventhPeaks, twelvethPeaks) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            if($stmt2 = mysqli_prepare($link, $sql2)){
                mysqli_stmt_bind_param($stmt2, 'ssssssssssssss', $param_userid, $param_datetime, $param_peak1, $param_peak2, $param_peak3, $param_peak4, $param_peak5, $param_peak6, $param_peak7, $param_peak8, $param_peak9, $param_peak10, $param_peak11, $param_peak12);
                $param_userid = $_SESSION['login_userid'];
                $param_datetime = $_SESSION['latest_date'];
                $param_peak1 = $temps[0];
                $param_peak2 = $temps[1];
                $param_peak3 = $temps[2];
                $param_peak4 = $temps[3];
                $param_peak5 = $temps[4];
                $param_peak6 = $temps[5];
                $param_peak7 = $temps[6];
                $param_peak8 = $temps[7];
                $param_peak9 = $temps[8];
                $param_peak10 = $temps[9];
                $param_peak11 = $temps[10];
                $param_peak12 = $temps[11];
                if(mysqli_stmt_execute($stmt2)){
                }
                else{
                }
            }
            mysqli_stmt_close($stmt2);
        }
    }
}
mysqli_stmt_close($stmt);
$sql3 = "SELECT cdata FROM fdlogs WHERE cdate = ?";
if($stmt = mysqli_prepare($link,$sql3)){
	mysqli_stmt_bind_param($stmt, 's', $param_cdate);
	$param_cdate = $_SESSION['latest_date'];
	if(mysqli_stmt_execute($stmt)){
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt) == 0){
			$temps = array_fill(0, 12, 0);
            $theData = $_SESSION['theData'];
            $values = explode(" ",$theData[3]);

            foreach($numbers as $key => $vals){
                $temps[$key] = $vals;
            }
            $base1 = $temps[0];
            if(($temps[1]/$base1) > 3.5){

            }


            $sql4 = "INSERT INTO fdlogs(id,userid,cdate,heart,liver,spleen,lung,kidney,stomach,gall_brani,blader,the_large_intestine,the_small_intestine,triple_burner,pericardium) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		}
	}
}
mysqli_stmt_close($stmt);*/

$temps = array_fill(0, 12, 0);
$theData = $_SESSION['theData'];
$values = explode(" ",$theData[3]);

foreach($values as $key => $vals){
    $temps[$key] = $vals;
}
$base1 = $temps[0];
$health = array_fill(0, 12, 0);
/*liver*/
$health[0] = '你的心聲脈值約是'.round($base1,2);
if(round($temps[1]/$base1,1) > 3.5){
    $health[1] = '你的肝聲脈值約是心的'.round($temps[1]/$base1,1).'倍，可能有肝炎(充血)或癌症。';
}
else if(round($temps[1]/$base1,1) < 3.5){
    $health[1] = '你的肝聲脈值約是心的'.round($temps[1]/$base1,1).'倍，可能是肝的血管阻塞。';
}
else{
    $health[1] = '你的肝聲脈值約是心的'.round($temps[1]/$base1,1).'倍。';
}
/*kidney*/
/*under-usual*/
if(round(($temps[2]/$base1),1) >= 4.5 && round(($temps[2]/$base1),1) < 5.0){
    $health[2] = '正在休息嗎?你的腎聲脈值是正常值，約是心的'.round(($temps[2]/$base1),1).'倍';
}
else if(round(($temps[2]/$base1),1) == 3.5){
    $health[2] = '正在做運動嗎?腎的聲脈值約是心的'.round(($temps[2]/$base1),1).'倍';

}else if(round(($temps[2]/$base1),1) < 3.5){
	$health[2] = '你正在洗腎嗎?還是剛運動完休息呢?你的腎聲脈值約是'.round(($temps[2]/$base1),1).'倍';
}
else{
    $health[2] = '你的腎聲脈值約是心的'.round(($temps[2]/$base1),1).'倍';
}

if(round(($temps[3]/$base1),1) >= 3.1 && round($temps[3]/$base1,1) <= 3.5){
    $health[3] = '脾聲脈值為正常值，約是心的'.round(($temps[3]/$base1),1).'倍';
}
else if(round(($temps[3]/$base1),1) >= 2.9 && round(($temps[3]/$base1),1) < 3.1){
    $health[3] = '你可能感冒了，脾聲脈值約是心的'.round(($temps[3]/$base1),1).'倍';
}
else if(round($temps[3]/$base1,1) > 1.9 && round($temps[3]/$base1,1) < 2.1){
    $health[3] = '你可能先天性免疫系統失調，脾聲脈值約是心的'.round(($temps[3]/$base1),1).'倍';
}
else{
    $health[3] = '你的脾聲脈值約是心的'.round($temps[3]/$base1,1).'倍';
}

if(round($temps[4]/$base1,1) >= 3.5){
    $health[4] = '現在在練氣功?你的肺聲脈值約是心的'.round($temps[4]/$base1,1).'倍';
}
else if(round($temps[4]/$base1,1) == 3.5){
    $health[4] = '你的肺聲脈值約是心的'.round($temps[4]/$base1,1).'倍';
}
else{
    $health[4] = '你肺聲脈值約是心的'.round($temps[4]/$base1,1).'倍';
}

if(round($temps[5]/$base1,1) > 1 ){
    $health[5] = '你正在吃東西跟喝水，胃聲脈值約是心的'.round($temps[5]/$base1,1).'倍';
}
else if(round($temps[4]/$base1,1) == 1){
    $health[5] = '你的胃脈聲值為正常值，約是心的'.round($temps[5]/$base1,1).'倍';
}
else{
    $health[5] = '你的胃脈聲值是心的'.round($temps[5]/$base1,1).'倍';
}


if(round($temps[6]/$base1,1) >= 2){
    $health[6] = '你常做科研嗎?你經常使用你的大腦。你的大腦聲脈值是心的'.round($temps[6]/$base1,1).'倍';
}
else if(round($temps[6]/$base1,1) == 1){
    $health[6] = '你的大腦聲脈為正常值，約是心的'.round($temps[6]/$base1,1).'倍';
}
else if(round($temps[6]/$base1,1) >= 0.2 && round($temps[6]/$base1,1) <= 0.3){
    $health[6] = '你的大腦聲脈值是心的'.round($temps[6]/$base1,1).'倍，可能患有憂鬱症或是患有情緒障礙等疾病';
}
else{
    $health[6] = '你的大腦聲脈值約是心的'.round($temps[6]/$base1,1).'倍';
}

if(round($temps[7]/$base1,1) > 1){
    $health[7] = '你可能膀胱發炎或者是膀胱積尿過大，膀胱聲脈值約是心的'.round($temps[7]/$base1,1).'倍';
}
else if(round($temps[7]/$base1,1) == 1){
    $health[7] = '你的膀胱聲脈值為正常值，約是心的'.round($temps[7]/$base1,1).'倍';
}
else{
    $health[7] = '你膀胱聲脈值約是心的'.round($temps[7]/$base1,1).'倍';
}


if(round($temps[8]/$base1,1) > 1){
    $health[8] = '你的大腸可能發炎，大腸的聲脈值約是心的'.round($temps[8]/$base1,1).'倍';
}
else if(round($temps[8]/$base1,1) == 1){
    $health[8] = '你的大腸聲脈值為正常值，約是心的'.round($temps[8]/$base1,1).'倍';
}
else{
    $health[8] = '你的大腸聲脈值約是心的'.round($temps[8]/$base1,1).'倍';
}

if(round($temps[9]/$base1,1) > 1){
    $health[9] = '你的小腸可能發炎，小腸的聲脈值約是心的'.round($temps[9]/$base1,1).'倍';
}
else if(round($temps[9]/$base1,1) == 1){
    $health[9] = '你的小腸聲脈值為正常值，約是心的'.round($temps[9]/$base1,1).'倍';
}
else{
    $health[9] = '你的小腸聲脈值約是心的'.round($temps[9]/$base1,1).'倍';
}

if(round($temps[10]/$base1,1) == 1){
    $health[10] = '你的三焦聲脈值為正常值，約是心的'.round($temps[10]/$base1,1).'倍';
}
else{
    $health[10] = '你的三焦聲脈值約是心的'.round($temps[10]/$base1,1).'倍';
}
$health[11] = '心包經:不太了解此生理功能';

print_r($health);
?>