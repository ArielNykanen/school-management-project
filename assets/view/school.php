

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
if (isset($_POST['edit-student'])) {
  // passes id of model to session
  Session::add('edit-mode', true);
  $selectedSudent = $cbl->getOne($_POST['edit-student']);
  include 'assets/view/edit-student.php';
} 

if (isset($_POST['edit-course'])) {
  // passes id of model to session
  Session::add('edit-mode', true);
  $selectedCourse = $cbl->getOne($_POST['edit-course']);
  include 'assets/view/edit-course.php';
}

if (!Session::has('edit-mode')) {
  include 'assets/view/courses-section.php';

// <!-- Students Section -->

  include 'assets/view/students-section.php';

// <!-- display course content -->

  include 'assets/view/selected-course.php';

// <!-- display student content -->

 include 'assets/view/selected-student.php'; 
} 


?>

 <!-- end of row -->
</div>

</form>

<script>
  $(document).ready(() => {
    $('button').click(
      (course) => {
        console.log(course.value);
      }
    );
   
  });
</script>