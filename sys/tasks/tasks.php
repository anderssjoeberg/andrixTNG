<?php

include("/var/www/Includes/includes.php");


ConnectDb(write, andrixTNG);
function RestartSensor(){
	 $age=GetSensorAge();
	 if($age > 300) {
	 	    $command="/etc/init.d/telldusd restart";
    		exec($command,$exec);
	 }
}

foreach($argv as $task)
{
	if($task=='ReadTelldusStatus'){ReadTelldusStatus();}
	if($task=='ReloadTelldusConfig'){ReloadTelldusConfig();}
    if($task=='ExportFirewallConfig'){ExportTelldusConfig();}
    if($task=='RestartSensor'){RestartSensor();}
}
