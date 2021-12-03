<div class="modal fade" id="pAssignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Select Police Station</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Select Police Station to Assign Complain
      </div>
          <hr/>
          <div style="margin-left: 20px;">
          <form method="post" name ="assignPolice" action="<?php echo $this->config->item('base_url')."Complain/assignPolice";?>"> 
          <input type="hidden" id="comId" name = "comId" class="form-control" > 
        <div class="ap-sinp-elm">
        <div class="row form-group ">
        <div>
        <div class="col-md-4 ap-sinp-col-for-lbl">
        <label class="ap-lbl-inp-txt" for="input-name">Police Station: <span class="app-req-star">*</span></label>
        </div> 

        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <select  data-live-search="true" name="policeStation" id ="policeStation">
            <option  value = "0" disabled selected>Select police station</option>
            <?php if (isset($list2)): ?>
            <?php foreach ($list2 as $police): ?>
            <option value="<?php echo $police->id; ?>" data-subtext="<?php echo $police->name; ?>"><?php echo $police->name; ?></option>
            <?php endforeach ?>
            <?php endif ?>
          </select>
        <span id="er-crimeselector" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeStation'); ?></span>
        </div>
        </div>
        </div>
        </div>

        <br/>
        <br/>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" id = "police-button" class="btn btn-danger btn-conf">ASSIGN</button>
      </div>
    </form>
    </div>
  </div>
</div>

