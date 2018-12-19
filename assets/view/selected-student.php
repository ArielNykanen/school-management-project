<?php
foreach ($allStudents as $student) {
  if (isset($_POST['student'. $student->student_id])) {
  $selectedStudent = $sbl->getOne($_POST['student'.$student->student_id]);
?>
  <div class="col-md-12 col-lg-4 order-1 order-lg-3"> 
    <div class="card border-default mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-default"><?php echo $selectedStudent->student_name ?></div>
  <div class="card-body text-default">
  <img style='height:200px; max-height: 200px; width: 100%;' src="../uploads/profiles/images/students/<?php echo $student->student_image ?>" alt="">
    <h5 class="card-title">
    <?php
     echo $selectedStudent->student_name;
    ?>
    </h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <div class="card-footer bg-transparent border-default">
  <div class="row">
  <div class="col-xs-5 mr-2">
  <button name='edit-student<?php echo $selectedStudent->student_id ?>' value='<?php echo $selectedStudent->student_id ?>' class='btn btn-warning'>Edit Student</button>
  </div> 
  </div>
  </div>
</div>
  </div>
  <?php 
  }
}
?>
