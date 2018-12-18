

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
  include 'edit-student.php';
} 

if (isset($_POST['edit-course'])) {
  // passes id of model to session
  Session::add('edit-mode', true);
  $selectedCourse = $cbl->getOne($_POST['edit-course']);
  include 'edit-course.php';
}

if (!Session::has('edit-mode')) {
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