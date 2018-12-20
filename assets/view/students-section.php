
<div class="col-md-5 col-lg-3 order-3 order-lg-2 bg-sections">
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
  <h4>Students</h4>
    <div  align=right>
        <button name='add-student' class='btn btn-danger'>+</button>
    </div>
  </li>
  <?php foreach ($allStudents as $index => $student) {
    
    ?>  
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <button class='btn section-btn' name='student<?php echo $student->student_id ?>' value='<?php echo $student->student_id ?>'>
      <div class="row">
        <div class="col-md-4">
          <img style="width:100px; height:100px;" src="../uploads/profiles/images/students/<?php echo $student->student_image ?>" alt="student-image">
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

