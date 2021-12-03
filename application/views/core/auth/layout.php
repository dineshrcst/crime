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
    
    <link href="<?php echo $this->config->item('public_url');?>images/assets/icon.png" rel="shortcut icon" >
    <link href="<?php echo $this->config->item('public_url');?>css/bootstrap.min.css" rel="stylesheet"> 
    <link href="<?php echo $this->config->item('public_url');?>css/fontawesome.min.css" rel="stylesheet">    
    <link href="<?php echo $this->config->item('public_url');?>css/styles.css" rel="stylesheet">

    <!-- scripts -->
    <script src="<?php echo $this->config->item('public_url');?>js/jquery-1.11.2.js"></script>
    <script src="<?php echo $this->config->item('public_url');?>js/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->item('public_url')."js/jquery.validate.min.js";?>"></script>
    <?php if ($this->config->item('app_browser_context')): ?>
    <script src="<?php echo $this->config->item('public_url')."js/contxtiedb.js";?>"></script>
    <?php endif ?>
</head>
<body>

<div class="container">
<div class="container" style=" margin-top: 12.5%;">
<div class="row vertical-offset-100">
<div class="col-md-4 col-md-offset-4">
<div class="panel panel-default ap-login-panel">

<div class="panel-heading ap-lf-panel-heading">
<div class="" style="margin-bottom: 0px; margin-top: 30px;">
<div class="">
    <a class="" style="padding: 15px 0px;">
    <span><img src="<?php echo $this->config->item('public_url');?>images/assets/crime.jpg" class="img_logo"  width="55" height="50" alt="police-logo"></span>
    <span class="ap-login-header">&nbsp;<?php echo $this->config->item('app_name');?></span>
    </a>
</div>
</div>
</div>

<div class="panel-body">

<?php echo $body; ?>

</div>

<div class="panel-heading ap-lf-panel-footer">
<span class="ap-lf-panel-footer-txt pull-right">
All RIGHTS RESERVED - 2021 &nbsp;&copy;&nbsp;
<?php echo strtoupper($this->config->item('app_copyrights')); ?>
</span>
<div class="clearfix"></div>
</div>

</div>
</div>
</div>
</div>
</div>

</body>
</html>