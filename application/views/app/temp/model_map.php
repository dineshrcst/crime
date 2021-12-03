<!--Javascript to load google map-->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Criminal Location</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id = "comIdMap"></span>
      <div id="map_canvas2" style="width: 100%; height: 300px;"></div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>       
      </div>

    </div>
  </div>
</div>