<?php
$con=mysql_connect("localhost","saikat","saikat") or die("Failed to connect with database!!!!");
mysql_select_db("chart", $con);

$sth = mysql_query("SELECT * FROM webchart");


$rows = array();

$flag = true;
$table = array();
$table['cols'] = array(

        array('label' => 'S. No.', 'type' => 'number'),
    array('label' => 'Values', 'type' => 'number')

);

$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $temp = array();
    
    $temp[] = array('v' => (string) $r['sno']);

    
    $temp[] = array('v' => (int) $r['val']);
    $rows[] = array('c' => $temp);
}


$table['rows'] = $rows;
$jsonTable = json_encode($table);

?>


<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <script type="text/javascript">

    
    google.load('visualization', '1', {'packages':['line','bar','corechart']});

    
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options1 = {
           title: 'Line Chart',
          is3D: 'true',
          width: 500,
          height: 300
        };
        var options2 = {
             title: 'Bar Chart',
            is3D: 'true',
            width: 500,
            height: 300
          };

      
      var chart1 = new google.visualization.LineChart(document.getElementById('chart_div1'));
      chart1.draw(data, options1);
      var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
      chart2.draw(data, options2);
    }
    </script>

  </head>

  <body>
    
    <div class="col-xs-offset-9" style="color:grey"><b>
      <?php


      mysql_select_db("chart", $con);
      $mth = mysql_query("SELECT timestamp FROM webchart");

      $timestamp=mysql_result($mth,1,"timestamp");
      echo "Last Updated: $timestamp";
      mysql_close($con);
      ?></b></div>

    <div class="rowone">
      <div class="col-xs-6">
    <div id="chart_div1"></div></div>
    <div class="col-xs-6">
    <div id="chart_div2"></div>
  </div>
</div>  <br>
  <br>
  <div class="row">
          <div class="col-xs-offset-4 col-xs-4">
              <form method="post" form action="insert.php">

  				<div class="form-group">
          			<center><label>ENTER THE MULTIPLIER</label></center>
  					<div class="input-group">
  						<input type="text" class="form-control" name="num" placeholder="Number Only">
  						<span class="input-group-addon info"><span class="glyphicon glyphicon-asterisk"></span></span>
  					</div>
  				</div>

                  <button type="submit" name="Submit" value="submit" class="btn btn-primary col-xs-offset-4 col-xs-4">Submit</button>
              </form>

          </div>
      </div>
  </body>
</html>
