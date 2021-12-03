<section id="content-section">
<!-- start of section-form -->
<link href="<?php echo $this->config->item('public_url');?>css/jquery-ui.css" rel="stylesheet">  
<link href="<?php echo $this->config->item('public_url');?>css/jquery-ui-custom.css" rel="stylesheet">
<script src="<?php echo $this->config->item('public_url');?>js/jquery-ui.js"></script>

<link href="<?php echo $this->config->item('public_url');?>css/reports/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo $this->config->item('public_url');?>css/reports/buttons.dataTables.min.css" rel="stylesheet">


<script src="<?php echo $this->config->item('public_url');?>js/reports/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/dataTables.buttons.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/jszip.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/pdfmake.min.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/vfs_fonts.js"></script>
<script src="<?php echo $this->config->item('public_url');?>js/reports/buttons.html5.min.js"></script>

<div id="section-form" class="ap-section-component">
<div id="app-tab-create"> 
<div class="row ap-padding-0">
<div class="col-lg-12 col-md-12 ap-padding-0">
<div class="panel blank-panel">

<div id="section-header" class="container-fluid ap-section-header">

<style>.dboard-menu-sub-ul li { font-size: 13px; }</style>

<?php 
$now = new DateTime('now');
$c_date = date("Y-m-d");
$c_time = date("h:i");
$c_timestamp = $c_date." ".$c_time;
?>

<div class="sw-hdr-timestamp"><?php echo $c_timestamp; ?></div>
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

<div class="panel-body">

<div class="ap-orgin-frmwp">

<form id="requestform" class="col-md-8 app-tab-pane-content-form ap-padding-0 " tabindex="-1" method="post" action="<?php echo $this->config->item('base_url')."reports/viewAnalysis";?>"">   
<div class="col-md-12 wid-no-padding">

<!--For Administrator-->
<?php if (isset($stations)): ?>
<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-bottom:0px;"><b>Please Select Police Station</b></label>
<hr>
<br/>
</div>

<!--Select Police Station-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Police Station: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-policeselector" class="selectpicker form-control ap-inp-field" name="policeselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Police Station" tabindex="2" onchange="showOfficers(this.value)">
<option value="0" >Select Police Station</option>
<?php if (isset($stations)): ?>

<?php foreach ($stations as $station): ?>
<?php if (isset($list) && $list[0]->police_station == $station->name) : ?>
<option value="<?php echo $station->id; ?>" data-subtext="<?php echo $station->name; ?>" selected><?php echo $station->name; ?></option>
<?php else: ?>    
<option value="<?php echo $station->id; ?>" data-subtext="<?php echo $station->name; ?>"><?php echo $station->name; ?></option>
<?php endif ?>
<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-policeselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeselector'); ?></span>
</div>
</div>
</div>
</div>

<div id="officerSelection">
	
</div>
<input type="hidden" name="policeStation" id="policeStation">
<!--End Channel select value-->
<?php endif ?>
<!--End for administraror-->

<!--For Police OIC-->
<?php if (isset($officers)): ?>
<div class="row form-group app-form-group app-form-group-first">
<label class="app-input-label" style="margin-bottom:0px;"><b>Please Select Police Officer</b></label>
<hr>
<br/>
</div>

<!--Select Police Officer-->
<div class="ap-sinp-elm">
<div class="row form-group ap-sinp-wrapper">
<div>
<div class="col-md-4 ap-sinp-col-for-lbl">
<label class="ap-lbl-inp-txt" for="input-name">Police Officer: <span class="app-req-star">*</span></label>
</div> 

<div class="col-md-8 ap-sinp-col-for-inp-1">
<select id="id-officerselector" class="selectpicker form-control ap-inp-field" name="officerselector" data-dropup-auto="false" data-size="5" data-live-search="false" data-show-subtext="true" title="Select Police Officer" tabindex="2">
<option value="0" >Select Police Officer</option>
<?php if (isset($officers)): ?>

<?php foreach ($officers as $officer): ?>
<?php if (isset($list) && $list[0]->username == $officer->username) : ?>
<option value="<?php echo $officer->user_id; ?>"  selected><?php echo $officer->firstname. ' '.$officer->lastname; ?></option>
<?php else: ?>    
<option value="<?php echo $officer->user_id; ?>" ><?php echo $officer->firstname. ' '.$officer->lastname; ?></option>
<?php endif ?>
<?php endforeach ?>

<?php endif ?>
</select>
<span id="er-officerselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('officerselector'); ?></span>
</div>
</div>
</div>
</div>

<?php endif ?>
<!--End for police OIC-->
    <div class="clearfix"></div>
    <br/>
    <div class="row ap-btn-ctrl-wrapper">
        <div class="ap-btn-pannel">
        <div class="form-group pull-right">
         <button type="submit" class="btn btn-primary">View Report</button>
        </div>
        <div class="clearfix"></div>
        <hr>
        </div>
    </div>
</form>

</div>
<!--Display Officer Details-->
<?php if (isset($officerData) && is_array($officerData) && !empty($officerData)): ?> 

<div class="col-md-8 wid-no-padding">
	<div class="row form-group app-form-group app-form-group-first">
	<label class="app-input-label" style="margin-bottom:0px;"><b id="id-dtallbl1">Officer Details</b></label>
	<label class="clearfix"></label>
	<hr style="margin-top: 1px;">
	<hr style="margin-bottom: 5px;">
	</div>


<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">First Name:</label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-fName" class="form-control ap-inp-field" type="text" name="fName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="<?php echo $officerData['firstName'];?>" readonly>		
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Last Name:</label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-lName" class="form-control ap-inp-field" type="text" name="lName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value="<?php echo $officerData['lastName'];?>" readonly>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">E- Mail:</label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-eMail" class="form-control ap-inp-field" type="text" name="eMail" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4" value="<?php echo $officerData['email'];?>" readonly>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Phone No:</label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-mobile" class="form-control ap-inp-field numeric_only" type="text" name="mobile" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="5" value="<?php echo $officerData['phoneNo'];?>" readonly>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Assign Complains:</label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-uName" class="form-control ap-inp-field" type="text" name="uName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="6" value="<?php echo $officerData['assignCount'];?>" readonly>
		</div>
		</div>
	</div>

	<div class="ap-sinp-elm">
		<div class="row form-group ap-sinp-wrapper">
		<div class="col-md-4 ap-sinp-col-for-lbl"><label class="ap-lbl-inp-txt" for="input-name">Resolve Complains:</label></div> 
		<div class="col-md-8 ap-sinp-col-for-inp-1">
		<input id="id-uName" class="form-control ap-inp-field" type="text" name="uName" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="6" value="<?php echo $officerData['resolveCount'];?>" readonly>
		</div>
		</div>
	</div>
</div>
<?php endif ?>
<!--End Display Officer Details-->

<?php if (isset($list) && is_array($list) && !empty($list)): ?> 
<div class="clearfix"></div>
<br/>
<hr>
<br/>
<div class="container-fluid" style="overflow-y: scroll; height:58vh;">
	<div class="row form-group app-form-group app-form-group-first">
	<label class="app-input-label" style="margin-bottom:0px;"><b id="id-dtallbl1">Complain Details</b></label>
	<label class="clearfix"></label>
	<hr style="margin-top: 1px;">
	<hr style="margin-bottom: 5px;">
	</div>

<table id="data-table" class="ap-data-table display" style="width:100%">
<thead>
	 <tr>
    <th class="text-center">REFERENCE NO</th>
    <th class="text-center">TYPE</th>
    <th class="text-center">DATE</th>
    <th class="text-center">TIME</th>
    <th class="text-center">ADDRESS</th>
    <th class="text-center">DESCRIPTION</th>
    <th class="text-center">STATUS</th>
    <th class="text-center">POLICE STATION</th>
    <th class="text-center">OFFICER</th>
    <th class="text-center">Time to Accept(days)</th>
    <th class="text-center">Time to Relove(days)</th>
    </tr>
</thead>
<tbody>
	<?php foreach ($list as $item): ?>    

<tr class="ap-st-label">  

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->id; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->type; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->date; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->time; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->address; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->description; ?></span>
</td>
<td class="text-center">
 <?php if ($item->status == 'P'): ?>
    <span class="label label-primary">Pending</span>
  <?php endif ?>
  <?php if ($item->status == 'I'): ?>
    <span class="label label-warning">In-Progress</span>
  <?php endif ?>
  <?php if ($item->status == 'R'): ?>
    <span class="label label-success">Resolved</span>
  <?php endif ?>
  <?php if ($item->status == 'C'):?>
    <span class="label label-danger">Court Action</span>
  <?php endif ?>

</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->police_station; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->fName.' '.$item->lName ; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->accDays; ?></span>
</td>

<td class="text-center">
<span class="ap-tabledata-export"><?php echo $item->resDays; ?></span>
</td>

</tr>   

<?php endforeach ?>
</tbody>
</table>
<hr class="ap-rp-hr-b">
</div>
<?php endif ?>
</div>

</div>
</div>
</div>
</div>  
</div>  
</div>
<!-- end of section-form -->
</section>
<script type="text/javascript">

$(document).ready(function() {   

	$('#data-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );

} );

function showOfficers(policeStation){
		
		$('#policeStation').val(policeStation);
		if(policeStation == 0){
			$( "#officerSelection").empty();
		}else{
		var urlData = "<?php echo $this->config->item('base_url');?>Reports/getPoliceOfficers?policeStation="+policeStation;
      									
        var html = "";
        $( "#officerSelection").empty();

        html += "<div class='ap-sinp-elm'>";
        html += "<div class='row form-group ap-sinp-wrapper'>";
        html += "<div>";
        html += "<div class='col-md-4 ap-sinp-col-for-lbl'>";
        html += "<label class='ap-lbl-inp-txt' for='input-name'>Police Officer: <span    class='app-req-star'>*</span></label>";
        html += "</div> ";

        html += "<div class='col-md-8 ap-sinp-col-for-inp-1'>";
        html += "<select id='id-officerselector' class='selectpicker form-control ap-inp-field' name='officerselector' data-dropup-auto='false' data-size='5' data-live-search='false' data-show-subtext='true' title='Select Police Officer' tabindex='2'>";
        html += "<option value='0' >Select Police Officer</option>";

        $.ajax({    //create an ajax request to display.php
        type: 'POST',
        url: urlData,      
        contentType: "application/json",       
        dataType: 'json',  //expect html to be returned                
         success: function(response) {
            var string1 = JSON.stringify(response);
            var parsed = JSON.parse(string1);
            
            for(var i=0;i<parsed.length;i++){
              html += "<option value='"+parsed[i].user_id+"'>"+parsed[i].firstname+" - "+parsed[i].lastname+" </option>";              
            }
            html += "</select>";
        	html += "<span id='er-officerselector' class='ap-lbl-inp-err' for='error-msg'><?php echo form_error('officerselector'); ?></span>"
        	html += "</div>";
        	html +=	"</div>";										
        	html += "</div>";
        	html += "</div>";

        	$( "#officerSelection" ).append(html);
        	html = "";
        },
        error: function(response) {
            console.log(response);
        }

    });
        
	}

}  
</script>