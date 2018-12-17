<?php
    $student = $sbl->getOne(Session::get('edit-mode'));
?>
<div class="row">
<div class="col-12">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="edit-details-tab" data-toggle="tab" href="#edit-details" role="tab" aria-controls="edit-details" aria-selected="true">Edit Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="edit-enrolled-tab" data-toggle="tab" href="#enrolled" role="tab" aria-controls="enrolled" aria-selected="false">Enrolled Students</a>
  </li>
  <li class="nav-item">
    <a class="nav-link bg-danger text-white" id="delete-tab" data-toggle="tab" href="#delete-course" role="tab" aria-controls="courses" aria-selected="false">Delete</a>
  </li>
</ul>


  <!-- tabs content section -->
<div class="tab-content" id="myTabContent">
  <!-- personal settings tab -->
  <div class="tab-pane fade show active" id="edit-details" role="tabpanel" aria-labelledby="home-tab">
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
  <input type="text" class='form-control' value='<?php echo $student->student_name ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Phone
  <input type="text" class='form-control' value='<?php echo $student->student_phone ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Email
  <input type="text" class='form-control' value='<?php echo $student->student_email ?>'>
  </label>
  </div>
  
  <div class="col-12">
  <button class='btn btn-sm btn-success'>Save Changes</button>
  </div>
  </div>
  </div>


  <!-- courses tab -->
  <div class="tab-pane fade" id="enrolled" role="tabpanel" aria-labelledby="enrolled-tab">
  <h1>Courses</h1>
  </div>

  <!-- Delete Student tab -->
  <div class="tab-pane fade" id="delete-course" role="tabpanel" aria-labelledby="delete-tab">
  <div class="row">
  <div class="col-12">
  <h2>Delete Student</h2>
  <p class='text-muted'>Student Name: <?php echo $student->student_name ?></p>
  <p class='text-muted'>Student Phone: <?php echo $student->student_phone ?></p>
  <p class='text-muted'>Student Email: <?php echo $student->student_email ?></p>
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