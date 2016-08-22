<?php
header("Location: index.php");
$con = mysql_connect("localhost","saikat","saikat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("chart", $con);

$sql="INSERT INTO multiplier (num)
VALUES ('$_POST[num]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

  $sql1="UPDATE webchart SET val=$_POST[num]*val";


  if (!mysql_query($sql1,$con))
    {
    die('Error: ' . mysql_error());
    }


mysql_close($con)
?>
<?php
$con = mysql_connect("localhost","saikat","saikat");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("chart", $con);

mysql_query("update `webchart` set timestamp=now()");

mysql_close($con);
?>
