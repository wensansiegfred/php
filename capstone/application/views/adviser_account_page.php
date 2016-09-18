<?php if(!empty($result["groups"])){ ?>
<div class="panel-group" id="accordion">
<?php foreach($result["groups"] as $key=>$val): ?>
  <div class="panel panel-default" panel_id="<?php echo $val['id'];?>">
    <div class="panel-heading">
      <h4 class="panel-title"><span class="fa fa-group">&nbsp;</span>
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $val['id'];?>" group_id="<?php echo $val['id'];?>">
          <?php echo $val["name"];?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $val['id'];?>" class="panel-collapse collapse">
      <div class="panel-body">
        <table class="table table-bordered table-hover">
          <thead>
              <tr>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php if(!empty($val["students"])){ ?>
              <?php foreach($val["students"] as $k=>$v): ?>
                <tr>
                  <td><?php echo (!empty($v["name"])) ? $v["name"]: '';?></td>
                  <td><span class="fa fa-file-o edit_student_account" style="cursor:pointer;cursor:hand" s_id="<?php echo $v["id"];?>">&nbsp;</span>Edit</td>
                  <td><span style="cursor:pointer;cursor:hand;" class="fa fa-minus-circle student_delete_user" s_id="<?php echo $v["id"];?>">&nbsp;</span>Delete</td>
                </tr>
              <?php endforeach; ?>
            <?php }else{ ?>
              <tr>
                <td colspan="4">No user available.</td>
              </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php } ?>
<br/>
<button type="submit" id="add_student_group_btn" class="btn btn-default"><i class="fa fa-book"></i>&nbsp;Add Project Group</button>
<button type="submit" id="add_student_btn" class="btn btn-default"><i class="fa fa-book"></i>&nbsp;Add Student</button>