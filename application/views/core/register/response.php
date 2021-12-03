<div class="container">
	<?php if (isset($response_id) && $response_id=='response_email_verification'): ?>
	<div id="response_email_verification">
		<h3>Email Verification</h3>
		<hr style="margin-bottom:15px;">
		<p>We've sent the verification link to your email! Please check and verify your email address.</p>
		<p>If you still can't find the link, please click Resend button to send the verification email again.</p>
		<a href="<?php echo $response_url; ?>">Resend Verification Email</a>
	</div>
    <?php elseif (isset($response_id) && $response_id=='response_email_verified'): ?> 
    <div id="response_email_verified">
		<h3>Email Verified</h3>
		<hr style="margin-bottom:15px;">
		<p>Your email has been verified successfully.</p>
		<p>Please Login with your username and password.</p>
		<a href="<?php echo $response_url; ?>">Login</a>
	</div>
	<?php else: redirect('register', 'refresh'); ?>		
	<?php endif ?>

</div>