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
              Add New Student
            </h4>
            </div>

            <div class="card-body text-default">
            <h5 class="card-title">
            <div id="preview">
            <img width="160px" height="120px" src="../uploads/profiles/images/students/defaultStudent.png" alt='Image Preview' id="imagePre" />
        </div>
            </h5>
            <label>Student Name
              <input name='student-name' type="text" class='form-control add-validation'>
            </label>
            <label>Student Phone <span id='phoneWarn'></span>
                <input id="phone" name='student-phone' type="text" class='form-control add-validation'>
            </label>
            <label>Student Email <span id='emailWarn'></span>
                <input id='email' name='student-email' type="text" class='form-control add-validation'>
            </label>
            <label>Student Image
            <div class="custom-file">
                <input name='student-image' onchange="readURL(this);" value='default-image' type="file" class="custom-file-input" id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"></label>
            </div>
            </label>
          </div>
          <div class="card-footer bg-dark border-default">
            <button name='add-student' id='add-student' class='btn btn-lg btn-success' disabled>Add Student</button>
          </div>
        </div>
      </div>
      <?php
      $allStudentsArr = $sbl->get();
      $allStudentNumbers = [];
      $allStudentEmails = [];

      foreach ($allStudentsArr as $student) {
        array_push($allStudentNumbers, $student->student_phone);
        array_push($allStudentEmails, $student->student_email);
      }
      ?>
      <script type="text/javascript">
      const numbersArr = <?php echo json_encode($allStudentNumbers); ?>;
      const emailArr = <?php echo json_encode($allStudentEmails); ?>;

      $(document).ready(() => {
        const numInput = $('#phone');
        const emailInput = $('#email');
        $('#phone').keyup((key) => { 
          numbersArr.forEach(number => {
            if(number === numInput.val()) {
              numInput.css('border', '1px solid red');
              $('#phoneWarn').html('<i class="fa fa-times-circle" aria-hidden="true"></i>').css('color', 'red');
            } else if (numInput.val().length < 9 || numInput.val().length > 10) {
              $('#phoneWarn').html('<i class="fa fa-times-circle" aria-hidden="true"></i>').css('color', 'red');
              numInput.css('border', '1px solid red');
            } else if (!Number(numInput.val())) {
              $('#phoneWarn').html('<i class="fa fa-times-circle" aria-hidden="true"></i>').css('color', 'red');
              numInput.css('border', '1px solid red');
            } else {
              $('#phoneWarn').html('<i class="fa fa-check" aria-hidden="true"></i>').css('color', 'green');
              numInput.css('border', '1px solid green');
            }
          });
        });
        $('#email').keyup((key) => { 
          emailRegx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          
          invalid = 0;
          emailArr.forEach(email => {
            if (email == emailInput.val()) {
              invalid += 1;
              $('#emailWarn').html('<i class="fa fa-times-circle" aria-hidden="true"></i> In Use').css('color', 'red');
            } else if (!emailRegx.test(emailInput.val()))  {
              invalid += 1;
              $('#emailWarn').html('<i class="fa fa-times-circle" aria-hidden="true"></i>').css('color', 'red');
              emailInput.css('border', '1px solid red');
            } else if (invalid > 0) {
              $('#emailWarn').html('<i class="fa fa-times-circle" aria-hidden="true"></i>').css('color', 'red');
            } else {
              $('#emailWarn').html('<i class="fa fa-check" aria-hidden="true"></i>').css('color', 'green');
              emailInput.css('border', '1px solid green');

            }
          });
        });

        $('input.add-validation').keyup(() => {
          invalid = 0;
          $('input.add-validation').each(function() {
            if ($(this).val() === '') {
              $('#add-student').attr("disabled", true);
              invalid += 1;
            } 
            if (invalid <= 0) {
              $('#add-student').attr("disabled", false);
            }
          }); 
        })
      });
      
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
