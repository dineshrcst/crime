<form action="<?php echo $this->config->item('base_url')."auth/change"; ?>" id="form-login" class="" method="post" accept-charset="utf-8">
<fieldset class="scheduler-border">
<legend class="scheduler-border">Change Password</legend>
<div class="form-group">
<input class="form-control ap-inp-field" placeholder="Username" name="username" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="<?php if (isset($username)) { echo $username; } ?>">
<span id="er-username" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('username'); ?></span>
</div>

<div class="form-group">
<input class="form-control ap-inp-field" placeholder="Current Password" name="password" type="password" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="<?php if (isset($password)) { echo $password; } ?>">
<span id="er-password" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('password'); ?></span>
</div>

<div class="form-group">
<input class="form-control ap-inp-field" placeholder="New Password" name="newPassword" type="password" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value="<?php if (isset($newPassword)) { echo $newPassword; } ?>">
<span id="er-newPassword" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('newPassword'); ?></span>
</div>
<div class="form-group">
<input class="form-control ap-inp-field" placeholder="Confirm Password" name="confPassword" type="password" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4" value="<?php if (isset($confPassword)) { echo $confPassword; } ?>">
<span id="er-confPassword" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('confPassword'); ?></span>
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
<a class="ap-lf-btn-login pull-right">
<input id="sbmt_login" type="submit" value="Change Password" class="ap-lf-btn-change" tabindex="3">
</a>
<div class="clearfix"></div>
</div>

</fieldset>
</form>