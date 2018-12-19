
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
    <a class="nav-link bg-danger text-white" id="delete-tab" data-toggle="tab" href="#delete-course" role="tab" aria-controls="courses" aria-selected="false">Delete / Disable</a>
  </li>
</ul>


  <!-- tabs content section -->
<div class="tab-content" id="myTabContent">


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
  <div class="tab-pane fade text-center tabs-style" id="enrolled" role="tabpanel" aria-labelledby="enrolled-tab">
  <h1>Enrolled Students</h1>
  </div>


  <!-- delete tab -->
  <div class="tab-pane fade text-center tabs-style" id="delete-course" role="tabpanel" aria-labelledby="enrolled-tab">
  <h1>Delete Course</h1>
  </div>

</div>