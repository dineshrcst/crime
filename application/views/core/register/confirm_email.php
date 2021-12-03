<div class="container">
	<?php if (isset($error) && !$error): ?>
	<div id="success">
		<h3>Email Verification</h3>
		<hr style="margin-bottom:15px;">
		<p>You've successfully verified your email! Please return to login page.</p>
		<a href="<?php echo $url; ?>">Login</a>
	</div>
	<?php else: ?>
	<div id="error">
		<h3>Email Verification</h3>
		<hr style="margin-bottom:15px;">
		<p>There was a problem verifying your email! Please try again.</p>
		<a href="<?php echo $url; ?>">Resend Verification Link</a>
	</div>	
	<?php endif ?>
</div>