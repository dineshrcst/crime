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

<body class="ap-body" ng-app="app">
	<input id="app-baseurl" name="app-baseurl" type="hidden" value="<?php echo $this->config->item('base_url');?>">
	<nav class="navbar navbar-default navbar-inverse top-bar navbar-fixed-top ap-navbar-inverse" role="navigation">
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