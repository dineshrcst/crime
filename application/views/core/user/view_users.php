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
	    <button type="button"  class="btn btn-primary" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confModal" data-href="<?php echo $this->config->item('base_url')."User/approveData";?>?id=<?php echo $item->id; ?>">APPROVE
	    </button>
	    <button type="button"  class="btn btn-warning" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#rejModal" data-href="<?php echo $item->id; ?>">REJECT
	    </button>
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
<!--Assign User done here for administrator-->
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

<?php if (isset($list3) && is_array($list) && !empty($list3)): ?>     
<?php foreach ($list3 as $item): ?>    

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
    <?php if (isset($police_modal)): ?>
      <button type="button"  class="btn btn-primary" value="<?php echo $item->id; ?>" data-toggle="modal" data-target="#pAssignModal" data-href="<?php echo $item->id; ?>">Assign User
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
<?php if (isset($police_modal)): ?>
<?php echo $police_modal; ?>
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
    $(this).find('#userId').attr('value', $(e.relatedTarget).data('href'));
});

$('#pAssignModal').on('show.bs.modal', function(e) {
    $(this).find('#userId2').attr('value', $(e.relatedTarget).data('href'));
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
