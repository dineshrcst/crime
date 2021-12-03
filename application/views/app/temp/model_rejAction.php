<div class="modal fade" id="rejctModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Reject Complain</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please enter reject reason        
        <form method="post" name ="addNote" enctype="multipart/form-data" action="<?php echo $this->config->item('base_url')."Complain/rejOfficerAction";?>">
          <br/>
        

          <input type="hidden" id="comId3" name = "comId3" class="form-control" id="recipient-name">

          <!--Start Note-->
          <div class="ap-sinp-elm">
          <div class="row form-group ap-sinp-wrapper">
          <div>
          <div class="col-md-2 ap-sinp-col-for-lbl">
          <label class="ap-lbl-inp-txt" for="input-name">Reject Reason: <span class="app-req-star">*</span></label>
          </div> 

          <div class="col-md-8 ap-sinp-col-for-inp-1">
          <textarea id="id-note" class="form-control ap-inp-field" name="note" cols="50" rows="5" placeholder="Enter brief note about crime here..." tabindex="4" minlength="1" maxlength="100"></textarea>
          <span id="er-note" class="ap-lbl-inp-err" for="error-msg" style="color:red;"><?php echo form_error('note'); ?></span>
          </div>
          </div>
          </div>
          </div>  
          <!--End Note-->   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="btn btn-primary" >REJECT</button>
      </div>
       </form>
    </div>
  </div>
</div>