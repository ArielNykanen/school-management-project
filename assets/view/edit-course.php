
<div class="row w-100">
<div class="col-12">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="edit-details-tab" data-toggle="tab" href="#edit-details" role="tab" aria-controls="edit-details" aria-selected="true">Edit Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="edit-enrolled-tab" data-toggle="tab" href="#enrolled" role="tab" aria-controls="enrolled" aria-selected="false">Enrolled Students</a>
  </li>
  <li class="nav-item">
    <a class="nav-link bg-danger text-white" id="delete-tab" data-toggle="tab" href="#delete-course" role="tab" aria-controls="courses" aria-selected="false">Delete / Disable</a>
  </li>
</ul>


  <!-- tabs content section -->
<div class="tab-content col-12" id="myTabContent">


  <!-- Course Details tab -->
  <div class="tab-pane fade show active in text-center tabs-style" id="edit-details" role="tabpanel" aria-labelledby="home-tab">
  <h1>Course Details</h1>
  <div class="row">
  <div class="col-12">
  <label>Image
  <div class="card" style="width: 10rem;">
  <img class="card-img-top" src="../uploads/courses/courses-cover-images/<?php echo $selectedCourse->course_image ?>" alt="Card image cap">
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
  <input type="text" class='form-control' value='<?php echo $selectedCourse->course_name ?>'>
  </label>
  </div>
  <div class="col-12">
  <label>Course Description
  <textarea name='course-description' cols="30" rows="10" class='form-control'>
  <?php echo $selectedCourse->course_description ?>
  </textarea>
  </label>
  </div>
    <div class="col-12 text-center">
        <label>Max Students To Enroll
          <input class='form-control w-50 text-center m-auto' type="number" name="max-enroll" value='<?php echo $selectedCourse->course_max_students ?>'>
        </label>
    </div>
  <div class="col-12">
  <button class='btn btn-lg btn-success my-4'>Save Changes</button>
  </div>
  </div>
  </div>


  <!-- Enrolled Students tab -->
  <div class="tab-pane fade tabs-style" id="enrolled" role="tabpanel" aria-labelledby="enrolled-tab">
  <h1>Enrolled Students</h1>
  <div class="row my-2">
    
    <div class="col-sm-8 col-md-10 text-left">
      <button type='button' class='btn btn-danger mr-2' id='delete-students'>Remove Selected</button> 
    </div>
    <div class=" col-2" align=right>
      <button type='button' class='btn btn-primary mr-5' style='width:120px;' id='check-all'>Check All</button>
      <button type='button' class='btn btn-primary mr-5' id='unCheck-all' style='display:none; width:120px;'>Uncheck All</button> 
    </div>
  </div>

  <div id='checkWrap' class="text-right">
  </div>
  <table class="table border border-white">
  <thead class="thead-dark">
    <tr>
      <th class='border border-white' scope="col">Student</th>
      <th class='border border-white' scope="col">Email</th>
      <th class='border border-white' scope="col">Phone</th>

      <th class='border border-white' scope="col"><p>Remove</p>
           
      </th>
    </tr>
  </thead>
  <tbody>
  <?php
  $studentsInCourse = $cbl->getOne($selectedCourse->course_id, true);
  foreach ($studentsInCourse->getStudentModelArray() as $student) { 
      ?>
    <tr>
      <td class='border border-white'>
      <img src="..\uploads\profiles\images\students\<?php echo $student->student_image ?>" style='max-height:40px;' alt="student image">
      <?php echo $student->student_name ?>
      </td>
      <td class='border border-white'><?php echo $student->student_email ?></td>
      <td class='border border-white'><?php echo $student->student_phone ?></td>
      <td class='checkSingle border border-white'><input type="checkbox" class='form-control' name="students[]" id=""></td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
  </div>


  <!-- delete tab -->
  <div class="tab-pane fade text-center tabs-style" id="delete-course" role="tabpanel" aria-labelledby="enrolled-tab">
  <div class="row">
  <div class="col-12 my-5">
  <h2>Delete Course</h2>
  <img src="../uploads/courses/courses-cover-images/<?php echo $selectedCourse->course_image ?>" alt="">
  <p class='text-muted'>Course Name: <?php echo $selectedCourse->course_name ?></p>
  <p class='text-muted'>Course Description: <?php echo $selectedCourse->course_description ?></p>
  <!-- todo make it fetch the number of students in -->
  </div>
  <div class="col-12">
  <label>Password
  <input type="password" class='form-control' placeholder='re-enter your password.'>
  </label>
  </div>
  <div class="col-12 text-center">
  <button class='btn btn-sm btn-danger m-4'>Delete</button>
  </div>
  </div>
  </div>
</div>
  </div>
</div>
</div>
<script>

$(document).ready(function() {

  $("#check-all").click(function(){
    var all = $('input:checkbox');
    for (let i = 0; i < all.length; i++) {
      all[i].checked = true;
    }
    $("#check-all").css('display', 'none');
    $("#unCheck-all").css('display', 'block');    
  });

  $("#unCheck-all").click(function(){
    var all = $('input:checkbox');
    for (let i = 0; i < all.length; i++) {
      all[i].checked = false;
    }
    $("#check-all").css('display', 'block');
    $("#unCheck-all").css('display', 'none');
  });

  
    
    

});
</script>