<div class="container">
<form id="ap-form" enctype="multipart/form-data" class="col-md-6 app-tab-pane-content-form ap-padding-0" tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."register/registerUser";?>"">   
	
<div class="col-md-12 wid-no-padding">
	<div class="row form-group app-form-group app-form-group-first">
	<label class="app-input-label" style="margin-bottom:0px;"><b id="id-dtallbl1">New User Details</b></label>
	<label class="clearfix"></label>
	<hr style="margin-top: 1px;">
	<hr style="margin-bottom: 5px;">
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">User type: <span class="app-req-star">*</span></label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<select id="id-utype" class="selectpicker form-control ap-inp-field" data-dropup-auto="true" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Transfer Channel"  tabindex="1" name="utype" value="<?php echo set_value('utype');?>">
		<option value="0" data-subtext="Select Type" >Select User Type</option>
		<?php if (isset($userTypes)): ?>
		<?php foreach ($userTypes as $typee): ?>
		<option value="<?php echo $typee->roll_id; ?>" data-subtext="<?php echo $typee->roll_name; ?>"><?php echo $typee->roll_name; ?></option>
		<?php endforeach ?>
		<?php endif ?>
		</select>
		
		<span id="er-utype" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('utype'); ?></span>
		</div>
		</div>
	</div>
	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">First Name:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-fName" class="form-control ap-inp-field" type="text" name="fName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="<?php echo set_value('fName');?>">
		<span id="er-fNAme" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('fName'); ?></span>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Last Name:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-lName" class="form-control ap-inp-field" type="text" name="lName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value="<?php echo set_value('lName'); ?>">
		<span id="er-lName" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('lName'); ?></span>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">E Mail:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-eMail" class="form-control ap-inp-field" type="text" name="eMail" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4" value="<?php echo set_value('eMail'); ?>">
		<span id="er-eMail" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('eMail'); ?></span>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Phone No:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-mobile" class="form-control ap-inp-field numeric_only" type="text" name="mobile" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="5" value="<?php echo set_value('mobile'); ?>">
		<span id="er-mobile" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('mobile'); ?></span>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">User Name:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-uName" class="form-control ap-inp-field" type="text" name="uName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="6" value="<?php echo set_value('uName'); ?>">
		<span id="er-uName" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('uName'); ?></span>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Password:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-pWord" class="form-control ap-inp-field" type="password" name="pWord" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="7">
		<span id="er-pWord" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('pWord'); ?></span>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Confirm Password:</label><span class="app-req-star">*</span></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-cpWord" class="form-control ap-inp-field" type="password" name="cpWord" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="8">
		<span id="er-cpWord" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('cpWord'); ?></span>
		</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<br/>
	<div class="row ap-btn-ctrl-wrapper">
		<div class="ap-btn-pannel">

		<div class="form-group pull-right">
		 <button type="button" id= "" class="btn btn-secondary reset">Reset</button>
		<!-- <button type="button" class="btn btn-primary" onclick="Login()">Login</button>-->
		 <button type="submit" class="btn btn-primary">Register User</button>

		</div>
		<div class="clearfix"></div>
		<?php		
			if($this->session->flashdata('success'))
			{
				echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';
				unset($_SESSION['success']);
			}	
			if($this->session->flashdata('error'))
			{
				echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>';
				unset($_SESSION['error']);
			}
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
//	function Login(){
//		window.location.href = href="<?php // echo $this->config->item('base_url');?>auth/logout";
//	}
	$(".reset").click(function() {
    	$(this).closest('form').find("input[type=text][name!=cdate],input[type=password], textarea").val("");
	});
</script>

</form>
</div>