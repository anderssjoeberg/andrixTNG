<?
 $con = mysql_connect("localhost","root","f0ndr132t");
 mysql_select_db("andrix", $con) or die( 'Databasfel !!! ' . mysql_error());
		
		
//fixar lite datum,tid osv
$datum=date("Y-m-d");
$tid=date("G:i");

echo "$tid";
echo "</BR>";
echo "$datum";
if ($tid=='00:00') {
	
// K�r igenom och kollar om schemat �r k�rdat och st�llerom s� det kan k�ras igen
mysql_query("UPDATE Schedules SET runtoday='1'") or die( 'Databasfel !!! ' . mysql_error());	
}

if ($tid=='00:01' && $datum=='2012-01-01') {
$sql="Truncate mesure";
$result=mysql_query($sql);	
}

//K�r igenom alla schemor som �r aktiva och inte har dag,datum eller m�nad angiven med andra ord ska k�ras varje dag

$sql="SELECT * from Schedules WHERE tid='$tid' AND aktiv='1'";
echo "$sql";
$result=mysql_query($sql);
$num=mysql_numrows($result);


$i=0;
	while ($i < $num) {
		
	$id=mysql_result($result,$i,"unitid");
    $action=mysql_result($result,$i,"action");
    $namn=mysql_result($result,$i,"unitname");
    
	echo "$id";
	echo "$action";
	echo "$namn";
		
	if($action=='T�nd'){
		
		$command="/usr/bin/tdtool --on ".$id."";
        exec($command,$exec); 
        mysql_query("UPDATE TellstickUnits SET status= 'ON' WHERE id='$id'");
		mysql_query("UPDATE TellstickUnits SET dimlevel= '100' WHERE id='$id'");
	}
	
	if($action=='Sl�ck'){
		$command="/usr/bin/tdtool --off ".$id."";
        exec($command,$exec); 
        mysql_query("UPDATE TellstickUnits SET status='OFF' WHERE id='$id'");
		mysql_query("UPDATE TellstickUnits SET dimlevel='0' WHERE id='$id'");
	}
	
$i++;

	}
mysql_close($con);
?>