
<div class="row w-100">
<div class="col-12">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<?php 
if ($loggedAdmin[0]->admin_role <= 2) {
?>
  <li class="nav-item">
    <a class="nav-link" id="edit-details-tab" data-toggle="tab" href="#edit-details" role="tab" aria-controls="edit-details" aria-selected="true">Edit Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete-course" role="tab" aria-controls="courses" aria-selected="false">Delete Course</a>
  </li>
  <?php
}
?>
  <li class="nav-item">
    <a class="nav-link active" id="edit-enrolled-tab" data-toggle="tab" href="#enrolled" role="tab" aria-controls="enrolled" aria-selected="false">Enrolled Students</a>
  </li>

</ul>


  <!-- tabs content section -->
<div class="tab-content col-12" id="myTabContent">

<?php 
if ($loggedAdmin[0]->admin_role <= 2) {
?>
  <!-- Course Details tab -->
  <div class="tab-pane fade text-center tabs-style" id="edit-details" role="tabpanel" aria-labelledby="home-tab">
  <h1>Course Details</h1>
  <div class="row">
  <div class="col-12">
  <label>Image
  <div class="card" style="width: 10rem;">
  <img id='imagePre' class="card-img-top" src="../uploads/courses/courses-cover-images/<?php echo $selectedCourse->course_image ?>" alt="Card image cap">
  <div class="card-body mx-auto">
  </div>
  </div>

  </label>
  </div>
  <div class="col-12">
  <label>Change Image
            <div class="custom-file">
                <input name='course-image' onchange="readURL(this);" type="file" class="custom-file-input" id="inputGroupFile02"> 
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
            </label>
  </div>
  <div class="col-12">
  <label>Name
  <input name='course-name' type="text" class='form-control' value='<?php echo $selectedCourse->course_name ?>'>
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
  <button name='save-course' value='<?php echo $selectedCourse->course_id ?>' class='btn btn-lg btn-success my-4'>Save Changes</button>
  </div>
  </div>
  </div>
  <?php
}
?>

  <!-- Enrolled Students tab -->
  <div class="tab-pane fade tabs-style show active in " id="enrolled" role="tabpanel" aria-labelledby="enrolled-tab">
  <h1>Enrolled Students</h1>
  <div class="row my-2">
    
    <div class="col-sm-8 col-md-10 text-left">
      <button name='r-s-s' type='submit' value='<?php echo $selectedCourse->course_id ?>' class='btn btn-danger mr-2' id='delete-students'>Remove Selected</button> 
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
      <td class='checkSingle border border-white'><input value='<?php echo $student->student_id ?>' type="checkbox" class='form-control' name="s-s[]" id=""></td>
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
  <?php
  if (!CourseController::getAllEnrolled($selectedCourse->course_id)->getStudentModelArray()) {
  ?>
  <div class="col-12">
  <label>Password
  <input name='admin-password' type="password" class='form-control' placeholder='re-enter your password.'>
  </label>
  </div>
 
  <div class="col-12 text-center">
  <button name='delete-course' value='<?php echo $selectedCourse->course_id ?>' class='btn btn-sm btn-danger my-4'>Delete</button>
  </div>
  <?php
  } else {
    ?>
  <div class="col-12 text-center">
    <h1 class='text-danger'><i class="fa fa-lock" aria-hidden="true"></i></h1>
  <h2 class='text-danger'>Cannot Delete When Students Are Enrolled!</h2>
  <h3 class='text-danger'>Remove Students Before Deleting.</h3>
  </div>
<?php
  }
  ?>
  </div>
  </div>
</div>
  </div>
</div>
</div>


<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePre').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
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