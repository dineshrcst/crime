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

</div>
</div>
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


});

$('#pAssignModal').on('show.bs.modal', function(e) {
    $(this).find('#userId').attr('value', $(e.relatedTarget).data('href'));
});

</script>
