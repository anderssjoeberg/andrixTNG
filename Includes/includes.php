

<link href="includes/css/jquery-ui.css" rel="stylesheet" type="text/css" />

<script src="Includes/jquery/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="Includes/jquery/jquery-ui-1.8.7.min.js" type="text/javascript"></script>
<script src="Includes/jquery/sliders.js" type="text/javascript"></script>


<?php
function ConnectDb($status,$db){
    if($status=='read'){
        $con = mysql_connect("dbnode001.andrix.se","root","21*T0rp3d0");
        mysql_select_db("$db", $con) or die( 'Databasfel !!! ' . mysql_error());
    }
    else if($status=='write'){
        $con = mysql_connect("dbnode001.andrix.se","root","21*T0rp3d0");
         mysql_select_db("$db", $con) or die( 'Databasfel !!! ' . mysql_error());
    }
}
function CreateSensorTable($name)
{
    if (mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . $name . "'")) == 0) {

        $sql = "CREATE TABLE `$name` (
`id` INT (11) NULL DEFAULT NULL,
`year` SMALLINT (6) NULL DEFAULT NULL,
`month` TINYINT (4) NULL DEFAULT NULL,
`day` TINYINT (4) NULL DEFAULT NULL,
`hour` TINYINT (4) NULL DEFAULT NULL,
`minute` TINYINT (4) NULL DEFAULT NULL,
`value` INT (11) NULL DEFAULT NULL
)
ENGINE= InnoDB
;
";
        mysql_query($sql) or die('Databasfel !!! ' . mysql_error());
    }
}
function RemoveSensorTable($name) {
    $sql="DROP TABLE `$name`;";
    mysql_query($sql) or die('Databasfel !!! ' . mysql_error());
}

function CreateRandomPassword() {
//Skapar ett 12tecken lång lösen  ord
	$chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEFGHIJKLMNOPQRSTUWVXYZ";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;

	while ($i <= 12) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}

	return $pass;
}
function CreateUnitCode() {
	$hcode=rand(1, 67108863);
	$ucode=rand(1, 16);
	
	return $hcode;
	return $ucode;
}
function menysystem()

{

	echo "<head>

	<link rel=\"stylesheet\" href=\"Includes/css/style.css\" type=\"text/css\" />

	</head>
	<body style=\"background-color:#EBEBEB\">
<table border=\"0\" width=\"100%\" cellspacing=\"0\" height=\"120\">
	<tr>
		<td bgcolor=\"#009933\" height=\"35\">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor=\"#606060\"><font color=\"#FFFF00\" face=\"Arial Black\" size=\"7\">
		AndrixCenter <BR></font><font color=\"#FFFF00\" face=\"Arial Black\" size=\"3\">
		THE NEXT GENERATION <BR><BR><BR></font>
		<font color=\"#FFFF00\" face=\"Arial Black\" size=\"3\">
		Allt för det smarta hemmet</font></td>
	</tr>
</table>

<table border=\"0\">
<tr><td>
    <ul id=\"css3menu1\" class=\"topmenu\">
		<li><a href=\"main.php\" title=\"Tänd och släck<\" style=\"height:11px;line-height:11px;\"><span>Hem</span></a></li>

		<li><a href=\"#\" title=\"Tänd och släck<\" style=\"height:11px;line-height:11px;\"><span>Tänd och släck</span></a>
		<ul>


		<li><a href=\"main.php?status=ALLON\" title=\"Tänd alla lampor\">Tänd alla lampor</a></li>
		<li><a href=\"main.php?status=ALLOFF\" title=\"Släck alla lampor\">Släck alla lampor</a></li>
		<li><a href=\"main.php?status=ALLON\" title=\"Slå på alla enheter\">Slå på alla enheter</a></li>
		<li><a href=\"main.php?status=ALLOFF\" title=\"Slå av alla enheter\">Slå av alla enheter</a></li>
		</ul>
		<li><a href=\"#\" title=\"Sensorer<\" style=\"height:11px;line-height:11px;\"><span>Sensorer</span></a>
		<ul>
		<li><a href=\"main.php?page=showall\" title=\"xxx\">xxx</a></li>

		</ul>
		<li><a href=\"#\" title=\"System<\" style=\"height:11px;line-height:11px;\"><span>System</span></a>
		<ul>
		<li><a href=\"main.php?status=Firewall\" title=\"Alla enheter\">Exportera Brandvägs configuration</a></li>
		<li><a href=\"main.php?status=Tellstick\" title=\"Alla enheter\">Exportera Tellstick configuration</a></li>
		</ul>

    </td></tr>
    </table>";



}

Function TelldusUnitON($id) {



    mysql_query("UPDATE TelldusUnits SET UnitStatus = 'ON' WHERE UnitId='$id'");

    $sql="select Runtimes from Setting";
    $result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
    $num=mysql_numrows($result);
    $RunTimes=mysql_result($result,0,"RunTimes");
    $x=0;

    while ($x < $RunTimes) {

        $command = "/usr/bin/tdtool --on " . $id . "";
        exec($command, $exec);
        $x++;
    }



    $sql="SELECT * FROM TelldusUnits WHERE UnitId='$id'";
    $result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
    $num=mysql_numrows($result);
    $count=mysql_result($result,0,"UnitCount");
    $count++;
    mysql_query("UPDATE UnitCount SET UnitCount='$count' WHERE UnitId='$id'");
    mysql_query("UPDATE TelldusUnits SET UnitDimLvl='255' WHERE UnitId='$id'");

}
Function TelldusUnitOFF($id) {
//Stänger av en enhet version 1
    mysql_query("UPDATE TelldusUnits SET UnitStatus = 'OFF' WHERE UnitId='$id'");
    $sql="select Runtimes from Setting";
    $result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
    $num=mysql_numrows($result);
    $RunTimes=mysql_result($result,0,"RunTimes");
    $x=0;

    while ($x < $RunTimes) {
        $command = "/usr/bin/tdtool --off " . $id . "";
        exec($command, $exec);
        $x++;
    }


    $sql="SELECT * FROM TelldusUnits WHERE UnitId='$id'";
    $result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
    $num=mysql_numrows($result);
    $count=mysql_result($result,0,"UnitCount");
    $count++;
    mysql_query("UPDATE TelldusUnits SET UnitCount='$count' WHERE UnitId='$id'");
    mysql_query("UPDATE TelldusUnits SET UnitDimLvl='0' WHERE UnitId='$id'");
}
Function TelldusUnitDim($id,$level) {
// Dimmer funktion av enhet version 1


    $sql="UPDATE TelldusUnits SET Unitdimlevel = $level WHERE Unitid='$id'";
    $result=mysql_query($sql);

    $level2=($level/100);
    $lvl=round((255*$level2), 0);

    $command="/usr/bin/tdtool --dimlevel ".$lvl."  --dim ".$id."";
    exec($command,$exec);

    $sql="SELECT * FROM TelldusUnits WHERE UnitId='$id'";
    $result=mysql_query($sql) or die( 'Databasfel !!! ' . mysql_error());
    $num=mysql_numrows($result);
    $count=mysql_result($result,0,"UnitCount");
    $count++;
    mysql_query("UPDATE TelldusUnits SET UnitCount='$count' WHERE UnitId='$id'");
    mysql_query("UPDATE TelldusUnits SET UnitDimLvl='$lvl' WHERE UnitId='$id'");

}
Function TelldusExportConfig(){
	
	ConnectDb(write,andrixTNG);
	mysql_query("UPDATE Setting SET ExportTelldusConfig = '1'")  or die( 'Databasfel !!! ' . mysql_error());
	
    $timestamp = date("Y-m-d  H:m");
    $file = fopen("/var/www/sys/configfiles/tellstick/tellstick.conf", "w");
    $string = "# Created by AndrixTNG $timestamp
user = \"nobody\"

group = \"plugdev\"
deviceNode = \"/dev/tellstick\"
ignoreControllerConfirmation = \"false\"\n";


    fwrite($file,$string);
    fclose($file);

    $result=mysql_query("SELECT * from TelldusUnits");
    $num=mysql_numrows($result);

    $file = fopen("/var/www/sys/configfiles/tellstick/tellstick.conf", "a");
    $i=0;

    $UnitId=1;

    while ($i < $num) {

        $id=mysql_result($result,$i,"Unitid");
        $namn=mysql_result($result,$i,"UnitName");
        $protokoll=mysql_result($result,$i,"UnitProtocoll");
        $modell=mysql_result($result,$i,"UnitModell");
        $unitcode=mysql_result($result,$i,"UnitCodeId");
        $housecode=mysql_result($result,$i,"UnitCode");

        mysql_query("UPDATE TelldusUnits SET UnitId = '$UnitId' WHERE UnitName='$namn'")  or die( 'Databasfel !!! ' . mysql_error());

        $string = "device {
  id = $UnitId
  name = \"$namn\"
  controller = 0
  protocol = \"$protokoll\"
  model = \"$modell\"
  parameters {
  	# devices = \"\"
    house = \"$housecode\"
    unit = \"$unitcode\"
    # code = \"\"
    # system = \"\"
    # units = \"\"
    # fade = \"\"
  }
}\n";

        fwrite($file,$string);

        $i++;
        $UnitId++;
    }
    fclose($file);
    $file = fopen("/var/www/sys/configfiles/tellstick/tellstick.conf", "a");

    $string="controller {
  id = 1
  # name = \"\"
  type = 2
  serial = \"A6028CUL\"
}
controller {
  id = 2
  # name = \"\"
  type = 1
  serial = \"A4016CZW\"
}";

    fwrite($file,$string);

    chgrp("/var/www/sys/configfiles/tellstick/tellstick.conf","plugdev");
    chown("/var/www/sys/configfiles/tellstick/tellstick.conf","root");
    fclose($file);



}
function ReadTelldusStatus()
{

    # Reads Status from Telldus Duo if unit changed status with pushbutton or otherway than Andrix
    # Then it change status in Andrix system to be the same

    ConnectDb(write, andrixTNG);

    $output = null;
    exec('/usr/bin/tdtool --list-devices', $output);

    foreach ($output as $row) {
        $columns = explode("\t", $row);
        $columns[1] = substr($columns[1], 3);
        $columns[3] = substr($columns[3], 16);

        mysql_query("UPDATE TelldusUnits SET UnitStatus='$columns[3]' WHERE UnitId='$columns[1]'");
    
    }
}
function ReloadTelldusConfig(){
    # Reload new Tellstick.conf file and restarts the Tellduscore service
	ConnectDb(write,andrixTNG);
	$result=mysql_query("Select ExportTelldusConfig From Setting")  or die( 'Databasfel !!! ' . mysql_error());
	$status=mysql_result($result,$i,"ExportTelldusConfig");
	
	if($status=='1') {
	
    $command="rm /etc/tellstick.conf";
    exec($command,$exec);

    $command="cp /var/www/sys/configfiles/tellstick/tellstick.conf /etc/";
    exec($command,$exec);

    $command="chown root:plugdev /etc/tellstick.conf";
    exec($command,$exec);

    $command="/etc/init.d/telldusd restart";
    exec($command,$exec);

	mysql_query("UPDATE Setting SET ExportTelldusConfig = '0'")  or die( 'Databasfel !!! ' . mysql_error());
	}
}
function GetSensorAge() {
	
$output = null;
exec('/usr/bin/tdtool --list-sensors', $output);

foreach ($output as $row) {
    $columns = explode("\t", $row);

    
$sensortime = substr($columns[6], 5);
$time=date('Y-m-d H:i:s');

$date1=date_create("$sensortime");
$date2=date_create("$time");
$diff=date_diff($date1,$date2);

$str = $diff->format("%s%");

return $str;
}
}

function CheckIPLocal($ip)
{

    $ip = substr($ip, 0, 7);

    if ($ip == '192.168') {
        $str = 1;
        return $str;
    }
    elseif ($ip == '127.0.0'){
        $str = 1;
        return $str;
    }

    else $str = 0;
    return $str;
}
function GetIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function BlockIP($ip) {
    ConnectDb(write,andrixTNG);
    echo "$ip";

    $query = "SELECT * FROM BlockIP where ip='$ip'";
    $result=mysql_query($query);


    if(mysql_num_rows($result) == 0){
        $query = "INSERT INTO BlockIP(ip) VALUES ('$ip')";
        mysql_query($query)  or die( 'Databasfel !!! ' . mysql_error());
        $command="iptables -A INPUT -s ". $ip ."-j DROP";
        exec($command,$exec);
    }

}
function CheckIPBlock($ip) {
    $result=mysql_query("SELECT * FROM BlockIP where ip='$ip'");
    if(mysql_num_rows($result) == 1){
        $str=1;
        return $str;
    }
    else $str=0;
    return $str;
}
function ExportFirewallConfig(){
    ConnectDb(write,andrixTNG);
    $result=mysql_query("Delete FROM BlockIP where ip =''");

    $result=mysql_query("SELECT * FROM BlockIP");
    $num=mysql_numrows($result);
    $x=0;

    while ($x < $num) {
        $ip=mysql_result($result,$x,"ip");
        $command = "iptables -A INPUT -s ". $ip ."-j DROP";
        $file = fopen("/var/www/sys/configfiles/firewall/blockip", "a");
        exec($command, $exec);
        $string = "iptables -A INPUT -s ". $ip ."-j DROP\n";
        fwrite($file,$string);
        $x++;
    }
    fclose($file);
}

function drawdiagram($ydata, $zdata, $namn,$file)
{
    $graph = new Graph(700,300);
    $graph->SetScale("textlin");
    $lineplot=new LinePlot($ydata);
    $lineplot->SetColor('blue');
    $graph->title->Set($namn);

    $graph->Add($lineplot);
    $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
    $fileName = "$file";
    $graph->img->Stream($fileName);
}
function drawdiagramfill($ydata,$zdata,$namn,$file)
{
    $graph = new Graph(700,300);
    $graph->SetScale("textlin");
    $lineplot=new LinePlot($ydata);
    $lineplot->SetColor('#aadddd');
    $lineplot->SetFillGradient('#FFFFFF','#F0F8FF');

    $lineplot2=new LinePlot($zdata);
    $lineplot2->SetColor('red');

    $graph->title->Set($namn);

    $graph->Add($lineplot);
    $graph->Add($lineplot2);

    $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
    $fileName = "$file";
    $graph->img->Stream($fileName);
}

function GetDays($monthnr) {

    if($monthnr==01) {
        $days='31';
    }
    if($monthnr==02) {
        $days='28';
    }
    if($monthnr==03) {
        $days='31';
    }
    if($monthnr==04) {
        $days='30';
    }
    if($monthnr==05) {
        $days='31';
    }
    if($monthnr==06) {
        $days='30';
    }
    if($monthnr==07) {
        $days='31';
    }
    if($monthnr==08) {
        $days='31';
    }
    if($monthnr==09) {
        $days='30';
    }
    if($monthnr==10) {
        $days='31';
    }
    if($monthnr==11) {
        $days='30';
    }
    if($monthnr==12) {
        $days='31';
    }

    return $days;
}
function GetMonthName($monthnr)
{

    if($monthnr==01) {
        $month='januari';
    }
    if($monthnr==02) {
        $month='februari';
    }
    if($monthnr==03) {
        $month='mars';
    }
    if($monthnr==04) {
        $month='april';
    }
    if($monthnr==05) {
        $month='maj';
    }
    if($monthnr==06) {
        $month='juni';
    }
    if($monthnr==07) {
        $month='juli';
    }
    if($monthnr==08) {
        $month='augusti';
    }
    if($monthnr==09) {
        $month='september';
    }
    if($monthnr==10) {
        $month='oktober';
    }
    if($monthnr==11) {
        $month='november';
    }
    if($monthnr==12) {
        $month='december';
    }

    return $month;
}
function GetMonth()
{
    $monthnr=date("n");
    if($monthnr==1) {
        $month=' Januari ';
    }
    if($monthnr==2) {
        $month=' Februari ';
    }
    if($monthnr==3) {
        $month=' Mars ';
    }
    if($monthnr==4) {
        $month=' April ';
    }
    if($monthnr==5) {
        $month=' Maj ';
    }
    if($monthnr==6) {
        $month=' Juni ';
    }
    if($monthnr==7) {
        $month=' Juli ';
    }
    if($monthnr==8) {
        $month=' Augusti ';
    }
    if($monthnr==9) {
        $month=' September ';
    }
    if($monthnr==10) {
        $month=' Oktober ';
    }
    if($monthnr==11) {
        $month=' November ';
    }
    if($monthnr==12) {
        $month=' December ';
    }


    return $month;
}
function GetSolUp()
{

    connectdb();
    $sql="SELECT * from settings WHERE label=longitud";
    $result=mysql_query($sql);

    $longitud=mysql_result($result,"value");

    $sql="SELECT * from settings WHERE label=latitud";
    $result=mysql_query($sql);

    $latitud=mysql_result($result,"latitud");

    $sql="SELECT * from settings WHERE label=tidzon";
    $result=mysql_query($sql);
    $timezone=mysql_result($result,"value");


    $zenith = (90 + (50 / 60));
    $twilightZenith = 96;


    $time=date_sunrise(time(), SUNFUNCS_RET_STRING, $latitud, $longitud, $zenith, $timezone);

    return $time;
}
function GetDay()
{
    $daynr=date("N");
    if($daynr==1) {
        $day='M�ndag ';
    }
    if($daynr==2) {
        $day='Tisdag ';
    }
    if($daynr==3) {
        $day='Onsdag ';
    }
    if($daynr==4) {
        $day='Torsdag ';
    }
    if($daynr==5) {
        $day='Fredag ';
    }
    if($daynr==6) {
        $day='L�rdag ';
    }
    if($daynr==7) {
        $day='S�ndag ';
    }


    return $day;
}
function GetMonthNr($monthnr)
{

    if($monthnr==1) {
        $month=' Januari ';
    }
    if($monthnr==2) {
        $month=' Februari ';
    }
    if($monthnr==3) {
        $month=' Mars ';
    }
    if($monthnr==4) {
        $month=' April ';
    }
    if($monthnr==5) {
        $month=' Maj ';
    }
    if($monthnr==6) {
        $month=' Juni ';
    }
    if($monthnr==7) {
        $month=' Juli ';
    }
    if($monthnr==8) {
        $month=' Augusti ';
    }
    if($monthnr==9) {
        $month=' September ';
    }
    if($monthnr==10) {
        $month=' Oktober ';
    }
    if($monthnr==11) {
        $month=' November ';
    }
    if($monthnr==12) {
        $month=' December ';
    }


    return $month;
}
function GetSolNer()
{
    connectdb();
    $sql="SELECT * from settings WHERE label=longitud";
    $result=mysql_query($sql);

    $longitud=mysql_result($result,"value");

    $sql="SELECT * from settings WHERE label=latitud";
    $result=mysql_query($sql);

    $latitud=mysql_result($result,"latitud");

    $sql="SELECT * from settings WHERE label=tidzon";
    $result=mysql_query($sql);
    $timezone=mysql_result($result,"value");

    $zenith = (90 + (50 / 60));
    $twilightZenith = 96;


    $time=date_sunset(time(), SUNFUNCS_RET_STRING, $latitud, $longitud, $zenith, $timezone);

    return $time;
}
function GetGryning()
{
    connectdb();
    $sql="SELECT * from settings WHERE label=longitud";
    $result=mysql_query($sql);

    $longitud=mysql_result($result,"value");

    $sql="SELECT * from settings WHERE label=latitud";
    $result=mysql_query($sql);

    $latitud=mysql_result($result,"latitud");

    $sql="SELECT * from settings WHERE label=tidzon";
    $result=mysql_query($sql);
    $timezone=mysql_result($result,"value");

    $zenith = (90 + (50 / 60));
    $twilightZenith = 96;


    $time=date_sunrise(time(), SUNFUNCS_RET_STRING, $latitud, $longitud, $twilightZenith, $timezone);

    return $time;
}
function GetSkymning()
{
    connectdb();
    $sql="SELECT * from settings WHERE label=longitud";
    $result=mysql_query($sql);

    $longitud=mysql_result($result,"value");

    $sql="SELECT * from settings WHERE label=latitud";
    $result=mysql_query($sql);
    $latitud=mysql_result($result,"latitud");

    $sql="SELECT * from settings WHERE label=tidzon";
    $result=mysql_query($sql);
    $timezone=mysql_result($result,"value");

    $zenith = (90 + (50 / 60));
    $twilightZenith = 96;

    $timezone=1;

    $time=date_sunset(time(), SUNFUNCS_RET_STRING, $latitud, $longitud, $twilightZenith, $timezone);

    return $time;
}
function ExportSchedule() {
	
	$timestamp = date("Y-m-d  H:m");
	ConnectDb(write, andrixTNG);
	$file = fopen("sys/configfiles/CRON", "a");
	$string = "# Created by AndrixTNG $timestamp";
    fwrite($file,$string);
    fclose($file);
    	
	$result=mysql_query("Select * From Schedule Order by ID DESC") or die('Databasfel !!! ' . mysql_error());
	$num=mysql_numrows($result);
	$i=0;

    while ($i < $num) {

        $ID=mysql_result($result,$i,"ID");
        $minute=mysql_result($result,$i,"minute");
        $hour=mysql_result($result,$i,"hour");
        $dayofMon=mysql_result($result,$i,"dayofMon");
	    $month=mysql_result($result,$i,"month");
        $dayofWek=mysql_result($result,$i,"dayofWek");
    }
    $i++;
}
function ReadSensor() {

    $sensor = "/mnt/1wire/1D.C0FA0C000000/counter.B";
    $file = fopen("$sensor", "r");

    $day = date("d");
    $month = date("m");
    $year = date("Y");
    $value = fgets($file);
    $hour = date("H");
    $minute = date("i");

    $query = "INSERT INTO 1wireSlask (year, month, day, hour, minute, value, sensor) VALUES ('$year', '$month', '$day', '$hour','$minute', '$value' , '$sensor')";
    mysql_query($query) or die('Databasfel !!! ' . mysql_error());

    $sql = "SELECT * FROM 1wireSlask where sensor ='/mnt/1wire/1D.C0FA0C000000/counter.B' order by id DESC";
    $result1=mysql_query($sql);

    $value1=mysql_result($result1,0,"value");
    $value2=mysql_result($result1,1,"value");

    $totalday=(($value1-$value2)/1000)*60;

    $query = "INSERT INTO 1wireEnergy (year, month, day, hour, minute, value) VALUES ('$year', '$month', '$day', '$hour', '$minute', '$totalday')";
    mysql_query($query) or die('Databasfel !!! ' . mysql_error());
}
function Check1wire() {

//Kollar om nya 1wire enheter anslutits till nätet
    $day=date("d");
    $month=date("m");
    $year=date("Y");
    $hour=date("H");
    $minute=date("i");

    $array=(glob("/mnt/1wire/??.*"));

    foreach ($array as $libs) {

// 1wire enheter
        $temp=file_exists("$libs/temperature");
        $humi=file_exists("$libs/humidity");
        $counta=file_exists("$libs/counters.A");
        $countb=file_exists("$libs/counters.B");
        $name= substr($libs, 11);



        if ($temp==1) {
            $fil="temperature";
            $sensor="$libs/$fil";
            $name= substr($libs, 11);
            $sql = "SELECT * FROM 1wireSensors WHERE SensorPath='$sensor'";
            $result = mysql_query($sql) or die("error: ".mysql_error());


            if(mysql_num_rows($result) == 0)

            {
                $query = "INSERT INTO 1wireSensors (SensorActive, SensorName, SensorPath, SensorType, SensorUnit, AddYear, AddMonth, AddDay, AddHour, AddMinute) VALUES ('1','$name','$sensor', 'TEMP', '°C','$year', '$month', '$day', '$hour', '$minute')";
                mysql_query($query)  or die( 'Databasfel !!! ' . mysql_error());
                CreateSensorTable($name);
            }
        }

        if ($humi==1) {
            $fil="humidity";
            $sensor="$libs/$fil";
            $name= substr($libs, 11);
            $sql = "SELECT * FROM 1wireSensors WHERE SensorPath='$sensor'";
            $result = mysql_query($sql) or die("error: ".mysql_error());


            if(mysql_num_rows($result) == 0)

            {

                $query = "INSERT INTO 1wireSensors (SensorActive, SensorName, SensorPath, SensorType, SensorUnit, AddYear, AddMonth, AddDay, AddHour, AddMinute) VALUES ('1','$name','$sensor', 'HUMID', ' %','$year', '$month', '$day', '$hour', '$minute')";
                mysql_query($query)  or die( 'Databasfel !!! ' . mysql_error());
                CreateSensorTable($name);
            }
        }

        if ($counta==1) {
            $fil="counters.A";
            $sensor="$libs/$fil";
            $name= substr($libs, 11);
            $sql = "SELECT * FROM 1wireSensors WHERE SensorPath='$sensor'";
            $result = mysql_query($sql) or die("error: ".mysql_error());


            if(mysql_num_rows($result) == 0)

            {

                $query = "INSERT INTO 1wireSensors (SensorActive, SensorName, SensorPath, SensorType, SensorUnit, AddYear, AddMonth, AddDay, AddHour, AddMinute) VALUES ('1','$name','$sensor', 'Count', ' ','$year', '$month', '$day', '$hour', '$minute')";
                mysql_query($query)  or die( 'Databasfel !!! ' . mysql_error());
                CreateSensorTable($name);
            }
        }

        if ($countb==1) {
            $fil="counters.B";
            $sensor="$libs/$fil";
            $name= substr($libs, 11);
            $sql = "SELECT * FROM 1wireSensors WHERE SensorPath='$sensor'";
            $result = mysql_query($sql) or die("error: ".mysql_error());


            if(mysql_num_rows($result) == 0)

            {

                $query = "INSERT INTO 1wireSensors (SensorActive, SensorName, SensorPath, SensorType, SensorUnit, AddYear, AddMonth, AddDay, AddHour, AddMinute) VALUES ('1','$name','$sensor', 'Count', ' ','$year', '$month', '$day', '$hour', '$minute')";
                mysql_query($query)  or die( 'Databasfel !!! ' . mysql_error());
                CreateSensorTable($name);
            }
        }
    }
}
function Read1Wire(){


    $day=date("d");
    $month=date("m");
    $year=date("Y");

    $query = "SELECT * FROM 1wireSensors";
    $result=mysql_query($query);
    $num=mysql_numrows($result);

    $i=0;

    while ($i < $num) {

        $name=mysql_result($result,$i,"SensorName");
        $sokvag=mysql_result($result,$i,"SensorPath");

        $file = fopen("$sokvag","r");
        $value=fgets($file);
        $hour=date("H");
        $minute=date("i");

        $query = "INSERT INTO $name(year, month, day, hour, minute, value) VALUES ('$year', '$month', '$day', '$hour', '$minute', '$value')";
        mysql_query($query)  or die( 'Databasfel !!! ' . mysql_error());

    }

    fclose($file);
    $i++;
}
function ReadTellstickSensors(){

}

function EstConsMonth(){

    ConnectDb(write,andrixTNG1wire);
    $month=date("m");
    $year=date("Y");

    $number = cal_days_in_month(CAL_GREGORIAN,$month,$year);

    $query="SELECT AVG(value) FROM 1wireEnergy where month='$month'";
    $result=mysql_query($query);
    $avgvalue=mysql_result($result,0,"AVG(value)");

    $EstConsMonth=$avgvalue*$number;

    return $EstConsMonth;
}
function EstConsYear(){

    ConnectDb(write,andrixTNG1wire);
    $month=date("m");
    $year=date("Y");


    $query="SELECT AVG(value) FROM 1wireEnergy where year='$year'";
    $result=mysql_query($query);
    $avgvalue=mysql_result($result,0,"AVG(value)");

    $EstConsYear=$avgvalue*365.25;

    return $EstConsYear;
}
function EstConsDay() {
    $day=date("d");
    ConnectDb(write,andrixTNG1wire);
    $month=date("m");
    $year=date("Y");

    $number = 24;

    $query="SELECT AVG(value) FROM 1wireEnergy where day='$day'";
    $result=mysql_query($query);
    $avgvalue=mysql_result($result,0,"AVG(value)");

    $EstConsDay=$avgvalue*$number;

    return $EstConsDay;
}
function AvgHour($hour,$day){
    ConnectDb(write,andrixTNG1wire);
    $query="SELECT AVG(value) FROM 1wireEnergy where day='$day' AND hour='$hour'";
    $result=mysql_query($query);
    $avgvalue=mysql_result($result,0,"AVG(value)");



    return $avgvalue;
}
function AvgMonth($month,$year){
    ConnectDb(write,andrixTNG1wire);
    $query="SELECT AVG(value) FROM 1wireEnergy where year='$year' AND month='$month'";
    $result=mysql_query($query);
    $avgvalue=mysql_result($result,0,"AVG(value)");

    return $avgvalue;
}
function AvgDay($day,$month){
    ConnectDb(write,andrixTNG1wire);
    $query="SELECT AVG(value) FROM 1wireEnergy where day='$day' AND month='$month'";
    $result=mysql_query($query);
    $avgvalue=mysql_result($result,0,"AVG(value)");

    return $avgvalue;
}


?>
