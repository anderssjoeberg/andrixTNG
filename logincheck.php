<?php
session_start();

include("Includes/includes.php");


if($_GET["status"] == "login") {

    ConnectDb(write,andrixTNG);
    $usern = $_POST["usern"];
    $passw = $_POST["passw"];

    $usern = stripslashes($usern);
    $passw = stripslashes($passw);
    $usern = mysql_real_escape_string($usern);
    $passw = mysql_real_escape_string($passw);

    $usern=md5($usern);
    $passw=md5($passw);

    $sql = "SELECT * FROM Users WHERE Uname='$usern' AND Pword='$passw'";
    $result = mysql_query($sql) or die("error: ".mysql_error());

    if($_SESSION["logins"] == '0') {
        $_SESSION["logins"] = 1;
    }
    else
        $_SESSION["logins"]++;

    if(mysql_num_rows($result) == '0')
    {
        $ip=GetIP();
        $locip=CheckIPLocal($ip);

        If($locip == 0) {
            if($_SESSION["logins"] > 3){
            BlockIP($ip);
            }
        }
        header("location:index.php");
    }
    else
    $result = mysql_query("SELECT * FROM Users WHERE Uname='$usern' AND Pword='$passw'") or die("error: ".mysql_error());
    $_SESSION["User"]=mysql_result($result,0,"Name");
    $_SESSION["UserType"]=mysql_result($result,0,"UserType");
        header("location:main.php");
}
