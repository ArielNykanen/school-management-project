

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



<form action="" method="POST" enctype="multipart/form-data">
 
<div class="row">
<!-- courses Section -->
<?php 
$editStudent = false;
$editCourse = false;

// checks for click on buttons
foreach ($allStudents as $student) {
  if(isset($_POST['edit-student'.$student->student_id])) {
    $editStudent = true;
    $id = $_POST['edit-student'.$student->student_id];
    $studentInfo = $sbl->getOne($id, true);
    include 'edit-student.php';
  }
}
  // checks for click on buttons
  foreach ($allCourses as $course) {
if (isset($_POST['edit-course'.$course->course_id])) {
  $editCourse = true;
  $selectedCourse = $course;
  include 'edit-course.php';
}
}

// add course
if (isset($_POST['add-course'])) {
  include 'add-course.php';
}

// add student
if (isset($_POST['add-student'])) {
include 'add-student.php';
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

<script>
  $(document).ready(() => {
  });
</script>