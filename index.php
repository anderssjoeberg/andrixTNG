<?php
session_start();
include("Includes/includes.php");
echo "<html>

<head>


<title>ANDRIX CENTER- Allt för hemmet</title>
</head>

<br><br><br><br><br>
<body bgcolor=\"#CCFF99\">

<div align=\"center\">
	<table border=\"0\" width=\"60%\">
		<tr>
			<td width=\"90%\"><font face=\"Arial Black\" style=\"font-size: 42pt\">ANDRIX 
			CENTER</font><font size=\"7\" face=\"Arial Black\"> </font>
			<font face=\"Arial Black\" size=\"1\">THE NEXT GENERATION<br>
			</font>
			<font face=\"Arial Black\">Allt för det smarta hemmet...</font><BR>
			</td>
		</tr>
	</table>
</div>
<br><br><br>

<div align=\"center\">
	<table border=\"0\" width=\"60%\">
		<tr>
			<td width=\"90%\">
			<form method=\"POST\" action=\"logincheck.php?status=login\">
				
				<p align=\"right\"><font face=\"Arial Black\" size=\"2\">&nbsp;</font>
				<table border=\"0\" width=\"100%\">
					<tr>
						<td>
						<p align=\"right\"><font face=\"Arial Black\" size=\"2\">Användarnamn :</font></td>
						<td width=\"183\">
						
						<p align=\"center\"> <input type=\"text\" name=\"usern\" size=\"20\"></td>
					</tr>
					<tr>
						<td>
						<p align=\"right\"><font face=\"Arial Black\" size=\"2\">Lösenord : </font> &nbsp;</td>
						<td width=\"183\">
						<p align=\"center\"> <input type=\"password\" name=\"passw\" size=\"20\"></td>";

    $ip=GetIP();
    ConnectDb(write,andrixTNG);
	$result=mysql_query("SELECT * FROM BlockIP where ip='$ip'");
    if(mysql_num_rows($result) == 1){
        echo "IP NUMMRET NI KOMMER FRÅN ÄR SPÄRRAT!!!";
    }

echo "</tr>
				</table><p align=\"right\"><br>
				<input type=\"submit\" value=\"Login\" name=\"Logga in\"></p>
			</form></td>
		</tr>
	</table>
</div>
<center><font face=\"Arial\" size=\"1\">...</font></center>
</body>

</html>";