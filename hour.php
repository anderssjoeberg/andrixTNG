<?php
include("Includes/jpgraph/jpgraph.php");
include("Includes/jpgraph/jpgraph_line.php");
include("Includes/includes.php");

ConnectDb(write,andrixTNG1wire);

$dag=date("d");
$manad=date("m");
$year=date("Y");
$timme=date("H");
$minut=date("i");

$nexttimme=$timme+1;
if ($nexttimme>23) {$nexttimme='00';}

$result7=mysql_query("SELECT * FROM 1wireEnergy WHERE day='$dag' and hour='$timme' order by id ASC");
$result8=mysql_query("SELECT AVG(value) FROM 1wireEnergy WHERE day='$dag' AND hour='$timme'");

$num7=mysql_numrows($result7);


$ydata = array();
$zdata = array();

$c=0;


while ($c < $num7) {



    $value=mysql_result($result7,$c,"value");
    $avgvalue=mysql_result($result8,0,"AVG(value)");

    $ydata[$c]=$value;
    $zdata[$c]=$avgvalue;

    $c++;
}



$namn="Energi förbrukning ".$year."-".$manad."-".$dag." ".$timme.":00";
$file="/var/www/sys/Graphs/$year/$manad/$dag/$timme/energi_".$year."-".$manad."-".$dag."-".$timme.":00.png";
drawdiagram($ydata, $zdata, $namn, $file);

?>





