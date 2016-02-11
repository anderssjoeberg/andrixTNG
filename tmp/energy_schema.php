<?

include("/var/www/andrix/Includes/energyfunctions.php");

$starttime = EXPLODE(' ', MICROTIME());
$starttime = $starttime[1] + $starttime[0];

	
//fixar lite datum,tid osv
$datum=date("Y-m-d");
$tid=date("G:i");
$dag=date("d");
$manad=date("m");
$year=date("Y");	
$timme=date("H");
$minut=date("i");

updateday();
updatemonth($manad);
    
if($tid=='00:00') {
	updatemonth($manad);
	updateyear();
}

if($tid=='06:00') {
	updatemonth($manad);
	
}

if($tid=='12:00') {
	updatemonth($manad);
	updateyear();
}

if($tid=='18:00') {
	updatemonth($manad);

}

$mtime = EXPLODE(' ', MICROTIME());
$totaltime = $mtime[0] + $mtime[1] - $starttime;
PRINTF('Page loaded in %.3f seconds.', $totaltime);


?>