<?php if (isset($permissions['MISSING_PERSON_STATUS']) && $permissions['MISSING_PERSON_STATUS']): ?>
<ul class="list-group">
<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/missing.png" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>MISSING PERSON</span></span>
</a>
</li>

<?php if (isset($permissions['MISSING_PERSON_WRITE_PERMISSION']) && $permissions['MISSING_PERSON_WRITE_PERMISSION']): ?>
	<li class="list-group-item ap-dash-link">
	<a href="<?php echo $this->config->item('base_url');?>missing/new">
		<span>Add New Persons</span>
	</a>
	</li>
<?php endif ?> 


<?php if (isset($permissions['MISSING_PERSON_UPDATE_PERMISSION']) && $permissions['MISSING_PERSON_UPDATE_PERMISSION']): ?> 
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>missing/edit">
	<span>Manage Persons</span>
</a>
</li>
<?php endif ?> 

<?php if (isset($permissions['MISSING_PERSON_APPROVE_PERMISSION']) && $permissions['MISSING_PERSON_APPROVE_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>missing/approve">
	<span>Approve Persons</span>
</a>
</li>
<?php endif ?>
<?php if (isset($permissions['MISSING_PERSON_READ_PERMISSION']) && $permissions['MISSING_PERSON_READ_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>missing/view">
	<span>View Persons</span>
</a>
</li>
<?php endif ?>

</ul>	
<?php endif ?>