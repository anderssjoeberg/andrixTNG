<?php
include("/var/www/includes/db_include.php");
include("/var/www/includes/includes.php");
include("/var/www/includes/1wire_include.php");

ConnectDb(write,andrixTNG1wire);

function UpdateMonth(){
    $monthvalue=EstConsMonth();
    mysql_query("UPDATE 1wireEnergyReport SET Value='$monthvalue' WHERE Label='EstConsMonth'");

}

function UpdateYear(){
    $yearvalue=EstConsYear();
    mysql_query("UPDATE 1wireEnergyReport SET Value='$yearvalue' WHERE Label='EstConsYear'");

}

function UpdateDay(){
    $yearvalue=EstConsYear();
    mysql_query("UPDATE 1wireEnergyReport SET Value='$yearvalue' WHERE Label='EstConsYear'");

}


foreach($argv as $task)
{
    if($task=='ReadSensor'){ReadSensor();}
    if($task=='Check1wire'){Check1wire();}
    if($task=='Read1Wire'){Read1Wire();}
    if($task=='UpdateMonth'){UpdateMonth();}
    if($task=='UpdateYear'){UpdateMonth();}
    if($task=='UpdateDay'){UpdateDay();}
}
