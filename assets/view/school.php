

<?php
SchoolController::checkIfLogged();

$adminDetails = Session::get('admin_logged');


$abl = new BLAdmins();
$sbl = new BLStudents();
$cbl = new BLCourses();

$loggedAdmin = $abl->getByEmail($adminDetails['admin_email']);
$loggedAdminRole = $loggedAdmin[0]->adminRole();

$allCourses = $cbl->get(); 
$allStudents = $sbl->get();
?>

 <!-- options code -->



<form action="" method="POST">

<div class="row">
<!-- courses Section -->
<?php 
$editStudent = false;
$editCourse = false;
foreach ($allStudents as $student) {
  if(isset($_POST['edit-student'.$student->student_id])) {
    $editStudent = true;
    $id = $_POST['edit-student'.$student->student_id];
    $studentInfo = $sbl->getOne($id, true);
    include 'edit-student.php';
  }
}
  // passes id of model to session
  foreach ($allCourses as $course) {
if (isset($_POST['edit-course'.$course->course_id])) {
  $editCourse = true;
  // passes id of model to session
  $selectedCourse = $course;
  include 'edit-course.php';
}
}

if (!$editStudent && !$editCourse) {
  include 'courses-section.php';

// <!-- Students Section -->

  include 'students-section.php';

// <!-- display course content -->

  include 'selected-course.php';

// <!-- display student content -->

 include 'selected-student.php'; 
} 


?>

 <!-- end of row -->
</div>

</form>




<?php include 'footer.php'; ?> 
<script>
  $(document).ready(() => {
  });
</script>