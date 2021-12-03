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
    <th class="text-center">USER ID</th>
    <th class="text-center">USER NAME</th>
    <th class="text-center">FIRST NAME</th>
    <th class="text-center">LAST NAME</th>
    <th class="text-center">EMAIL</th>
    <th class="text-center">MOBILE NO</th>
    <th class="text-center">USER ROLL</th>
    <th class="text-center">STATUS</th>
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
<span class="ap-tabledata-export"><?php echo $item->username; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->fName; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->lName; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->email; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->phone; ?></span>
</td>
<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->rName; ?></span>
</td>

<td class="text-center">
 <?php if ($item->status == 'P'): ?>
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
	    <form method="post" name ="assignPolice" action="<?php echo $this->config->item('base_url')."User/updateUser";?>"> 
        <input type="hidden" name="userId" value="<?php echo $item->id; ?>">
	    <button type="submit" class="btn btn-primary btn-update" >EDIT
	    </button>
     
      <button type="button"  class="btn btn-danger" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#delModal" data-href="<?php echo $this->config->item('base_url')."User/deleteData";?>?id=<?php echo $item->id; ?>">DELETE
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
<?php if (isset($delete_modal)): ?>
<?php echo $delete_modal; ?>
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



function saveChanges(){
  var url = $('#del-button').val();
  $.get(url,  // url
      function (data, textStatus, jqXHR) {  // success callback
          $('#delModal').modal('toggle');
          location.reload();
    });
  
}
</script>