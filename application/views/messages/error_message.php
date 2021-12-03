<div id="ap-msgmdl" class="modal fade">
<div class="modal-dialog" style="top: 30%;">
<div id="ap-modal-content" class="modal-content">

<!-- #header -->
<div id="ap-modal-header" class="app-modal-header ap-modal-header-erro">  
<span class="ap-modal-header-icon-erro"><i class="fas fa-times-circle"></i></span>&nbsp;&nbsp;<span class="ap-header-bold">Error</span>  
</div>
<!-- #header -->

<!-- #body -->
<div id="ap-modal-body" class="app-modal-body app-modal-body-message-only">
<p id="ap-modal-message" class="ap-modal-message">
<p id="ap-modal-message" class="ap-modal-message">
<?php echo $message; ?>
</p>

<?php if (isset($description)): ?>
<p id="ap-modal-desc" class="ap-modal-desc">
<?php echo $description; ?>
</p>
<?php endif ?>

<?php if (isset($description_2)): ?>
<p id="ap-modal-desc-2" class="ap-modal-desc">
<?php echo $description_2; ?>
</p>	
<?php endif ?>

</div>
<!-- #body -->

<div id="ap-modal-footer" class="app-modal-footer">

<?php if (isset($buttons)) { 
foreach ($buttons as $button) { 

if ($button['url']!=="") {
$html = '<a id="'.$button['id'].'" class="'.$button['class'].'" href="'.$button['url'].'">';
} else {
$html = '<a id="'.$button['id'].'" class="'.$button['class'].'">';
}

if ($button['loader']!=="") {
$html = $html.'<span id="'.$button['loader'].'" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;';
}
$html = $html.'<span>'.$button['name'].'</span>';
if ($button['icon']!=="") {
$html = $html.'&nbsp;&nbsp;<span><i class="'.$button['icon'].'"></i></span>';
}
$html = $html.'</a>';

$result = preg_replace('/(<a\b[^><]*)>/i', '$1 style="xxxx:yyyy;">', $html);

echo $result;

}
} 
?>

</div>
<!-- #footer -->
</div>
</div>
</div>