<?php
foreach ($allCourses as $course) {
if(isset($_POST['course'.$course->course_id])) {
  $selectedCourse = $course;
?>
  <div class="col-lg-3 order-1 order-lg-3">
        <div class="card border-default mb-3 bg-card text-center" style="width: 30rem;">
            <div class="card-header bg-dark border-default">
            <h4>
            <?php echo $selectedCourse->course_name ?>
            </h4>
            </div>
            <div class="card-body text-default">
              <img style='height:200px; max-height: 200px; width: 50%;' src="../uploads/courses/courses-cover-images/<?php echo $course->course_image ?>" alt="">
            <h5 class="card-title"><?php echo $selectedCourse->course_description ?></h5>
          </div>
          <div class="card-footer bg-dark border-default">
          <?php
          if ($loggedAdmin[0]->admin_role >! 2) {
          ?>
            <button class='btn btn-lg btn-primary' name='edit-course<?php echo $selectedCourse->course_id ?>' vlaue='<?php echo $selectedCourse->course_id ?>'>Course Details</button>
          <?php
            }
            ?>
            <h4>Enrolled Students</h4>
            <ul>
            <?php
            if (count(CourseController::getAllEnrolled($course->course_id)->getStudentModelArray()) < 1) {
              ?>
              <li class='list-group-item bg-dark'>
            Not enrolled yet
            </li>
              <?php
            }
            foreach (CourseController::getAllEnrolled($course->course_id)->getStudentModelArray() as $key => $student) {
              ?>
              <li class='list-group-item bg-dark'>
          <span>
            <?php echo $student->student_name; ?>
          <img style="width:35px; height:40px; border-radius:100px" src="../uploads/profiles/images/students/<?php echo $student->student_image ?>" alt="student-image">
          </span>
        </li>
        <?php
    }
    ?>
    </ul>
            </div>
        </div>
      </div>
<?php
}
}
?>