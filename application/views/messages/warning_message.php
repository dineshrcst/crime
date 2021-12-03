<div id="ap-msgmdl" class="modal fade">
<div class="modal-dialog" style="top: 30%;">
<div id="ap-modal-content" class="modal-content">

<!-- #header -->
<div id="ap-modal-header" class="app-modal-header ap-modal-header-warn">  
<span class="ap-modal-header-icon-warn"><i class="fas fa-exclamation-triangle"></i></span>&nbsp;&nbsp;<span class="ap-header-bold">Transaction Failed</span>  
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

<!-- #footer -->
<div id="ap-modal-footer" class="app-modal-footer">

<?php 
if (isset($buttons)) { 
$event = "";
foreach ($buttons as $button) { 

if ($button['url']!=="") {
$html = '<a id="'.$button['id'].'" class="'.$button['class'].'" href="'.$button['url'].'" data-chanel="'.$button['chanel'].'" data-event="'.$button['event'].'">';
} else {
$html = '<a id="'.$button['id'].'" class="'.$button['class'].'" data-chanel="'.$button['chanel'].'" data-event="'.$button['event'].'">';
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

$event = $button['event'];

}

if ($event==="auth" || $event==="reauth") { ?>

<script type="text/javascript">

$(document).ready(function() {  

$('#id-retrybtn').on("click", function(e) {
    var c = $(this).data("chanel");  
    var a = $(this).data("event");  
    var u = $("input[name=ubrn]").val();
    var b = $("input[name=app-baseurl]").val();
   
    $(this).off(e);     

    var json_array = {
        reference: u,
        return_json: true,
    }

    var url = "";
    if (a==="auth") {
    url = b+'requests/'+c+'/saveauthorization';
    } else if (a==="reauth") {
    url = b+'requests/'+c+'/savereauthorization';
    } else {
    url = "";
    }

    $("#ap-btn-loading-retry").show();

    $.ajax({
    type: 'POST',
    url: url,
    data: JSON.stringify(json_array),
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    success: function (response) {  
    $("#ap-btn-loading-retry").hide();

    var r = response;

    if (typeof r !== 'undefined' && r !== '') {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-msgmdlcon').html(r.message_skelton);
    $('.modal-backdrop').remove();
    $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
    $('#ap-msgmdl').modal('show');    
    $('body').css('overflow-y', 'hidden');
    } else {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden');  
    }
    
    },
    error: function() {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden'); 
    },

    });
}); 


$('#id-holdsavbtn').on("click", function(e) {
    var c = $(this).data("chanel");  
    var a = $(this).data("event");  
    var u = $("input[name=ubrn]").val();
    var b = $("input[name=app-baseurl]").val();
   
    $(this).off(e);     

    var json_array = {
        reference: u,
        type: 'S',
        return_json: true,
    }

    $("#ap-btn-loading-hold").show();

    $.ajax({
    type: 'POST',
    url: b+'requests/'+c+'/holdpayment',
    data: JSON.stringify(json_array),
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    success: function (response) {  
    $("#ap-btn-loading-hold").hide();

    var r = response;
    
    if (typeof r !== 'undefined' && r !== '') {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-msgmdlcon').html(r.message_skelton);
    $('.modal-backdrop').remove();
    $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
    $('#ap-msgmdl').modal('show');    
    $('body').css('overflow-y', 'hidden');
    } else {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden');  
    }

    },
    error: function() {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden'); 
    },

    });
}); 

$('#id-holdcurbtn').on("click", function(e) {
    var c = $(this).data("chanel");  
    var a = $(this).data("event");  
    var u = $("input[name=ubrn]").val();
    var b = $("input[name=app-baseurl]").val();
   
    $(this).off(e);     

    var json_array = {
        reference: u,
        type: 'C',
        return_json: true,
    }

    $("#ap-btn-loading-hold").show();

    $.ajax({
    type: 'POST',
    url: b+'requests/'+c+'/holdpayment',
    data: JSON.stringify(json_array),
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    success: function (response) {  
    $("#ap-btn-loading-hold").hide();

    var r = response;
    if (typeof r !== 'undefined' && r !== '') {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-msgmdlcon').html(r.message_skelton);
    $('.modal-backdrop').remove();
    $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
    $('#ap-msgmdl').modal('show');    
    $('body').css('overflow-y', 'hidden');
    } else {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden');  
    }
    
    },
    error: function() {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden'); 
    },

    });
}); 

$('#id-forcedbtbtn').on("click", function(e) {
    var c = $(this).data("chanel");  
    var a = $(this).data("event");  
    var u = $("input[name=ubrn]").val();
    var b = $("input[name=app-baseurl]").val();
   
    $(this).off(e);     
    
    var json_array = {
        reference: u,
        action: a,
        return_json: true,
    }

    $("#ap-btn-loading-force").show();

    $.ajax({
    type: 'POST',
    url: b+'requests/'+c+'/debitforcefully',
    data: JSON.stringify(json_array),
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    success: function (response) {  
    $("#ap-btn-loading-force").hide();

    var r = response;

    if (typeof r !== 'undefined' && r !== '') {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-msgmdlcon').html(r.message_skelton);
    $('.modal-backdrop').remove();
    $('#ap-msgmdl').modal({backdrop: 'static', keyboard: false});
    $('#ap-msgmdl').modal('show');    
    $('body').css('overflow-y', 'hidden');
    } else {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden');  
    }

    },
    error: function() {
    $('#ap-confmodal').modal('hide');
    $('#ap-msgmdlcon').empty();
    $('#ap-toutmodal').modal({backdrop: 'static', keyboard: false});
    $('#ap-toutmodal').modal('show');
    $('body').css('overflow-y', 'hidden'); 
    },
    
    });
}); 

}); 

</script>

<?php } } ?>

</div>
<!-- #footer -->
</div>
</div>
</div>
