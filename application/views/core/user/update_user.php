<section id="content-section">
<!-- start of section-form -->
<div id="section-form" class="ap-section-component">
<div id="app-tab-create">
<div class="row ap-padding-0">
<div class="col-lg-12 col-md-12 ap-padding-0">
<div class="panel blank-panel">

<div id="section-header" class="container-fluid ap-section-header">

<style>.dboard-menu-sub-ul li { font-size: 13px; }</style>

<?php 
$now = new DateTime('now');
$c_date = date("Y-m-d");
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>

<div class="sw-hdr-timestamp"><?php echo $c_timestamp; ?></div>
<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header"><?php echo $title;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li></li>
</ul>
</div>

</div>
</header>
</div>

<div class="panel-body">

<div class="ap-orgin-frmwp">

<form id="requestform" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."user/updateUserData";?>"">   
<div class="col-md-12 wid-no-padding">

<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-bottom:0px;"><b>User Details</b></label>
<hr>
</div>
<!--Form Fields Start Here-->
<!--Hidden input for user Id-->
<input type="hidden" name="id" value="<?php echo $id;?>">

<!--Select User Type-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">User Type: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-userselector" class="selectpicker form-control ap-inp-field" name="userselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select user type" tabindex="2">
<?php if (isset($userTypes)): ?>

<?php foreach ($userTypes as $user): ?>
<?php if($user->roll_id == $list[0]->rollid ){ ?>
<option value="<?php echo $user->roll_id; ?>" data-subtext="<?php echo $user->roll_name; ?>" selected><?php echo $user->roll_name;?></option>
<?php }else{ ?>
<option value="<?php echo $user->roll_id; ?>" data-subtext="<?php echo $user->roll_name; ?>"><?php echo $user->roll_name;?></option>
<?php }?>

<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-userselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('userselector'); ?></span>
</div>
</div>
</div>
</div>
<!--End user type select -->

<!--Start First Name-->
<div class="ap-sinp-elm">
        <div class="row form-group ap-sinp-wrapper">
        <div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">First Name:</label><span class="app-req-star">*</span></div> 
        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <input id="id-fName" class="form-control ap-inp-field" type="text" name="fName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value = "<?php echo $list[0]->firstname;?>">
        <span id="er-fNAme" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('fName'); ?></span>
        </div>
        </div>
    </div>
<!--End First Name-->

<!--Start Last Name-->
    <div class="ap-sinp-elm">
        <div class="row form-group ap-sinp-wrapper">
        <div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Last Name:</label><span class="app-req-star">*</span></div> 
        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <input id="id-lName" class="form-control ap-inp-field" type="text" name="lName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value= "<?php echo $list[0]->lastname;?>">
        <span id="er-lName" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('lName'); ?></span>
        </div>
        </div>
    </div>
<!--End Last Name-->

<!--Start Email-->
    <div class="ap-sinp-elm">
        <div class="row form-group ap-sinp-wrapper">
        <div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">E Mail:</label><span class="app-req-star">*</span></div> 
        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <input id="id-eMail" class="form-control ap-inp-field" type="text" name="eMail" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4" value="<?php echo $list[0]->email;?>">
        <span id="er-eMail" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('eMail'); ?></span>
        </div>
        </div>
    </div>
<!--End Email-->
<!--Start Phone Number-->
    <div class="ap-sinp-elm">
        <div class="row form-group ap-sinp-wrapper">
        <div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Phone No:</label><span class="app-req-star">*</span></div> 
        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <input id="id-mobile" class="form-control ap-inp-field" type="text" name="mobile" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="5" value="<?php echo $list[0]->phone;?>">
        <span id="er-mobile" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('mobile'); ?></span>
        </div>
        </div>
    </div>

<!--End Phone Number-->

<!--Select Police Station only for oic and police officer-->
<?php if ($list[0]->rollid == 2 or $list[0]->rollid == 3): ?>
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Police Station: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-policeselector" class="selectpicker form-control ap-inp-field" name="policeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Police Station" tabindex="2">
<option value="0" data-subtext="Select Police Station">Select Police Station</option>

<?php if (isset($policeStation)): ?>

<?php foreach ($policeStation as $police): ?>
<?php if($police->id == $list[0]->police_station ){ ?>
<option value="<?php echo $police->id; ?>" data-subtext="<?php echo $police->name; ?>" selected><?php echo $police->name;?></option>
<?php }else{ ?>
<option value="<?php echo $police->id; ?>" data-subtext="<?php echo $police->name; ?>"><?php echo $police->name;?></option>
<?php }?>

<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-policeselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeselector'); ?></span>
</div>
</div>
</div>
</div>

<?php endif ?>
<!--End police Station select -->

<!--Diplsy Reject Reason for rejected userd-->
<?php if ($list[0]->status == 'R'): ?>
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Reject Reason: </label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-reject_reason" class="form-control ap-inp-field" name="reject_reason" cols="50" rows="5" placeholder="Reject Reason" tabindex="4" minlength="1" maxlength="100" readonly><?php echo $list[0]->reject_reason;?>
</textarea>
<span id="er-description" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('reject_reason'); ?></span>
</div>
</div>
</div>
</div>
<?php endif ?>
<!--End Reject Reason-->

<!--Form Fields End Here-->
    <div class="clearfix"></div>
    <br/>
    <div class="row ap-btn-ctrl-wrapper">
        <div class="ap-btn-pannel">
        <div class="form-group pull-right">

         <button type="submit" class="btn btn-primary">Update User</button>

        </div>
        <div class="clearfix"></div>
        </div>
    </div>
</form>

</div>

</div>

</div>
</div>
</div>
</div>  
</div>  
</div>
<!-- end of section-form -->
</section>

