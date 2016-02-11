<?php
include("Includes/include.php");


session_start(); 
menysystem();

if($_GET["status"] == "ADDUNIT") {

	echo "<form method=\"POST\" action=\"formcheck.php?action=addunit\">

	<p align=\"left\"><b><font face=\"Arial\" size=\"2\">L�gg till placering</font></b></p>
	<table border=\"0\" width=\"75%\">
	<tr>
	<td align=\"left\"><font face=\"Arial\" size=\"1\">Namn&nbsp;&nbsp;
	</font> </td>
	<td><font face=\"Arial\"><input type=\"text\" name=\"namn\" size=\"42\"></font></td>
	</tr></table>
	<p><input type=\"submit\" value=\"Spara\" name=\"Spara\">
	<input type=\"reset\" value=\"Rensa\" name=\"Rensa\"></p>
	</form>";
	
	echo "<Table width=\"75%\"> <font face=\"Arial\" size=\"1\">";
	connectdb();
	$sql="SELECT * FROM TellstickUnitTypes order by namn ASC";
	$result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);
	$i=0;
while ($num > $i) {
	if($i % 2) {
	$color="#BEBEBE";
   
} else {
   $color="#949494"; 
}	
	$namn=mysql_result($result,$i,"namn");
	$id=mysql_result($result,$i,"id");
	echo "<tr><td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\">$namn</td>
	<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href =\"formcheck.php?status=delunit&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/delete.png\" width=\"16\" height=\"16\"></a> 
	<a href =\"generic.php?status=editunit&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/edit.png\" width=\"16\" height=\"16\"></a></td></tr>";
	
$i++;
}
echo "</table>";
}

if($_GET["status"] == "editunit") {

	$id=$_GET["id"];
	
	$result=mysql_query("Select * FROM TellstickUnitTypes where id='$id'") or die( 'Databasfel !!! ' . mysql_error());
	$namn2=mysql_result($result,0,"namn");

	
	echo "<form method=\"POST\" action=\"formcheck.php?status=updateunit&id=$id&oldname=$namn2\">
	
	<p align=\"left\"><b><font face=\"Arial\" size=\"2\">Editera  enhetstyp</font></b></p>
	<table border=\"0\" width=\"75%\">
	<tr>
	<td align=\"left\"><font face=\"Arial\" size=\"1\">Namn&nbsp;&nbsp;
	</font> </td>
	<td><font face=\"Arial\"><input type=\"text\" name=\"namn\" size=\"42\" value=\"$namn2\"></font></td>
	</tr></table>
	<p><input type=\"submit\" value=\"Spara\" name=\"Spara\">
	<input type=\"reset\" value=\"Rensa\" name=\"Rensa\"></p>
	</form>";
	
	echo "<Table width=\"75%\"> <font face=\"Arial\" size=\"1\">";
	connectdb();
	$sql="SELECT * FROM TellstickUnitTypes order by namn ASC";
	$result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);
	$i=0;
	
	while ($num > $i) {
	if($i % 2) {
	$color="#BEBEBE";
   
} else {
   $color="#949494"; 
}
		$namn=mysql_result($result,$i,"namn");
			$id=mysql_result($result,$i,"id");
	
		echo "<tr><td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\">$namn</td>
		<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href =\"formcheck.php?status=delunit&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/delete.png\" width=\"16\" height=\"16\"></a>
		<a href =\"generic.php?status=editunit&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/edit.png\" width=\"16\" height=\"16\"></a></td></tr>";
	
		$i++;
	}
	echo "</table>";
}

if($_GET["status"] == "editplac") {

	$id=$_GET["id"];
	
	$result=mysql_query("Select * FROM TellstickUnitPlace where id='$id'") or die( 'Databasfel !!! ' . mysql_error());
	$namn2=mysql_result($result,0,"namn");

	
	echo "<form method=\"POST\" action=\"formcheck.php?status=updateplac&id=$id&oldname=$namn2\">
	
	<p align=\"left\"><b><font face=\"Arial\" size=\"2\">Editera  placering</font></b></p>
	<table border=\"0\" width=\"75%\">
	<tr>
	<td align=\"left\"><font face=\"Arial\" size=\"1\">Namn&nbsp;&nbsp;
	</font> </td>
	<td><font face=\"Arial\"><input type=\"text\" name=\"namn\" size=\"42\" value=\"$namn2\"></font></td>
	</tr></table>
	<p><input type=\"submit\" value=\"Spara\" name=\"Spara\">
	<input type=\"reset\" value=\"Rensa\" name=\"Rensa\"></p>
	</form>";
	
	echo "<Table width=\"75%\"> <font face=\"Arial\" size=\"1\">";
	connectdb();
	$sql="SELECT * FROM TellstickUnitPlace order by namn ASC";
	$result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);
	$i=0;
	
	while ($num > $i) {
	if($i % 2) {
	$color="#BEBEBE";
   
} else {
   $color="#949494"; 
}
		$namn=mysql_result($result,$i,"namn");
			$id=mysql_result($result,$i,"id");
	
		echo "<tr><td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\">$namn</td>
		<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href =\"formcheck.php?status=delplac&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/delete.png\" width=\"16\" height=\"16\"></a>
		<a href =\"generic.php?status=editplac&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/edit.png\" width=\"16\" height=\"16\"></a></td></tr>";
	
		$i++;
	}
	echo "</table>";
	}

if($_GET["status"] == "ADDPLAC") {

	echo "<form method=\"POST\" action=\"formcheck.php?action=addplac\">

	<p align=\"left\"><b><font face=\"Arial\" size=\"2\">L�gg till placering</font></b></p>
	<table border=\"0\" width=\"75%\">
	<tr>
	<td align=\"left\"><font face=\"Arial\" size=\"1\">Namn&nbsp;&nbsp;
	</font> </td>
	<td><font face=\"Arial\"><input type=\"text\" name=\"namn\" size=\"42\"></font></td>
	</tr></table>
	<p><input type=\"submit\" value=\"Spara\" name=\"Spara\">
	<input type=\"reset\" value=\"Rensa\" name=\"Rensa\"></p>
	</form>";
	
	echo "<Table width=\"75%\"> <font face=\"Arial\" size=\"1\">";
	connectdb();
	$sql="SELECT * FROM TellstickUnitPlace order by namn ASC";
	$result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);
	$i=0;
while ($num > $i) {
	if($i % 2) {
	$color="#BEBEBE";
   
} else {
   $color="#949494"; 
}	
	$namn=mysql_result($result,$i,"namn");
	$id=mysql_result($result,$i,"id");
	echo "<tr><td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\">$namn</td>
	<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href =\"formcheck.php?status=delplac&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/delete.png\" width=\"16\" height=\"16\"></a> 
	<a href =\"generic.php?status=editplac&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/edit.png\" width=\"16\" height=\"16\"></a></td></tr>";
	
$i++;
}
echo "</table>";
}
if($_GET["status"] == "ADDGRUPP") {

	echo "<form method=\"POST\" action=\"formcheck.php?action=addgroups\">

	<p align=\"left\"><b><font face=\"Arial\" size=\"2\">L�gg till grupp</font></b></p>
	<table border=\"0\" width=\"75%\">
	<tr>
	<td align=\"left\"><font face=\"Arial\" size=\"1\">Namn&nbsp;&nbsp;
	</font> </td>
	<td><font face=\"Arial\"><input type=\"text\" name=\"namn\" size=\"42\"></font></td>
	</tr></table>
	<td align=\"left\"><font face=\"Arial\" size=\"1\">Namn&nbsp;&nbsp;
	</font> </td>
	<td><font face=\"Arial\"><input type=\"text\" name=\"namn\" size=\"42\"></font></td>
	</tr></table>
	<p><input type=\"submit\" value=\"Spara\" name=\"Spara\">
	<input type=\"reset\" value=\"Rensa\" name=\"Rensa\"></p>
	</form>";
	
	echo "<Table width=\"75%\"> <font face=\"Arial\" size=\"1\">";
	connectdb();
	$sql="SELECT * FROM TellstickUnitsGroups order by namn ASC";
	$result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);
	$i=0;
while ($num > $i) {	
	if($i % 2) {
	$color="#BEBEBE";
   
} else {
   $color="#949494"; 
}
	$namn=mysql_result($result,$i,"namn");
	$id=mysql_result($result,$i,"id");
	echo "<tr><td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><$namn</td>
	<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href =\"formcheck.php?status=delplac&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/delete.png\" width=\"16\" height=\"16\"></a></td> 
	<td bgcolor=\"$color\"><B><font face=\"Arial\" size=\"2\"><a href =\"generic.php?status=editplac&id=$id&namn=$namn\"><img border=\"0\" src=\"images/system/edit.png\" width=\"16\" height=\"16\"></a></td></tr>";
	
$i++;
}
echo "</table>";
}
?>