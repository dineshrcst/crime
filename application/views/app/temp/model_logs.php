<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Update Action</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please select action and add note about the action        
        <form method="post" name ="addNote" enctype="multipart/form-data" action="<?php echo $this->config->item('base_url')."Complain/updateAction";?>">
          <br/>
        <!--Start Actiom-->  
        <div class="ap-sinp-elm">
        <div class="row form-group ">
        <div>
        <div class="col-md-2 ap-sinp-col-for-lbl">
        <label class="ap-lbl-inp-txt" for="input-name">Action : <span class="app-req-star">*</span></label>
        </div> 

        <div class="col-md-8 ap-sinp-col-for-inp-1">
        <select  data-live-search="true" name="action" id="action-select" onchange="showDiv(this.value)">
            <option value = "" disabled selected>Select Action</option>
            <option value="P" data-subtext="Pending">Pending</option>
            <option value="I" data-subtext="In-Progress">In-Progress</option>
            <option value="R" data-subtext="Resolved">Resolved</option>
            <option value="C" data-subtext="Court Action">Court Action</option>
          </select>
        <span id="er-action" class="ap-lbl-inp-err" for="error-msg" style="color:red;"><?php echo form_error('action'); ?></span>
        </div>
        </div>
        </div>
        </div>
        <!--End Action-->

          <input type="hidden" id="comId2" name = "comId2" class="form-control" id="recipient-name">
          <input type="hidden" id="acType" name = "acType" class="form-control" value="A">
          
          <!--Start Note-->
          <div class="ap-sinp-elm">
          <div class="row form-group ap-sinp-wrapper">
          <div>
          <div class="col-md-2 ap-sinp-col-for-lbl">
          <label class="ap-lbl-inp-txt" for="input-name">Note: <span class="app-req-star">*</span></label>
          </div> 

          <div class="col-md-8 ap-sinp-col-for-inp-1">
          <textarea id="id-note" class="form-control ap-inp-field" name="note" cols="50" rows="5" placeholder="Enter brief note about crime here..." tabindex="4" minlength="1" maxlength="100"></textarea>
          <span id="er-note" class="ap-lbl-inp-err" for="error-msg" style="color:red;"><?php echo form_error('note'); ?></span>
          </div>
          </div>
          </div>
          </div>  
          <!--End Note-->   

          <!--File Upload-->
          <br/>
          <div class="clearfix"></div>
          <div class="ap-sinp-elm" id="attachDocuments">
          <div class="row form-group ap-sinp-wrapper">
          <div>
          <div class="col-md-4 ap-sinp-col-for-lbl">
          <label class="ap-lbl-inp-txt" for="input-name">Attach Documents: </label>
          </div> 
          <div class="col-md-8 ap-sinp-col-for-inp-1">              
              <input type="file" name="fileToUpload" id="fileToUpload" />
          </div>
          </div>
          </div>
          </div>

<!--End File Upload-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="btn btn-primary" >Update Action</button>
      </div>
       </form>
    </div>
  </div>
</div>