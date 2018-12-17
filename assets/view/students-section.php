
<div class="col-xs-6 mx-2  order-3 order-lg-2">
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
  <h4>Students</h4>
    <div  align=right>
        <button class='btn btn-danger'>+</button>
    </div>
  </li>
  <?php foreach ($allStudents as $index => $student) {
    
    ?>  
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <button class='btn btn-info' name='student' value='<?php echo $student->student_id ?>'>
      <div class="row">
        <div class="col-md-4">
          <img style="width:100px; height:100px;" src="https://pixabay.com/get/e833b10c2ae9002ad25a5840981318c3fe76e7d11db4184794f3c1/concentration-16032_1920.jpg" alt="student-image">
          <!-- <img style="width:100px; height:100px;" src="<?php echo $student->student_image ?>" alt="student-image"> -->
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <p><?php echo $student->student_name ?></p>
          <p class=''><?php echo $student->student_phone ?></p>
        </div>
      </div>
    </button>
  </li>
  <?php
  } ?>
</ul>
</div>

