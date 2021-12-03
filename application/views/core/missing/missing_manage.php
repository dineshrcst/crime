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
    <th class="text-center">ID</th>
    <th class="text-center">NAME</th>
    <th class="text-center">ADDRESS</th>
    <th class="text-center">DESCRIPTION</th>
    <th class="text-center">MISSING FROM</th>
    <th class="text-center">CONTACT NO</th>    
    <th class="text-center">POLICE STATION</th>
    <th class="text-center">IMAGE</th>
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
<span class="ap-tabledata-export"><?php echo $item->name; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->address; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->description; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->missing_from; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->phone; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->police_station; ?></span>
</td>

<td class="text-center"> 
  <center>
     <?php if (isset($item->image_name)): 
      if($item->image_name != ""){ ?>
      <button type="button"  class="btn btn-info" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#sliderModel" data-href="<?php echo $item->image_name; ?>">SHOW IMAGE
      </button>
     <?php } 
     endif
     ?>
    </center>
</td>

<td class="text-center">
  <center>
      <form method="post" name ="updatePerson" action="<?php echo $this->config->item('base_url')."Missing/updatePerson";?>"> 
        <input type="hidden" name="comId" value="<?php echo $item->id; ?>">
      <button type="submit" class="btn btn-primary btn-update" >EDIT
      </button>
     
      <button type="button"  class="btn btn-danger" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#delModal" data-href="<?php echo $this->config->item('base_url')."Missing/deleteData";?>?id=<?php echo $item->id; ?>">DELETE
      </button>
      </form>
    </center>
</td>
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
<?php if (isset($delete_modal)): ?>
<?php echo $delete_modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($update_sucess_modal)): ?>
<?php echo $update_sucess_modal; ?>
<?php endif ?>
</div>

<div id="ap-msgmdlcon">
<?php if (isset($update_error_Modal)): ?>
<?php echo $update_error_Modal; ?>
<?php endif ?>
</div>
<div id="ap-msgmdlcon">
<?php if (isset($slider_Modal)): ?>
<?php echo $slider_Modal; ?>
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

<?php if($this->session->flashdata('success')) { ?>
  $('#update_sucess_modal').modal('show');
  <?php  unset($_SESSION['success']); ?>
<?php }  if($this->session->flashdata('error')) {?>  
  $('#update_error_modal').modal('show');
  <?php  unset($_SESSION['error']); ?>
<?php } ?> 

});


$('#delModal').on('show.bs.modal', function(e) {
    $(this).find('.btn-del').attr('value', $(e.relatedTarget).data('href'));
});

$('#rejModal').on('show.bs.modal', function(e) {
    $(this).find('#comId').attr('value', $(e.relatedTarget).data('href'));
});

$('#sliderModel').on('show.bs.modal', function(e) {
    $(this).find('#compId').attr('value', $(e.relatedTarget).data('href'));
     var Data = $('#compId').attr("value");
     var html = "";
     var path = "<?php echo $this->config->item('base_url');?>uploads/missing/";
     html += "<div class='mySlides'>";
     html += "<div class='numbertext'></div>";
     html += "<img src='"+path+"/"+Data+"' style='width:95%;margin-left:10px;'>";
     html += "</div>";
     $( "#myData" ).append(html);
     html = "";
     html2 = "";
     document.getElementById("ClickMe").click();
});

function saveChanges(){
  var url = $('#del-button').val();
  $.get(url,  // url
      function (data, textStatus, jqXHR) {  // success callback
          $('#delModal').modal('toggle');
          location.reload();
    });
  
}
</script>
