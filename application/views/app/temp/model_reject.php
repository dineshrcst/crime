<div class="modal fade" id="rejModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Reject Complain</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to reject this record?
        
        <form method="post" name ="rejectComplain" action="<?php echo $this->config->item('base_url')."Complain/rejectData";?>">
          <br/>
          <input type="hidden" id="comId" name = "comId" class="form-control" id="recipient-name">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Reject Reason <span class="app-req-star">*</span></label>
            <textarea class="form-control" id="message-text" name = "message"></textarea>
          </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="submit" class="btn btn-warning" >REJECT</button>
      </div>
       </form>
    </div>
  </div>
</div>