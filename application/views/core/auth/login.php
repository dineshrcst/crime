<form action="<?php echo $this->config->item('base_url')."auth/login"; ?>" id="form-login" class="" method="post" accept-charset="utf-8">
<fieldset class="scheduler-border">
<legend class="scheduler-border">Login</legend>
<div class="form-group">
<input class="form-control ap-inp-field" placeholder="Username" name="username" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php if (isset($username)) { echo $username; } ?>">
</div>

<div class="form-group">
<input class="form-control ap-inp-field" placeholder="Password" name="password" type="password" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="<?php if (isset($password)) { echo $password; } ?>">
</div>

<?php if (isset($error_status) && $error_status): ?>
<div class="">
<label class="form-label ap-lf-label ap-lf-label-error">
<?php echo $error_message; ?>
</label>
</div>


<?php if (isset($reset) && $reset): ?>
<label class="form-label ap-lf-label">
<a href="<?php echo $this->config->item('base_url')."auth/login/reset";?>">Reset User 
<span><i class="fas fa-arrow-right"></i></span>
</a>
</label>
<?php else: ?>
<label class="form-label ap-lf-label">
<a href="<?php echo $this->config->item('base_url')."auth";?>">Back to Login Page 
<span><i class="fas fa-arrow-right"></i></span>
</a>
</label>
<?php endif ?>
<?php endif ?>

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

<div class="form-group">
<a href="<?php echo $this->config->item('base_url')."register";?>">Create Account</a>
<a class="ap-lf-btn-login pull-right">
<input id="sbmt_login" type="submit" value="Login" class="ap-lf-btn-sbmt" tabindex="3">
</a>
<div class="clearfix"></div>
</div>

<div class="form-group">
<div class=" pull-right">
	<a href="<?php echo $this->config->item('base_url')."change";?>">Change Password?</a>

</div>
</div>
</fieldset>
</form>