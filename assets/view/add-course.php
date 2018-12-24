
  <?php
  if (
    isset($_POST['add-course']) &&
    isset($_POST['course-name']) &&
    isset($_POST['course-description']) &&
    isset($_FILES['course-image']) &&
    isset($_POST['course-max-students'])) {
  
      $courseDetails = [
        'course_name' => $_POST['course-name'],
        'course_description' => $_POST['course-description'],
        'course_image' => $_FILES['course-image'],
        'course_max_students' => $_POST['course-max-students'],
      ];

    if (CourseController::validateForm($courseDetails)) {
        CourseController::uploadCourse($courseDetails);
    }
  
  }

  ?>
  
  <div class="col-lg-3 order-1 order-lg-3">
        <div class="card border-default mb-3 bg-card text-center">
            <div class="card-header bg-dark border-default">
            <h4>
              Add New Course
            </h4>
            </div>

            <div class="card-body text-default">
            <h5 class="card-title">
            <div id="preview">
            <img width="160px" height="120px" src="../assets/images/statistics/defaultImagePL.png" alt='Image Preview' id="imagePre" />
        </div>
            </h5>
            <div class="row">
              <div class="col-12">
                <label>Course Name
                  <input name='course-name' type="text" class='form-control'>
                </label>
              </div>
              <div class="col-12">
                <label>Course Description
                  <textarea class='form-control' name="course-description" cols="30" rows="10"></textarea>
                </label>
              </div>
              <div class="col-12">

                <label>Course Image
                  <div class="custom-file">
                    <input  name='course-image' onchange="readURL(this);" type="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
                  </div>
                </label>
                <div class="col-12" align=center>
                  <label>Course Max Students
                    <input  name='course-max-students' type="number" class='form-control w-50 '>
                  </label>
                </div>
            </div>
          </div>
          </div>
          <div class="card-footer bg-dark border-default">
            <button name='add-course' class='btn btn-lg btn-success'>Add Course</button>
          </div>
        </div>
      </div>
      
      <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePre').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>