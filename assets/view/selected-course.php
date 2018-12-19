<?php
foreach ($allCourses as $course) {
if(isset($_POST['course'.$course->course_id])) {
  $selectedCourse = $course;
?>
  <div class="col-lg-4 order-1 order-lg-3">
        <div class="card border-default mb-3 bg-card text-center" style="max-width: 18rem;">
            <div class="card-header bg-dark border-default">
            <h4>
            <?php echo $selectedCourse->course_name ?>
            </h4>
            </div>
            <div class="card-body text-default">
              <img style='height:200px; max-height: 200px; width: 100%;' src="../uploads/courses/courses-cover-images/<?php echo $course->course_image ?>" alt="">
            <h5 class="card-title"><?php echo $selectedCourse->course_description ?></h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
          <div class="card-footer bg-dark border-default">
            <button class='btn btn-lg btn-primary' name='edit-course<?php echo $selectedCourse->course_id ?>' vlaue='<?php echo $selectedCourse->course_id ?>'>Course Details</button>
          </div>
        </div>
      </div>
      
<?php
}
}
?>