<?php if (isset($permissions['USER_STATUS']) && $permissions['USER_STATUS']): ?>
<ul class="list-group">
<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/user.png" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>USER</span></span>
</a>
</li> 


<?php if (isset($permissions['USER_UPDATE_PERMISSION']) && $permissions['USER_UPDATE_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>user/edit">
	<span>Manage User</span>
</a>
</li>
<?php endif ?> 

<?php if (isset($permissions['USER_APPROVE_PERMISSION']) && $permissions['USER_APPROVE_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>user/approve">
	<span>Approve User</span>
</a>
</li>
<?php endif ?>

<?php if (isset($permissions['USER_ASSIGN_PERMISSION']) && $permissions['USER_ASSIGN_PERMISSION']): ?>
<li class="list-group-item ap-dash-link" >
<a href="<?php echo $this->config->item('base_url');?>user/assign">
	<span>Assign User</span>
</a>
</li>
<?php endif ?>
</ul>	
<?php endif ?>