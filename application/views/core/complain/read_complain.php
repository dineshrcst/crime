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
    <th class="text-center">STATUS</th>
    <th class="text-center">LOCATION</th>
    <th class="text-center">EVIDENCES</th>
    <th class="text-center">HISTORY</th>
    <th class="text-center">DOCUMENT</th>
    <th class="text-center">Crime Name</th>
    <th class="text-center">Crime Address</th>
    <?php  $roll_id =  $_SESSION['roll_id']; 
     if ($roll_id != 4):?>
    <th class="text-center">ACTION</th>
    <?php endif ?>
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
  <span id="status_val" value="<?php echo $item->status;?>" ></span>
 <?php if ($item->status == 'P'): ?>
    <span class="label label-primary">Pending</span>
  <?php endif ?>
  <?php if ($item->status == 'I'): ?>
    <span class="label label-warning">In-Progress</span>
  <?php endif ?>
  <?php if ($item->status == 'R'): ?>
    <span class="label label-success">Resolved</span>
  <?php endif ?>
  <?php if ($item->status == 'C'):?>
    <span class="label label-danger">Court Action</span>
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
    <a data-href="<?php echo $this->config->item('base_url')."complain/showHistory";?>?id=<?php echo $item->id; ?>" data-toggle="modal" data-target="#historyModal">
      Show History
    </a>
    </center>
</td>

<td class="text-center">
  <?php if (isset($item->file_name)): ?>
  <center>
     <a href="<?php echo $this->config->item('base_url')."complain/downloadFile";?>?id=<?php echo $item->id; ?>">
      Download
    </a>
    </center>
  <?php endif ?>  
</td>


<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->crime_person_name; ?></span>
</td>
<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->crime_person_address; ?></span>
</td>

<?php  if ($roll_id != 4):?>
<td class="text-center">
  <center>  
<?php if ($roll_id == 1 OR $roll_id == 2): ?>  
     <button type="button"  class="btn btn-primary" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#noteModal" data-href="<?php echo $item->id; ?>">UPDATE ACTION
      </button>
<?php elseif ($roll_id == 3): ?> 
  <?php if ($item->status == 'P'): ?>
<form method="post" name ="officerAction" action="<?php echo $this->config->item('base_url')."Complain/updateOfficerAction";?>">
<input type="hidden" name="complainId" value="<?php echo $item->id; ?>">
<button type="submit" class="btn btn-primary" >ACCEPT</button>
</form>
<button type="button"  class="btn btn-warning" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#rejctModal" data-href="<?php echo $item->id; ?>">REJECT
      </button>
<?php endif ?>
<?php endif ?>
  </center>
</td>
<?php endif ?>
</tr>   

<?php endforeach ?>
<?php endif ?>
</tbody>
</table>
<hr class="ap-rp-hr-b">
</div>

</div>
</div>
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
<?php if (isset($slider_Modal)): ?>
<?php echo $slider_Modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($map_Modal)): ?>
<?php echo $map_Modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($logs_Modal)): ?>
<?php echo $logs_Modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($history_Modal)): ?>
<?php echo $history_Modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($rej_Modal)): ?>
<?php echo $rej_Modal; ?>
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
  
 //hide attach files section 
 $("#attachDocuments").hide();
});

$('#pAssignModal').on('show.bs.modal', function(e) {
    $(this).find('#comId').attr('value', $(e.relatedTarget).data('href'));
});

$('#OAssignModal').on('show.bs.modal', function(e) {
    $(this).find('#comId').attr('value', $(e.relatedTarget).data('href'));
});

$('#noteModal').on('show.bs.modal', function(e) {
    $(this).find('#comId2').attr('value', $(e.relatedTarget).data('href'));
});

$('#rejctModal').on('show.bs.modal', function(e) {
    $(this).find('#comId3').attr('value', $(e.relatedTarget).data('href'));
});

//show images
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

//Show Complain History
$('#historyModal').on('show.bs.modal', function(e) {
    $(this).find('#compIdNew').attr('value', $(e.relatedTarget).data('href'));
     var urlData = $('#compIdNew').attr("value");
        
        var html = "";
        $( "#tableData").empty();
        $.ajax({    //create an ajax request to display.php
        type: 'POST',
        url: urlData,      
        contentType: "application/json",       
        dataType: 'json',  //expect html to be returned                
         success: function(response) {
            var string1 = JSON.stringify(response);
            var parsed = JSON.parse(string1);
            for(var i=0;i<parsed.length;i++){
              var action1 = "";
              if(parsed[i].action == 'I'){
                action1 = "In-Progress";
              }else if(parsed[i].action == 'R'){
                action1 = "Resolved";
              }else if(parsed[i].action == 'C'){
                action1 = "Court Action";
              }else if(parsed[i].action == 'P'){
                action1 = "Pending";
              }

              html += "<tr>";             
              html += "<td>"+action1+"</td>";
              html += "<td>"+parsed[i].log_user+"</td>";
              html += "<td>"+parsed[i].log_date+"</td>";
              html += "<td>"+parsed[i].log_time+"</td>";
              html += "<td>"+parsed[i].note+"</td>";
              html += "</tr>";
              $( "#tableData" ).append(html);
              html = "";
            }
        },
        error: function(response) {
            console.log(response);
        }

    });
});


$(function() {
  // Initialize form validation on the registration form.
  $("form[name='addNote']").validate({
    // Specify validation rules
    rules: {
      note: "required",
      action: "required" 
    },
    // Specify validation error messages
    messages: {
      note: "Reject reason is required.",
      action: "Action is required"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

function showDiv(value){
  if(value == 'R'){
    //show attach files section when changed value to Resolve
    $("#attachDocuments").show();
  }else{
     $("#attachDocuments").hide();
  }
}

</script>
