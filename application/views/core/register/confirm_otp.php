<div class="container">
	<div id="otp_verification">
			<h3>Phone Number Verification</h3>
			<hr style="margin-bottom:15px;">
			<form id="requestform" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."register/otp/verification/auth";?>">   
		<div class="col-md-12 wid-no-padding">

			<div class="row form-group app-form-group app-form-group-first">
			<label class="app-input-label" style="margin-bottom:0px;"><b> Welcome <?php echo $username;?> Plese enter OTP</b></label>
			<hr>
			<br/>
			<!--OTP Enter-->
			<div class="ap-sinp-elm">
			<div class="row form-group ap-sinp-wrapper">
			<div>
			<div class="col-md-4 ap-sinp-col-for-lbl">
			<label class="ap-lbl-inp-txt" for="input-name">OTP: <span class="app-req-star">*</span></label>
			</div>  

			<div class="col-md-8 ap-sinp-col-for-inp-1">
			<input id="otp" class="form-control ap-inp-field" type="number" name="otp" autocomplete="off" autocorrect="off" spellcheck="false"  tabindex="1" size="5" maxlength="5">		
			<span id="er-otp" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('otp'); ?>
			
			</span>
			</div>
			<div>
			<?php 
				$user = $username;
				$pass = $passWord; 
			?>
			<input type="hidden" name="username" value="<?php echo $user; ?>">
			<input type="hidden" name="passWord" value="<?php echo $pass; ?>">	
			</div>
			</div>
			</div>
			</div>
			<!--End OTP Enter-->

			<div class="row ap-btn-ctrl-wrapper">

		        <div class="ap-btn-pannel" style="margin-top: 5px;">

		        <div class="form-group pull-right"> 
		        <button type="submit" class="btn btn-primary">Verify</button>
		        </div>		        

		        <div class="form-group pull-right" style="margin-right: 5px;"> 
		        <!-- <button type="button" class="btn btn-primary">Resend OTP</button> -->
		        <a href="<?php echo $this->config->item('base_url')."register/otp/resend?hash=".$hash;?>" class="btn btn-primary">Resend OTP</a>
		        </div>

		        </div>

		    </div>

		    <?php if (isset($error_status) && $error_status): ?>
				<div class="">
				<label class="form-label ap-lf-label ap-lf-label-error">
				<?php echo $error_message; ?>
				</label>
				</div>
			<?php endif ?>
			</div>
		</div>

	</div>
</div>