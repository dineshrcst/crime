<style>
* {
  box-sizing: border-box;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  left: 0;
  border-radius: 3px 0 0 3px;
  margin-left: 34.9%;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>


<section id="view-section" style="margin-top: 0px; margin-bottom: 50px;">
<div id="section-header" class="container ap-section-header">
<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>

<div class="sw-hdr-timestamp"><?php echo $c_timestamp; ?></div>
<div class="container-fluid">  
<div id="rp-container">

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header"><?php echo $screen_name;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li>
</li>
</ul>
</div>

</div>
</header>
<br/>
<div class="clearfix"></div>
<div class="container-fluid">
<div>
  <h5><b>Click on Image to View Details...</b></h5>
</div>
<br/>
<!--Start Here-->
<!-- Container for the image gallery -->
<div class="container">

  <?php if (isset($list) && is_array($list) && !empty($list)):
  $count = 0;  ?> 
    <?php foreach ($list as $item):  
      $path = $this->config->item('base_url')."uploads/wanted/";
       $count =  $count +1;
      ?>
        
        <div class="row">
          
          <div class="col-md-6 mySlides" onclick="showDetails(<?php echo  $count;?> )">

          <span id = "pName_<?php echo $count;?>" value="<?php echo $item->name;?>"></span>
          <span id = "pAge_<?php echo $count;?>" value="<?php echo $item->age;?>"></span>
          <span id = "pSex_<?php echo $count;?>" value="<?php echo $item->sex;?>"></span>
          <span id = "aliases_<?php echo $count;?>" value="<?php echo $item->aliases;?>"></span>
          <span id = "remarks_<?php echo $count;?>" value="<?php echo $item->remarks;?>"></span>      
          <span id = "caution_<?php echo $count;?>" value="<?php echo $item->caution;?>"></span>      
          <span id = "police_<?php echo $count;?>" value="<?php echo $item->police_station;?>"></span>


          <img src="<?php echo $path.$item->image_name;?>" style="width:80%;height: 400px" i> 

        </div>
        <div class="col-md-6"></div>

        </div>
     <?php endforeach ?> 
  <?php endif ?> 

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>


  <hr style="margin-top: 15px; margin-bottom: 15px; border-top: 4px solid #000;">

  <!-- Thumbnail images -->
  <div class="row">
     <div style="display: flex;">
    <?php if (isset($list) && is_array($list) && !empty($list)): 
      $count = 0;                                   
      ?>
      <?php foreach ($list as $item):  
        $path = $this->config->item('base_url')."uploads/wanted/";
        $count = $count +1;  
        ?>
          <div>
              <img class="demo cursor" src="<?php echo $path.$item->image_name;?>" style="width:100%; height: 150px;" onclick='currentSlide("<?php echo $count?>")'> 
          </div>
      <?php endforeach ?> 
    <?php endif ?>
  </div>
  </div>
</div>

<!--End Here-->
</div>

</div>
</div>
</div>


</div>

<div id="ap-msgmdlcon">
<?php if (isset($info_Modal)): ?>
<?php echo $info_Modal; ?>
<?php endif ?>
</div>

</section>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

function showDetails(count){
  $("#perInfo").empty();
  var name = $('#pName_'+count).attr('value');
  var age = $('#pAge_'+count).attr('value');
  var sex = $('#pSex_'+count).attr('value');
  var aliases = $('#aliases_'+count).attr('value');
  var remarks = $('#remarks_'+count).attr('value');
  var caution = $('#caution_'+count).attr('value');
  var police = $('#police_'+count).attr('value');
  var sexx = '';
  if (sex == 'M'){
    sexx = 'Male';
  }else{
    sexx = 'Female';
  }
  
  var html="";
  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Name</label>";
  html += "<div class='col-sm-10'>";
  html += "<input type='text' readonly class='form-control-plaintext' value='"+name+"'>";
  html += "</div>";
  html += "</div>";

  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Age</label>";
  html += "<div class='col-sm-10'>";
  html += "<input type='text' readonly class='form-control-plaintext' value='"+age+"'>";
  html += "</div>";
  html += "</div>";

  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Sex</label>";
  html += "<div class='col-sm-10'>";
  html += "<input type='text' readonly class='form-control-plaintext' value='"+sexx+"'>";
  html += "</div>";
  html += "</div>";

  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Aliases</label>";
  html += "<div class='col-sm-10'>";
  html += "<input type='text' readonly class='form-control-plaintext' value='"+aliases+"'>";
  html += "</div>";
  html += "</div>";

  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Remarks</label>";
  html += "<div class='col-sm-10'>";
  html += "<textarea class='form-control' readonly rows='3'>"+remarks+"</textarea>";
  html += "</div>";
  html += "</div>";

  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Caution</label>";
  html += "<div class='col-sm-10'>";
  html += "<textarea class='form-control' readonly rows='3'>"+caution+"</textarea>";
  html += "</div>";
  html += "</div>";

  html += "<div class='form-group row'>";
  html += "<label class='col-sm-2 col-form-label'>Police Station</label>";
  html += "<div class='col-sm-10'>";
  html += "<input type='text' readonly class='form-control-plaintext' value='"+police+"'>";
  html += "</div>";
  html += "</div>";

  $("#perInfo" ).append(html);
  html = "";
  $('#infoModal').modal('toggle');
}
</script>