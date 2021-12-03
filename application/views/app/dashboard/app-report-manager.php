<?php if (isset($permissions['REPORTS_STATUS']) && $permissions['REPORTS_STATUS']): ?>
<ul class="list-group">
<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/reports.jpg" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>REPORTS</span></span>
</a>
</li> 

<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>reports/dateRange">
	<span>Complains - Date Range</span>
</a>
</li>
 
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>reports/type">
	<span>Complains - Type</span>
</a>
</li>


<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>reports/status">
	<span>Complains - Status </span>
</a>
</li>
<?php $rollId = $_SESSION['roll_id'];
if($rollId == 1):?>
	<li class="list-group-item ap-dash-link" >
	<a href="<?php echo $this->config->item('base_url');?>reports/police">
	<span>Complains - Police Station </span>
	</a>
	</li>
<?php endif ?>	
<?php if($rollId == 1 || $rollId == 2):?>
	<li class="list-group-item ap-dash-link" >
	<a href="<?php echo $this->config->item('base_url');?>reports/delayed">
	<span>Complains - Delayed Complains </span>
	</a>
	</li>
<?php endif ?>
<?php if($rollId == 1 || $rollId == 2):?>
	<li class="list-group-item ap-dash-link" >
	<a href="<?php echo $this->config->item('base_url');?>reports/analysys">
	<span>Officer - Analysys</span>
	</a>
	</li>
<?php endif ?>
</ul>	
<?php endif ?>