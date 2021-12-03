<?php if (isset($permissions['POLICE_STATUS']) && $permissions['POLICE_STATUS']): ?>
<ul class="list-group">
<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/police.png" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>POLICE</span></span>
</a>
</li>
<?php if (isset($permissions['POLICE_WRITE_PERMISSION']) && $permissions['POLICE_WRITE_PERMISSION']): ?>
	<li class="list-group-item ap-dash-link">
	<a href="<?php echo $this->config->item('base_url');?>police/new">
		<span>New Police</span>
	</a>
	</li>
<?php endif ?> 


<?php if (isset($permissions['POLICE_UPDATE_PERMISSION']) && $permissions['POLICE_UPDATE_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>police/edit">
	<span>Manage Police</span>
</a>
</li>
<?php endif ?> 

</ul>	
<?php endif ?>