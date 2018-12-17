<?php
if(isset($_POST['course'])) {
  $selectedCourse = $cbl->getOne($_POST['course']);
?>
  <div class="col-lg-4 order-1 order-lg-3"> 
    <div class="card border-default mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-default"><?php echo $selectedCourse->course_name ?></div>
  <div class="card-body text-default">
  <img style='height:200px; max-height: 200px; width: 100%;' src="https://pixabay.com/get/ee36b70b28f41c22d2524518a33219c8b66ae3d01db4114497f8c478/javascript-736400_1280.png" alt="">
    <h5 class="card-title"><?php echo $selectedCourse->course_description ?></h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <div class="card-footer bg-transparent border-default">
  <button class='btn btn-warning' name='edit-course' vlaue='<?php echo $selectedCourse->course_id ?>'>Edit Course</button>
  <button class='btn btn-danger'>Delete Course</button>
  </div>
</div>
  </div>

<?php
}
?>