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
}

//remove students dir from course

if (isset($_POST['r-s-s']) && isset($_POST['s-s'])) {
  $courseId = $_POST['r-s-s'];
  $selectedStudentIdArr = $_POST['s-s'];
  foreach ($selectedStudentIdArr as $studentId) {
    StudentController::removeCourse($studentId, $courseId);
  }
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

 // update student
 if (
   isset($_POST['update-student']) && 
   isset($_POST['student-name']) && 
   isset($_POST['student-email']) && 
   isset($_POST['student-phone'])
   ) {
   $student = $sbl->getOne($_POST['update-student']);
   $updatedImage = $_FILES['student-image']['name'] !== '' ? $_FILES['student-image'] : $student->student_image;
   $studentDetails = [
    'student_name' => $_POST['student-name'],
    'student_phone' => $_POST['student-phone'],
    'student_email' => $_POST['student-email'],
    'student_image' => $updatedImage,     
   ];

   StudentController::validateForm($studentDetails, $student->student_id);
    
 }



 //update course

 if (
   isset($_POST['save-course']) &&
    isset($_POST['course-name']) &&
    isset($_POST['course-description']) &&
    isset($_FILES['course-image']) &&
    isset($_POST['max-enroll'])
 ) {
  $course = $cbl->getOne($_POST['save-course']);
  $updatedImage = $_FILES['course-image']['name'] !== '' ? $_FILES['course-image'] : $course->course_image;

  $courseDetails = [
    'course_id' => $_POST['save-course'],
    'course_name' => $_POST['course-name'],
    'course_description' => $_POST['course-description'],
    'course_image' => $updatedImage,
    'course_max_students' => $_POST['max-enroll'],
  ];

  CourseController::validateForm($courseDetails, $course->course_id);

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