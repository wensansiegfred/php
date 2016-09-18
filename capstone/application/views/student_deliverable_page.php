<table class="table table-bordered table-hover">
  <thead>
      <tr>
        <th>Code</th>
        <th>Description</th>
        <th>Submission Date</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($result)){ ?>
        <?php foreach($result as $key=>$val): ?>
          <?php if(!empty($val["id"])): ?>
          <?php
            //$bg = ($val["id"])
          ?> 
          <tr bgcolor="<?php echo ($val['backcolor'] == 'red') ? '#ff0000' : '';?>">
            <td><span class="fa fa-bell">&nbsp;</span><?php echo $val["code"];?></td>
            <td><?php if($result["isgroupmember"]): ?>
              <span class="fa fa-file-o student_add_deliverable" style="cursor:pointer;cursor:hand" d_id="<?php echo $val["id"];?>">&nbsp;</span>
              <?php endif; ?>
              <?php echo $val["description"];?>
            </td>
            <td><?php echo $val["submission_date"];?></td>
          </tr>
        <?php endif; ?>
        <?php endforeach; ?>
      <?php } else { ?>
      <tr>
        <td colspan="5">No deliverables.</td>
      </tr>
      <?php } ?>
    </tbody>
</table>