<?php
include("Includes/include.php");
include("Includes/telldus_functions.php");

$id = $_GET["UnitId"];
$level = $_GET["level"];
$name = $_GET["name"];

TelldusUnitDim($id, $level);	



?>
