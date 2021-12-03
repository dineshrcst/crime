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
        Select Police Station to Assign User
      </div>
          <hr/>
          <div style="margin-left: 20px;">
          <form method="post" name ="assignPolice" action="<?php echo $this->config->item('base_url')."User/assignPolice";?>"> 
          <input type="hidden" id="userId2" name = "userId2" class="form-control" > 
          <div class="form-group">
          <select class="selectpicker" data-live-search="true" name="policeStation">
            <option  value = "0" disabled selected>Select police station</option>
            <?php if (isset($list2)): ?>
            <?php foreach ($list2 as $police): ?>
            <option value="<?php echo $police->id; ?>" data-subtext="<?php echo $police->name; ?>"><?php echo $police->name; ?></option>
            <?php endforeach ?>
            <?php endif ?>
          </select>
        </div>
          <span id="er-utype" class="ap-lbl-inp-err" for="error-msg"><?php echo form_error('policeStation'); ?></span>
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

