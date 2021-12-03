    <div class="ap-btn-group" style="padding: 6px 0px;"> 
    <link href="<?php echo $this->config->item('public_url');?>css/jquery-ui.css" rel="stylesheet">  
    <link href="<?php echo $this->config->item('public_url');?>css/jquery-ui-custom.css" rel="stylesheet"> 
    <script src="<?php echo $this->config->item('public_url');?>js/jquery-ui.js"></script>

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

<form id="requestform" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."missing/savePerson";?>"">   
<div class="col-md-12 wid-no-padding">

<!--Misiing Person Name-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Name : <span class="app-req-star">*</span></label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-name" class="form-control ap-inp-field" type="text" name="name" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="1">
<span id="er-name" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('name'); ?></span>
</div>
</div>
</div>
</div>
<!--End Name-->

<!--Address-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Address: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-address" class="form-control ap-inp-field" name="address" cols="50" rows="5" placeholder="Enter missing person address here..." tabindex="2" minlength="1" maxlength="100"></textarea>
<span id="er-address" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('address'); ?></span>
</div>
</div>
</div>
</div>
<!--End Address -->

<!--Description-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Descriprion: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-description" class="form-control ap-inp-field" name="description" cols="50" rows="5" placeholder="Enter brief description about missing person here..." tabindex="3" minlength="1" maxlength="100"></textarea>
<span id="er-description" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('description'); ?></span>
</div>
</div>
</div>
</div>
<!--End Description-->

<!--Missing Date-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Missing From: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1 ">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li>    
    <input type="text" name= "cdate" id="datepicker" value="<?php echo $c_date; ?>" style="padding: 1px 6px;" tabindex="4">    

    </div>
</li>
</ul>
</div>
</div>
</div>
<!--End Missing Date-->

<!--Phone Number-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Phone No : <span class="app-req-star">*</span></label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-phone" class="form-control ap-inp-field" type="text" name="phone" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="5">
<span id="er-phone" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('phone'); ?></span>
</div>
</div>
</div>
</div>
<!--End Phone Number-->

<!--Select police Station-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Nearest Police Station: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-policeselector" class="selectpicker form-control ap-inp-field" name="policeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Police Station" tabindex="6">
<option value="0" data-subtext="Select Type" >Select Police Station</option>
<?php if (isset($police)): ?>

<?php foreach ($police as $pc): ?>

<option value="<?php echo $pc->id; ?>" data-subtext="<?php echo $pc->name; ?>"><?php echo $pc->name; ?></option>

<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-policeselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeselector'); ?></span>
</div>
</div>
</div>
</div>
<!--End Select police Station-->

<!--File Upload-->
<br/>
<div class="clearfix"></div>
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Attach Image: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">    
    <input type="file" name="fileToUpload" id="fileToUpload" />
    <span id="er-fileToUpload" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('fileToUpload'); ?></span>
</div>
</div>
</div>
</div>

<!--End File Upload-->

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

    $(document).ready(function(){
    $( "#datepicker" ).datepicker({
    dateFormat: 'yy-mm-dd',
    maxDate: $("#datepicker").val(),
    beforeShow: function(input, inst) {
        var widget = $(inst).datepicker('widget');
        widget.css('margin-left', ($(input).outerWidth() - widget.outerWidth()) + 22);
    }, 
    onSelect: function(dateText, inst) {
        var date = dateText;
    }
    });
    });

    $(".reset").click(function() {
        $(this).closest('form').find("input[type=text][name!=cdate], textarea").val("");
    });
 </script>