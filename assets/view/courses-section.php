<!-- courses Section -->

<div class="col-xs-6 order-3 order-lg-1">
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
  <h4>Courses</h4>
    <div  align=right>
        <button class='btn btn-danger'>+</button>
    </div>
  </li>
  <?php foreach ($allCourses as $index => $course) {
    
  ?>  
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <button name='course' type='submit' value='<?php echo $course->course_id ?>' class='btn btn-info course'>
      <div class="row">
        <div class="col-md-4">
          <img style="width:100px; height:100px;" src="..\uploads\courses\courses-cover-images\<?php echo $course->course_image ?>" alt="course-image">
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <p><?php echo $course->course_name ?></p>
          <span>Enrolled</span>
          <span class="badge badge-primary badge-pill">14</span>
        </div>
      </div>
    </button>
  </li>
  <?php
  } 
  ?>
</ul>
</div>
