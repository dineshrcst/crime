<div class="pg-frm-wrp">
<div class="col-lg-12 col-md-12">
<div class="panel blank-panel">
	<div class="panel-heading">
		<?php if (isset($allowed_tabs) && $allowed_tabs): ?>
		<div id="tabs-allowed" class="panel-options">
			<?php else: ?>
			<div id="tabs-not-allowed" class="panel-options">
			<?php endif ?>
			<ul id="tabs" class="nav nav-tabs">
				<li class="nav-item">
					<?php if (isset($id)): ?>
					<?php $data_id=$id; ?>
					<?php else: ?>
					<?php $data_id=""; ?>
					<?php endif ?>

					<?php if (isset($res)): ?>
					<?php $data_res=$res; ?>
					<?php else: ?>
					<?php $data_res=""; ?>
					<?php endif ?>
					<div id="ap-bckbtn" abindex="-1" class="ap-btn ap-btn-tab" data-event="<?php echo $event; ?>" data-id="<?php echo $data_id; ?>" data-res="<?php echo $data_res; ?>">
					<span><i class="fas fa-chevron-left"></i></span>&nbsp;&nbsp;<span>BACK</span> 
					</div>
					<div id="ap-prvbtn" abindex="-1" class="ap-btn ap-btn-tab" style="display: none;">
					<span><i class="fas fa-chevron-left"></i></span>&nbsp;&nbsp;<span>BACK</span> 
					</div>
				</li> 

				<?php if (isset($tabs)): ?>
				<?php foreach ($tabs as $key => $tab): ?>   
					<li class="<?php echo "nav-item ".$tab['status']; ?>">  		
						<a href="<?php echo "#tab-".$tab['id']; ?>" data-toggle="tab" data-tabid="<?php echo $tab['id']; ?>" tabindex="-1" class="ap-btn ap-btn-tab" ng-click="<?php echo "refresh_tab(".$tab['id'].")"; ?>"><?php echo $key; ?></a>
					</li>
				<?php endforeach ?>
				<?php endif ?>

			</ul>
			</div> 
		</div>

		<div class="panel-body">
			<div class="tab-content">
				<?php if (isset($tabs)): ?>
				<?php foreach ($tabs as $key => $tab): ?>
				<div class="<?php echo "tab-pane ".$tab['status']; ?>" id="<?php echo "tab-".$tab['id']; ?>">
				<div class="col-md-12 ap-tab-pane-content-wrapper">
				<div class="<?php echo "ap-tab-content-".$tab['id']; ?>">
				<?php if (isset($tab['content']) && $tab['content']!==""): ?>
				<?php echo $tab['content']; ?>
				<?php endif ?>
				</div>
				</div>
				</div>
				<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>

	</div>
</div>
</div>
<?php if (isset($timeout)) {
echo $timeout;
} ?>
</div>
