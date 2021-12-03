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

<form id="requestform" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."complain/save";?>"">   
<div class="col-md-12 wid-no-padding">

<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-bottom:0px;"><b>Complain Details</b></label>
<hr>
</div>

<!--Select Crime Type-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Criminal Type: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-crimeselector" class="selectpicker form-control ap-inp-field" name="crimeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select criminal type" tabindex="1">
<option value="0" data-subtext="Select Type" >Select Criminal Type</option>
<?php if (isset($crimes)): ?>

<?php foreach ($crimes as $crime): ?>

<option value="<?php echo $crime->id; ?>" data-subtext="<?php echo $crime->name; ?>"><?php echo $crime->name; ?></option>

<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-crimeselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('crimeselector'); ?></span>
</div>
</div>
</div>
</div>
<!--End Channel select value-->

<!--Criminal Date-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Criminal Date / Time: <span class="app-req-star">*</span></label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1 ">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li>
    <div class="ap-btn-group" style="padding: 6px 0px;"> 
    <link href="<?php echo $this->config->item('public_url');?>css/jquery-ui.css" rel="stylesheet">  
    <link href="<?php echo $this->config->item('public_url');?>css/jquery-ui-custom.css" rel="stylesheet"> 
    <script src="<?php echo $this->config->item('public_url');?>js/jquery-ui.js"></script>
    <script>
    $(document).ready(function(){
    $( "#datepicker" ).datepicker({
    dateFormat: 'yy-mm-dd',
    beforeShow: function(input, inst) {
        var widget = $(inst).datepicker('widget');
        widget.css('margin-left', ($(input).outerWidth() - widget.outerWidth()) + 22);
    }, 
    onSelect: function(dateText, inst) {
        var date = dateText;
    }
    });
    $('#ctime').val('<?php echo $c_time;?>');
    });
    </script>
    <input type="text" name= "cdate" id="datepicker" value="<?php echo $c_date; ?>" style="padding: 1px 6px;" tabindex="2">
    
     <input type="time" id="ctime" name="ctime" style="margin-top:2px; margin-left:5px;" tabindex="3">   
     <span id="er-ctime" class="ap-lbl-inp-err" style="margin-left:123px;" for="error-msg"><?php echo form_error('ctime'); ?></span>

    <a class="ap-btn ap-btn-new ap-btn-widget" style="margin-top:2px; padding: 30px 2px 2px 227px;">
    <span style="position: relative;top: -3px;"></span>
    </a>     

    </div>
</li>
</ul>
</div>
</div>
</div>
</div>

<!--End Criminal Date-->

<!--Address-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Crime Address: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-address" class="form-control ap-inp-field" name="address" cols="50" rows="5" placeholder="Enter criminal address here..." tabindex="4" minlength="1" maxlength="100"></textarea>
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
<textarea id="id-description" class="form-control ap-inp-field" name="description" cols="50" rows="5" placeholder="Enter brief description about crime here..." tabindex="5" minlength="1" maxlength="100"></textarea>
<span id="er-description" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('description'); ?></span>
</div>
</div>
</div>
</div>
<!--End Description-->
<!--Withness name1-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Withness Name 1: </label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-wname1" class="form-control ap-inp-field" type="text" name="wname1" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="6">
</div>
</div>
</div>
</div>
<!--End Withness name1-->

<!--Withness phone number1-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Withness Contact No 1: </label>
</div>  

<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-wphone1" class="form-control ap-inp-field numeric_only" type="text" name="wphone1" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="7" >
<span id="er-phone1" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!--End withness phone number1-->

<!--Withness name2-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Withness Name 2: </label>
</div>  

<div class="col-md-8 ap-sinp-col-for-inp-1">
<input id="id-wname2" class="form-control ap-inp-field" type="text" name="wname2" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="8">
</div>
</div>
</div>
</div>
<!--End Withness name1-->

<!--Withness phone number1-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Withness Contact No 2: </label>
</div>  

<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-wphone2" class="form-control ap-inp-field numeric_only" type="text" name="wphone2" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="9" >
<span id="er-phone2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!--End withness phone number1-->

<!--Select Nearest police Station-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Nearest Police Station: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-policeselector" class="selectpicker form-control ap-inp-field" name="policeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Police Station" tabindex="10">
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

<!--Location-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Location:<span class="app-req-star">*</span> </label>
</div>  
<div class="col-md-8 ap-sinp-col-for-inp-1">
<input type ="hidden" id = "latitude" name="latitude"/>
<input type ="hidden" id = "longitude" name="longitude"/>
<div id="map_canvas" style="width: 100%; height: 300px;"></div>
</div>    
</div>
</div>
</div>
<!--End Location-->

<br/>
<hr/>
<br/>
<!--crime person details-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Know Crime Person: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="knowCrime" id="inlineRadio1" value="Y"  tabindex="3" checked>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="knowCrime" id="inlineRadio2" value="N"  tabindex="3">
  <label class="form-check-label" for="inlineRadio2">No</label>
</div>
</div>
</div>
</div>
</div>
<!--End crime person details>
<!--Crime Name-->

<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Criminal Name </label>
</div>  

<div class="col-md-4 ap-sinp-col-for-inp-1">
<input id="id-wphone2" class="form-control ap-inp-field " type="text" name="cName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="9" >
<span id="er-phone2" class="ap-lbl-inp-err" for="error-msg"></span>
</div>

</div>
</div>
</div>
<!--Crime Name-->

<!--Address-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Criminal Person Address: </label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<textarea id="id-address" class="form-control ap-inp-field" name="caddress" cols="50" rows="5" placeholder="Enter criminal address here..." tabindex="4" minlength="1" maxlength="100"></textarea>
</div>
</div>
</div>
</div>
<!--End Address -->

<!--Criminal Persom Image-->
<br/>
<div class="clearfix"></div>
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Attach Criminal Person Image: </label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
    <input type="file" name="fileToUpload" id="fileToUpload" />
    <div id="moreFileUpload"></div>
</div>
</div>
</div>
</div>

<!---->

<br/>
<hr/>
<br/>
<!--File Upload-->
<br/>
<div class="clearfix"></div>
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Attach Files: </label>
</div> 
<div class="col-md-8 ap-sinp-col-for-inp-1">
    
    <input type="file" name="file[]" id="file1" multiple />
    <div id="moreFileUpload"></div>
   
    <div id="moreFileUploadLink" style="display:none; margin-left: 240px;margin-top: -20px;">
                            <a href="javascript:void(0);" id="attachMore">Attach another file</a>
    </div>
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

<!--Javascript to load google map-->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
 $( document ).ready(function() {
    showMore();
    attachMore();
    getLocation();
    setTimeout( function(){ 
    showMap();
  }  , 1000 );
});

 function getLocation(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    
    }else{
        alert("Geolocation is not supported by this browser.");
    }
 }

 function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    latitude = (Math.round(latitude * 100000) / 100000);
    longitude = (Math.round(longitude * 100000) / 100000);

    $("#longitude").val(longitude);
    $("#latitude").val(latitude);
 }

 function showMap(){
    var latitude = $("#latitude").val();
    var longitude = $("#longitude").val();

    /*var center = new google.maps.LatLng(latitude,longitude);
    var mapOptions = {
    zoom: 13,
    center: center,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    var marker = new google.maps.Marker({
    map: map,
    position: center,
    });
*/

    var center = new google.maps.LatLng(latitude,longitude);
    var mapOptions = {
    zoom: 13,
    center: center,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    var marker = new google.maps.Marker({
    map: map,
    position: center,
    });

  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!",
    position: center,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
    );
    infoWindow.open(map);
    var lat1 = infoWindow.getPosition().lat(); 
    var long1 = infoWindow.getPosition().lng();
    var latlng = new google.maps.LatLng(lat1,long1);
    marker.setPosition(latlng);
    $("#longitude").val(long1);
    $("#latitude").val(lat1);
  });

 }

 function showMore(){
     $("input[id^='file']").each(function () {
            var id = parseInt(this.id.replace("file", ""));
            $("#file" + id).change(function () {
                if ($("#file" + id).val() !== "") {
                    $("#moreFileUploadLink").show();
                }
            });
        });
 }

 function attachMore(){
    var upload_number = 2;
        $('#attachMore').click(function () {
            //add more file
            $("#moreFileUploadLink").css("margin-top", "-60px");
            var moreUploadTag = '';
           // moreUploadTag += '&nbsp;<input type="file" id="upload_file' + upload_number + '" name="file[]' + upload_number + '"/>';
           moreUploadTag += '&nbsp;<input type="file" id="upload_file' + upload_number + '" name="file[]"/>';
            moreUploadTag += '&nbsp;<a href="javascript:void" style="cursor:pointer;" onclick="deletefileLink(' + upload_number + ')">Delete ' + upload_number + '</a></div>';
            $('<dl id="delete_file' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreFileUpload');
            upload_number++;
        });
 }

 function deletefileLink(elementId) {
        if (confirm("Are you sure you want to delete ?")) {
            var ele = document.getElementById("delete_file" + elementId);
            ele.parentNode.removeChild(ele);
        }
    }

$(".reset").click(function() {
    $(this).closest('form').find("input[type=text][name!=cdate], textarea").val("");
}); 

</script>