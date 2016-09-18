<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CAPSTONE :: DASHBOARD</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/dashboard/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dashboard/css/datepicker.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="<?php echo base_url();?>assets/dashboard/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dashboard/font-awesome/css/font-awesome.min.css">
    <link href="<?php echo base_url();?>assets/swu/swu.css" rel="stylesheet">
  </head>
  <body>
    <div id="wrapper">
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">SWU Capstone</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav swu_menutitle">
            <li class="active"><a href="#" link="dashboard" linkname="Dashboard" onclick="loadthis(this)"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <?php foreach($result["menus"] as $key=> $val): ?>
              <li><a id="links" link="<?php echo $val["links"];?>" groupid="<?php echo $result['group_id'];?>" linkname="<?php echo $val["name"];?>" href="#" onclick="loadthis(this)"><i class="fa fa-edit"></i> <?php echo $val["name"];?></a></li>
            <?php endforeach; ?>            
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            
            <!--<li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> 
                  Alerts <span class="badge"><?php //echo (!empty($result["total_alerts"])) ? count($result["total_alerts"]) : 0 ?></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <?php //if(!empty($result["alerts"])){ ?>
                  <?php //foreach($result["alerts"] as $k_alerts=>$val_alerts): ?>
                    <li><a href="#"><?php //echo $val_alerts["table"];?><span class="label label-warning"><?php// echo $val_alerts["count"]?></span></a></li>
                    <li class="divider"></li>
                  <?php //endforeach;?>
                <?php //} ?>
              </ul>
            </li>-->
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                <?php echo $result["info"]["firstname"] . " " . $result["info"]["lastname"];?>  <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="#" onclick="logout(); return false;"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <!--<h1>Dashboard <small>Statistics Overview</small></h1>-->
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
           
          </div>
        </div><!-- /.row -->
        <div class="row content">          
          <div class="col-lg-12"></div>
        </div><!-- /.row -->
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="<?php echo base_url();?>assets/dashboard/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url();?>assets/dashboard/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/dashboard/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/swu/swuscripts.js"></script>
    <script src="<?php echo base_url();?>assets/swu/ajaxfileupload.js"></script>
    <script>
      $(document).ready(function(){
        $(".swu_menutitle .active a").click();
      });
    </script>
    </body>
</html>
