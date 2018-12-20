<?php

  if (
  isset($_POST['add-student']) &&
  isset($_POST['student-name']) &&
  isset($_POST['student-phone']) &&
  isset($_POST['student-email']) &&
  isset($_FILES['student-image'])) {

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
              Add New Student
            </h4>
            </div>

            <div class="card-body text-default">
            <h5 class="card-title"></h5>
            <label>Student Name
              <input name='student-name' type="text" class='form-control'>
            </label>
            <label>Student Phone
                <input name='student-phone' type="text" class='form-control'>
            </label>
            <label>Student Email
                <input name='student-email' type="text" class='form-control'>
            </label>
            <label>Student Image
            <div class="custom-file">
                <input name='student-image' type="file" class="custom-file-input" id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
            </label>
          </div>
          <div class="card-footer bg-dark border-default">
            <button name='add-student' class='btn btn-lg btn-success'>Add Student</button>
          </div>
        </div>
      </div>
      
