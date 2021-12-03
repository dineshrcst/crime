<section id="view-section" style="margin-top: 0px; margin-bottom: 50px;">
<div id="section-header" class="container ap-section-header">
<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>

<div class="sw-hdr-timestamp"><?php echo $c_timestamp; ?></div>
<div class="container-fluid">  
<div id="rp-container">

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header"><?php echo $screen_name;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li></li>
</ul>
</div>

</div>
</header>
<br/>
<div class="clearfix"></div>
<div class="container-fluid" style="overflow-y: scroll; height:58vh;">

<table id="data-table" class="ap-data-table display" style="width:100%">
<thead>
	 <tr>
    <th class="text-center">REFERENCE NO</th>
    <th class="text-center">TYPE</th>
    <th class="text-center">DATE</th>
    <th class="text-center">TIME</th>
    <th class="text-center">ADDRESS</th>
    <th class="text-center">DESCRIPTION</th>  
    <th class="text-center">NEAR POLICE STATION</th>
    <th class="text-center">STATUS</th>      
    <th class="text-center">LOCATION</th> 
    <th class="text-center">EVIDENCES</th>
    <th class="text-center">ACTION</th>
    </tr>
</thead>
<tbody>

<?php if (isset($list) && is_array($list) && !empty($list)): ?>     
<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->id; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->type; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->date; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->time; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->address; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->description; ?></span>
</td>
<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->near_police; ?></span>
</td>

<td class="text-center">
 <?php if ($item->status == 'P' OR $item->status == 'H'): ?>
    <span class="label label-primary">Pending</span>
  <?php endif ?>
  <?php if ($item->status == 'R'): ?>
    <span class="label label-warning">Rejected</span>
  <?php endif ?>
  <?php if ($item->status == 'M'): ?>
    <span class="label label-default">Modified</span>
  <?php endif ?>
  <?php if ($item->status == 'A'): ?>
    <span class="label label-success">Approved</span>
  <?php endif ?>
  <?php if ($item->status == 'D'):?>
    <span class="label label-danger">Deleted</span>
  <?php endif ?>

</td>

<td class="text-center">
  <center>
    <a data-href="<?php echo $this->config->item('base_url')."complain/showLocation";?>?id=<?php echo $item->id; ?>" data-toggle="modal" data-target="#mapModal">
      Show Location
    </a>
    </center>
</td>

<td class="text-center">
  <center>
     <?php if (isset($item->count)): 
      if($item->count > 0){ ?>
      <button type="button"  class="btn btn-info" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#sliderModel" data-href="<?php echo $this->config->item('base_url')."complain/showImages";?>?id=<?php echo $item->id; ?>">SHOW
      </button>
     <?php } 
     endif
     ?>
    </center>
</td>

<td class="text-center">
	<center>
      <?php $user_roll = $_SESSION['roll_id']; ?>
	    <button type="button"  class="btn btn-success" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confModal" data-href="<?php echo $this->config->item('base_url')."complain/approveData";?>?id=<?php echo $item->id;?>&nearPolice=<?php echo $item->np;?>">APPROVE
	    </button>
	    <button type="button"  class="btn btn-warning" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#rejModal" data-href="<?php echo $item->id; ?>">REJECT
	    </button>
      <?php if($user_roll == 2): ?>
        <button type="button"  class="btn btn-primary" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confModal" data-href="<?php echo $this->config->item('base_url')."complain/assignAdmin";?>?id=<?php echo $item->id; ?>">ASSIGN ADMIN
      </button>
      <?php endif?>  
    </center>
</td>
</tr>   

<?php endforeach ?>
<?php endif ?>
</tbody>
</table>
<hr class="ap-rp-hr-b">
</div>

<?php if (isset($list3)): ?>
<!--Assign Part done here for administrator-->
<br/>
<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header"><?php echo $screen_name2;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li></li>
</ul>
</div>

</div>
</header>
<br/>
<div class="clearfix"></div>
<div class="container-fluid" style="overflow-y: scroll; height:58vh;">

<table id="data-table2" class="ap-data-table display" style="width:100%">
<thead>
   <tr>
    <th class="text-center">REFERENCE NO</th>
    <th class="text-center">TYPE</th>
    <th class="text-center">DATE</th>
    <th class="text-center">TIME</th>
    <th class="text-center">ADDRESS</th>
    <th class="text-center">DESCRIPTION</th>
    <th class="text-center">NEAR POLICE STATION</th> 
    <th class="text-center">STATUS</th>
    <th class="text-center">LOCATION</th>    
    <th class="text-center">EVIDENCES</th>
    <th class="text-center">ACTION</th>
    </tr>
</thead>
<tbody>

<?php if (isset($list3) && is_array($list3) && !empty($list3)): ?>     
<?php foreach ($list3 as $item): ?>    

<tr class="ap-st-label">  

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->id; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->type; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->date; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->time; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->address; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->description; ?></span>
</td>
<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->near_police; ?></span>
</td>
<td class="text-center">
 <?php if ($item->status == 'P' OR $item->status == 'H'): ?>
    <span class="label label-primary">Pending</span>
  <?php endif ?>
  <?php if ($item->status == 'R'): ?>
    <span class="label label-warning">Rejected</span>
  <?php endif ?>
  <?php if ($item->status == 'M'): ?>
    <span class="label label-default">Modified</span>
  <?php endif ?>
  <?php if ($item->status == 'A'): ?>
    <span class="label label-success">Approved</span>
  <?php endif ?>
  <?php if ($item->status == 'D'):?>
    <span class="label label-danger">Deleted</span>
  <?php endif ?>

</td>

<td class="text-center">
  <center>
    <a data-href="<?php echo $this->config->item('base_url')."complain/showLocation";?>?id=<?php echo $item->id; ?>" data-toggle="modal" data-target="#mapModal">
      Show Location
    </a>
    </center>
</td>

<td class="text-center">
  <center>
     <?php if (isset($item->count)): 
      if($item->count > 0){ ?>
      <button type="button"  class="btn btn-info" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#sliderModel" data-href="<?php echo $this->config->item('base_url')."complain/showImages";?>?id=<?php echo $item->id; ?>">SHOW
      </button>
     <?php } 
     endif
     ?>
    </center>
</td>


<td class="text-center">
  <center>
    <?php if (isset($police_modal)): ?>
      <button type="button"  class="btn btn-primary" value="<?php echo $item->np; ?>" data-toggle="modal" data-target="#pAssignModal" data-href="<?php echo $item->id; ?>">Assign Complain
      </button>
    <?php endif ?>

    <?php if (isset($officer_modal)): ?>
      <button type="button"  class="btn btn-primary" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#OAssignModal" data-href="<?php echo $item->id; ?>">Assign Complain
      </button>
    <?php endif ?>

    </center>
</td>
</tr>   

<?php endforeach ?>
<?php endif ?>
</tbody>
</table>
<hr class="ap-rp-hr-b">
</div>

<?php endif ?>

</div>
</div>
</div>



<div id="ap-msgmdlcon">
<?php if (isset($confrm_modal)): ?>
<?php echo $confrm_modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon2">
<?php if (isset($reject_modal)): ?>
<?php echo $reject_modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($slider_Modal)): ?>
<?php echo $slider_Modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($police_modal)): ?>
<?php echo $police_modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon2">
<?php if (isset($officer_modal)): ?>
<?php echo $officer_modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($map_Modal)): ?>
<?php echo $map_Modal; ?>
<?php endif ?>
</div>

</section>

<script>
$(document).ready(function() {   

$('#data-table').DataTable({
"paging":   true,
"info":     false,
"order": [ 0, 'asc' ]

});

$('#data-table2').DataTable({
"paging":   true,
"info":     false,
"order": [ 0, 'asc' ]

});


});

$('#confModal').on('show.bs.modal', function(e) {
    $(this).find('.btn-conf').attr('value', $(e.relatedTarget).data('href'));
});

$('#rejModal').on('show.bs.modal', function(e) {
    $(this).find('#comId').attr('value', $(e.relatedTarget).data('href'));
});

$('#pAssignModal').on('show.bs.modal', function(e) {
    $(this).find('#comId').attr('value', $(e.relatedTarget).data('href'));
    $("#policeStation").val($(e.relatedTarget).val());
});

$('#OAssignModal').on('show.bs.modal', function(e) {
    $(this).find('#comId').attr('value', $(e.relatedTarget).data('href'));
});

$('#sliderModel').on('show.bs.modal', function(e) {
    $(this).find('#compId').attr('value', $(e.relatedTarget).data('href'));
     var urlData = $('#compId').attr("value");
        //$.get(url,  // url
        //function (data, textStatus, jqXHR) {  // success callback
        //  alert(data);
        //});
        var html = "";
        var html2 = "";
        $( "#myData").empty();
        $( "#ShowDots" ).empty();
        $.ajax({    //create an ajax request to display.php
        type: 'POST',
        url: urlData,      
        contentType: "application/json",       
        dataType: 'json',  //expect html to be returned                
         success: function(response) {
            var string1 = JSON.stringify(response);
            var parsed = JSON.parse(string1);
            for(var i=0;i<parsed.length;i++){
              html += "<div class='mySlides'>";
              html += "<div class='numbertext'>"+(i+1)+"</div>";

              if(parsed[i].category == 'V'){
                var path = "<?php echo $this->config->item('base_url');?>uploads/video/";
                html += "<video  controls>";
                html += "<source src='"+path+"/"+parsed[i].file_name+"' type='video/"+parsed[i].file_type+"'>";
                html += "</video>";
              }if(parsed[i].category == 'A'){
                var path = "<?php echo $this->config->item('base_url');?>uploads/audio/";
                html += "<div style='padding-left:125px;'>";
                html += "<audio  controls>";
                html += "<source src='"+path+"/"+parsed[i].file_name+"' type='audio/"+parsed[i].file_type+"'>";
                html += "</audio>";
                html += "</div>";
              }else if(parsed[i].category == 'I'){
                var path = "<?php echo $this->config->item('base_url');?>uploads/images/";
                html += "<img src='"+path+"/"+parsed[i].file_name+"' style='width:95%;margin-left:10px;'>";
              }              
              
              html += "</div>";
              html2 += "<span  class='dot' onclick='currentSlide("+(i+1)+")'></span>";
              $( "#myData" ).append(html);
              $( "#ShowDots" ).append(html2);
              html = "";
              html2 = "";
              document.getElementById("ClickMe").click();
            }
        },
        error: function(response) {
            console.log(response);
        }

    });
});

//load Map
$('#mapModal').on('show.bs.modal', function(e) {
    $(this).find('#comIdMap').attr('value', $(e.relatedTarget).data('href'));
    var urlData = $('#comIdMap').attr("value");
     $.ajax({    //create an ajax request to display.php
        type: 'POST',
        url: urlData,      
        contentType: "application/json",       
        dataType: 'json',  //expect html to be returned                
         success: function(response) {
            var string1 = JSON.stringify(response);
            var parsed = JSON.parse(string1);

            var longitude = parsed[0].longitude;
            var latitude = parsed[0].latitude;

            var center = new google.maps.LatLng(latitude,longitude);
            var mapOptions = {
            zoom: 13,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            map = new google.maps.Map(document.getElementById("map_canvas2"), mapOptions);

            var marker = new google.maps.Marker({
            map: map,
            position: center,
            });

        },
        error: function(response) {
            console.log(response);
        }

    });

});

function saveChanges(){
	var url = $('#conf-button').val();
	$.get(url,  // url
      function (data, textStatus, jqXHR) {  // success callback
          $('#confModal').modal('toggle');
          location.reload();
    });
	
}

$(function() {
  // Initialize form validation on the registration form.
  $("form[name='rejectComplain']").validate({
    // Specify validation rules
    rules: {
      message: "required" 
    },
    // Specify validation error messages
    messages: {
      message: "Reject reason is required."
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>
