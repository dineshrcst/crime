<div class="modal fade" id="OAssignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Select Police Officer</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Select Police Officer to Assign Complain
      </div>
          <hr/>
          <div style="margin-left: 20px;">
          <form method="post" name ="assignOfficer" action="<?php echo $this->config->item('base_url')."Complain/assignOfficer";?>"> 
          <input type="hidden" id="comId" name = "comId" class="form-control" > 
          
        <div class="ap-sinp-elm">
        <div class="row form-group ">
        <div>
        <div class="col-md-4 ap-sinp-col-for-lbl">
        <label class="ap-lbl-inp-txt" for="input-name">Police Officer: <span class="app-req-star">*</span></label>
        </div> 

        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <select  data-live-search="true" name="policeOfficer">
            <option  value = "0" disabled selected>Select police officer</option>
            <?php if (isset($list2)): ?>
            <?php foreach ($list2 as $officer): 
               if(isset($officer->count)){
                  $count1 = $officer->count;
               }else{
                  $count1 = 0;
               }

              ?>
            <option value="<?php echo $officer->user_id; ?>" data-subtext="<?php echo $officer->firstname; ?>"><?php echo $officer->firstname.' '.$officer->lastname . '  : Complains Count - '. $count1; ?></option>
            <?php endforeach ?>
            <?php endif ?>
          </select>
        <span id="er-policeOfficer" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeOfficer'); ?></span>
        </div>
        </div>
        </div>
        </div>

        
          <span id="er-utype" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeOfficer'); ?></span>
        </div>
        <br/>
        <br/>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" id = "officer-button" class="btn btn-danger btn-conf">ASSIGN</button>
      </div>
    </form>
    </div>
  </div>
</div>