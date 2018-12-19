<?php
foreach ($allStudents as $student) {
  if (isset($_POST['student'. $student->student_id])) {
  $selectedStudent = $sbl->getOne($_POST['student'.$student->student_id]);
?>
  <div class="col-md-12 col-lg-4 order-1 order-lg-3"> 
    <div class="card border-default mb-3 bg-card text-center" style="max-width: 18rem;">
  <div class="card-header bg-dark border-default">
    <h4>
    Student Info
    </h4>
  </div>
  <div class="card-body text-default">
  <img style='height:200px; max-height: 200px; width: 100%;' src="../uploads/profiles/images/students/<?php echo $student->student_image ?>" alt="">
    <h5 class="card-title">
    </h5>
    <p class="card-text">Name: <?php echo $selectedStudent->student_name; ?></p>
    <p class="card-text">Phone: <?php echo $selectedStudent->student_phone; ?></p>
    <p class="card-text">Email: <?php echo $selectedStudent->student_email; ?></p>
    <p class="card-text">Enrolled In</p>
      <ol class='list-group'>
      <?php
      $id = $selectedStudent->student_id;
      $studentEnrolledCourses = $sbl->getOne($id, true)->getCourseModelArray();
      if (!$studentEnrolledCourses) {
        echo " <li class='list-group-item list-group-item-dark'>Not enrolled yet.</li>";
      }
  foreach ($studentEnrolledCourses as $enrolled) { 
      ?>
        <li class='list-group-item bg-dark'>
          <img src="../uploads/courses/courses-cover-images/<?php echo $enrolled->course_image ?>" class='border border-radius' alt="course image" style='max-width:40px; max-height:35'>
          <span>
            <?php echo $enrolled->course_name; ?>
          </span>
        </li>
  <?php 
    } 
  ?>
      </ol>  
  </div>
  <div class="card-footer bg-dark border-default">
  <div class="mr-2 text-center">
  <button name='edit-student<?php echo $selectedStudent->student_id ?>' value='<?php echo $selectedStudent->student_id ?>' class='btn btn-lg btn-primary'>Edit Student</button>
  </div>
  </div>
</div>
  </div>
  <?php 
  }
}
?>
