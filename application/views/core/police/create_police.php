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
$c_time = date("h:i");
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

<form id="requestform" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."police/save";?>"">   
<div class="col-md-12 wid-no-padding">
<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-bottom:0px;"><b>Police Station Details</b></label>
<hr>
</div>

<!--Select District-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">District: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-districtselector" class="selectpicker form-control ap-inp-field" name="districtselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select District" tabindex="1">
<option value="0" data-subtext="Select Type" >Select District</option>
<?php if (isset($districts)): ?>

<?php foreach ($districts as $disc): ?>

<option value="<?php echo $disc->id; ?>" data-subtext="<?php echo $disc->name; ?>"><?php echo $disc->name; ?></option>

<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-districtselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('districtselector'); ?></span>
</div>
</div>
</div>
</div>
<!--End District select-->

<!--Police station name-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Police Station Name: <span class="app-req-star">*</span> </label>
</div>  
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-pName" class="form-control ap-inp-field" type="text" name="pName" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="2">
<span id="er-pName" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('pName'); ?></span>
</div>
</div>
</div>
</div>
<!--End Police station name-->

<!--Address-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Address: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-address" class="form-control ap-inp-field" name="address" cols="50" rows="5" placeholder="Enter police station address here..." tabindex="3" minlength="1" maxlength="100"></textarea>
<span id="er-address" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('address'); ?></span>
</div>
</div>
</div>
</div>
<!--End Address -->


<!--Email address-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">E-Mail: <span class="app-req-star">*</span></label>
</div>  
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-eMail" class="form-control ap-inp-field" type="text" name="eMail" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="4">
<span id="er-eMail" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('eMail'); ?></span>
</div>
</div>
</div>
</div>
<!--End Email address-->

<!--phone number-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Phone Number: <span class="app-req-star">*</span></label>
</div>  

<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-phone" class="form-control ap-inp-field numeric_only" type="text" name="phone" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="5" >
<span id="er-phone" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('phone'); ?></span>
</div>
</div>
</div>
</div>
<!--End phone number-->

<!--Select OIC-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Police OIC: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-oicselector" class="selectpicker form-control ap-inp-field" name="oicselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select OIC" tabindex="6">
<option value="0" data-subtext="Select Type" >Select OIC</option>
<?php if (isset($p_oic)): ?>

<?php foreach ($p_oic as $oic): 

if (isset($oic->policeName)):
    $policeStation = 'Police Station : '.$oic->policeName;
else:
    $policeStation = '';
endif    
?>

<option value="<?php echo $oic->user_id; ?>" data-subtext="<?php echo $oic->firstname; ?>"><?php echo $oic->firstname ."  ".$oic->lastname." - ".$policeStation;?></option>

<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-oicselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('oicselector'); ?></span>
</div>
</div>
</div>
</div>
<!--End OIC select-->

    <div class="clearfix"></div>
    <br/>
    <div class="row ap-btn-ctrl-wrapper">
        <div class="ap-btn-pannel">
        <div class="form-group pull-right">
         <button type="button" id= "" class="btn btn-secondary reset">Reset</button>
         <button type="submit" class="btn btn-primary">Save Data</button>

        </div>
        <div class="clearfix"></div>
        <?php       
            if($this->session->flashdata('success'))
            {
                echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';
                unset($_SESSION['success']);
            }   
            if($this->session->flashdata('error'))
            {
                echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>';
                unset($_SESSION['error']);
            }
        ?>
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

<script type="text/javascript">
    $(".reset").click(function() {
    $(this).closest('form').find("input[type=text][name!=cdate], textarea").val("");
});
</script>
