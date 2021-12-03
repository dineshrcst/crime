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
    <title><?php echo $this->config->item('app_name').' | '.$heading;?></title>  
    <link href="<?php echo $this->config->item('public_url')."images/assets/icon.png";?>" rel="shortcut icon" >
    <link href="<?php echo $this->config->item('public_url')."css/fontawesome.min.css";?>" rel="stylesheet">    
    <link href="<?php echo $this->config->item('public_url')."css/bootstrap.min.css";?>" rel="stylesheet">	
    
    <link href="<?php echo $this->config->item('public_url')."css/styles.css";?>" rel="stylesheet">
    <script src="<?php echo $this->config->item('public_url')."js/jquery-1.11.2.js";?>"></script>
    <script src="<?php echo $this->config->item('public_url')."js/bootstrap.min.js";?>"></script>

    <script src="<?php echo $this->config->item('public_url');?>js/app-scripts.js"></script>
    <?php if ($this->config->item('app_browser_context')): ?>
    <script src="<?php echo $this->config->item('public_url')."js/contxtiedb.js";?>"></script>
    <?php endif ?>
</head>
<body class="ap-body" ng-app="app">
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
    <?php 
        $cstmdta="";
        if (isset($_SESSION['user_branch']) && $_SESSION['user_branch']!="0") {
        $cstmdta=$cstmdta."BRANCH: ".$this->session->userdata('user_branch')." - ".$this->session->userdata('user_brname');
        }

        if (isset($_SESSION['user_clscode'])) {
        if (isset($_SESSION['user_branch']) && $_SESSION['user_branch']!="0") {
        $cstmdta=$cstmdta." | ";
        }
        $cstmdta=$cstmdta."CLUSTER: ".$this->session->userdata('user_clscode');
        }

        if (isset($_SESSION['user_env'])) {

        if (isset($_SESSION['user_branch']) || isset($_SESSION['user_clscode'])) {
        $cstmdta=$cstmdta." | ";
        }
        $cstmdta=$cstmdta."ENV: ".$this->session->userdata('user_env');
        }
        ?>

        <ul class="nav navbar-nav ap-navbar-nav navbar-right" style="margin-top: 7px;">
        <li><p class="navbar-text ap-navbar-text"><?php echo $cstmdta; ?></p></li>
        <br>
        <li class="dropdown ap-nav-dropdown-rgt pull-right">
        <a href="#" class="dropdown-toggle dp-rgt" data-toggle="dropdown">
        <?php if (isset($_SESSION['username'])) { ?>
        <span><?php echo $this->session->userdata('username');?></span>
        <?php } ?>
        &nbsp;<span class="caret"></span>
        </a>
        <ul id="login-dp" class="dropdown-menu ap-dpdown-mnu">
        <?php if (isset($_SESSION['fullname'])) { ?>
        <li> 
        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
        <span class="pull-left">USER NAME:</span>
        <br>
        <span class="pull-left"><?php echo $this->session->userdata('fullname');?></span>
        <span class="clearfix"></span>
        </a>
        </li>
        <?php } ?>


        <?php if (isset($_SESSION['user_level'])) { ?>
        <?php if ($_SESSION['user_level'] == "O") { ?>
        <li> 
        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
        <span class="pull-left">USER ROLE:</span>
        <br>
        <span class="pull-left">BRANCH OPERATOR</span>
        <span class="clearfix"></span>
        </a>
        </li>
        <?php } elseif ($_SESSION['user_level'] == "B") { ?>
        <li> 
        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
        <span class="pull-left">USER ROLE:</span>
        <br>
        <span class="pull-left">B CLASS OFFICER</span>
        <span class="clearfix"></span>
        </a>
        </li>
        <?php } elseif ($_SESSION['user_level'] == "A") { ?>
        <li> 
        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
        <span class="pull-left">USER ROLE:</span>
        <br>
        <span class="pull-left">A CLASS OFFICER</span>
        <span class="clearfix"></span>
        </a>
        </li>
        <?php } elseif ($_SESSION['user_level'] == "D") { ?>
        <li> 
        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
        <span class="pull-left">USER ROLE:</span>
        <br>
        <span class="pull-left">DEALER</span>
        <span class="clearfix"></span>
        </a>
        </li>
        <?php } ?>
        <?php } ?>

        <?php if (isset($_SESSION['user_branch']) && $_SESSION['user_branch']!="0") { ?>  
        <li> 
        <a href="" class="ap-navbar-top-span" style="padding-left: 10px;">
        <span class="pull-left">USER BRANCH:</span>
        <br>
        <span class="pull-left"><?php echo $this->session->userdata('user_branch');?> - <?php echo $this->session->userdata('user_brname');?></span>
        <span class="clearfix"></span>
        </a>
        </li>
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

    </div>
  </div><!-- /.container-fluid -->
</nav>


<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
    background-color: #fff;
    margin: 40px;
    font: 13px/20px normal Helvetica, Arial, sans-serif;
    color: #4F5155;
}

a {
    color: #003399;
    background-color: transparent;
    font-weight: normal;
}

h1 {
    color: #444;
    background-color: transparent;
    border-bottom: 1px solid #D0D0D0;
    font-size: 19px;
    font-weight: normal;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
}

code {
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
    font-size: 12px;
    background-color: #f9f9f9;
    border: 1px solid #D0D0D0;
    color: #002166;
    display: block;
    margin: 14px 0 14px 0;
    padding: 12px 10px 12px 10px;
}

#er-container {
    margin-top: 25px;
}

p {
    margin: 12px 15px 12px 15px;
}

.desc {
    font-size: 11px;
    color: #e57171;
}

.ico_er {
    color: #e57171;
}


</style>


<div class="ap-body-wrapper">  

<div id="er-container" class="container">
<h1><?php echo $heading; ?></h1>
<p><?php echo $message; ?></p>
<?php if (isset($description)): ?>
<p class="desc"><?php echo $description; ?></p>
<?php endif ?>

<p>
<span>Please</span>
<span><a href="<?php echo $this->config->item('base_url');?>dashboard">click here</a></span>
<span>to go back to the</span>
<span><?php echo $this->config->item('app_name'); ?></span>
<span>Dashboard</span>
</p>

</div>

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
</html>