<div id="section-header" class="container-fluid ap-section-header">

<style>.dboard-menu-sub-ul li { font-size: 13px; }</style>

<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>

<div class="pull-right">
<div class="sw-hdr-timestamp"><?php echo $c_timestamp; ?></div>
</div>
<div class="clearfix"></div>

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header"><?php echo $title;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li></li>
</ul>
</div>

</div>
</header>
</div>

<?php if ($this->config->item('app_ui_dashboard_layout')==="DEFAULT") { ?>
<div class="container-fluid">   
	<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">	
	<div class="">
	<div class="panel panel-default" style="border: 1px solid transparent;">
	<span id = "counts" value="<?php echo $this->config->item('base_url')."Auth/getCounts";?>"></span>
   	
   	<div class="panel-body" style="padding: 15px 0;">
   		<!-- Add Pages Here -->
   		<?php include 'app-crime-manager.php';?>
   		<?php include 'app-user-manager.php';?>
   		<?php include 'app-police-manager.php';?>
   		<?php include 'app-missing-manager.php';?>
   		<?php include 'app-wanted-manager.php';?>
   		<?php include 'app-report-manager.php';?>
   	</div>
	</div>


	</div>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="margin-bottom: 20px;">	
	<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<?php if (isset( $_SESSION['roll_id'])): ?> 
					<?php $user_roll = $_SESSION['roll_id']; ?>
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Overview</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-edit"></i></span>
										<p>
											<span class="number" id="pCount"></span>
											<?php if($rollId == 1 || $rollId == 2) :?>
											<span class="title">Un-Assigned Complains</span>
											<?php else :?>
											<span class="title">Pending Complains</span>
											<?php endif ?>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-check-circle"></i></span>
										<p>
											<span class="number" id="dCount"></span>
											<span class="title">Completed Complains</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-university"></i></span>
										<p>
											<span class="number" id="cCount"></span>
											<span class="title">Court Action Complains</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-wrench"></i></span>
										<p>
											<span class="number" id="wCount"></span>
											<span class="title">In-Progress Complains</span>
										</p>
									</div>
								</div>
								<?php if($user_roll == 1): ?>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-male"></i></span>
										<p>
											<span class="number" id="uCount"></span>
											<span class="title">Pending Users</span>
										</p>
									</div>
								</div>
							<?php endif ?>
							</div>
						</div>
					</div>
				<?php endif?>
					<!-- END OVERVIEW -->
					</div>
					</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {  
		var urlData = $('#counts').attr("value");
		$.ajax({    //create an ajax request to display.php
        type: 'POST',
        url: urlData,      
        contentType: "application/json",       
        dataType: 'json',  //expect html to be returned                
        success: function(response) {
            var string1 = JSON.stringify(response);
            var parsed = JSON.parse(string1);

            var pendingCount = parsed.pendingCount;
            var completeCount = parsed.completeCount;
            var courtCount = parsed.courtCount;
            var pendingUsers = parsed.pendingUsers;
            var workingCount = parsed.workingCount;

            $("#pCount").text(pendingCount);
            $("#dCount").text(completeCount);            
            $("#cCount").text(courtCount);
            $("#uCount").text(pendingUsers);
            $("#wCount").text(workingCount);

        },
        error: function(response) {
        }

    });															
	});
</script>
<?php } ?>