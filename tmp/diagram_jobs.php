<?php


include("/var/www/andrix/Includes/dbfunctions.php");
include("/var/www/andrix/Includes/datefunctions.php");
include("/var/www/andrix/Includes/diagramfunctions.php");



$result=mysql_query("Select * from 1wire");
$num=mysql_num_rows($result);

$a=0;

while ($a < $num) {
	$b=0;
	$sokvag=mysql_result($result,$a,"sokvag");
	$namn=mysql_result($result,$a,"namn");


	$result2=mysql_query("SELECT * FROM mesure where sensor='$sokvag'  order by id ASC");
	$num2=mysql_numrows($result2);

	$sensor = substr($sokvag,11);
	$sensor = str_replace("/", "_", $sensor);

	$ydata = array();

	while ($b < $num2) {
		$value=mysql_result($result2,$b,"value");
		$ydata[$b]=$value;
		$b++;
	}
	
$file="/var/www/andrix/images/jpgraph/$sensor.png";
	
drawdiagram($ydata, $namn, $file);	
	$a++;

}

//Skapar diagram f�r energif�rbrukning sen m�tningarna startade
	$result=mysql_query("SELECT * FROM mesure where sensor='energi' order by id ASC");
	$num=mysql_numrows($result);

	$namn="Energi f�rbrukning kwh";
	$file="/var/www/andrix/images/jpgraph/energikwh.png";
	
	$ydata = array();
	$c=0;
	while ($c < $num) {
		$value=mysql_result($result,$c,"value");
		$ydata[$c]=$value;
		$c++;
	}
drawdiagram($ydata, $namn, $file);


//Skapar diagram f�r 1wire enheter per dag 


$result=mysql_query("Select * from 1wire");
$num=mysql_num_rows($result);

$a=0;

while ($a < $num) {
	$b=0;
	$sokvag=mysql_result($result,$a,"sokvag");
	$namn=mysql_result($result,$a,"namn");


	$result3=mysql_query("SELECT * FROM mesure where sensor='$sokvag' AND dag='$dag'  order by id ASC");
	$num3=mysql_numrows($result3);

	$sensor = substr($sokvag,11);
	$sensor = str_replace("/", "_", $sensor);

	$ydata = array();

	while ($b < $num3) {
		$value=mysql_result($result3,$b,"value");
		$ydata[$b]=$value;
		$b++;
	}
	
$file2="/var/www/andrix/images/jpgraph/day/".$sensor."_".$year."-".$manad."-".$dag.".png";
	
drawdiagram($ydata, $namn, $file2);	
	$a++;
}


//Skapar diagram f�r 1wire enheter per timme


$result=mysql_query("Select * from 1wire");
$num=mysql_num_rows($result);

$a=0;

while ($a < $num) {
	$b=0;
	$sokvag=mysql_result($result,$a,"sokvag");
	$namn=mysql_result($result,$a,"namn");


	$result4=mysql_query("SELECT * FROM mesure where sensor='$sokvag' AND timme='$timme'  order by id ASC");
	$num4=mysql_numrows($result4);

	$sensor = substr($sokvag,11);
	$sensor = str_replace("/", "_", $sensor);

	$ydata = array();

	while ($b < $num4) {
		$value=mysql_result($result4,$b,"value");
		$ydata[$b]=$value;
		$b++;
	}
	
$file3="/var/www/andrix/images/jpgraph/hour/".$sensor."_".$timme.":00.png";
	
drawdiagram($ydata, $namn, $file3);	
	$a++;
}


//Skapar diagram f�r 1wire enheter per m�nad
$result=mysql_query("Select * from 1wire");
$num=mysql_num_rows($result);

$a=0;

while ($a < $num) {
	$b=0;
	$sokvag=mysql_result($result,$a,"sokvag");
	$namn=mysql_result($result,$a,"namn");


	$result4=mysql_query("SELECT * FROM mesure where sensor='$sokvag' AND manad='$manad'  order by id ASC");
	$num4=mysql_numrows($result4);

	$sensor = substr($sokvag,11);
	$sensor = str_replace("/", "_", $sensor);

	$ydata = array();

	while ($b < $num4) {
		$value=mysql_result($result4,$b,"value");
		$ydata[$b]=$value;
		$b++;
	}
$month=GetMonth();	
$file3="/var/www/andrix/images/jpgraph/month/".$sensor."_".$month.".png";
	
drawdiagram($ydata, $namn, $file3);	
	$a++;
}



	$result5=mysql_query("SELECT * FROM mesure where sensor='energi' AND timme='$timme' order by id ASC");
	$num5=mysql_numrows($result5);

	$timmep=$timme-1;
	if ($timmep=='-1') {
		$timmep='23';
	}
	
	$namn="Energi f�rbrukning ".$timmep.":00 - ".$timme.":00 kwh";
	$file="/var/www/andrix/images/jpgraph/energihour/energi_".$timme.":00.png";
	
	$ydata = array();
	$c=0;
	while ($c < $num5) {
		$value=mysql_result($result5,$c,"value");
		$ydata[$c]=$value;
		$c++;
	}
drawdiagram($ydata, $namn, $file);


$result6=mysql_query("SELECT * FROM mesure where sensor='energi' AND manad='$manad' order by id ASC");
$num6=mysql_numrows($result6);

	$namn="Energi f�rbrukning $month m�nad kwh";
	$file="/var/www/andrix/images/jpgraph/energimonth/energi_".$month.".png";

	$ydata = array();
$c=0;
	while ($c < $num6) {
		$value=mysql_result($result6,$c,"value");
		$ydata[$c]=$value;
		$c++;
	}
drawdiagram($ydata, $namn, $file);	


$result6=mysql_query("SELECT * FROM mesure where sensor='energi' AND dag='$dag' order by id ASC");
$num6=mysql_numrows($result6);


	$ydata = array();
$c=0;


	while ($c < $num6) {
		$value=mysql_result($result6,$c,"value");
		$ydata[$c]=$value;
		
		$c++;
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
drawdiagramfill($ydata, $zdata, $namn, $file);	
mysql_close($con);
?>
