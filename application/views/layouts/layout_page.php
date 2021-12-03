<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<?php if ($this->config->item('app_browser_context')): ?>
<html lang="en" oncontextmenu="return false;">
<?php else: ?>
<html lang="en">
<?php endif ?>
<head> 
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="content-language" content="en-us">
    <meta http-equiv="content-script-type" content="text/javascript">
    <meta http-equiv="content-style-type" content="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $this->config->item('app_name').' | '.$title;?></title>  
    <link href="<?php echo $this->config->item('public_url')."images/assets/icon.png";?>" rel="shortcut icon" >
    <link href="<?php echo $this->config->item('public_url')."css/fontawesome.min.css";?>" rel="stylesheet">  
    <link href="<?php echo $this->config->item('public_url')."css/bootstrap.min.css";?>" rel="stylesheet">	

    <?php if (isset($bootstrap_select) && $bootstrap_select): ?>
    <link href="<?php echo $this->config->item('public_url')."css/bootstrap-select.min.css";?>" rel="stylesheet">
    <?php endif ?>

    <?php if (isset($datatables) && $datatables): ?>
    <link href="<?php echo $this->config->item('public_url')."css/jquery.dataTables.min.css";?>" rel="stylesheet">
    <?php endif ?>

    <?php if (isset($dataexport) && $dataexport): ?>
    <link href="<?php echo $this->config->item('public_url')."css/buttons.dataTables.min.css";?>" rel="stylesheet"> 
    <?php endif ?>

    <link href="<?php echo $this->config->item('public_url')."css/styles.css";?>" rel="stylesheet">
    <script src="<?php echo $this->config->item('public_url')."js/jquery-1.11.2.js";?>"></script>
    <script src="<?php echo $this->config->item('public_url')."js/bootstrap.min.js";?>"></script>
    <script src="<?php echo $this->config->item('public_url')."js/jquery.validate.min.js";?>"></script>

    <?php if (isset($bootstrap_select) && $bootstrap_select): ?>
    <script src="<?php echo $this->config->item('public_url')."js/bootstrap-select.min.js";?>"></script>
    <?php endif ?>

    <?php if (isset($datatables) && $datatables): ?>
    <script src="<?php echo $this->config->item('public_url')."js/jquery.dataTables.min.js";?>"></script>
    <?php endif ?>

    <?php if (isset($dataexport) && $dataexport): ?>
    <script src="<?php echo $this->config->item('public_url')."js/dataTables.buttons.min.js";?>"></script> 
    <script src="<?php echo $this->config->item('public_url')."js/buttons.flash.min.js";?>"></script> 
    <script src="<?php echo $this->config->item('public_url')."js/jszip.min.js";?>"></script> 
    <script src="<?php echo $this->config->item('public_url')."js/pdfmake.min.js";?>"></script> 
    <script src="<?php echo $this->config->item('public_url')."js/vfs_fonts.js";?>"></script> 
    <script src="<?php echo $this->config->item('public_url')."js/buttons.html5.min.js";?>"></script> 
    <script src="<?php echo $this->config->item('public_url')."js/buttons.print.min.js";?>"></script> 
    <?php endif ?>

    <script src="<?php echo $this->config->item('public_url');?>js/app-scripts.js"></script>

    

    <?php if ($this->config->item('app_browser_context')): ?>
    <script src="<?php echo $this->config->item('public_url')."js/contxtiedb.js";?>"></script>
    <?php endif ?>

</head>

<body class="ap-body">
	<input id="app-baseurl" name="app-baseurl" type="hidden" value="<?php echo $this->config->item('base_url');?>">
	<nav class="navbar navbar-default navbar-inverse top-bar navbar-fixed-top ap-navbar-inverse" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>
		        <a class="navbar-brand ap-navbar-brand" href="#">
		        <span><img src="<?php echo $this->config->item('public_url');?>images/assets/crime.jpg" class="img_logo"  width="55" height="35" alt="police-logo"></span>
		        <span style="position: relative; top: -1px;">&nbsp;<?php echo $this->config->item('app_name');?></span>
		        </a>
		    </div>

		        <!-- Collect the nav links, forms, and other content for toggling -->
    		<div class="collapse navbar-collapse ap-navbar-collapse" id="bs-example-navbar-collapse-1">
    			<ul class="nav navbar-nav ap-navbar-nav">
    				<!-- dashboard -->
        			<li class="ap-navbar-options-ul-li"><a class="ap-navbar-top-span" href="<?php echo $this->config->item('base_url');?>dashboard" tabindex="-1">DASHBOARD</a></li>
        			<!-- dashboard -->
        			<!--user-->
                    <?php if (isset($permissions['USER_STATUS']) && $permissions['USER_STATUS']): ?>   
                    <li class="dropdown ap-navbar-options-ul-li"> 
                        <a class="ap-navbar-top-span" href="" tabindex="-1" data-toggle="dropdown">USER &nbsp;<span class=""><i id="103C-btn-f20-dp" class="fas fa-caret-down ap-icon"></i></span></a>
                        <ul class="dropdown-menu ap-dropdown-menu" style="margin-top: 5px; background: #019ABA; padding-bottom: 0px;">  
                          
                          <?php if (isset($permissions['USER_UPDATE_PERMISSION']) && $permissions['USER_UPDATE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."user/edit";?>" class="ap-navbar-top-span">MANAGE USER</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['USER_APPROVE_PERMISSION']) && $permissions['USER_APPROVE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."user/approve";?>" class="ap-navbar-top-span">APPROVE USER</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['USER_ASSIGN_PERMISSION']) && $permissions['USER_ASSIGN_PERMISSION']): ?>  
                           <li> <a href="<?php echo $this->config->item('base_url')."user/assign";?>" class="ap-navbar-top-span">ASSIGN USER</a></li> 
                           <?php endif ?>
                        </ul>
                     </li>
                    <?php endif ?>
                    <!--End user-->

                    <!--Complains-->
                    <?php if (isset($permissions['COMPLAIN_STATUS']) && $permissions['COMPLAIN_STATUS']): ?> 
                    <li class="dropdown ap-navbar-options-ul-li"> 
                        <a class="ap-navbar-top-span" href="" tabindex="-1" data-toggle="dropdown">COMPLAIN &nbsp;<span class=""><i id="103C-btn-f20-dp" class="fas fa-caret-down ap-icon"></i></span></a>
                        <ul class="dropdown-menu ap-dropdown-menu" style="margin-top: 5px; background: #019ABA; padding-bottom: 0px;"> 
                          
                          <?php if (isset($permissions['COMPLAIN_WRITE_PERMISSION']) && $permissions['COMPLAIN_WRITE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."complain/create/new";?>" class="ap-navbar-top-span">NEW COMPLAIN</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['COMPLAIN_UPDATE_PERMISSION']) && $permissions['COMPLAIN_UPDATE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."complain/edit";?>" class="ap-navbar-top-span">MANAGE COMPLAIN</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['COMPLAIN_APPROVE_PERMISSION']) && $permissions['COMPLAIN_APPROVE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."complain/approve";?>" class="ap-navbar-top-span">APPROVE COMPLAIN</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['COMPLAIN_ASSIGN_PERMISSION']) && $permissions['COMPLAIN_ASSIGN_PERMISSION']): ?>  
                           <li> <a href="<?php echo $this->config->item('base_url')."complain/assign";?>" class="ap-navbar-top-span">ASSIGN COMPLAIN</a></li> 
                           <?php endif ?>

                           <?php if (isset($permissions['COMPLAIN_READ_PERMISSION']) && $permissions['COMPLAIN_READ_PERMISSION']): ?>  
                           <li> <a href="<?php echo $this->config->item('base_url')."complain/read";?>" class="ap-navbar-top-span">VIEW COMPLAIN</a></li> 
                           <?php endif ?>
                        </ul>
                     </li>
                     <?php endif ?>
                    <!--End Complains-->

                    <!--Police-->
                    <?php if (isset($permissions['POLICE_STATUS']) && $permissions['POLICE_STATUS']): ?>
                    <li class="dropdown ap-navbar-options-ul-li"> 
                        <a class="ap-navbar-top-span" href="" tabindex="-1" data-toggle="dropdown">POLICE &nbsp;<span class=""><i id="103C-btn-f20-dp" class="fas fa-caret-down ap-icon"></i></span></a>
                        <ul class="dropdown-menu ap-dropdown-menu" style="margin-top: 5px; background: #019ABA; padding-bottom: 0px;">  
                          
                          <?php if (isset($permissions['POLICE_WRITE_PERMISSION']) && $permissions['POLICE_WRITE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."police/new";?>" class="ap-navbar-top-span">NEW POLICE</a></li>
                          <?php endif ?>
                          <?php if (isset($permissions['POLICE_UPDATE_PERMISSION']) && $permissions['POLICE_UPDATE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."police/edit";?>" class="ap-navbar-top-span">MANAGE POLICE</a></li>
                          <?php endif ?>
                        </ul>
                     </li>
                    <?php endif ?>
                    <!--End Police-->

                    <!--Missing Persons-->
                    <?php if (isset($permissions['MISSING_PERSON_STATUS']) && $permissions['MISSING_PERSON_STATUS']): ?> 
                    <li class="dropdown ap-navbar-options-ul-li"> 
                        <a class="ap-navbar-top-span" href="" tabindex="-1" data-toggle="dropdown">MISSING PERSON &nbsp;<span class=""><i id="103C-btn-f20-dp" class="fas fa-caret-down ap-icon"></i></span></a>
                        <ul class="dropdown-menu ap-dropdown-menu" style="margin-top: 5px; background: #019ABA; padding-bottom: 0px;"> 
                          
                          <?php if (isset($permissions['MISSING_PERSON_WRITE_PERMISSION']) && $permissions['MISSING_PERSON_WRITE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."missing/new";?>" class="ap-navbar-top-span">ADD NEW PERSONS</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['MISSING_PERSON_UPDATE_PERMISSION']) && $permissions['MISSING_PERSON_UPDATE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."missing/edit";?>" class="ap-navbar-top-span">MANAGE PERSONS</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['MISSING_PERSON_APPROVE_PERMISSION']) && $permissions['MISSING_PERSON_APPROVE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."missing/approve";?>" class="ap-navbar-top-span">APPROVE PERSONS</a></li>
                          <?php endif ?>

                           <?php if (isset($permissions['MISSING_PERSON_READ_PERMISSION']) && $permissions['MISSING_PERSON_READ_PERMISSION']): ?>  
                           <li> <a href="<?php echo $this->config->item('base_url')."missing/view";?>" class="ap-navbar-top-span">VIEW PERSONS</a></li> 
                           <?php endif ?>
                        </ul>
                     </li>
                     <?php endif ?>
                    <!--Missing Persons-->

                     <!--Most Wanted Persons-->
                    <?php if (isset($permissions['MOST_WANTED_STATUS']) && $permissions['MOST_WANTED_STATUS']): ?> 
                    <li class="dropdown ap-navbar-options-ul-li"> 
                        <a class="ap-navbar-top-span" href="" tabindex="-1" data-toggle="dropdown">MOST WANTED PERSON &nbsp;<span class=""><i id="103C-btn-f20-dp" class="fas fa-caret-down ap-icon"></i></span></a>
                        <ul class="dropdown-menu ap-dropdown-menu" style="margin-top: 5px; background: #019ABA; padding-bottom: 0px;"> 
                          
                          <?php if (isset($permissions['MOST_WANTED_WRITE_PERMISSION']) && $permissions['MOST_WANTED_WRITE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."wanted/new";?>" class="ap-navbar-top-span">ADD NEW PERSONS</a></li>
                          <?php endif ?>

                          <?php if (isset($permissions['MOST_WANTED_UPDATE_PERMISSION']) && $permissions['MOST_WANTED_UPDATE_PERMISSION']): ?> 
                          <li> <a href="<?php echo $this->config->item('base_url')."wanted/edit";?>" class="ap-navbar-top-span">MANAGE PERSONS</a></li>
                          <?php endif ?>

                           <?php if (isset($permissions['MOST_WANTED_READ_PERMISSION']) && $permissions['MOST_WANTED_READ_PERMISSION']): ?>  
                           <li> <a href="<?php echo $this->config->item('base_url')."wanted/view";?>" class="ap-navbar-top-span">VIEW PERSONS</a></li> 
                           <?php endif ?>
                        </ul>
                     </li>
                     <?php endif ?>
                    <!--Most Wanted Persons-->


                    <!-- reports -->
                    <?php if (isset($permissions['REPORTS_STATUS']) && $permissions['REPORTS_STATUS']): ?>   
                    <li class="dropdown ap-navbar-options-ul-li"> 
                        <a class="ap-navbar-top-span" href="" tabindex="-1" data-toggle="dropdown">REPORTS &nbsp;<span class=""><i id="103C-btn-f20-dp" class="fas fa-caret-down ap-icon"></i></span></a>
                        <ul class="dropdown-menu ap-dropdown-menu" style="margin-top: 5px; background: #019ABA; padding-bottom: 0px;">  
                          
                        <li> <a href="<?php echo $this->config->item('base_url')."reports/dateRange";?>" class="ap-navbar-top-span">COMPLAINS - DATE RANGE</a></li>

                        <li> <a href="<?php echo $this->config->item('base_url')."reports/type";?>" class="ap-navbar-top-span">COMPLAINS - TYPE</a></li>
 
                        <li> <a href="<?php echo $this->config->item('base_url')."reports/status";?>" class="ap-navbar-top-span">COMPLAINS - STATUS</a></li> 

                        <?php $rollId = $_SESSION['roll_id'];
                        if($rollId == 1):?>
                           <li> <a href="<?php echo $this->config->item('base_url')."reports/police";?>" class="ap-navbar-top-span">COMPLAINS - POLICE STATION</a></li>        
                        <?php endif ?>  

                        <?php if($rollId == 1 || $rollId == 2):?>
                           <li> <a href="<?php echo $this->config->item('base_url')."reports/delayed";?>" class="ap-navbar-top-span">COMPLAINS - DELAYED COMPLAINS</a></li>      
                        <?php endif ?> 

                        <?php if($rollId == 1 || $rollId == 2):?>
                           <li> <a href="<?php echo $this->config->item('base_url')."reports/analysys";?>" class="ap-navbar-top-span">OFFICER - ANALYSYS</a></li>      
                        <?php endif ?>

                        </ul>
                     </li>
                    <?php endif ?>
                    <!-- reports -->
                    
                    <!------------------------------------------------------------------------------------>
                     <ul class="nav navbar-nav ap-navbar-nav navbar-right">
                        <li class="dropdown ap-nav-dropdown-rgt pull-right">
                        <a href="#" class="dropdown-toggle dp-rgt" data-toggle="dropdown">
                        <?php if (isset($_SESSION['user_name'])) { ?>
                            <span><?php echo $this->session->userdata('user_name');?></span>
                        <?php } ?>
                        &nbsp;<span class="caret"></span>
                        </a>
                        <ul id="login-dp" class="dropdown-menu ap-dpdown-mnu">
                        <?php if (isset($_SESSION['first_name'])) { ?>
                            <li> 
                            <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
                            <span class="pull-left">USER NAME:</span>
                            <br>
                            <span class="pull-left"><?php echo $this->session->userdata('first_name');?> &nbsp;   <?php echo $this->session->userdata('last_name');?> </span>
                            <span class="clearfix"></span>
                            </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($_SESSION['roll_id'])) { ?>
                        <?php if ($_SESSION['roll_id'] == "1") { ?>
                        <li> 
                        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
                        <span class="pull-left">USER ROLE:</span>
                        <br>
                        <span class="pull-left">Administrator</span>
                        <span class="clearfix"></span>
                        </a>
                        </li>
                        <?php } elseif ($_SESSION['roll_id'] == "2") { ?>
                        <li> 
                        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
                        <span class="pull-left">USER ROLE:</span>
                        <br>
                        <span class="pull-left">Police OIC</span>
                        <span class="clearfix"></span>
                        </a>
                        </li>
                        <?php } elseif ($_SESSION['roll_id'] == "3") { ?>
                        <li> 
                        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
                        <span class="pull-left">USER ROLE:</span>
                        <br>
                        <span class="pull-left">Police Officer</span>
                        <span class="clearfix"></span>
                        </a>
                        </li>
                        <?php } elseif ($_SESSION['roll_id'] == "4") { ?>
                        <li> 
                        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
                        <span class="pull-left">USER ROLE:</span>
                        <br>
                        <span class="pull-left">Citizen</span>
                        <span class="clearfix"></span>
                        </a>
                        </li>
                        <?php } ?>
                        <?php } ?>


                        <li> 
                        <a href="<?php echo $this->config->item('base_url');?>auth/logout" class="ap-navbar-top-span" style="padding-left: 10px;">
                        <span class="pull-left">LOGOUT</span>
                        <br>
                        <span class="pull-left"></span>
                        <span class="clearfix"></span>
                        </a>
                        </li>           

                        </ul>
                        </li>
                      </ul>

    			</ul>

			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<div class="ap-body-wrapper">  
		<?php if (isset($body)): ?>
		<?php echo $body; ?>
		<?php endif ?>
	</div>


	<footer>
	<div class="panel panel-default" style="margin-bottom:0px;">
		<div class="panel-heading ap-panel-footer">
		<div class="pull-left"></div>
		<div class="pull-right">
			<?php if ($this->config->item('app_copyrights') != '') { ?>
			<span class="ap-lf-panel-footer-txt pull-right" style="font-size:12px;">All RIGHTS RESERVED &nbsp;&copy;&nbsp;
			<?php echo $this->config->item('app_copyrights'); ?>
			<?php if ($this->config->item('app_country') != '') { ?>
			&nbsp;
			<?php echo $this->config->item('app_country'); ?>
			<?php } ?>
			</span>
			<?php } ?>
			<?php if ($this->config->item('app_version') != '') { ?>
			<span class="ap-lf-panel-footer-txt pull-right">&nbsp;Version <?php echo $this->config->item('app_version'); ?> &nbsp;|&nbsp;</span>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
		</div>
	</div> 
	</footer>
</body>
</thml>