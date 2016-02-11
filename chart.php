<html>
  <head>


<?php

   $con = mysql_connect("192.168.0.40","andrixTNG_user","vsG6[&H+5hVjj,%G");
   mysql_select_db("andrixTNG1wire", $con) or die( 'Databasfel !!! ' . mysql_error());

$query = "SELECT * from 1wireEnergy ORDER BY value DESC";

$result=mysql_query($query);
$num=mysql_numrows($result);

$maxvalue=mysql_result($result,0,"value");
$yellowfrom=$maxvalue/2;
$xxx=$maxvalue/4;
$yellowto=$yellowfrom+$xxx;

$query2 = "SELECT * from 1wireEnergy ORDER BY id DESC ";
$result2=mysql_query($query2);
$value=mysql_result($result2,0,"value");

echo"<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>
    <script type=\"text/javascript\">
    google.load(\"visualization\", \"1\", {packages:[\"gauge\"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

          var data = google.visualization.arrayToDataTable([
                  ['Label', 'Value'],
                  ['Ström', $value],

              ]);

          var options = {";
 echo "width: 600, height: 180, redFrom: $yellowto, redTo: $maxvalue,minorTicks: 10 , max: $maxvalue ,greenFrom: 0, greenTo: $yellowfrom,
        yellowFrom: $yellowfrom, yellowTo: $yellowto
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);


      }
    </script>
  </head>
  <body>
  <table style=\"width:75%\">
   <tr>
    <td height=\"200\" valign=\"top\"><div id=\"chart_div\" style=\"width: 400px; height: 120px;\"></div></td>
    <td>$value</td>
    </tr>
    </table>
    <table style=\"width:75%\">";
while ($i < 23) {
    echo "<tr >
    <td>$i</td >
    <td> då </td >
    </tr >";
    $i++;

}


echo"  </table>
  </body>
</html>";
