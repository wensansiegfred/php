<table class="table table-bordered table-hover">
  <thead>
      <tr>
        <th>Group</th>
        <th>File</th>
        <th>Date Added</th>        
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($result["list"])){ ?>
        <?php foreach($result["list"] as $key=>$val): ?>
        <?php if($val["approved"]==1){
                $app = "fa-check-square-o";
              }else if($val["approved"]==2){
                $app = "fa-check";
              }else{
                $app = "fa-exclamation-circle"; 
              }
        ?>
          <tr>
            <td><?php echo $val["student_group_name"];?></td>
            <td><span class="fa fa-download" style="cursor:pointer;cursor:hand" d_id="<?php echo $val["id"];?>">&nbsp;</span>
              <a href="<?php echo base_url().'filemanagement/download?id='.$val['id'];?>"><?php echo $val["raw_name"];?></a></td>
            <td><?php echo date("Y-m-d h:i:s A", strtotime($val["date_added"]));?></td>
            <td><span class="fa <?php echo $app;?> approve_deliverable" style="cursor:pointer;cursor:hand" d_id="<?php echo $val["id"];?>">&nbsp;</span>Approve</td>            
            <td><span class="fa fa-file-o edit_deliverable" style="cursor:pointer;cursor:hand" d_id="<?php echo $val["id"];?>">&nbsp;</span>Edit</td>
            <td><span class="fa fa-file-text show_notes_deliverable" style="cursor:pointer;cursor:hand" d_id="<?php echo $val["id"];?>">&nbsp;</span>Notes</td>
          </tr>
        <?php endforeach; ?>
      <?php } else { ?>
      <tr>
        <td colspan="5">No deliverables.</td>
      </tr>
      <?php } ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Notes</h4>
      </div>
      <div class="modal-body">
        &nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>