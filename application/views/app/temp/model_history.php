<div class="modal fade bd-example-modal-lg" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Complain History</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span id = "compIdNew"></span>
      <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Changed Action</th>
          <th scope="col">Changed User</th>
          <th scope="col">Changed Date</th>
          <th scope="col">Changed Time</th>
          <th scope="col">Special Notes</th>
        </tr>
      </thead>
      <tbody id = "tableData">
      </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
      </div>
    </div>
  </div>
</div>