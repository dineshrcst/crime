<?php if (isset($permissions['MOST_WANTED_STATUS']) && $permissions['MOST_WANTED_STATUS']): ?>
<ul class="list-group">
<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/wanted.png" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>MOST WANTED PERSON</span></span>
</a>
</li>

<?php if (isset($permissions['MOST_WANTED_WRITE_PERMISSION']) && $permissions['MOST_WANTED_WRITE_PERMISSION']): ?>
	<li class="list-group-item ap-dash-link">
	<a href="<?php echo $this->config->item('base_url');?>wanted/new">
		<span>Add New Persons</span>
	</a>
	</li>
<?php endif ?> 


<?php if (isset($permissions['MOST_WANTED_UPDATE_PERMISSION']) && $permissions['MOST_WANTED_UPDATE_PERMISSION']): ?> 
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>wanted/edit">
	<span>Manage Persons</span>
</a>
</li>
<?php endif ?> 

<?php if (isset($permissions['MOST_WANTED_READ_PERMISSION']) && $permissions['MOST_WANTED_READ_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>wanted/view">
	<span>View Persons</span>
</a>
</li>
<?php endif ?>

</ul>	
<?php endif ?>