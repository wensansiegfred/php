<span style="font-weight:bold">Project Adviser Class Record:</span>
<table class="table table-bordered table-hover class-record">
	<thead>
    <tr rowspan="2">
      <th colspan="3">&nbsp;</th>
      <th style="font-size:x-small;">Chapter 1</th>
      <th style="font-size:x-small;">Chapter 2</th>
      <th style="font-size:x-small;">Chapter 3</th>
      <th style="font-size:x-small;">Chapter 4</th>
      <th style="font-size:x-small;">Chapter 5</th>
      <th style="font-size:x-small;">Output<br/> Software</th>
      <th style="font-size:x-small;">Attendance</th>
      <th style="font-size:x-small;">Attitude &<br/> Contribution</th>
      <th style="font-size:x-small;">Total Score</th>
      <th style="font-size:x-small;">EQ. <br/>Grade</th>
      <th style="font-size:x-small;">REMARKS</th>
    </tr>
    <tr>
      <th>Name</th>
      <th>Course</th>
      <th>Student #</th>
      <th>10</th>
      <th>10</th>
      <th>10</th>
      <th>10</th>
      <th>10</th>
      <th>10</th>
      <th>10</th>
      <th>30</th>
      <th>100</th>
      <th>1.0</th>
      <th>PASSED</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($result["list"] as $key=>$val): ?>
        <?php $total = 0;?>
        <tr>
            <td><?php echo $val["name"];?></td>
            <td><?php echo $val["course"];?></td>
            <td><?php echo $val["id"];?></td>
        <?php foreach($val["grades"] as $k=>$v):?>          
            <td><?php echo $v["gradevalue"]; $total += $v["gradevalue"];?></td>
        <?php endforeach;?>
            <td><?php echo $total;?></td>
            <td><?php echo (6-5*($total/100));?></td>
            <td><?php echo ((6-5*($total/100)) < 3) ? "PASSED" : "FAILED";?> </td>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>