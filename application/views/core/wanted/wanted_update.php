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

<form id="requestform" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."wanted/update";?>"">

<input type="hidden" name="id" value="<?php echo $list[0]->id;?>">   
<div class="col-md-12 wid-no-padding">

<!--Misiing Person Name-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Name : <span class="app-req-star">*</span></label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-name" class="form-control ap-inp-field" type="text" name="name" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="1" value = "<?php echo $list[0]->name;?>">
<span id="er-name" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('name'); ?></span>
</div>
</div>
</div>
</div>
<!--End Name-->

<!--Wanted Person age-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Age : <span class="app-req-star">*</span></label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-age" class="form-control ap-inp-field" type="text" name="age" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="2" value = "<?php echo $list[0]->age;?>">
<span id="er-age" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('age'); ?></span>
</div>
</div>
</div>
</div>
<!--End age-->

<!--Sex-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Sex: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<?php if($list[0]->sex == 'M'):?>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="M"  tabindex="3" checked>
      <label class="form-check-label" for="inlineRadio1">Male</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="F"  tabindex="3">
      <label class="form-check-label" for="inlineRadio2">Female</label>
    </div>
<?php endif?>
<?php if($list[0]->sex == 'F'):?>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="M"  tabindex="3" >
      <label class="form-check-label" for="inlineRadio1">Male</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="F"  tabindex="3" checked>
      <label class="form-check-label" for="inlineRadio2">Female</label>
    </div>
<?php endif?>
</div>
</div>
</div>
</div>

<!--End Sex-->

<!--Aliases-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Aliases : </label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-aliases" class="form-control ap-inp-field" type="text" name="aliases" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="4" value = "<?php echo $list[0]->aliases;?>">
</div>
</div>
</div>
</div>
<!--End Aliases-->

<!--Remarks-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Remarks: </label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-remarks" class="form-control ap-inp-field" name="remarks" cols="50" rows="5" placeholder="Enter remakrs about person here..." tabindex="5" minlength="1" maxlength="500">
<?php echo $list[0]->remarks;?>
</textarea>
</div>
</div>
</div>
</div>
<!--End Remarks -->

<!--Caution-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Caution: </label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-caution" class="form-control ap-inp-field" name="caution" cols="50" rows="5" placeholder="Enter caution about most wanted person here..." tabindex="6" minlength="1" maxlength="500">
 <?php echo $list[0]->caution;?>   
</textarea>
</div>
</div>
</div>
</div>
<!--End Caution-->

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
<?php if($pc->id == $list[0]->police_station ){ ?>
<option value="<?php echo $pc->id; ?>" data-subtext="<?php echo $pc->name; ?>" selected><?php echo $pc->name;?></option>
<?php }else{ ?>
<option value="<?php echo $pc->id; ?>" data-subtext="<?php echo $pc->name; ?>"><?php echo $pc->name;?></option>
<?php }?>

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
    <a value="<?php echo $list[0]->id; ?>" data-toggle="modal" data-target="#sliderModel" data-href="<?php echo $list[0]->image_name; ?>" style="margin-left: 275px;">Show Saved Image</a>
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

<div id="ap-msgmdlcon">
<?php if (isset($slider_Modal)): ?>
<?php echo $slider_Modal; ?>
<?php endif ?>
</div>

<!-- end of section-form -->
</section>

<script type="text/javascript">

    $('#sliderModel').on('show.bs.modal', function(e) {
    $(this).find('#compId').attr('value', $(e.relatedTarget).data('href'));
     var Data = $('#compId').attr("value");
     var html = "";
     var path = "<?php echo $this->config->item('base_url');?>uploads/wanted/";
     html += "<div class='mySlides'>";
     html += "<div class='numbertext'></div>";
     html += "<img src='"+path+"/"+Data+"' style='width:95%;margin-left:10px;'>";
     html += "</div>";
     $( "#myData" ).append(html);
     html = "";
     html2 = "";
     document.getElementById("ClickMe").click();
});
 </script>