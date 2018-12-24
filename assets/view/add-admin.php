<?php

  if (
  isset($_POST['add-student']) &&
  isset($_POST['student-name']) &&
  isset($_POST['student-phone']) &&
  isset($_POST['student-email'])) {

    $studentDetails = [
      'student_name' => $_POST['student-name'],
      'student_phone' => $_POST['student-phone'],
      'student_email' => $_POST['student-email'],
      'student_image' => $_FILES['student-image'],
    ];


    if(StudentController::validateForm($studentDetails)) {
      StudentController::uploadStudent($studentDetails);
      
    }

  }
?>
  
  <div class="col-lg-3 order-1 order-lg-3">
        <div class="card border-default mb-3 bg-card text-center">
            <div class="card-header bg-dark border-default">
            <h4>
              Add New Admin
            </h4>
            </div>

            <div class="card-body text-default">
            <h5 class="card-title">
            <div id="preview">
            <img width="160px" height="120px" src="../uploads/profiles/images/students/defaultStudent.png" alt='Image Preview' id="imagePre" />
        </div>
            </h5>
            <label>Admin Name
              <input name='student-name' type="text" class='form-control'>
            </label>
            <label>Admin Phone
                <input name='student-phone' type="text" class='form-control'>
            </label>
            <label>Admin Email
                <input name='student-email' type="text" class='form-control'>
            </label>
            <label>Admin Role
                <input name='student-email' type="text" class='form-control'>
            </label>
            <label>Admin Image
            <div class="custom-file">
                <input name='student-image' onchange="readURL(this);" value='default-image' type="file" class="custom-file-input" id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
            </label>
          </div>
          <div class="card-footer bg-dark border-default">
            <button name='add-student' class='btn btn-lg btn-success'>Add Student</button>
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
