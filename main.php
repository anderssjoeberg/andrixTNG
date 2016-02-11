<?php
error_reporting(E_ALL);
session_start();

include("Includes/includes.php");

if (!($_SESSION["User"])){
	echo $_SESSION["user"];
	$iplocal=CheckIPLocal($ip);

    if($iplocal == '1') {
        header("location:main.php");
    }
	else
        BlockIP($ip);
		header("location:index.php");
}

ConnectDb(write,andrixTNG);


if($_GET["status"] == "ALLOFF") {
	$sql="SELECT * FROM TelldusUnits where UnitStatus='ON' ";
	$result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);

	while($i < $num) {
	$id=mysql_result($result,$i,"UnitId");
	TelldusUnitOFF("$id");
	$i++;
	}
	header("location:main.php");
}
if($_GET["status"] == "ON") {
	$id=$_GET["id"];
	TelldusUnitON("$id");
	header("location:main.php");
}if($_GET["status"] == "ON") {
    $id=$_GET["id"];
    TelldusUnitON("$id");
    header("location:main.php");
}
if($_GET["status"] == "OFF") {
    $id=$_GET["id"];

    TelldusUnitOFF("$id");
    header("location:main.php");
}
if($_GET["status"] == "OFF") {
	$id=$_GET["id"];

	TelldusUnitOFF("$id");
	header("location:main.php");
}
if($_GET["status"] == "DIM") {
	$id=$_GET["id"];
	$level=$_GET["level"];
	$step=$_GET["step"];

	$level=($level+$step);
	if($level > 100) {
		$level=100;
	}
	TelldusUnitDim("$id","$level");
}
if($_GET["status"] == "Tellstick"){
    TelldusExportConfig();
    header("location:main.php");

}
if($_GET["status"] == "Firewall"){
    ExportFirewallConfig();
    header("location:main.php");

}


$query = "SELECT * FROM TelldusUnits";
$result=mysql_query($query);
$num=mysql_numrows($result);

menysystem();

echo "<Table width=\"60%\"> <font face=\"Arial\" size=\"2\">";

$i=0;


while ($i < $num) {

$UnitId=mysql_result($result,$i,"UnitId");
$UnitName=mysql_result($result,$i,"UnitName");
$UnitStatus=mysql_result($result,$i,"UnitStatus");
$UnitModell=mysql_result($result,$i,"UnitModell");
$dimlevel=mysql_result($result,$i,"dimlevel");


if($i % 2) {
	$color="#BEBEBE";
   
} else {
   $color="#949494"; 
}

echo "<tr><td bgcolor=\"$color\"><font face=\"Arial\" size=\"2\"><B>$UnitName</font></td>";



IF($UnitStatus==OFF) {
echo "<font face=\"Arial\" size=\"2\"><B><td bgcolor=\"$color\"><a href=\"main.php?status=ON&id=$UnitId\"><img border=\"0\" src=\"images/system/lampoff.png\" width=\"32\" height=\"32\"></a></td>
	 <td bgcolor=\"$color\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>    </td>";
}

else {

	if($UnitModell=='selflearning-dimmer'){

		
	echo "<td bgcolor=\"$color\">
	<a href=\"main.php?status=OFF&id=$UnitId\">
	<img border=\"0\" src=\"images/system/lampon.png\" width=\"32\" height=\"32\"></a>
	</td>
	
	
	<td bgcolor=\"$color\">
	
	<div id=\"slider-".$UnitId."_".$UnitId."\" class=\"slider\" name=\"$namn\"></div>
	<span id=\"slider-status-".$UnitId."_".$UnitId."\" style=\"font-face: Arial; font-size: 10px;\">$dimlevel</span>
	</td>";}

	else {
	echo "<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href=\"main.php?status=OFF&id=$UnitId\"><img border=\"0\" src=\"images/system/lampon.png\" width=\"32\" height=\"32\"></a></font></td>
	<td bgcolor=\"$color\"><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </td>";
	

}
}
echo "</tr>";
$i++;
}
echo "<tr> </tr>";
echo "</Table></font>";








?>
