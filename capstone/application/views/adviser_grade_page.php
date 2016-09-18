<?php if(!empty($result["groups"])){ ?>
<div class="panel-group" id="accordion">
<?php foreach($result["groups"] as $key=>$val): ?>
  <div class="panel panel-default" panel_id="<?php echo $val['id'];?>">
    <div class="panel-heading">
      <h4 class="panel-title"><span class="fa fa-group">&nbsp;</span>
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $val['id'];?>" group_id="<?php echo $val['id'];?>">
          <?php echo $val["name"];?>
        </a>
        <span style="cursor:pointer;cursor:hand;float:right" class="fa fa-folder-open-o group_set_grade" group_name="<?php echo $val["name"];?>" group_id="<?php echo $val['id'];?>" alt="Group Grade" title="Group Grade">&nbsp;Grade</span> 
      </h4>
    </div>
    <div id="collapse<?php echo $val['id'];?>" class="panel-collapse collapse">
      <div class="panel-body">
        <table class="table table-bordered table-hover">
          <thead>
              <tr>
                <th>Name</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php if(!empty($val["students"])){ ?>
              <?php foreach($val["students"] as $k=>$v): ?>
                <tr>
                  <td><?php echo (!empty($v["name"])) ? $v["name"]: '';?></td>                  
                  <td><span style="cursor:pointer;cursor:hand;" class="fa fa-folder-open-o student_set_grade" s_name="<?php echo (!empty($v["name"])) ? $v["name"]: '';?>" s_id="<?php echo $v["id"];?>">&nbsp;</span>Grade</td>
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
<br/>
<button type="submit" id="view_student_grade" class="btn btn-default"><i class="fa fa-list"></i>&nbsp;View Class Record</button>
<?php } ?>