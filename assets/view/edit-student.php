
<div class="row w-100">
  <div class="header-color col-12">
    <h1>Selected Student (<?php echo $studentInfo->student_name ?>)</h1>
  </div>
<div class="col-12">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="a nav-link active text-dark" id="home-tab" data-toggle="tab" href="#personal-settings" role="tab" aria-controls="personal-settings" aria-selected="true">Personal Settings</a>
  </li>
  <li class="nav-item">
    <a class="a nav-link text-dark" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Enrolled Courses</a>
  </li>
  <li class="nav-item">
    <a class="a nav-link text-dark" id="add-courses-tab" data-toggle="tab" href="#add-courses" role="tab" aria-controls="courses" aria-selected="false">Add Courses</a>
  </li>
  <li class="nav-item">
    <a class="a nav-link bg-danger text-white" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="courses" aria-selected="false">Delete Student</a>
  </li>
</ul>
<?php


  
?>
  <!-- tabs content section -->
<div class="tab-content  col-12" id="myTabContent">
  <!-- personal settings tab -->
  <div class="tab-pane fade tabs-style " id="add-courses" role="tabpanel" aria-labelledby="home-tab">
    <h1 class='m-0'>Add Courses</h1>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Course</th>
      <th scope="col">Description</th>
      <th scope="col">Enroll</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $allCourses = $cbl->get();
  $studentEnrolled = $studentInfo->getCourseModelArray();
  $notEnrolledCourses = array_udiff($allCourses, $studentEnrolled,
  function ($obj_a, $obj_b) {
    return $obj_a->course_id - $obj_b->course_id;
  }
);
  foreach ($studentInfo->getCourseModelArray() as $course) { 
      ?>
    <tr>
      <td>
      <div class="row">
      <div class="col-12">
      <img src="..\uploads\courses\courses-cover-images\<?php echo $course->course_image ?>" alt="">
      </div>
      <div class="col-12">
      <?php echo $course->course_name ?>
      </div>
      </div>
      </td>
      <td><?php echo $course->course_description ?>
      <div class="row">
      <div class="col-2">
      <h1 style='color:green'>Enrolled</h1>
      </div>
      <div class="col-3">
        </div>
      </div>
    </td>
    <td>
        <img style='max-width:80px' src="../assets/images/statistics/check.png" alt="">
      </td>
    </tr>
    <?php 
    } 
    foreach ($notEnrolledCourses as $course) {

      ?>
         <tr>
      <td>
      <div class="row">
      <div class="col-12">
      <img src="..\uploads\courses\courses-cover-images\<?php echo $course->course_image ?>" alt="">
      </div>
      <div class="col-12">
      <?php echo $course->course_name ?>
      </div>
      </div>
      </td>
      <td><?php echo $course->course_description ?></td>
      <td><input type="checkbox" class='form-control' value='<?php echo $course->course_id ?>' name="courses[]"></td>
    </tr>

     <?php 
    }
     ?>
  </tbody>
</table>
<?php 
if (!empty($notEnrolledCourses)) {
?>
<div align=right>
  <button name='add-courses' value='<?php echo $studentInfo->student_id ?>' class='btn btn-lg btn-success'>Add Selected Courses</button>
</div>
<?php
}
?>
</div>

  <div class="tab-pane fade tabs-style show active in" id="personal-settings" role="tabpanel" aria-labelledby="home-tab">
  <div class="row text-center">
  <div class="col-12">
  <h1 class='m-0'>personal settings</h1>
  </div>
  <!-- name
  phone 
  email
  image -->
  <div class="col-12 w-100">
  <label>Image

  <div class="card" style="width: 10rem;">
  <img class="card-img-top" style='max-width:200px; max-height:160px;' src="../uploads/profiles/images/students/<?php echo $studentInfo->student_image ?>" alt="Card image cap">
  <div class="card-body mx-auto">
  </div>
  </div>

  </label>
  </div>
  <div class="col-12 ">
  <label>Change Image
            <div class="custom-file">
                <input name='student-image' type="file" class="custom-file-input" value='..\uploads\profiles\images\students\defaultStudent.png' id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
            </label>

  </div>
  <div class="col-12">
  <label>Name
  <input name='student-name' type="text" class='form-control' value='<?php echo $studentInfo->student_name ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Phone
  <input name='student-phone' type="text" class='form-control' value='<?php echo $studentInfo->student_phone ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Email
  <input name='student-email' type="text" class='form-control' value='<?php echo $studentInfo->student_email ?>'>
  </label>
  </div>
  
  <div class="col-12">
  <button name='update-student' value='<?php echo $studentInfo->student_id ?>' class='btn btn-sm btn-success my-4'>Save Changes</button>
  </div>
  </div>
  </div>


  <!-- courses tab -->
  <div class="tab-pane fade tabs-style" id="courses" role="tabpanel" aria-labelledby="courses-tab">
  <div class="row">
  <div class="col-xs-5">
  <h1 class='m-0'>Enrolled Courses</h1>
  </div>
 
  </div>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Course</th>
      <th scope="col">Description</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($studentInfo->getCourseModelArray() as $course) { 
      ?>
    <tr>
      <td>
      <div class="row">
      <div class="col-12">
      <img src="..\uploads\courses\courses-cover-images\<?php echo $course->course_image ?>" alt="">
      </div>
      <div class="col-12">
      <?php echo $course->course_name ?>
      </div>
      </div>
      </td>
      <td><?php echo $course->course_description ?></td>
      <td><input type="checkbox" class='form-control' name="removed-courses[]" value='<?php echo $course->course_id ?>'></td>
    </tr>

    <?php 
    }
    ?>
  </tbody>
</table>
<?php
if (!empty($studentInfo->getCourseModelArray())) {
?>
<div align=right>
  <button name='remove-courses' value='<?php echo $studentInfo->student_id ?>' class='btn btn-lg btn-danger'>Remove Selected</button>
  </div>
  <?php
}
?>
  </div>

  <!-- Delete Student tab -->
  <div class="tab-pane fade tabs-style text-center" id="delete" role="tabpanel" aria-labelledby="delete-tab">
  <div class="row">
  <div class="col-12 my-5">
  <h2>Delete Student</h2>
  <p class='text-muted'>Student Name: <?php echo $studentInfo->student_name ?></p>
  <p class='text-muted'>Student Phone: <?php echo $studentInfo->student_phone ?></p>
  <p class='text-muted'>Student Email: <?php echo $studentInfo->student_email ?></p>
  <!-- todo make it fetch the number of courses that the student is enrolled -->
  <!-- <p class='text-muted'>Student Courses: </p> -->
  </div>
  <div class="col-12">
  </div>
  <div class="col-12">
  <label>Password
  
  <input name='admin-password' type="password" class='form-control' placeholder='re-enter your password.' name="" id="">
  </label>
 
  </div>
  <div class="col-12 text-center">
  <button name='delete-student' value='<?php echo $studentInfo->student_id ?>' class='btn btn-sm btn-danger my-4'>Delete</div>
  </div>
  </div>
  </div>
</div>
</div>

<script>

$(document).ready(() => {
  
  // $('#personal-settings').addClass('');

});

</script>