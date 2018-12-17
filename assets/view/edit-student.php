<?php
   $studentInfo = $sbl->getOne(Session::get('edit-mode'), true);
?>
<div class="row w-100">
<div class="col-12">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#personal-settings" role="tab" aria-controls="personal-settings" aria-selected="true">Personal Settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-dark" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Enrolled Courses</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-dark" id="add-courses-tab" data-toggle="tab" href="#add-courses" role="tab" aria-controls="courses" aria-selected="false">Add Courses</a>
  </li>
  <li class="nav-item">
    <a class="nav-link bg-danger text-white" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="courses" aria-selected="false">Delete Student</a>
  </li>
</ul>


  <!-- tabs content section -->
<div class="tab-content" id="myTabContent">
  <!-- personal settings tab -->
  <div class="tab-pane fade show active" id="personal-settings" role="tabpanel" aria-labelledby="home-tab">
  <h1>personal-settings</h1>
  <!-- name
  phone 
  email
  image -->
  <div class="row">
  <div class="col-12">
  <label>Image

  <div class="card" style="width: 10rem;">
  <img class="card-img-top w-25" src="..." alt="Card image cap">
  <div class="card-body mx-auto">
  </div>
  </div>

  </label>
  </div>
  <div class="col-12">
  <button class="btn btn-sm btn-default">Change Image</button>
  </div>
  <div class="col-12">
  <label>Name
  <input type="text" class='form-control' value='<?php echo $studentInfo->student_name ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Phone
  <input type="text" class='form-control' value='<?php echo $studentInfo->student_phone ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Email
  <input type="text" class='form-control' value='<?php echo $studentInfo->student_email ?>'>
  </label>
  </div>
  
  <div class="col-12">
  <button class='btn btn-sm btn-success'>Save Changes</button>
  </div>
  </div>
  </div>


  <!-- courses tab -->
  <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
  <div class="row">
  <div class="col-xs-5">
  <h1>Enrolled Courses</h1>
  </div>
  <div class="col-xs-3 ml-auto my-auto mr-4">
  <button class='btn btn-sm btn-warning'>Remove Selected</button>
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
      <?php echo $course->course_image ?>
      </div>
      <div class="col-12">
      <?php echo $course->course_name ?>
      </div>
      </div>
      </td>
      <td><?php echo $course->course_description ?></td>
      <td><input type="checkbox" class='form-control' name="courses[]" id=""></td>
    </tr>

    <?php 
    }
    ?>
  </tbody>
</table>
  </div>

  <!-- Delete Student tab -->
  <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
  <div class="row">
  <div class="col-12">
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
  
  <input type="text" class='form-control' placeholder='re-enter your password.' name="" id="">
  </label>
 
  </div>
  <div class="col-12 text-left">
  <button class='btn btn-sm btn-danger'>Delete</button>
  </div>
  </div>
  </div>
</div>



</div>