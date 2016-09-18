<table class="table table-bordered table-hover">
  <thead>
      <tr>
        <th>Code</th>
        <th>Description</th>
        <th>Submission Date</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($result)){ ?>
        <?php foreach($result as $key=>$val): ?>          
          <tr>
            <td><?php echo $val["code"];?></td>
            <td><?php echo $val["description"];?></td>
            <td><?php echo $val["submission_date"];?></td>            
            <td><span class="fa fa-file-o view_deliverable" style="cursor:pointer;cursor:hand" d_desc="<?php echo $val["description"];?>" d_id="<?php echo $val["id"];?>">&nbsp;</span>View</td>
            <td><span class="fa fa-file-o edit_deliverable" style="cursor:pointer;cursor:hand" d_id="<?php echo $val["id"];?>">&nbsp;</span>Edit</td>
            <td><span style="cursor:pointer;cursor:hand;" class="fa fa-minus-circle delete_deliverable" d_id="<?php echo $val["id"];?>">&nbsp;</span>Delete</td>
          </tr>
        <?php endforeach; ?>
      <?php } else { ?>
      <tr>
        <td colspan="5">No deliverables.</td>
      </tr>
      <?php } ?>
    </tbody>
</table>

<br/>
<input type="submit" id="add_adviser_deliverable_btn" value="Add Deliverable" class="btn btn-default">