<?php


SchoolController::checkIfLogged();

$adminDetails = Session::get('admin_logged');


$abl = new BLAdmins();
$sbl = new BLStudents();
$cbl = new BLCourses();

$loggedAdmin = $abl->getByEmail($adminDetails['admin_email']);
$loggedAdminRole = $loggedAdmin[0]->adminRole();

// delete student 
if (isset($_POST['delete-student'])) {
  if (!isset($_POST['admin-password']) || ctype_space($_POST['admin-password'])) {
    return AlertService::createAlert('You need to re-enter password to delete!', '', 'danger');
  } else if ($loggedAdmin[0]->admin_password === md5($_POST['admin-password'])) {
    StudentController::deleteAllStudentCourses($_POST['delete-student']);
    StudentController::deleteStudent($_POST['delete-student']);    
   } else {
    AlertService::createAlert('Wrong password!', 'Student was not deleted', 'danger');
  }

 }


// delete course 
if (isset($_POST['delete-course'])) {
  if(!empty(CourseController::checkIfHasStudents($_POST['delete-course']))) {
    AlertService::createAlert('You cannot delete course with students!', '', 'danger');
  } else if ($loggedAdmin[0]->admin_password === md5($_POST['admin-password'])) {
    CourseController::deleteCourse($_POST['delete-course']);
  } else {
    AlertService::createAlert('Wrong password!', 'Course was not deleted', 'danger');
  }
  // todo make it work
  // CourseController::deleteStudent($_POST['delete-course']);   
}




// add courses to selected student 
if (isset($_POST['add-courses']) && isset($_POST['courses'])) {
  $selectedCourses = $_POST['courses'];
  $studentId = $_POST['add-courses'];
  foreach ($selectedCourses as $courseId) {
    StudentController::addCourse($studentId, $courseId);
  }
 }


 //remove courses from selected student

 if (isset($_POST['remove-courses']) && isset($_POST['removed-courses'])) {
  $coursesIdToRemoveArr =  $_POST['removed-courses'];
  $studentId = $_POST['remove-courses'];
  foreach ($coursesIdToRemoveArr as $courseId) {
    StudentController::removeCourse($studentId, $courseId);
  }
 }

 // todo update student personal details 

 if (
   isset($_POST['update-student']) && 
   isset($_POST['student-name']) && 
   isset($_POST['student-email']) && 
   isset($_POST['student-phone'])
   ) {
   $student = $sbl->getOne($_POST['update-student']);
   $studentDetails = [
    'student_name' => $_POST['student-name'],
    'student_phone' => $_POST['student-phone'],
    'student_email' => $_POST['student-email'],
    'student_image' => $_FILES['student-image'],     
   ];
   if ($student->student_email !== $_POST['student-email'] || $student->student_phone !== $_POST['student-phone']) {
    StudentController::validateForm($studentDetails);
  }
 }






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