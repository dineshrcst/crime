<?php if (isset($permissions['COMPLAIN_STATUS']) && $permissions['COMPLAIN_STATUS']): ?>
<ul class="list-group">
<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/complain.png" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>COMPLAINS</span></span>
</a>
</li>
<?php if (isset($permissions['COMPLAIN_WRITE_PERMISSION']) && $permissions['COMPLAIN_WRITE_PERMISSION']): ?>
	<li class="list-group-item ap-dash-link">
	<a href="<?php echo $this->config->item('base_url');?>complain/create/new">
		<span>New Complain</span>
	</a>
	</li>
<?php endif ?> 


<?php if (isset($permissions['COMPLAIN_UPDATE_PERMISSION']) && $permissions['COMPLAIN_UPDATE_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>complain/edit">
	<span>Manage Complain</span>
</a>
</li>
<?php endif ?> 

<?php if (isset($permissions['COMPLAIN_APPROVE_PERMISSION']) && $permissions['COMPLAIN_APPROVE_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>complain/approve">
	<span>Approve Complain</span>
</a>
</li>
<?php endif ?>

<?php if (isset($permissions['COMPLAIN_ASSIGN_PERMISSION']) && $permissions['COMPLAIN_ASSIGN_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>complain/assign">
	<span>Assign Complain</span>
</a>
</li>
<?php endif ?>
<?php if (isset($permissions['COMPLAIN_READ_PERMISSION']) && $permissions['COMPLAIN_READ_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>complain/read">
	<span>View Complain</span>
</a>
</li>
<?php endif ?>

</ul>	
<?php endif ?>