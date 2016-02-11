<?php

include("/var/www/andrix/Includes/jpgraph/jpgraph.php");
include("/var/www/andrix/Includes/jpgraph/jpgraph_line.php");

	    $dag=date("d");
		$manad=date("m");
		$year=date("Y");	
		$timme=date("H");
		$minut=date("i");
	
$con = mysql_connect("localhost","root","f0ndr132t");
mysql_select_db("andrix", $con) or die( 'Databasfel !!! ' . mysql_error());
		
		
// Returnerar dagens namn
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

// Returnerar m�nadens namn
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



$nexttimme=$timme+1;
if ($nexttimme>23) {$nexttimme='00';}
$namn="Energi f�rbrukning i kwh".$year."-".$manad."-".$dag." Klockan ".$timme.":00-".$nexttimme.":00";
$file="/var/www/andrix/images/jpgraph/energiday/energi_".$year."-".$manad."-".$dag.".png";
drawdiagram($ydata, $namn, $file);	

$result7=mysql_query("SELECT * FROM mesure where sensor='energi' AND dag='$dag' and timme='$timme' order by id ASC");
$result8=mysql_query("SELECT AVG(value) FROM mesure WHERE sensor='energi' AND dag='$dag' AND timme='$timme'");

// SELECT student_name, AVG(test_score) ->        FROM student ->        GROUP BY student_name;
    
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


	
$namn="Energi f�rbrukning ".$year."-".$manad."-".$dag." ".$timme.":00";
$file="/var/www/andrix/images/jpgraph/energiday/energi_".$year."-".$manad."-".$dag."-".$timme.":00.png";
//drawdiagramfill($ydata, $zdata, $namn, $file);	
mysql_close($con);
?>
