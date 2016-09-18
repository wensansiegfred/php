<html>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    <?php    
    foreach($items as $key=>$value):
    $y = 0;
    ?>      
      google.setOnLoadCallback(drawChart<?php echo $key;?>);
      function drawChart<?php echo $key;?>() {
        var data<?php echo $key;?> = new google.visualization.DataTable();
        data<?php echo $key;?>.addColumn('string', 'Name');
        data<?php echo $key;?>.addColumn('number', 'Value');        
        data<?php echo $key;?>.addRows(<?php echo count($value);?>);
        <?php foreach($value as $val):?>
        data<?php echo $key;?>.setValue(<?php echo $y;?>,0,'test');
        data<?php echo $key;?>.setValue(<?php echo $y;?>,1,<?php echo $val;?>);
        <?php $y++; endforeach;?>
        var chart<?php echo $key;?> = new google.visualization.ColumnChart(document.getElementById('<?php echo $key;?>'));
        chart<?php echo $key;?>.draw(data<?php echo $key;?>, {width: 400, height: 240, title: 'Company Performance',
                          hAxis: {title: 'Year', titleTextStyle: {color: 'red'}}
                         });
      }
      <?php endforeach;?>
    </script>
  </head>
  <body>
  <?php foreach ($items as $key=>$value):?>
    <div id="<?php echo $key;?>"></div>
    <?php endforeach;?>
  </body>
</html>