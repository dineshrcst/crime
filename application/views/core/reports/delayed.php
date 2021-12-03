<section id="content-section">
<!-- start of section-form -->
<link href="<?php echo $this->config->item('public_url');?>css/jquery-ui.css" rel="stylesheet">  
<link href="<?php echo $this->config->item('public_url');?>css/jquery-ui-custom.css" rel="stylesheet">
<script src="<?php echo $this->config->item('public_url');?>js/jquery-ui.js"></script>

<link href="<?php echo $this->config->item('public_url');?>css/reports/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo $this->config->item('public_url');?>css/reports/buttons.dataTables.min.css" rel="stylesheet">


<script src="<?php echo $this->config->item('public_url');?>js/reports/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/dataTables.buttons.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/jszip.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/pdfmake.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/vfs_fonts.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/buttons.html5.min.js"></script>

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

<form id="requestform" class="col-md-8 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."reports/viewDuraion";?>"">   
<div class="col-md-12 wid-no-padding">

<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-bottom:0px;"><b>Please Select Duration</b></label>
<hr>
<br/>
</div>

<!--Select Crime Type-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Duration: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-durationselector" class="selectpicker form-control ap-inp-field" name="durationselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select criminal type" tabindex="2">
<option value="0" >Select Duraion</option>
<option value="1" >One Week Delay</option>
<option value="2" >Two Weeks Delay</option>
<option value="3" >One Month Delay</option>
<option value="4" >Three Months Delay</option>
<option value="5" >Six Months Delay</option>
<option value="6" >One Year Delay</option>
</select>
<span id="er-durationselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('durationselector'); ?></span>
</div>
</div>
</div>
</div>
<!--End Channel select value-->
    <div class="clearfix"></div>
    <br/>
    <div class="row ap-btn-ctrl-wrapper">
        <div class="ap-btn-pannel">
        <div class="form-group pull-right">
         <button type="submit" class="btn btn-primary">View Report</button>
        </div>
        <div class="clearfix"></div>
        <hr>
        </div>
    </div>
</form>

</div>
<?php if (isset($list) && is_array($list) && !empty($list)): ?> 
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
        <th class="text-center">POLICE STATION</th>
        <th class="text-center">POLICE OFFICER</th>
        <th class="text-center">ASSIGN DATE</th>
    </tr>
</thead>
<tbody>
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
<span class="ap-tabledata-export"><?php echo $item->police_station; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->fName.' '.$item->lName ; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->assign_date; ?></span>
</td>

</tr>   

<?php endforeach ?>
</tbody>
</table>
<hr class="ap-rp-hr-b">
</div>
<?php endif ?>
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

$(document).ready(function() {   

	$('#data-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
var duration = <?php echo $duration;?>;
$("#id-durationselector").val(duration);
} );


  
</script>